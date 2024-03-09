<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanySize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCompanySizeController extends Controller
{
    public function index()
    {
        $company_sizes = CompanySize::get();
        return view('admin.pages.company-size.company_size', compact('company_sizes'));
    }

    public function create()
    {
        return view('admin.pages.company-size.company_size_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $obj = new CompanySize();
        $obj->name = $request->name;
        $obj->save();

        return redirect()->route('admin_company_size')->with('success', 'Data is saved successfully.');

    }

    public function edit($id)
    {
        $company_size_single = CompanySize::where('id',$id)->first();
        return view('admin.pages.company-size.company_size_edit',compact('company_size_single'));
    }

    public function update(Request $request, $id)
    {
        $obj = CompanySize::where('id',$id)->first();

        $request->validate([
            'name' => 'required'
        ]);

        $obj->name = $request->name;
        $obj->update();

        return redirect()->route('admin_company_size')->with('success', 'Data is updated successfully.');

    }

    public function delete($id)
    {

        CompanySize::where('id',$id)->delete();
        return redirect()->route('admin_company_size')->with('success', 'Data is deleted successfully.');
    }
}
