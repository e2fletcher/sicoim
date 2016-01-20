<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Venta;
use App\Detallesventa;
use App\Producto;
use Carbon\Carbon;

class VentasController extends Controller
{
	public function index(Request $request)
	{
		$newId = 0;
		$lastVenta = \DB::table('ventas')->max('id');
		if ($lastVenta)
			$newId = $lastVenta;
		$newId += 1;

	
		if($request->alert)
		{
			return view('ventas.index', ['newId' => $newId, 'alert' => $request->alert]);
		}
		
		return view('ventas.index', ['newId' => $newId]);
	}

	public function process(Request $request)
	{
		$success = false;

		\DB::beginTransaction();
		
		try
		{
			$venta = new Venta;
			$venta->id = $request->venta_id;
			$venta->cliente_id = $request->cliente_id;
			$venta->sucursal_id = \Auth::user()->sucursal()->id;
			$venta->user_id = \Auth::user()->id;
			$venta->save();

			foreach ($request->productos as $producto)
			{
				$detalleVenta = new Detallesventa;
				$detalleVenta->venta_id = $request->venta_id;
				$detalleVenta->producto_id = $producto["id"];
				$detalleVenta->cantidad = $producto["cantidad"];
				$detalleVenta->precio = $producto["precio"];
				$detalleVenta->save();

				$p = Producto::find($producto["id"]);
				if(!(($p->stock - $producto["cantidad"]) >= 0))
				{
					$success = false;
					break;
				}
			
				$p->stock -= $producto["cantidad"];
				$p->save();
			}
		
			$success = true;
		
		}
		catch (Exception $e)
		{
		
		}
		
		if ($success)
		{
			\DB::commit();
			
			$alert =
			[
				'type' => 'success',
				'message' => 'La venta nº ' . $venta->id . ' fué generada satisfactoriamente :). ',
				'actions' => [
					['name' => 'Imprimir', 'value' => action('VentasController@printer') . '?id=' . $venta->id],
				]
			];

			return redirect()->action('VentasController@index', ['alert' => $alert]);
		}
		else
		{
			\DB::rollback();
		}

	}

	public function printer(Request $request)
	{
		$r = Venta::find($request->id);
		if($r)
			return view('ventas.printer', ['venta' => $r]);
	}

	public function search(Request $request)
        {
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            $query = DB::table('ventas')
            ->whereDate('created_at', '=' , $date)
            ->where('sucursal_id', \Auth::user()->sucursal()->id);
        
            if($query->count() >= 1)
            {
                $ve = $query->get();

                foreach($ve as $v)
                {
                    $ventas[] = Venta::find($v->id);
                }

                return view('ventas.report', ['ventas' => $ventas]);
            }
        else
        {
            $alert =
                [
		    'type' => 'danger',
		    'message' => 'No existen ventas para esta fecha ;( '
		];

	    return redirect()->action('VentasController@index', ['alert' => $alert]);
        }
    }
}
