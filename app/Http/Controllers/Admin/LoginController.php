<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{

    // Admin Simple login methods

    public function login()
    {
        return view('admin.login');
    }

    public function forgetPassword()
    {
        return view('admin.forget_password');
    }


    // Admin foget password and send email notification to users email
    public function forgetPasswordSubmit(Request $request)
    {
        $request->validate([
            'email'    => 'required|email'
        ]);

        $data = Admin::where('email', $request->email)->first();
        if (!$data) {
            return redirect()->back()->with(['error' => 'Email is not valid']);
        }

        $token = hash('sha256', time());
        $data->token = $token;
        $data->update();

        $reset_link = url('admin/reset-password/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = 'Please click on the following link: </br>';
        $message .= '<a href="' . $reset_link . '">Click Me</a>';

        Mail::to($request->email)->send(new VerifyMail($subject,$message));

        return redirect()->route('admin_login')->with('success', 'Please check your email and follow the steps there.');
    }

    // Admin Login submit and redirect to admin dashboard
    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin_dashboard');
        } else {
            return redirect()->route('admin_login')->with(['error' => 'Information is not correct']);
        }
    }


    // Admin Logout Methods
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }


    // Admin password reset for get methods
    public function resetPassword($token, $email)
    {
        $data = Admin::where('token', $token)->where('email', $email)->first();

        if(!$data){
             return redirect()->route('admin_login');
        }
        return view('admin.reset_password', compact('token', 'email'));
    }



    // Admin Password Reset and update

     public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);

        $data  = Admin::where('token', $request->token)->where('email', $request->email)->first();

        $data->password = Hash::make($request->password);
        $data->token = '';
        $data->update();

        return redirect()->route('admin_login')->with('success', 'Password is reset Successfully ');
    }
}
