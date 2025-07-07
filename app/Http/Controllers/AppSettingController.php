<?php

namespace App\Http\Controllers;

use App\Models\App_Setting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $app_settings = App_Setting::all();
        return view('app_setting.index', compact('app_settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(App_Setting $app_Setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(App_Setting $app_Setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, App_Setting $app_Setting)
    {
        $request->validate([
            'app_name' => 'required',
            'foto' => 'required',
            'telegram_alert' => 'required'
        ]);
        $update = App_Setting::find(1);

        $filepath = public_path('assets/img/app_setting');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($filepath, $filename);

            if (!is_null($update->app_logo)) {
                $oldImage = public_path('assets/img/app_setting/' . $update->app_logo);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $update->app_logo = $filename;
        }

        $update->app_name = $request->app_name;
        $update->telegram_alert = $request->telegram_alert;
        $result = $update->save();
        return redirect()->route('app_setting.index')->with('success', 'Setting Disimpan!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(App_Setting $app_Setting)
    {
        //
    }
}
