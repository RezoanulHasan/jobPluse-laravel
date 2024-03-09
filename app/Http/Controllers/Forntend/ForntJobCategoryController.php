<?php

namespace App\Http\Controllers\Forntend;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HomePageItem;
use App\Models\PageJobCategory;

class ForntJobCategoryController extends Controller
{
    public function categories()
    {
        $job_category_page_data = PageJobCategory::where('id',1)->first();
        $job_category_data = JobCategory::orderBy('name', 'asc')->get();
        return view('Forntend.job_category', compact('job_category_data','job_category_page_data'));
    }
}
