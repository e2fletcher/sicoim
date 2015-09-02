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
	
	public function __construct()
	{
		$this->middleware('auth');
		//$this->middleware('roles:list_tipos');
	}

	public function index(Request $request)
	{
		if($request->search)
		{
			$tipos = DB::table('tipos')
				->where('codigo', 'like', '%' . $request->search . '%')
				->orWhere('nombre', 'like', '%' . $request->search . '%')
				->orWhere('origen', 'like', '%' . $request->search . '%')
				->orWhere('unidad', 'like', '%' . $request->search . '%')
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
		$tipo->nombre = Str::lower($request->nombre);
		$tipo->origen = Str::lower($request->origen);
		$tipo->unidad = Str::lower($request->unidad);
		$tipo->codigo = Str::lower($request->codigo);
		$tipo->cantidad = $request->cantidad;
		$tipo->save();
		
		$alert =
		[
			'title' => 'Elemento agregado!',
			'type' => 'warning',
			'message' => $tipo->nombre . ' fué agregado satisfactoriamente.'
		];

		return redirect()->action('TiposController@index', ['alert' => $alert]);
	}

	public function update(Request $request)
	{
		$tipo = Tipo::find($request->id);
		$tipo->codigo = Str::lower($request->codigo);
		$tipo->nombre = Str::lower($request->nombre);
		$tipo->origen = Str::lower($request->origen);
		$tipo->cantidad = $request->cantidad;
		$tipo->unidad = Str::lower($request->unidad);
		$tipo->save();
		
		$alert =
		[
			'title' => 'Elemento modificado!',
			'type' => 'warning',
			'message' => $tipo->nombre . ' fué editado satisfactoriamente.'
		];
		
		return redirect()->action('TiposController@index', ['alert' => $alert]);
	}

	public function destroy(Request $request)
	{
		$tipo = Tipo::find($request->id);
		$tipo->delete();
		return $request->id;
	}
	}
