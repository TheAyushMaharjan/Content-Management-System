<?php

namespace App\Http\Controllers\admin\pages\User;

use App\Models\editor\Editor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller 
{
   
    public function index()
    {
        $users = Editor::latest()->paginate(10);
        return view('admin.pages.user.users.list',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name','ASC')->get();
        return view('admin.pages.user.users.create',[
            'roles'=> $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email', // Corrected unique check to check for 'email'
            'password' => 'required|min:6|same:password_confirmation', // Ensures password confirmation
            'password_confirmation' => 'required' // Ensures password confirmation

        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->route('admin.user.users.create')->withInput()->withErrors($validator);
        }
    
        // Create a new user
        $user = new Editor();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Store the encrypted password
        $user->save();
    
        $user->syncRoles($request->role);
        // Redirect back with success message
        return redirect()->route('admin.user.users.index')->with('success', 'User created successfully!');
    }
    

 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = Editor::findOrFail($id);
        $roles = Role::orderBy('name','ASC')->get();

        $hasRoles = $users->roles->pluck('id');
        return view('admin.pages.user.users.edit',[
            'users'=>$users,
            'roles'=>$roles,
            'hasRoles'=>$hasRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Editor::findOrFail($id);
        $validator  =Validator::make($request->all(),[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email,'.$id.',id'
        ]);
        if($validator->fails()){
            return redirect()->route('admin.user.users.edit',$id)->withInput()->withErrors($validator);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('admin.user.users.index',$id)->with('success','User Updated Successfully.');

    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Editor::where('id',$id)->delete();
       return redirect()->route('admin.user.users.index')->with('success','User deleted successfully');

    }
}

