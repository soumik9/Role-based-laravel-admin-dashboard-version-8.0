<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showForgetPasswordForm()
    {
       return view('admin.auth.forgotPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $check_user = User::where('email', $request->email)->first();

        if(!empty($check_user)){
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token,
            ]);

            Mail::send('emails.forgotPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            Toastr::success('We have mailed reset link!');
            return back();
        }else{
            Toastr::error('You are not a registred member!');
            return back();
        }
    }

    public function showResetPasswordForm($token) { 
        return view('admin.auth.forgotPasswordLink', ['token' => $token]);
     }

     public function submitResetPasswordForm(Request $request)
     {
         $request->validate([
             'email'                 => 'required|email|exists:users',
             'password'              => 'required|string|min:6|confirmed',
             'password_confirmation' => 'required'
         ]);
 
         $updatePassword = DB::table('password_resets')->where([
                               'email' => $request->email, 
                               'token' => $request->token
                             ])->first();
 
        if(!empty($updatePassword)){
            $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
            DB::table('password_resets')->where(['email'=> $request->email])->delete();

            Toastr::success('Password Reset!');
            return redirect(route('login'));
        }else{
            Toastr::error('Invalid token!');
            return back()->withInput();
        }
     }
}
