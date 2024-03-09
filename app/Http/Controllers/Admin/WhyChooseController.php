<?php

namespace App\Http\Controllers\Admin;

use App\Models\WhyChoose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhyChooseController extends Controller
{
    public function index()
    {
        $data = WhyChoose::get();
        return view('admin.pages.why_choose.why_choose', compact('data'));
    }

    public function create()
    {
        return view('admin.pages.why_choose.why_choose_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
            'text' => 'required',

        ]);

        $data_obj = new WhyChoose();
        $data_obj->icon = $request->icon;
        $data_obj->heading = $request->heading;
        $data_obj->text = $request->text;
        $data_obj->save();
        return redirect()->route('admin_why_choose')->with('success', 'Data has been saved successfully');

    }

    public function edit($id)
    {
        $why_choose_item = WhyChoose::where('id', $id)->first();
        return view('admin.pages.why_choose.why_choose_edit', compact('why_choose_item'));
    }

    public function update(Request $request, $id)
    {
        $obj = WhyChoose::where('id', $id)->first();

        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
            'text' => 'required',
        ]);

        $data_obj = new WhyChoose();
        $data_obj->icon = $request->icon;
        $data_obj->heading = $request->heading;
        $data_obj->text = $request->text;
        $obj->update();
        return redirect()->route('admin_why_choose')->with('success', 'Data has been Updated successfully');

    }

    public function delete($id)
    {
        WhyChoose::where('id', $id)->delete();
        return redirect()->route('admin_why_choose')->with('success', 'Data has been Deleted successfully');
    }
}
