<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Traits\RedirectTrait;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
	use RedirectTrait;  // Use the trait
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
	protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	/**
	* The user has been authenticated.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  mixed  $user
	* @return mixed
	*/
	
	protected function authenticated(Request $request, $user)
	{
		
		$email = $request->input('email');
		$password = $request->input('password');

		$checkLogin = DB::table('users')->where(['email'=>$email,'password'=>$password])->first();
		
		switch(Auth::user()->role){
            case 5:
                return redirect('/dashboard');
                break;
            case 4:
				return redirect('/dashboard');
                break;
            case 3:
                return redirect('/dashboard');
                break;
            case 2:
                return redirect('/dashboard');
                break;
            case 1:
                return redirect('/dashboard');
                break;
            default:    
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }

        if (auth()->attempt($request->only('email', 'password'))) {
        return redirect()->intended(route('dashboard'));
        }
    		
    }
	

    
	
}
