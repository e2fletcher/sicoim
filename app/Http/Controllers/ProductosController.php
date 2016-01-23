<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductosController extends Controller
{
    public function search(Request $request)
    {
        if($request->q)
	{
	    $result = DB::table('tipos')
	        ->join('productos', function($join){
	            $join->on('productos.tipo_id', '=', 'tipos.id')
		        ->where('productos.sucursal_id', '=', Auth::user()->sucursal()->id)
			->where('productos.stock', '>', 0);
		    })
		    ->where('tipos.codigo', 'like', '%' . $request->q . '%')
		    ->orWhere('tipos.generic_tipo', 'like', '%' . $request->q . '%')
		    ->orWhere('tipos.nombre', 'like', '%' . $request->q . '%')
		    ->select(
		        'productos.id',
			'tipos.codigo',
			'tipos.nombre',
			'productos.precio',
			'productos.stock'
		    )
		    ->get();
	    return response()->json($result);
	}
    }

    public function index()
    {
        $productos = DB::table('tipos')
            ->join('productos', function($join){
	        $join->on('productos.tipo_id', '=', 'tipos.id')
		    ->where('productos.sucursal_id', '=', Auth::user()->sucursal()->id)
		    ->where('productos.stock', '>=', 0);
	    })
	    ->select(
		'tipos.codigo',
		'tipos.nombre',
		'productos.precio',
		'productos.stock'
	    )
	    ->paginate(5);
	
	return view('productos.index', ['productos' => $productos]);
    }
}

