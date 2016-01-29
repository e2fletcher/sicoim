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
      'photo' => 'image|image_size:<=800',
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
    
    if($request->hasFile('photo'))
    {
      $photoUpload = $request->file('photo');
      $ext = $photoUpload->getClientOriginalExtension();
      $photoName = sha1(\File::get($photoUpload)) . '.' . $ext;
      $sucursal->photo = $photoName;
      if(!\Storage::disk('local')->exists('sucursals/'))
        \Storage::disk('local')->makeDirectory('sucursals');
      \Storage::disk('local')->put('sucursals/' . $photoName,  \File::get($photoUpload));
    }
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
      'photo' => 'image|image_size:<=800',
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

    if($request->hasFile('photo'))
    {
      $photoUpload = $request->file('photo');
      $ext = $photoUpload->getClientOriginalExtension();
      $photoName = sha1(\File::get($photoUpload)) . '.' . $ext;
      $sucursal->photo = $photoName;
      if(!\Storage::disk('local')->exists('sucursals/'))
        \Storage::disk('local')->makeDirectory('sucursals');
      \Storage::disk('local')->put('sucursals/' . $photoName,  \File::get($photoUpload));
    }

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
    $points = array();
    
    $sucursals = Sucursal::all();
		if($sucursals->count() > 0)
		{
		  foreach ($sucursals as $sucursal) {
			  $points[] = [
          'latitud' => floatval(\App\Utils::before(',', $sucursal->coordenadas)),
					'longitud' => floatval(\App\Utils::after(',', $sucursal->coordenadas)),
					'nombre' => Str::upper($sucursal->nombre),
					'direccion' => Str::upper($sucursal->direccion) . $sucursal->tlf,
          'photo' => $sucursal->photo,
        ];
				}
			
      $data = [
				"center" => ['latitud' => 9.4879115, 'longitud' => -70.1867078],
				"zoom" => 9.75,
				"points" => $points
			];
			return view('sucursals.maps', $data);
		}

    return redirect()->action('HomeController@index');
  }

	public function search(Request $request)
	{
		if($request->q)
		{
			/**
			 * Error undefined variable request
			 *
			$sucursals = DB::table('sucursals')
				->where('id', '<>', \Auth::user()->sucursal()->id)
				->where(function($q){
					$q->where('ident', 'like', '%' . $request->q . '%')
						->orWhere('nombre', 'like', '%' . $request->q . '%');
				});
			 */
			
			$sucursals = DB::table('sucursals')
				->where('id', '<>', \Auth::user()->sucursal()->id)
				->where('nombre', 'like', '%' . $request->q . '%');

			return response()->json($sucursals->get());
		}
	}
}
