<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Str;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|unique:users,name|max:255',
            'type' => 'required|integer',
            'sucursal' => 'required|exists:sucursals,id',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        /*$user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => (int) $data['type'],
            'password' => bcrypt($data['password']),
        ]);*/

	$user = new User;
	$user->email = $data['email'];
	$user->name = $data['name'];
	$user->password = \Hash::make($data['password']);
	$user->type = (int) $data['type'];
	$user->save();
        $user->sucursals()->sync([$data['sucursal']]);
    }
	
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->create($request->all());

        $alert = [
            'type' => 'success',
	    'message' => 'El usuario ' . Str::upper($request->input('email')) . ' a sido registrado satisfactoriamente :)'
	];

	return redirect()->action('HomeController@index', ['alert' => $alert]);
    }
    
    public function getLogin(Request $request)
    {
        if($request->errors)
	    return view('auth.login', ['errors' => $request->errors]);

        return view('auth.login');

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }
}
