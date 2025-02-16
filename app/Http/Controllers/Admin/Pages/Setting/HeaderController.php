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
        new Middleware('permission:view blog category',only:['index']),
        // new Middleware('permission:edit blogCategory',only:['edit']),
        new Middleware('permission:store blogCategory',only:['store']),
        new Middleware('permission:destroy blogCategory',only:['destroy']),
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
    


    // public function edit($id){
    //     $blog = GalleryCategory::findOrFail($id);

    //     return view('admin.pages.media.galleryCategoryEdit',compact('blog'));
    // }

    // public function update(request $request, $id){
    //     $validateData = $request->validate([
    //         'gallery_category'=>'required|string|min:3',
    //             'content'=>'required|string|min:3',
    //             'is_published' => 'nullable|boolean',

    //     ]);
    //     $blog = GalleryCategory::findOrFail($id);
    //     $blog->is_published = $request->is_published ? 1 : 0; // Corrected column name
    //     $blog->gallery_category  = $request->gallery_category ; // Corrected column name
    //     $blog->content  = $request->content ; // Corrected column name

        
    //     $blog->save();

    //     return redirect()->route('admin.galleryCategory.galleryCategory')->with('success', 'Data Updated successfully.');

    // }


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