<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPageItem;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function index()
    {
        $page_blog_data = BlogPageItem::where('id',1)->first();
        return view('admin.pages.blog.blog_page', compact('page_blog_data'));
    }

    public function update(Request $request)
    {

        $blog_page_data = BlogPageItem::where('id',1)->first();

        $request->validate([
            'heading' => 'required'
        ]);

        $blog_page_data->heading = $request->heading;
        $blog_page_data->title = $request->title;
        $blog_page_data->meta_description = $request->meta_description;
        $blog_page_data->update();

        return redirect()->back()->with('success', 'Data is updated successfully.');
    }
}
