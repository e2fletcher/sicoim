<?php

namespace App\Http\Controllers;

use Validator;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Http\Redirect;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sucursal;

class SucursalsController extends Controller
{
	/*	
	public function __construct()
	{
		$this->middleware('auth');
	}*/

	public function index(Request $request)
	{
		if($request->search)
		{
			$sucursals = DB::table('sucursals')
				->where('ident', 'like', '%' . $request->search . '%')
				->orWhere('nombre', 'like', '%' . $request->search . '%')
				->orWhere('email', 'like', '%' . $request->search . '%')
				->orWhere('tlf', 'like', '%' . $request->search . '%')
				->paginate(5);
		}
		else
		{
			$sucursals = DB::table('sucursals')->paginate(5);
		}
		
		if($request->alert)
		{
			return view('sucursals.index', ['sucursals' => $sucursals, 'alert' => $request->alert]);
		}

		return view('sucursals.index', ['sucursals' => $sucursals]);
	}

	public function create(Request $request)
        {

            $validator = Validator::make($request->all(), [
                'ident' => 'required|unique:sucursals,ident',
                'nombre' => 'required',
                'direccion' => 'required',
                'tlf' => 'required',
                'coordenadas' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->action('SucursalsController@index')
                    ->withErrors($validator);
            }
		$sucursal = new Sucursal;
		$sucursal->ident = Str::lower($request->ident);
		$sucursal->nombre = Str::lower($request->nombre);
		$sucursal->direccion = Str::lower($request->direccion);
		$sucursal->tlf = Str::lower($request->tlf);
		$sucursal->coordenadas = $request->coordenadas;
		$sucursal->save();
		
		$alert =
		[
			'type' => 'warning',
			'message' => \Lang::get('messages.model-create', ['model' => 'Sucursal', 'name' => $sucursal->nombre])
		];

		return redirect()->action('SucursalsController@index', ['alert' => $alert]);
	}

	public function update(Request $request)
	{

            $validator = Validator::make($request->all(), [
                'nombre' => 'required',
                'direccion' => 'required',
                'tlf' => 'required',
                'coordenadas' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->action('SucursalsController@index')
                    ->withErrors($validator);
            }

            $sucursal = Sucursal::find($request->id);
		$sucursal->nombre = Str::lower($request->nombre);
		$sucursal->direccion = Str::lower($request->direccion);
		$sucursal->coordenadas = $request->coordenadas;
		$sucursal->tlf = Str::lower($request->tlf);
		$sucursal->save();
			
		$alert =
		[
			'type' => 'warning',
			'message' => \Lang::get('messages.model-update', ['model' => 'Sucursal', 'name' => $sucursal->nombre])
		];
		
		return redirect()->action('SucursalsController@index', ['alert' => $alert]);
	}

	public function destroy(Request $request)
	{
		$sucursal = Sucursal::find($request->id);
		$sucursal->delete();
		return $request->id;
	}

	public function maps(Request $request)
	{
		/*if(!$request->ajax() && 0)
		{
			$data = [
				"center" =>[ -5.797942,-35.211782 ],
				"zoom" => 14,
				"points" => [
					[
						"coor" => [ -5.799500,-35.21951 ],
						"text" => "First point<br/>Anything here"
					],
					[
						"coor" => [ -5.790982,-35.19409 ],
						"text" => "Other <b>point</b> here"
					],
					[
						"coor" => [ -5.802083,-35.20877 ],
						"text" => "Something else<br/>placed here"
					]
				]
			];
			return response()->json($data);
		}*/


		if($request->ajax())
		{
			$points = array();

			$sucursals = Sucursal::all();
			if($sucursals)
			{
				foreach ($sucursals as $sucursal) {
					$points[] = [
						"coor" => [
							floatval(\App\Utils::before(',', $sucursal->coordenadas)),
							floatval(\App\Utils::after(',', $sucursal->coordenadas))
						],
						"text" => Str::upper($sucursal->nombre)
					];
				}
			}

			$data = [
				"center" => [9.3617,-70.4526],
				"zoom" => 10,
				"points" => $points
			];
			return response()->json($data);
		}

		return view('sucursals.maps');
	}

	public function search(Request $request)
	{
		if($request->q)
		{
			/**
			 * Error undefined variable request
			 *
			$sucursals = DB::table('sucursals')
				->where('id', '<>', \Auth::user()->sucursal->id)
				->where(function($q){
					$q->where('ident', 'like', '%' . $request->q . '%')
						->orWhere('nombre', 'like', '%' . $request->q . '%');
				});
			 */
			
			$sucursals = DB::table('sucursals')
				->where('id', '<>', \Auth::user()->sucursal->id)
				->where('nombre', 'like', '%' . $request->q . '%');

			return response()->json($sucursals->get());
		}
	}
}
