<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privacy_policy_data = PrivacyPolicy::where('id',1)->first();
        return view('admin.pages.privacy.privacy_policy', compact('privacy_policy_data'));
    }

    public function update(Request $request)
    {

        $privacy_policy_data = PrivacyPolicy::where('id',1)->first();

        $request->validate([
            'heading' => 'required',
            'content' => 'required'
        ]);

        $privacy_policy_data->heading = $request->heading;
        $privacy_policy_data->content = $request->content;
        $privacy_policy_data->title = $request->title;
        $privacy_policy_data->meta_description = $request->meta_description;
        $privacy_policy_data->update();

        return redirect()->back()->with('success', 'Data is updated successfully.');
    }
}
