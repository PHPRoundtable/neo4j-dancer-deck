<?php namespace DancerDeck\Http\Controllers\Auth;

use DancerDeck\Http\Controllers\BaseFrontEndController;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Validator;
use User;

class AuthController extends BaseFrontEndController
{
    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        parent::__construct();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
          'name'     => 'required|max:255',
          'email'    => 'required|email|max:255|unique:users',
          'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {
        return User::create([
          'name'     => $data['name'],
          'email'    => $data['email'],
          'password' => bcrypt($data['password']),
        ]);
    }
}
