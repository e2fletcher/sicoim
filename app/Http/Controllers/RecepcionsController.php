<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recepcion;
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
				for ($i = 0; $i < $producto['cantidad']; $i++) {
					$p = new Producto;
					$p->tipo_id = $producto['tipo_id'];
					$p->sucursal_id = \Auth::user()->sucursal()->id;
					$p->proveedor_id = $request->proveedor_id;
					$p->caducidad = $producto['caducidad'];
					$p->precio = $producto['tipo_precio'];
					$p->estado = 0;
					$p->save();
					$idsProductos[] = $p->id;
				}
			}
			$recepcion->productos()->sync($idsProductos);
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
					['name' => 'Deshacer', 'value' => action('RecepcionsController@destroy') . '?id=' . $recepcion->id],
					['name' => 'Imprimir', 'value' => action('RecepcionsController@printer') . '?id=' . $recepcion->id]
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
		$success = false;

		\DB::beginTransaction();
		
		try
		{
			$recepcion = Recepcion::find($request->id);
			$productos = $recepcion->productos();
			$productos->delete();
			$recepcion->delete();
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
				'type' => 'warning',
				'message' => 'La recepción fué borrada satisfactoriamente :).',
			];

			return redirect()->action('RecepcionsController@index', ['alert' => $alert]);
		}
		else
		{
			\DB::rollback();
		}
	}
}
