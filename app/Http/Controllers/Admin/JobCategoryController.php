<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class JobCategoryController extends Controller
{
    public function index()
    {
        $job_categories = JobCategory::get();
        return view('admin.pages.job_category.job_category',compact('job_categories'));
    }

    public function create()
    {
        return view('admin.pages.job_category.job_category_create');
    }

    public function store(Request $request)
    {
       $request->validate([
         'name' => 'required',
         'icon' => 'required',
       ]);

       $data_obj = new JobCategory();
       $data_obj->name = $request->name;
       $data_obj->icon = $request->icon;
       $data_obj->save();
       return redirect()->route('admin_job_category')->with('success', 'Data has been saved successfully');

    }

    public function edit($id)
    {
        $job_category_edit = JobCategory::where('id', $id)->first();
        return view('admin.pages.job_category.job_category_edit',compact('job_category_edit'));
    }

    public function update(Request $request, $id)
    {
        $obj = JobCategory::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'icon' => 'required',
          ]);

          $obj->name = $request->name;
          $obj->icon = $request->icon;
          $obj->update();
          return redirect()->route('admin_job_category')->with('success', 'Data has been Updated successfully');

    }

    public function delete($id)
    {
        JobCategory::where('id', $id)->delete();
        return redirect()->route('admin_job_category')->with('success', 'Data has been Deleted successfully');
    }

}
