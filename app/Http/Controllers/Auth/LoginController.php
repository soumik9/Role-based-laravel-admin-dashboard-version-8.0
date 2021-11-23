<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prison;
use Auth;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login()
    {
        return view('admin.auth.login');
    }

    public function login_go(Request $request)
    {
        $rules = [
            'email'     => 'required|email|max:255',
            'password'  => 'required',
            'remember'  => 'nullable',
        ];

        $messages = [
            'email.required'        => __('auth.form.validation.email.required'),
            'email.email'           => __('auth.form.validation.email.email'),
            'email.exists'          => __('auth.form.validation.email.exists'),
            'password.required'     => __('auth.form.validation.email.required'),
        ];


        $data = $this->validate($request, $rules, $messages);


        if (!isset(request()->remember)) {
            $data['remember'] = "off";
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
            if (Auth::user()->status == 1) {
                return redirect()->intended('/admin/dashboard');
            }else{
                Auth::logout();
                return redirect()->back()->with('danger','Your account is Deactivated by Admin!');
            }
        }else{
            return redirect()->back()->with('danger','Credentials Missmatch!');
        }
    
    }



    public function logout(Request $request) {
        Auth::logout();
        return redirect('admin/login');
    }
}
