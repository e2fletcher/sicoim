<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ventas;
use App\Detallesventa;
use App\Producto;

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
			return view('ventas_index', ['newId' => $newId, 'alert' => $request->alert]);
		}
		
		return view('ventas_index', ['newId' => $newId]);
	}

	public function process(Request $request)
	{
		dd($request->all());
		$success = false;

		\DB::beginTransaction();
		
		try
		{
			$venta = new Venta;
			$venta->id = $request->venta_id;
			$venta->proveedor_id = $request->proveedor_id;
			$venta->sucursal_id = \Auth::user()->sucursal()->id;
			$venta->user_id = \Auth::user()->id;
			$venta->save();

			foreach ($request->productos as $producto)
			{
				$detalles = new Detallesventa;
				$detalles->venta_id = $request->venta_id;
				$detalles->tipo_id = $producto["tipo_id"];
				$detalles->cantidad = $producto["cantidad"];
				$detalles->precio = $producto["tipo_precio"];
				$detalles->caducidad = $producto["caducidad"];
				$detalles->save();

				$query = DB::table('productos')
					->where('sucursal_id', \Auth::user()->sucursal()->id)
					->where('tipo_id', $producto["tipo_id"])
					->first();

				if ($query) {
					$exist = Producto::find($query->id);
					$exist->stock += $producto["cantidad"];
					$exist->precio = $producto["tipo_precio"];
					$exist->save();
				}
				else
				{
					$new = new Producto;
					$new->tipo_id = $producto["tipo_id"];
					$new->sucursal_id = \Auth::user()->sucursal()->id;
					$new->precio = $producto["tipo_precio"];
					$new->stock = $producto["cantidad"];
					$new->save();
				}
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
				'message' => 'La recepción nº ' . $venta->id . ' fué generada satisfactoriamente :). ',
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
		dd($request->all());
	}

	public function destroy(Request $request)
	{
		dd($files);
	}

	public function search(Request $request)
	{
		dd($request->all());
	}
}
