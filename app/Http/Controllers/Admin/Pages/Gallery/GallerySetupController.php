<?php

namespace App\Http\Controllers\admin\pages\Gallery;

use App\Models\cr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\admin\pages\media\GallerySetup;
use App\Models\admin\pages\media\GalleryCategory;

class GallerySetupController extends Controller
{
  
    public function store(Request $request)
    {
        try{
        // Validate the request
        $validatedData = $request->validate([
            'category_id' => 'required', 
            'title' => 'required|string|min:3',
            'slug' => 'required|string|min:3', 
            'content' => 'required|string|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'required|boolean',
        ]);
        Log::info('Validation Data:', $validatedData); // Check if validation is passing
    
        // Create a new blog category entry
        $data = new GallerySetup();
        $data->category_id = $validatedData['category_id']; 
        $data->title = $validatedData['title'];
        $data->slug = $validatedData['slug'];
        $data->content = $validatedData['content'];
        $data->is_published = $validatedData['is_published'];
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store in 'public/images'
            $data->image = $imagePath;
        }
        $data->save();
        // Save the blog category data
    
        // Redirect back with success message
        return redirect()->route('admin.gallerySetup.gallerySetup')->with('success', 'Blog Category created successfully!');
    }
    catch(\Exception $e){
        Log::error('Error creating user: ', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return redirect()->route('admin.gallerySetup.gallerySetup')->with('error', 'An error occurred while creating the blog. Please try again.');
   
    }
}
    
    public function destroy(string $id){
        $data = GallerySetup::where('id',$id)->delete();
        return redirect()->route('admin.blogSetup.blogSetup')->with('success', 'Data deleted successfully.');
    }

    public function edit($id){
        $blogsData = GallerySetup::findOrFail($id);
        $category_name = GalleryCategory::where('is_published',1)->get(); 
        return view('admin.pages.media.gallerySetupEdit', [
            'blogsData' => $blogsData,
            'category_name' => $category_name
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        // Find the category by its ID
        $category = GallerySetup::findOrFail($id);

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

        // Redirect with success message
        return redirect()->route('admin.gallerySetup.edit')->with('success', 'Category updated successfully.');
    }
    public function gallerySetup(){
        $mediaData =GallerySetup::paginate(10);
        $gallery_category = GalleryCategory::where('is_published',1)->get(); 
       
                return view('admin.pages.media.gallerySetup', [
            'mediaData' => $mediaData,
            'gallery_category' => $gallery_category
        ]);
        }

}
