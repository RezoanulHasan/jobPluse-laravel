<?php

namespace App\Http\Controllers\Forntend;
use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPageController extends Controller
{
    public function index()
    {
        $privacy_page_data = PrivacyPolicy::where('id',1)->first();
        return view('forntend.privacy_policy', compact('privacy_page_data'));
    }
}
