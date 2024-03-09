<?php

namespace App\Http\Controllers\Forntend;

use App\Models\BlogPost;
use App\Models\WhyChoose;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\Testimonial;
use App\Models\HomePageItem;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $home_page_data = HomePageItem::where('id',1)->first();
        $job_category_data = JobCategory::orderBy('name', 'ASC')->take('9')->get();
        $all_job_locations = JobLocation::orderBy('name','asc')->get();
        $why_choose_data = WhyChoose::get();
        $testimonial_data = Testimonial::get();
        $blog_posts = BlogPost::get();
        return view('Forntend.home',compact('home_page_data','all_job_locations', 'job_category_data','blog_posts', 'why_choose_data','testimonial_data'));
    }
}
