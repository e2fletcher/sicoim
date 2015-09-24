<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Redirect;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tipo;

class TiposController extends Controller
{
	
	public function index(Request $request)
	{
		if($request->search)
		{
			$tipos = DB::table('tipos')
				->where('codigo', 'like', '%' . $request->search . '%')
				->orWhere('nombre', 'like', '%' . $request->search . '%')
				->orWhere('generic_tipo', 'like', '%' . $request->search . '%')
				->orWhere('origen', 'like', '%' . $request->search . '%')
				->paginate(5);
		}
		else
		{
			$tipos = DB::table('tipos')->paginate(5);
		}
		
		if($request->alert)
		{
			return view('tipos_index', ['tipos' => $tipos, 'alert' => $request->alert]);
		}

		return view('tipos_index', ['tipos' => $tipos]);
	}

	public function create(Request $request)
	{
		$tipo = new Tipo;
		$tipo->codigo = Str::lower($request->codigo);
		$tipo->generic_tipo = $request->generic_tipo;
		$tipo->nombre = $request->nombre;
		$tipo->origen = $request->origen;
		$tipo->precio = $request->precio;
		$tipo->presentacion = $request->presentacion;
		$tipo->cantidad = $request->cantidad;
		$tipo->unidad = $request->unidad;
		
		$tipo->save();
		
		$alert =
		[
			'type' => 'success',
			'message' => \Lang::get('messages.model-create', ['model' => 'tipo de producto', 'name' => $tipo->nombre])
		];

		return redirect()->action('TiposController@index', ['alert' => $alert]);
	}

	public function update(Request $request)
	{

		$tipo = Tipo::find($request->id);

		$tipo->codigo = Str::lower($request->codigo);
		$tipo->generic_tipo = $request->generic_tipo;
		$tipo->nombre = $request->nombre;
		$tipo->origen = $request->origen;
		$tipo->precio = $request->precio;
		$tipo->presentacion = $request->presentacion;
		$tipo->cantidad = $request->cantidad;
		$tipo->unidad = $request->unidad;

		$tipo->save();

		$alert =
		[
			'type' => 'success',
			'message' => \Lang::get('messages.model-update', ['model' => 'tipo de producto', 'name' => $tipo->nombre])
		];
		
		return redirect()->action('TiposController@index', ['alert' => $alert]);
	}

	public function destroy(Request $request)
	{
		$tipo = Tipo::find($request->id);
		$tipo->delete();
		return $request->id;
	}

	public function search(Request $request)
	{
		if($request->q)
		{
			$tipos = DB::table('tipos')
				->where('codigo', 'like', '%' . $request->q . '%')
				->orWhere('nombre', 'like', '%' . $request->search . '%')
				->orWhere('generic_tipo', 'like', '%' . $request->q . '%');
			
			return response()->json($tipos->get());
		}
	}
}
