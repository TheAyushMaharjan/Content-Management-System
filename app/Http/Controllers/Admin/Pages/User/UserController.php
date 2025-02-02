<?php

namespace App\Http\Controllers\admin\pages\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\editor\Editor;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'username' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|unique:editors,email', // Ensure email is unique in both tables
                'password' => 'required|string|min:8|confirmed',
                'contact' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'role' => 'required|in:user,editor',  // Ensure role is either 'user' or 'editor'
            ]);
    
            // Check the selected role (user or editor)
            if ($validatedData['role'] == 'editor') {
                // Store data in the Editor table
                Editor::create([
                    'username' => $validatedData['username'],
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                    'contact' => $validatedData['contact'],
                    'address' => $validatedData['address'],
                ]);
            } else {
                // Store data in the User table
                    User::create([
                    'username' => $validatedData['username'],
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                    'contact' => $validatedData['contact'],
                    'address' => $validatedData['address'],
                ]);
            }
    
            return redirect()->route('admin.user.manageUser')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating user: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('admin.user.manageUser')->with('error', 'An error occurred while creating the user. Please try again.');
        }
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        $editor = Editor::find($id);
    
        if ($user) {
            return view('admin.pages.user.manageUser', compact('user', 'isEditor', 'editor'));
        } elseif ($editor) {
            return view('admin.pages.user.manageUser', compact('editor', 'isEditor', 'user'));
        } else {
            // Handle the case where neither User nor Editor is found
            return redirect()->route('admin.user.manageUser')->with('error', 'User or Editor not found.');
        }
    }
    
    
    public function update(request $request, string $id){
        $validateUser =  Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id, // Allow same email for the same user
                'password' => 'nullable|string|min:8|confirmed',
                'contact' => 'required|string|max:15',
                'address' => 'required|string|max:255',
        ]);
        if ($validateUser->fails()) {
            return redirect()->route('admin.user.manageUser')
                ->withErrors($validateUser)
                ->withInput(); // Keeps old input
        }
            $user = User::findOrFail($id);
            $editor = Editor::findOrFail($id);

            if ($user) {
                // If it's a User, update the User
                $user->update([
                    'username' => $request['username'],
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => $request->password ? bcrypt($request->password) : $user->password, // Hash password only if provided
                    'contact' => $request['contact'],
                    'address' => $request['address'],
                ]);
                return redirect()->route('admin.user.manageUser')->with('success', 'User data edited successfully.');
            } elseif ($editor) {
                // If it's an Editor, update the Editor
                $editor->update([
                    'username' => $request['username'],
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => $request->password ? bcrypt($request->password) : $editor->password, // Hash password only if provided
                    'contact' => $request['contact'],
                    'address' => $request['address'],
                ]);
                return redirect()->route('admin.user.manageUser')->with('success', 'Editor data edited successfully.');
            }
            return redirect()->route('admin.user.manageUser')->with('error', 'User/Editor not found.');

    }

    public function destroy(string $id){
        $data = User::where('id',$id)->delete();
        return redirect()->route('admin.user.manageUser')->with('success', 'Data deleted successfully.');
    }


    public function manageUser(){
        // Paginate users and editors separately
        $users = User::paginate(10);
        $editors = Editor::paginate(10);
    
        // Add a 'type' attribute to distinguish between User and Editor
        $users->getCollection()->transform(function($user) {
            $user->type = 'User'; // Add the 'type' property
            return $user;
        });
    
        $editors->getCollection()->transform(function($editor) {
            $editor->type = 'Editor'; // Add the 'type' property
            return $editor;
        });
    
        // Combine the two collections
        $combined = $users->merge($editors);
    
        // Manually paginate the combined collection
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentResults = $combined->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginated = new LengthAwarePaginator($currentResults, $combined->count(), $perPage, $currentPage);
    
        return view('admin.pages.user.manageUser', compact('paginated'));
    }
    
    
}
