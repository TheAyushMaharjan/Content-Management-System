<?php

namespace App\Http\Controllers\Editor\pages\Setting;

use App\Models\cr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\pages\setting\Setting;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\admin\pages\media\GalleryCategory;
use Illuminate\Routing\Controllers\HasMiddleware;

class HeaderController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
        new Middleware('permission:view header',only:['index']),
        new Middleware('permission:edit header',only:['edit']),
        new Middleware('permission:store header',only:['store']),
        new Middleware('permission:destroy header',only:['destroy']),
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
    
            return redirect()->route('editor.setting.header')->with('success', 'Data created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating data:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('editor.setting.header')->with('error', 'An error occurred while saving data. Please try again.');
        }
    }
    
    public function destroy(string $id)
    {
        // Find the record
        $data = Setting::find($id);
    
        // Check if the record exists
        if (!$data) {
            return redirect()->route('editor.setting.header')->with('error', 'Data not found.');
        }
    
        // Delete the record
        $data->delete();
    
        return redirect()->route('editor.setting.header')->with('success', 'Data deleted successfully.');
    }
    

    public function edit(string $id)
    {
        $articles = Setting::findOrFail($id);
        return view('articles.edit',compact('articles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'nullable|string|min:3',
            'content' => 'nullable|string|min:3',
            'email' => 'nullable|string|email',
            'contact' => 'nullable|string|min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the category by its ID
        $category = Setting::findOrFail($id);

        // Update category data
        $category->category_id = $request->category_id;
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->content = $request->content;
        $category->is_published = $request->is_published ? 1 : 0;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
            $category->image = $imagePath;
        }

        // Save the updated category
        $category->save();
        return redirect()->route('editor.gallerySetup.edit', ['id' => $category->id])
        ->with('success', 'Data updated successfully.');
    }
  
    // Display the user management page
    public function index()
    {
        // Use paginate() to get paginated results (10 items per page)
        $heading = Setting::paginate(10); // This will paginate the results
    
        // Pass both variables to the view
        return view('editor.pages.setting.headerSetting', ['heading' => $heading]);
    }
    public function headerDisplay(){
        $header = Setting::latest()->first();  
        
        if ($header && $header->image) {
            $header->image = asset('storage/' . $header->image); 
        }
    
        return response()->json($header);  // Return the header as a JSON response
    
    
}
}