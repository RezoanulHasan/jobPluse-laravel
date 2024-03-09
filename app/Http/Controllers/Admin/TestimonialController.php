<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('admin.pages.testimonial.testimonial', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.pages.testimonial.testimonial_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
            'photo' => 'required|image|mimes:jpg,jepg,png,gif',

        ]);

        $data_obj = new Testimonial();


        $ext = $request->file('photo')->extension();
        $final_name = 'testimonial_'.time(). '.' . $ext;
        $request->file('photo')->move(public_path("forntend/uploads/"), $final_name);

        $data_obj->photo = $final_name;
        $data_obj->name = $request->name;
        $data_obj->designation = $request->designation;
        $data_obj->comment = $request->comment;
        $data_obj->save();
        return redirect()->route('admin_testimonial')->with('success', 'Data has been saved successfully');

    }

    public function edit($id)
    {
        $testimonial_data = Testimonial::where('id', $id)->first();
        return view('admin.pages.testimonial.testimonial_edit', compact('testimonial_data'));
    }


    public function update(Request $request, $id)
    {
        $testimonial_data = Testimonial::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            unlink(public_path('forntend/uploads/'. $testimonial_data->photo));

            $ext = $request->file('photo')->extension();
            $final_name = 'testimonial_'.time() . '.' . $ext;

            $request->file('photo')->move(public_path('forntend/uploads/'), $final_name);

            $testimonial_data->photo = $final_name;
        }

        $testimonial_data->name = $request->name;
        $testimonial_data->designation = $request->designation;
        $testimonial_data->comment = $request->comment;
        $testimonial_data->update();

        return redirect()->route('admin_testimonial')->with('success', 'Data has been Updated successfully');

    }

    public function delete($id)
    {
        $testimonial_data = Testimonial::where('id', $id)->first();
        unlink(public_path('forntend/uploads/'. $testimonial_data->photo));
        Testimonial::where('id', $id)->delete();
        return redirect()->route('admin_testimonial')->with('success', 'Data has been Deleted successfully');
    }
}
