<?php

namespace App\Http\Controllers;

use Validator;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Redirect;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proveedor;

class ProveedorsController extends Controller
{
	public function index(Request $request)
	{
		if($request->search)
		{
			$proveedors = DB::table('proveedors')
				->where('ident', 'like', '%' . $request->search . '%')
				->orWhere('nombre', 'like', '%' . $request->search . '%')
				->paginate(5);
		}
		else
		{
			$proveedors = DB::table('proveedors')->paginate(5);
		}
		
		if($request->alert)
		{
			return view('proveedors.index', ['proveedors' => $proveedors, 'alert' => $request->alert]);
		}

		if($request->ajax())
			return response()->json($proveedors);

		return view('proveedors.index', ['proveedors' => $proveedors]);
	}

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ident' => 'required|unique:proveedors,ident',
            'nombre' => 'required',
            'direccion' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->action('ProveedorsController@index')
                ->withErrors($validator);
        }
	
        $proveedor = new Proveedor;
	$proveedor->ident = Str::lower($request->ident);
	$proveedor->nombre = Str::lower($request->nombre);
	$proveedor->direccion = Str::lower($request->direccion);
	$proveedor->tlf = Str::lower($request->tlf);
	$proveedor->email = Str::lower($request->email);
	$proveedor->save();
		
	$alert =
	[
	    'type' => 'warning',
	    'message' => \Lang::get('messages.model-create', ['model' => 'Proveedor', 'name' => $proveedor->nombre])
	];

	return redirect()->action('ProveedorsController@index', ['alert' => $alert]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'direccion' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->action('ProveedorsController@index')
                ->withErrors($validator);
        }

        $proveedor = Proveedor::find($request->id);
	$proveedor->nombre = Str::lower($request->nombre);
	$proveedor->direccion = Str::lower($request->direccion);
	$proveedor->tlf = Str::lower($request->tlf);
	$proveedor->email = Str::lower($request->email);
	$proveedor->save();
			
	$alert =
	[
	    'type' => 'warning',
	    'message' => \Lang::get('messages.model-update', ['model' => 'Proveedor', 'name' => $proveedor->nombre])
        ];
		
	return redirect()->action('ProveedorsController@index', ['alert' => $alert]);
    }

	public function destroy(Request $request)
	{
		$proveedor = Proveedor::find($request->id);
		$proveedor->delete();
		return $request->id;
	}

	public function search(Request $request)
	{
		if($request->q)
		{
			$proveedors = DB::table('proveedors')
				->where('ident', 'like', '%' . $request->q . '%')
				->orWhere('nombre', 'like', '%' . $request->q . '%');
			
			return response()->json($proveedors->get());
		}
	}
}
