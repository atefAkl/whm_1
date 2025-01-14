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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admins-index')
            ->with('success', __('messages.Admin updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $admin = Admin::findOrFail($request->admin_id);

        // Prevent deleting super admin
        if ($admin->hasRole('Super Admin')) {
            return response()->json([
                'success' => false,
                'message' => __('messages.Cannot delete super admin')
            ]);
        }

        $admin->delete();

        return response()->json([
            'success' => true,
            'message' => __('messages.Admin deleted successfully')
        ]);
    }

    public function profile()
    {
        $vars = [
            'admin' => auth()->guard('admin')->user()
        ];
        return view('admin.profile.home', $vars);
    }

    /**
     * Update the admin's profile.
     */
    public function updateProfile(Request $request)
    {
        $id = auth()->guard('admin')->user()->id;
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'between:4,32'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        // if (!empty($validated['password'])) {
        //     $admin->password = Hash::make($validated['password']);
        // }

        $admin->save();

        return back()->with('success', 'Profile updated successfully.');
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
    public function settings()
    {
        if (!auth()->guard('admin')->user()->can('manage-settings')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.settings.home');
    }
}
