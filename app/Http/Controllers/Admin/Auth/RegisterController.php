<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Admin\Auth
 * 
 * Handles the registration of new admin users.
 * Only authenticated admins with proper permissions can access these functions.
 */
class RegisterController extends Controller
{
    /**
     * Show the admin registration form.
     * 
     * Displays the form for creating new admin users.
     * Access is restricted to authenticated admins with proper permissions.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        $roles = Role::where('guard_name', 'admin')
            ->where('name', '!=', 'Super Admin')
            ->get();

        return view('admin.auth.register', compact('roles'));
    }

    /**
     * Create a new admin user.
     *
     * Validates the input data and creates a new admin user.
     * Sets the creator and updater as the currently authenticated admin.
     * Handles any exceptions during the creation process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:4,32'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,id']
        ]);

        // Check if trying to assign Super Admin role
        $roles = Role::whereIn('id', $validated['roles'])->get();
        if ($roles->contains('name', 'Super Admin') && !auth()->guard('admin')->user()->hasRole('Super Admin')) {
            return back()->with('error', __('You cannot assign Super Admin role'));
        }

        // Create new admin
        $admin = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign roles
        $admin->assignRole($roles);

        return redirect()->route('admins-index')
            ->with('success', __('Admin created successfully'));
    }
}
