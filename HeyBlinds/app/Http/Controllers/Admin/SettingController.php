<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\AdminMatchOldPassword;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $admin_user =  Auth::guard('admin')->user();
        return view('admin.setting.index', compact('admin_user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'current_password' => ['required', new AdminMatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        Admin::find(auth()->id())->update(['password' => $request->new_password]);

        return redirect()->back()->with('success', "Password updated successfully.");
    }
}
