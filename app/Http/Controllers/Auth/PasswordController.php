<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use App\Http\Requests;
use Validator;
use Auth;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function getChangePassword()
    {
        return view('auth.change');   
    }

    public function postChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('home/')
                ->withErrors($validator);
        }
        
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        $alert = [
            'type' => 'success',
	    'message' => 'La contraseña a sido modificada con exito '
	];

	return redirect()->action('HomeController@index', ['alert' => $alert]);
    }


}
