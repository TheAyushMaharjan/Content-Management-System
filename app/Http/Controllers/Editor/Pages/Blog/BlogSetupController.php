<?php

namespace App\Http\Controllers\Editor\pages\Blog;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\admin\pages\blog\BlogSetup;
use App\Models\admin\pages\blog\BlogCategory;

class BlogSetupController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
        new Middleware('permission:view blog setup',only:['index']),
        new Middleware('permission:edit blog setup',only:['edit']),
        new Middleware('permission:store blog setup',only:['store']),
        new Middleware('permission:destroy blog setup',only:['destroy']),
        ];
    }
    
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
            'author' => 'required|string|min:3',
            'is_published' => 'required|boolean',
        ]);
        Log::info('Validation Data:', $validatedData); // Check if validation is passing
    
        // Create a new blog category entry
        $data = new BlogSetup();
        $data->category_id = $validatedData['category_id']; // Fixed category_id
        $data->title = $validatedData['title'];
        $data->slug = $validatedData['slug'];
        $data->content = $validatedData['content'];
        $data->author = $validatedData['author'];
        $data->is_published = $validatedData['is_published'];
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store in 'public/images'
            $data->image = $imagePath;
        }
        $data->save();
        // Save the blog category data
    
        // Redirect back with success message
        return redirect()->route('editor.blogSetup.index')->with('success', 'Blog Category created successfully!');
    }
    catch(\Exception $e){
        Log::error('Error creating user: ', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return redirect()->route('editor.blogSetup.index')->with('error', 'An error occurred while creating the blog. Please try again.');
   
    }
}
    
    public function destroy(string $id){
        $data = BlogSetup::where('id',$id)->delete();
        return redirect()->route('editor.blogSetup.index')->with('success', 'Data deleted successfully.');
    }

    public function edit($id){
        $blogsData = BlogSetup::findOrFail($id);
        $category_name = BlogCategory::where('is_published',1)->get(); 
        return view('editor.pages.blog.blogSetupEdit', [
            'blogsData' => $blogsData,
            'category_name' => $category_name
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate input data
        $validateData = $request->validate([
            'category_id'   => 'required|exists:blog_categories,id',  
            'title'         => 'required|string|min:3',
            'slug'          => 'required|string|min:3', // Ensure slug is unique except for the current blog
            'content'       => 'required|string|min:3',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author'        => 'required|string|min:3',
            'is_published'  => 'required|boolean',
        ]);
    
        $blog = BlogSetup::findOrFail($id);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); 
            $validateData['image'] = $imagePath;
        }
    
        // Update blog fields
        $blog->update([
            'category_id'   => $validateData['category_id'],
            'title'         => $validateData['title'],
            'slug'          => $validateData['slug'],
            'content'       => $validateData['content'],
            'author'        => $validateData['author'],
            'is_published'  => $validateData['is_published'],
            'image'         => $validateData['image'] ?? $blog->image, // Keep old image if not updated
        ]);
    
        return redirect()->route('editor.blogSetup.index', ['id' => $blog->id])
        ->with('success', 'Data updated successfully.');
}
    public function index(){
        $blogsData =BlogSetup::paginate(10);
        $category_name = BlogCategory::where('is_published',1)->get(); 
        return view('editor.pages.blog.blogSetup', [
            'blogsData' => $blogsData,
            'category_name' => $category_name
        ]);
        }

        //for frontend display
        public function frontDisplay(Request $request)
{
    $blogs = BlogSetup::where('is_published',1)->paginate(10); 

    $blogs->getCollection()->transform(function ($blog) {
        $blog->image = $blog->image ? asset('storage/' . $blog->image) : null;
        return $blog;
    });

    return response()->json($blogs);
}

        


}
