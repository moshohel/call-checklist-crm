<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Utils;

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

    public function username()
    {
        return 'user';
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::find($request->get($this->username()));

        if( $user && ($user->getAuthPassword() == $request->get("password")) ){
            Auth::login($user);
            return true;
        }
        return false;
    }

    protected function authenticated(Request $request, $user)
    {

        $redirectPath = '/';
        if(($user->user_level == 9) && ($user->user_group == 'ADMIN') ){
            $redirectPath = 'call-checklist/index';
        }
        else if(($user->user_level == 8) && ($user->user_group == 'SHOJON') ){
            $redirectPath = 'call-checklist/shojon/dashboard';
        }else if(($user->user_level == 8) && ($user->user_group == 'KPR')){
            $redirectPath = 'call-checklist/kpr/index';
        }
        else if(($user->user_level == 1) && ($user->user_group == 'SHOJON')){
            $redirectPath = 'call-checklist/shojon/index';
        }
        else if(($user->user_level == 1) && ($user->user_group == 'KPR')){
            $redirectPath = 'call-checklist/kpr/index';
        }
        else {
            echo "Unknown User group";
            return true;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($redirectPath);
    }
}
