<?php

namespace App\Http\Controllers\Forntend;

use App\Models\Faq;
use App\Models\PageFaqItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForntFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::get();
        $faq_page_item = PageFaqItem::where('id',1)->first();
        return view('Forntend.faq', compact('faqs','faq_page_item'));
    }

}
