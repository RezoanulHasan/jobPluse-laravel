<?php

namespace App\Http\Controllers\Forntend;

use Illuminate\Http\Request;
use App\Models\OtherPageItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginPageController extends Controller
{
    public function index()
    {
        if (Auth::guard('candidate')->check()) {
            return redirect()->route('candidate_dashboard');
        }

        if (Auth::guard('company')->check()) {
            return redirect()->route('company_dashboard');
        }

        $other_page_item = OtherPageItem::where('id', 1)->first();
        return view('forntend.login', compact('other_page_item'));
    }

    public function company_login_submit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credential = [
            'username' => $request->username,
            'password' => $request->password,
            'status' => 1
        ];


        if (Auth::guard('company')->attempt($credential)) {
            return redirect()->route('company_dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Information is not correct!');
        }
    }

    public function company_logout()
    {
        Auth::guard('company')->logout();
        return redirect()->route('login');
    }

    public function candidate_login_submit(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    $credentials = [
        'username' => $request->username,
        'password' => $request->password,
        'status' => 1
    ];

    if (Auth::guard('candidate')->attempt($credentials)) {
        // Authentication successful
        return redirect()->route('candidate_dashboard');
    } else {
        // Authentication failed
        return redirect()->route('login')->with('error', 'Incorrect information. Please try again.');
    }
}

    public function candidate_logout()
    {
        Auth::guard('candidate')->logout();
        return redirect()->route('login');
    }

}

