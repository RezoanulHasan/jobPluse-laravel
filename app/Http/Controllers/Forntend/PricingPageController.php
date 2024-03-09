<?php

namespace App\Http\Controllers\Forntend;

use App\Models\Package;
use App\Models\PricingPageItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PricingPageController extends Controller
{
    public function index()
    {
        $packages = Package::get();
        $pricing_page_item = PricingPageItem::where('id',1)->first();
        return view('Forntend.pricing_page', compact('packages','pricing_page_item'));
    }
}
