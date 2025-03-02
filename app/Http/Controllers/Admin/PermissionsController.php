<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // select all permissions group by group name
        $groupedPermissions = Permission::all()->groupBy('group_name');
        return view('admin.permissions.index', compact('groupedPermissions'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $groups = Permission::groups();
        return view('admin.permissions.create', compact('groups'));
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
            'description' => 'nullable|string|max:255'
        ]);

        Permission::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'guard_name' => 'admin'
        ]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'تم إنشاء الصلاحية بنجاح');
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        $groups = Permission::groups();
        $guards = Permission::distinct('guard_name')->pluck('guard_name');
        return view('admin.permissions.edit', compact('permission', 'groups', 'guards'));
    }

    public function getById($id)
    {
        return Permission::findOrFail($id);
    }

    /**
     * Update the specified permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required|string|max:50',
            'group_name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255'
        ]);
        $validated['updated_by'] = auth()->guard('admin')->user()->id;
        try {
            $permission->update($validated);
            return redirect()->back()
                ->with('success', 'تم تحديث الصلاحية بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withInput()->with('error', 'حدث خطأ ما');
        }
    }


    /**
     * Remove the specified permission from storage.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        // Check if permission is being used by any roles
        if ($permission->roles()->count() > 0) {
            return redirect()->route('admin.permissions.index')
                ->with('error', 'لا يمكن حذف الصلاحية لأنها مستخدمة من قبل أدوار أخرى');
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'تم حذف الصلاحية بنجاح');
    }
}
