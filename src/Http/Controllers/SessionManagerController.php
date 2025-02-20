<?php

namespace Itpathsolutions\Sessionmanager\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class SessionManagerController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        Session::start();
        $user = Auth::user();
        $roles = $user->getRoleNames();

        $hasAdminRole = collect($roles)->contains(function ($role) {
            return stripos($role, 'admin') !== false; // Case-insensitive search
        });

        if (!$hasAdminRole) {
            return redirect()->route('login')->with('error', 'You must be an admin to access this page.');
        }

        $roles = Role::all();
        return view('sessionmanager::home', compact('roles'));
    }

    public function updateSession(Request $request)
    {
        $role = Role::find($request->role_id);

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }

        $role->session_lifetime = $request->session_lifetime;
        $role->save();

        return response()->json(['success' => 'Session timeout updated successfully']);
    }
}
