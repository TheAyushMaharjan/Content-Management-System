<?php

namespace App\Http\Controllers\admin\pages\Gallery;

use App\Models\cr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\admin\pages\media\GalleryCategory;

class GalleryCategoryController extends Controller
{
  
    public function store(request $request){
        try{
            
            $validateData = $request->validate([
                'gallery_category'=>'required|string|min:3',
                'content'=>'required|string|min:3',
                'is_published' => 'nullable|in:0,1',

            ]);
            Log::info('Validation Data:', $validateData); // Check if validation is passing

            GalleryCategory::create([
                'gallery_category'=>$validateData['gallery_category'],
                'content'=>$validateData['content'],
                'is_published' => $request->input('is_published',0),
            ]);
            return redirect()->route('admin.galleryCategory.galleryCategory')->with('success','media added Successfully!');
        }
        catch(\Exception $e){
            Log::error('Error creating user: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('admin.galleryCategory.galleryCategory')->with('error', 'An error occurred while creating the blog. Please try again.');
       
        }
    }
    public function destroy(string $id){
        $data = GalleryCategory::where('id',$id)->delete();
        return redirect()->route('admin.galleryCategory.galleryCategory')->with('success', 'Data deleted successfully.');
    }


    public function edit($id){
        $blog = GalleryCategory::findOrFail($id);

        return view('admin.galleryCategory.edit',compact('blog'));
    }

    public function update(request $request, $id){
        $validateData = $request->validate([
            'gallery_category'=>'required|string|min:3',
                'content'=>'required|string|min:3',
            'is_published' => 'nullable|in:0,1',

        ]);
        $blog = GalleryCategory::findOrFail($id);
        $blog->is_published = $request->filled('is_published') ? 1 : 0; // Corrected column name
        $blog->gallery_category  = $request->gallery_category ; // Corrected column name
        $blog->content  = $request->content ; // Corrected column name

        
        $blog->save();

        return redirect()->route('admin.galleryCategory.galleryCategory')->with('success', 'Data Updated successfully.');

    }


    // Display the user management page
    public function galleryCategory()
{
    // Retrieve the blogs and categories
    $gallery_category = GalleryCategory::all(); // Adjust the number as per your requirement

    $blogsData = GalleryCategory::paginate(10); // Adjust the number as per your requirement

    // Pass both variables to the view
    return view('admin.pages.media.GalleryCategory', ['blogsData' => $blogsData,'gallery_category'=>$gallery_category]);
}
    
}
