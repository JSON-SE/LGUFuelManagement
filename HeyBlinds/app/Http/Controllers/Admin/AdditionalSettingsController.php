<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdditionalSettings;
use Illuminate\Http\Request;

class AdditionalSettingsController extends Controller
{
    public function create(){
        return view('admin.additional-settings.index');
    }
    public function product(Request $request): \Illuminate\Http\RedirectResponse
    {
        AdditionalSettings::updateOrCreate([
            'key' => 'delivery_time_tooltip',
            'value' => $request->input('delivery_time_tooltip'),
        ]);

        return back();
    }
}
