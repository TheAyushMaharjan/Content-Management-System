<?php

namespace App\Http\Controllers\admin\pages\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions =Permission::orderBy('created_at','DESC')->paginate(10);
        return view('admin.pages.user.permissions.list',[
            'permissions' =>$permissions
        ]);

    }
    public function create()
    {
        return view('admin.pages.user.permissions.create');
    }
    public function store(request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3,'

        ]);
        if ($validator->passes()) {
            Permission::create([
                'name' => $request->name,
                'guard_name'=>'editor'
            ]);
            return redirect()->route('admin.user.permissions')->with('success', 'Permission added successfully!');
        } else {
            return redirect()->route('admin.user.permissions.create')->withInput()->withErrors($validator);
        }
    }
    public function edit(string $id)
    {
        $permission =Permission::findOrFail($id);
        return view('admin.pages.user.permissions.edit',compact('permission'));
    }

public function update(Request $request, $id)
{
    $permission = Permission::findOrFail($id);
    
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3|unique:permissions,name,' . $id . ',id', // Ensure the table is plural
    ]);

    if ($validator->passes()) {
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('admin.user.permissions')->with('success', 'Permission updated successfully!');
    } else {
        return redirect()->route('admin.user.permissions.edit', $id)->withInput()->withErrors($validator); // Corrected the route to pass the ID
    }
}

public function destroy(string $id){
    $data = Permission::where('id',$id)->delete();
    return redirect()->route('admin.user.permissions')->with('success', 'Data deleted successfully.');
}
}
