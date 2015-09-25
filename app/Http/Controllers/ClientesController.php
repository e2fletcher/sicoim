<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Redirect;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;

class ClientesController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if($request->search)
		{
			$clientes = DB::table('clientes')
				->where('ident', 'like', '%' . $request->search . '%')
				->orWhere('nombre', 'like', '%' . $request->search . '%')
				->orWhere('tipo', 'like', '%' . $request->search . '%')
				->orWhere('email', 'like', '%' . $request->search . '%')
				->orWhere('tlf', 'like', '%' . $request->search . '%')
				->paginate(5);
		}
		else
		{
			$clientes = DB::table('clientes')->paginate(5);
		}
		
		if($request->alert)
		{
			return view('clientes_index', ['clientes' => $clientes, 'alert' => $request->alert]);
		}

		return view('clientes_index', ['clientes' => $clientes]);
	}

	public function create(Request $request)
	{
		$cliente = new Cliente;
		$cliente->ident = Str::lower($request->ident);
		$cliente->nombre = Str::lower($request->nombre);
		$cliente->tipo = $request->tipo;
		$cliente->direccion = Str::lower($request->direccion);
		$cliente->tlf = Str::lower($request->tlf);
		$cliente->email = Str::lower($request->email);
		$cliente->save();
		
		$alert =
		[
			'type' => 'warning',
			'message' => \Lang::get('messages.model-create', ['model' => 'Cliente', 'name' => $cliente->nombre])
		];

		return redirect()->action('ClientesController@index', ['alert' => $alert]);
	}

	public function update(Request $request)
	{
		$cliente = Cliente::find($request->id);
		$cliente->ident = Str::lower($request->ident);
		$cliente->nombre = Str::lower($request->nombre);
		$cliente->tipo = $request->tipo;
		$cliente->direccion = Str::lower($request->direccion);
		$cliente->tlf = Str::lower($request->tlf);
		$cliente->email = Str::lower($request->email);
		$cliente->save();
			
		$alert =
		[
			'type' => 'warning',
			'message' => \Lang::get('messages.model-update', ['model' => 'Cliente', 'name' => $cliente->nombre])
		];
		
		return redirect()->action('ClientesController@index', ['alert' => $alert]);
	}

	public function destroy(Request $request)
	{
		$cliente = Cliente::find($request->id);
		$cliente->delete();
		return $request->id;
	}

	public function search(Request $request)
	{
		if($request->q)
		{
			$clientes = DB::table('clientes')
				->where('ident', 'like', '%' . $request->q . '%')
				->orWhere('nombre', 'like', '%' . $request->q . '%');
			
			return response()->json($clientes->get());
		}
	}
}
