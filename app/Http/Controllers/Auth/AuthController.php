<?php namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;


class AuthController extends Controller {

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



    //protected $redirectTo = '/auth/register';
	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */


    /**
     * the model instance
     * @var User
     */
    protected $user;
    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;
    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator  $auth
     * @return void
     */
    public function __construct(Guard $auth, User $user)
    {
        $this->user = $user;
        $this->auth = $auth;

        $this->middleware('guest', ['except' => ['getLogout']]);
    }


    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $this->auth->login($this->user);
        $this->user->email = $request->email;
        $this->user->username = $request->username;
        $this->user->password = bcrypt($request->password);
        $this->user->dept_name = $request->dept_name;
        $this->user->user_type = $request->user_type;
        $this->user->save();

        return redirect('/auth/login');
    }


    public function getLogin()
    {
        return view('auth.login');
    }

//
//    public function postLogin(LoginRequest $request)
//    {
//        if($this->auth->attempt($request->only('email', 'password', 'user_type')))
//        {
//            return view('dashboard');
//        }
//
//        return redirect('/auth/login')->withErrors([
//            'email' => 'The credentials you entered did not match our records. Try again?',
//        ]);
//    }
    public function postLogin(LoginRequest $request)
    {
        if($this->auth->attempt($request->only('email', 'password', 'user_type')))
        {
            $user = \Auth::user();
            if($user->user_type == 1)
            {
                return redirect('/homepage');
            }

            elseif($user->user_type == 2)
            {
                return redirect('/student');
            }

            elseif($user->user_type == 3)
            {
                return redirect('/dash-board');
            }
            //return view('dashboard', compact('user'));
        }

        else{
            return redirect('/auth/login')->withErrors([
                'email' => 'The credentials you entered did not match our records. Try again?',
            ]);
        }
    }


    public function getLogout()
    {
        $this->auth->logout();
        return redirect('/');
    }

    public function reset()
    {
//        $user = \Auth::user();
//        return view('otherspassword');
        echo("works");
    }

    public function resetadmin()
    {
//        $user = \Auth::user();
//        return view('adminpassword');
        echo("works");
    }




}
