<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CompanyIndustry;
use App\Http\Controllers\Controller;

class AdminCompanyIndustryController extends Controller
{
    public function index()
    {
        $company_industries = CompanyIndustry::get();
        return view('admin.pages.company-industry.company_industry', compact('company_industries'));
    }

    public function create()
    {
        return view('admin.pages.company-industry.company_industry_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $obj = new CompanyIndustry();
        $obj->name = $request->name;
        $obj->save();

        return redirect()->route('admin_company_industry')->with('success', 'Data is saved successfully.');

    }

    public function edit($id)
    {
        $company_industry_single = CompanyIndustry::where('id',$id)->first();
        return view('admin.pages.company-industry.company_industry_edit',compact('company_industry_single'));
    }

    public function update(Request $request, $id)
    {
        $obj = CompanyIndustry::where('id',$id)->first();

        $request->validate([
            'name' => 'required'
        ]);

        $obj->name = $request->name;
        $obj->update();

        return redirect()->route('admin_company_industry')->with('success', 'Data is updated successfully.');

    }

    public function delete($id)
    {

        CompanyIndustry::where('id',$id)->delete();
        return redirect()->route('admin_company_industry')->with('success', 'Data is deleted successfully.');
    }
}
