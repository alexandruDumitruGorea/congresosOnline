<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            $user = \Illuminate\Support\Facades\Auth::user();
            if($user->hasVerifiedEmail()) {
                // Logeado
                $request->session()->flash('op', 'logged');
                return $this->sendLoginResponse($request);
            } else {
                $user->sendEmailVerificationNotification();
                \Illuminate\Support\Facades\Auth::logout();
                $request->session()->flash('op', 'reverification');
            }
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function showLoginForm(Request $request) {
        $opSession = $request->session()->get('op');
        $alertMessage = null;
        if ($opSession !== null) {
            $alertMessage = 'No se ha podidio identificar, correo de verificación reenviado';
        }
        return view('auth.login')->with((['alertMessage' => $alertMessage]));
    }
}
