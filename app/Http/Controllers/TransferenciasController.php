<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transferencia;
use App\Detallestransferencia;
use App\Producto;
use App\Tipo;

class TransferenciasController extends Controller
{
	public function index(Request $request)
	{
		$newId = 0;
		$lastTransferencia = \DB::table('transferencias')->max('id');
		if ($lastTransferencia)
			$newId = $lastTransferencia;
		$newId += 1;

	
		if($request->alert)
		{
			return view('transferencias.index', ['newId' => $newId, 'alert' => $request->alert]);
		}
		
		return view('transferencias.index', ['newId' => $newId]);
	}

	public function process(Request $request)
	{
		$success = false;
		\DB::beginTransaction();
		
		try
		{
			$transferencia = new Transferencia;
			$transferencia->id = $request->transferencia_id;
			$transferencia->sucursal_id = \Auth::user()->sucursal()->id;
			$transferencia->sucursal_hasta_id = $request->sucursal_id;
			$transferencia->user_id = \Auth::user()->id;
			$transferencia->save();

			foreach ($request->productos as $producto)
			{
				$detalleTransferencia = new Detallestransferencia;
				$detalleTransferencia->transferencia_id = $request->transferencia_id;
				$detalleTransferencia->producto_id = $producto["id"];
				$detalleTransferencia->cantidad = $producto["cantidad"];
				$detalleTransferencia->precio = $producto["precio"];
				$detalleTransferencia->save();

				$p = Producto::find($producto["id"]);
				if(!(($p->stock - $producto["cantidad"]) >= 0))
				{
					$success = false;
					break;
				}
			
				$p->stock -= $producto["cantidad"];
				$p->save();
				$query = DB::table('productos')
					->where('sucursal_id', $transferencia->sucursal_hasta_id)
					->where('tipo_id', $p->tipo->id)
					->first();

				if ($query) {
					$exist = Producto::find($query->id);
					$exist->stock += $producto["cantidad"];
					$exist->precio = $producto["precio"];
					$exist->save();
				}
				else
				{
					$new = new Producto;
					$new->tipo_id = $p->tipo->id;
					$new->sucursal_id = $transferencia->sucursal_hasta_id;
					$new->precio = $producto["precio"];
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
				'message' => 'La transferencia nº ' . $transferencia->id . ' fué generada satisfactoriamente :). ',
				'actions' => [
					['name' => 'Imprimir', 'value' => action('TransferenciasController@printer') . '?id=' . $transferencia->id],
				]
			];

			return redirect()->action('TransferenciasController@index', ['alert' => $alert]);
		}
		else
		{
			\DB::rollback();
		}

	}

	public function printer(Request $request)
	{
		$r = Transferencia::find($request->id);
		if($r)
			return view('transferencias.printer', ['transferencia' => $r]);
	}

	public function search(Request $request)
	{
		dd($request->all());
	}
}
