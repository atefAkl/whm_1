<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::with('roles')->paginate(10);
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.list', compact('admins', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        return $request->all();

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => true
        ]);

        $admin->assignRole($request->roles);

        return redirect()->route('admin.admins.index')->with('success', __('Admin created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $admin->update($request->only(['name', 'email']));
        $admin->syncRoles($request->roles);

        return redirect()->route('admin.admins.index')->with('success', __('Admin updated successfully'));
    }

    /**
     * Update admin's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        return [$request->all(), $admin->password, Hash::make($request->old_password)];

        if (Hash::check($request->old_password, $admin->password)) {
            return __('Current password is incorrect');
        }
        return 'Password do not matches';

        // Check if old password matches
        try {
            if (Hash::check($request->old_password, $admin->password)) {
                return 'Password matches';
                // Update password
                $admin->password = Hash::make($request->password);
                $admin->update();
                return back()->with('success', __('Password updated successfully'));
            }
        } catch (\Exception $e) {
            return back()->withError(__('Current password is incorrect' . $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->id === auth('admin')->id()) {
            return back()->withError(__('You cannot delete your own account'));
        }

        $admin->delete();

        return back()->with('success', __('Admin deleted successfully'));
    }

    public function profile()
    {
        $admin = auth('admin')->user();
        return view('admin.admins.profile', compact('admin'));
    }

    /**
     * Update the admin's profile.
     */
    public function updateProfile(Request $request)
    {
        $admin = Admin::findOrFail(auth('admin')->user()->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
        ]);

        try {
            $admin->update($request->only(['name', 'email', 'phone']));
            $admin->profile->update($request->only(['phone']));
            return back()->with('success', __('Profile updated successfully'));
        } catch (\Exception $e) {
            return back()->withError(__('Profile updated successfully' . $e->getMessage()));
        }
    }

    public function settings()
    {
        $admin = auth('admin')->user();
        return view('admin.settings.home', compact('admin'));
    }

    public function updateSettings(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'notification_enabled' => 'boolean',
            'theme' => 'string|in:light,dark',
            'language' => 'string|in:ar,en'
        ]);

        $admin->settings()->update($request->all());

        return back()->with('success', __('Settings updated successfully'));
    }

    public function toggleStatus($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->status = !$admin->status;
        $admin->save();

        return back()->with('success', __('Status updated successfully'));
    }

    public function admins()
    {
        $admins = Admin::with('roles')->get();
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.list', compact('admins', 'roles'));
    }

    public function getAdminRoles($id)
    {
        $admin = Admin::findOrFail($id);
        return response()->json($admin->roles->pluck('id'));
    }

    public function assignRoles(Request $request)
    {
        $admin = Admin::findOrFail($request->admin_id);
        $request->validate([
            'roles' => 'required|array',
            'admin_roles.*' => 'exists:admin_roles,id'
        ]);
        // return $request->all();

        //Prevent modifying super admin roles
        $user = Admin::findOrFail($request->admin_id);
        if ($admin->hasRole('Super Admin') && !$user->hasRole('Super Admin')) {
            return back()->with('error', __('messages.Cannot modify super admin roles'));
        }

        $admin->syncRoles($request->roles);

        return back()->with('success', __('messages.Roles assigned successfully'));
    }

    /**
     * Show the settings page.
     */
    public function showSettings()
    {
        if (!auth()->guard('admin')->user()->can('manage-settings')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.settings.home');
    }
}
