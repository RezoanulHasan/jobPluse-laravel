<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\JobSalaryRange;
use App\Http\Controllers\Controller;

class AdminJobSalaryRange extends Controller
{
    public function index()
    {
        $job_salary_ranges = JobSalaryRange::get();
        return view('admin.pages.salary.job_salary_range', compact('job_salary_ranges'));
    }

    public function create()
    {
        return view('admin.pages.salary.job_salary_range_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $obj = new JobSalaryRange();
        $obj->name = $request->name;
        $obj->save();

        return redirect()->route('admin_job_salary_range')->with('success', 'Data is saved successfully.');

    }

    public function edit($id)
    {
        $job_salary_range_single = JobSalaryRange::where('id',$id)->first();
        return view('admin.pages.salary.job_salary_range_edit',compact('job_salary_range_single'));
    }

    public function update(Request $request, $id)
    {
        $obj = JobSalaryRange::where('id',$id)->first();

        $request->validate([
            'name' => 'required'
        ]);

        $obj->name = $request->name;
        $obj->update();

        return redirect()->route('admin_job_salary_range')->with('success', 'Data is updated successfully.');

    }

    public function delete($id)
    {

        JobSalaryRange::where('id',$id)->delete();
        return redirect()->route('admin_job_salary_range')->with('success', 'Data is deleted successfully.');
    }
}
