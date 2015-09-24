<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recepcion;
use App\Detallesrecepcion;
use App\Producto;

class RecepcionsController extends Controller
{
	public function index(Request $request)
	{
		$newId = 0;
		$lastRecepcion = \DB::table('recepcions')->max('id');
		if ($lastRecepcion)
			$newId = $lastRecepcion;
		$newId += 1;

	
		if($request->alert)
		{
			return view('recepcions_index', ['newId' => $newId, 'alert' => $request->alert]);
		}
		
		return view('recepcions_index', ['newId' => $newId]);
	}

	public function process(Request $request)
	{
		$success = false;

		\DB::beginTransaction();
		
		try
		{
			$recepcion = new Recepcion;
			$recepcion->id = $request->recepcion_id;
			$recepcion->proveedor_id = $request->proveedor_id;
			$recepcion->sucursal_id = \Auth::user()->sucursal()->id;
			$recepcion->user_id = \Auth::user()->id;
			$recepcion->save();

			foreach ($request->productos as $producto)
			{
				$detalles = new Detallesrecepcion;
				$detalles->recepcion_id = $request->recepcion_id;
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
				'message' => 'La recepción nº ' . $recepcion->id . ' fué generada satisfactoriamente :). ',
				'actions' => [
					['name' => 'Imprimir', 'value' => action('RecepcionsController@printer') . '?id=' . $recepcion->id],
				]
			];

			return redirect()->action('RecepcionsController@index', ['alert' => $alert]);
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
	}

	public function search(Request $request)
	{
		dd($request->all());
	}
}