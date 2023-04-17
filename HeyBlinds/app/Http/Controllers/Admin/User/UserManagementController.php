<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = Admin::with('roles')->paginate(10);
        $allRoles = Role::all()->pluck('name');
        return view('admin.users.index', compact('users', 'allRoles'));
    }

}
