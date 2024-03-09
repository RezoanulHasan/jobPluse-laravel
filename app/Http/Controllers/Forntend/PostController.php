<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Models\BlogPageItem;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('id','desc')->paginate(6);
        $blog_page_item = BlogPageItem::where('id',1)->first();
        return view('forntend.blog', compact('posts','blog_page_item'));
    }

    public function detail($slug)
    {
        $post_single = BlogPost::where('slug',$slug)->first();
        $post_single->total_view = $post_single->total_view+1;
        $post_single->update();
        return view('forntend.post', compact('post_single'));
    }
}
