<?php

namespace App\Http\Controllers\admin\pages\Blog;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\editor\Editor;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\pages\blog\BlogCategory;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogCategoryController extends Controller
{

    public function store(request $request){
        try{
            
            $validateData = $request->validate([
                'category_name'=>'required|string|min:3',
                'icon_name'=>'required|string|min:3',
                'description'=>'nullable|string|min:3',
                'is_published' => 'nullable|in:0,1',

            ]);
            Log::info('Validation Data:', $validateData); // Check if validation is passing

            BlogCategory::create([
                'category_name'=>$validateData['category_name'],
                'icon_name'=>$validateData['icon_name'],
                'description'=>$validateData['description'] ?? null,
                'is_published' => $request->input('is_published',0),
            ]);
            return redirect()->route('admin.blog.blogSetup')->with('success','Blog added Successfully!');
        }
        catch(\Exception $e){
            Log::error('Error creating user: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('admin.blog.blogSetup')->with('error', 'An error occurred while creating the blog. Please try again.');
       
        }
    }
    public function destroy(string $id){
        $data = BlogCategory::where('id',$id)->delete();
        return redirect()->route('admin.user.blogSetup')->with('success', 'Data deleted successfully.');
    }


    public function storeEdit($id){
        $blog = BlogCategory::findOrFail($id);

        return view('admin.blog.blogSetupEdit',compact('blog'));
    }

    public function update(request $request, $id){
        $validateData = $request->validate([
            'category_name'=>'required|string|min:3',
            'icon_name'=>'required|string|min:3',
            'description'=>'nullable|string|min:3',
            'is_published' => 'nullable|in:0,1',

        ]);
        $blog = BlogCategory::findOrFail($id);
        $blog->is_published = $request->filled('is_published') ? 1 : 0; // Corrected column name
        $blog->category_name  = $request->category_name ; // Corrected column name
        $blog->icon_name  = $request->icon_name ; // Corrected column name
        $blog->description  = $request->description ; // Corrected column name

        
        $blog->save();

        return redirect()->route('admin.blog.blogSetup')->with('success', 'Data Updated successfully.');

    }


    // Display the user management page
    public function blogCategory()
{
    // Retrieve the blogs and categories
    $blogsData = BlogCategory::paginate(10); // Adjust the number as per your requirement

    // Pass both variables to the view
    return view('admin.blog.blogCategory', [
        'blogsData' => $blogsData,
    ]);
}
    
}
