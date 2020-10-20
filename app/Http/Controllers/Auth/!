<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use DB;
use Hash;
use Illuminate\Validation\ValidationException;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['ＩＤまたはパスワードが違います。'],
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string'
            
        ],[
            $this->username().'.required' => 'ログインIDを入力してください。',
            'password.required' => 'パスワードを入力して下さい。',
        ]);
		
		
	
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // if ($this->attemptLogin($request)) {

        //     return $this->sendLoginResponse($request);
        // }

            $kinder = User::where("username",$request->username)
            ->where('use_flg',1)
            ->first();
            if(!empty($kinder)){
            if (Hash::check($request->password, $kinder->password)) {
                $auth = Auth::login($kinder);
             } 
            }
            $auth =false;
        if($auth){
            return $this->sendLoginResponse($request);
        }
		

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        dd( $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath('/')));
    }

    protected function authenticated(Request $request, $user)
    {
        
        return redirect()->intended('/index');   
    }


    public function username()
    {
        return 'username';
    }
}
