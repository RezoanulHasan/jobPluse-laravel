<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPageItem;
use Illuminate\Http\Request;

class AdminPricingPageController extends Controller
{
    public function index()
    {
        $page_pricing_data = PricingPageItem::where('id',1)->first();
        return view('admin.pages.package.pricing_page', compact('page_pricing_data'));
    }

    public function update(Request $request)
    {

        $pricing_page_data = PricingPageItem::where('id',1)->first();

        $request->validate([
            'heading' => 'required'
        ]);

        $pricing_page_data->heading = $request->heading;
        $pricing_page_data->title = $request->title;
        $pricing_page_data->meta_description = $request->meta_description;
        $pricing_page_data->update();

        return redirect()->back()->with('success', 'Data is updated successfully.');
    }
}
