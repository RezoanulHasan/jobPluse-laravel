<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::get();
        return view('admin.pages.blog.blog_post',compact('posts'));
    }

    public function create()
    {
        return view('admin.pages.blog.blog_post_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'slug' => 'required|alpha_dash|unique:blog_posts',
            'short_description' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        $obj = new BlogPost();

        $ext = $request->file('photo')->extension();
        $final_name = 'post_'.time().'.'.$ext;
        $request->file('photo')->move(public_path('uploads/'),$final_name);

        $obj->photo = $final_name;
        $obj->heading = $request->heading;
        $obj->slug = $request->slug;
        $obj->short_description = $request->short_description;
        $obj->description = $request->description;
        $obj->total_view = 0;
        $obj->title = $request->title;
        $obj->meta_description = $request->meta_description;
        $obj->save();

        return redirect()->route('admin_blog_post')->with('success', 'Data is saved successfully.');

    }

    public function edit($id)
    {
        $post_single = BlogPost::where('id',$id)->first();
        return view('admin.pages.blog.blog_post_edit',compact('post_single'));
    }

    public function update(Request $request, $id)
    {
        $obj = BlogPost::where('id',$id)->first();

        $request->validate([
            'heading' => 'required',
            'slug' => ['required','alpha_dash', Rule::unique('blog_posts')->ignore($id)],
            'short_description' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            unlink(public_path('uploads/'.$obj->photo));

            $ext = $request->file('photo')->extension();
            $final_name = 'post_'.time().'.'.$ext;

            $request->file('photo')->move(public_path('forntend/uploads/'),$final_name);

            $obj->photo = $final_name;
        }

        $obj->heading = $request->heading;
        $obj->slug = $request->slug;
        $obj->short_description = $request->short_description;
        $obj->description = $request->description;
        $obj->title = $request->title;
        $obj->meta_description = $request->meta_description;
        $obj->update();

        return redirect()->route('admin_blog_post')->with('success', 'Data is updated successfully.');

    }

    public function delete($id)
    {
        $post_single = BlogPost::where('id',$id)->first();
        unlink(public_path('forntend/uploads/'.$post_single->photo));
        BlogPost::where('id',$id)->delete();
        return redirect()->route('admin_blog_post')->with('success', 'Data is deleted successfully.');
    }
}
