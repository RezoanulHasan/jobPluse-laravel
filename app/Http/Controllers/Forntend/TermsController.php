<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Models\TermPage;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $term_page_item = TermPage::where('id',1)->first();
        return view('forntend.term_page', compact('term_page_item'));
    }
}
