<?php

namespace App\Http\Controllers\admin\pages\Setting;

use App\Models\cr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\admin\pages\setting\Setting;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\admin\pages\media\GalleryCategory;
use Illuminate\Routing\Controllers\HasMiddleware;

class HeaderController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
        new Middleware('permission:view settingheader',only:['index']),
        new Middleware('permission:edit settingheader',only:['edit']),
        new Middleware('permission:store settingheader',only:['store']),
        new Middleware('permission:destroy settingheader',only:['destroy']),
        ];
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'nullable|string|min:3',
                'content' => 'nullable|string|min:3',
                'email' => 'nullable|string|email',
                'contact' => 'nullable|string|min:3',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $data = new Setting();
            $data->title = $validatedData['title'];
            $data->content = $validatedData['content'];
            $data->email = $validatedData['email'];
            $data->contact = $validatedData['contact'];
    
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $data->image = $imagePath;
            }
    
            $data->save();
    
            Log::info('Data Saved Successfully:', $data->toArray());
    
            return redirect()->route('admin.setting.header')->with('success', 'Data created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating data:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('admin.setting.header')->with('error', 'An error occurred while saving data. Please try again.');
        }
    }
    
    public function destroy(string $id)
    {
        // Find the record
        $data = Setting::find($id);
    
        // Check if the record exists
        if (!$data) {
            return redirect()->route('admin.setting.header')->with('error', 'Data not found.');
        }
    
        // Delete the record
        $data->delete();
    
        return redirect()->route('admin.setting.header')->with('success', 'Data deleted successfully.');
    }
    


    public function edit($id){
        $articles = Setting::findOrFail($id);

        return view('admin..pages.setting.edit',compact('articles'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate incoming request
            $validatedData = $request->validate([
                'title' => 'nullable|string|min:3',
                'content' => 'nullable|string|min:3',
                'email' => 'nullable|string|email',
                'contact' => 'nullable|string|min:3',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Find the record
            $category = Setting::findOrFail($id);
    
            // Update fields
            $category->title = $validatedData['title'];
            $category->content = $validatedData['content'];
            $category->email = $validatedData['email'];
            $category->contact = $validatedData['contact'];
    
            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $category->image = $imagePath;
            }
    
            // Save the updated category
            $category->save();
    
            return redirect()->route('admin.setting.index')
                ->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.setting.index')
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    // Display the user management page
    public function index()
    {
        // Use paginate() to get paginated results (10 items per page)
        $heading = Setting::paginate(10); // This will paginate the results
    
        // Pass both variables to the view
        return view('admin.pages.setting.headerSetting', ['heading' => $heading]);
    }
    public function headerDisplay(){
        $header = Setting::latest()->first();  
        
        if ($header && $header->image) {
            $header->image = asset('storage/' . $header->image); 
        }
    
        return response()->json($header);  // Return the header as a JSON response
    
    
}
}