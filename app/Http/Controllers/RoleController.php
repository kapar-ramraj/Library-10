<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        $chunks = $permissions->chunk(4);
        // foreach ($chunks as $items) {
        //     foreach ($items as $item) {
        //         dd($item);
        //     }
        // }
        return view('role.create', compact('permissions', 'chunks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $roleData = $request->all();
        $role = Role::create(['name' => $roleData['name']]);
        $role->syncPermissions($roleData['permission']);
        return redirect()->back()->with('success', 'Role Created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $chunks = $permissions->chunk(4);
        $assignedPermissions = $role->permissions->pluck('name')->toArray();
        // dd($assignedPermissions);
        return view('role.edit', compact('chunks', 'assignedPermissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // dd($request->all());
        $roleName = $request->name;
        $permissions = $request->permission;
        $role->update(['name' => $roleName]);
        $role->syncPermissions($permissions);
        return redirect()->back()->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
