<?php

namespace App\Http\Controllers\admin\pages\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller 
{
   
    public function index(){
        $roles = Role::orderBy('name','ASC')->paginate(10);
        return view('admin.pages.roles.list',[
            'roles'=>$roles
        ]);
    }
    public function create(){
        
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('admin.pages.roles.create',[
            'permissions' => $permissions
        ]);
        
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:roles,name'
        ]);
    
        if ($validator->passes()) {
            // Create a new role and assign it to $role
            $role = Role::create(['name' => $request->name,
            'guard_name'=>'editor'
        ]);
    
            // Check if permissions exist and assign them to the role
            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name); // Corrected function name
                }
            }
    
            return redirect()->route('admin.user.roles')->with('success', 'Role added successfully!');
        } else {
            return redirect()->route('admin.user.roles.create')->withInput()->withErrors($validator);
        }
    }

    public function edit(Request $request, $id)
    {
        // Fetch the role without assuming a fixed guard
        $role = Role::where('id', $id)->first();
    
        if (!$role) {
            return redirect()->route('admin.user.roles')->with('error', 'Role not found.');
        }
    
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();
    
        // Define categories to ensure all permissions are displayed even if no match
        $categories = [
            'blog setup',
            'blog category',
            'gallery setup',
            'gallery category',
            'setting',
            'general', // Fallback category for uncategorized permissions
        ];
    
        // Categorize permissions, ensuring all are included
        $categorizedPermissions = [];
        foreach ($categories as $category) {
            $categorizedPermissions[$category] = $permissions->filter(
                fn($permission) => str_contains(strtolower($permission->name), strtolower($category))
            );
        }
    
        // Add a 'general' category for permissions that don't fit anywhere
        $categorizedPermissions['general'] = $permissions->reject(
            fn($permission) => collect($categories)->contains(
                fn($category) => str_contains(strtolower($permission->name), strtolower($category))
            )
        );
    
        return view('admin.pages.roles.edit', [
            'permissions' => $permissions,
            'categorizedPermissions' => $categorizedPermissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
    
        if (!$role) {
            return redirect()->route('admin.user.roles')->with('error', 'Role not found.');
        }
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:roles,name,' . $id . ',id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.user.roles.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }
    
        // Update role name
        $role->name = $request->name;
        $role->save();
    
        // ✅ Fix: Ensure we use "permissions" (same as Blade file)
        $permissions = $request->has('permissions') ? $request->permissions : [];
    
        // ✅ Fix: Sync only when permission exists
        $role->syncPermissions($permissions);
    
        return redirect()->route('admin.user.roles')->with('success', 'Role updated successfully!');
    }
    
    
    
    public function destroy(string $id){
        $data = Role::where('id',$id)->delete();
        return redirect()->route('admin.user.roles')->with('success', 'Data deleted successfully.');
    }
}

