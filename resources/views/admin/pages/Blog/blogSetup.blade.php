<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-900 leading-tight">
            {{ __('Blog Management') }}
        </h2>
    </x-slot>
    <div x-data :class="$store.sidebar.isCollapsed ? 'ml-20' : 'ml-10'" class="py-6 transition-all duration-300">
        
        <body class="bg-gray-50 dark:bg-gray-800 font-sans">
            <div class="container mx-auto p-4">
    
                <!-- Success and Error Messages -->
                @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4 rounded text-xs">
                    {{ session('success') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-4 rounded text-xs">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h2 class="font-bold text-l  un text-gray-800 pt-3 dark:text-gray-900 leading-tight">
                    {{ __("Blog Setup") }}
                </h2>
                    <!-- Flexbox Layout for Form and Table -->
                <div class="flex gap-6 pt-6">
                        <!-- Category Management Form Table (left side) -->

                        <div class="w-full lg:w-2/5 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                            <form action="{{ route('admin.blogSetup.store') }}" method="POST" enctype="multipart/form-data>
                                @csrf
                                <div class="space-y-2">
                                    <div class="mb-4">
                                        <label for="category_id"
                                            class="block text-xs font-medium text-gray-700 dark:text-gray-300">Category
                                            *</label>
                                            <select name="category_id" id="category_id"
                                            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                            required>
                                            <option value="" disabled selected>Select Category</option>
                                            @foreach ($category_name as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    <!-- Title Input -->
                                    <div class="mb-4">
                                        <label for="title"
                                            class="block text-xs font-medium text-gray-700 dark:text-gray-300">Title
                                            *</label>
                                        <input type="text" name="title" id="title"
                                            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                            required>
                                    </div>
                                </div>
                                <!-- Slug Input -->
                                <div class="mb-4">
                                    <label for="slug"
                                        class="block text-xs font-medium text-gray-700 dark:text-gray-300">Slug *</label>
                                    <input type="text" name="slug" id="slug"
                                        class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                        required>
                                </div>
    
                                <!-- Content Input -->
                                <div class="mb-4">
                                    <label for="content"
                                        class="block text-xs font-medium text-gray-700 dark:text-gray-300">Content *</label>
                                    <textarea name="content" id="content"
                                        class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                        required></textarea>
                                </div>
    
                                <!-- Image Input -->
                                <div class="mb-4">
                                    <label for="image"
                                        class="block text-xs font-medium text-gray-700 dark:text-gray-300">Image</label>
                                    <input type="file" name="image" id="image"
                                        class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100">
                                </div>
    
                                <!-- Author Input -->
                                <div class="mb-4">
                                    <label for="author"
                                        class="block text-xs font-medium text-gray-700 dark:text-gray-300">Author *</label>
                                    <input type="text" name="author" id="author"
                                        class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                        required>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <label for="toggle_published"
                                        class="text-xs font-medium text-gray-700 dark:text-gray-300">Publish *</label>
    
                                    <!-- Hidden Input Field to Submit Value -->
                                    <input type="hidden" name="is_published" id="is_published" value="0">
    
                                    <!-- Custom Toggle Switch -->
                                    <label for="toggle_published" class="relative inline-block w-10 h-5">
                                        <input type="checkbox" id="toggle_published" class="sr-only peer">
                                        <div
                                            class="w-10 h-5 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-green-500 transition-all">
                                        </div>
                                        <div
                                            class="absolute left-1 top-0.5 w-4 h-4 bg-white dark:bg-gray-300 rounded-full transition-all peer-checked:left-5">
                                        </div>
                                    </label>
                                </div>
    
                                <!-- Submit Button -->
                                <div class="mt-4 flex gap-2">
                                    <button type="submit"
                                        class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">Save</button>
                                    <button type="reset"
                                        class="px-3 py-1 bg-gray-300 text-gray-700 rounded text-xs hover:bg-gray-400">Reset</button>
                                </div>
                            </form>
    
                        </div>
    
                    <!-- Category List Table (right side) -->
                    <div class="w-full lg:w-6/5 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <table class="w-full">
                            <thead>
                                <th class="text-gray-700 dark:text-gray-100 text-xm font-medium py-2">Category List</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="overflow-y-auto max-h-96">
                                            <table class="w-full text-left border-collapse text-xs border border-gray-300 dark:border-gray-600">
                                                <thead>
                                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                                        <th class="px-3 py-2 font-medium text-gray-700 dark:text-gray-100 border">Category</th>
                                                        <th class="px-3 py-2 font-medium text-gray-700 dark:text-gray-100 border">Title</th>
                                                        <th class="px-3 py-2 font-medium text-gray-700 dark:text-gray-100 border">Slug </th>
                                                        <th class="px-3 py-2 font-medium text-gray-700 dark:text-gray-100 border">Content</th>
                                                        <th class="px-3 py-2 font-medium text-gray-700 dark:text-gray-100 border">Image</th>
                                                        <th class="px-3 py-2 font-medium text-gray-700 dark:text-gray-100 border">Author</th>
                                                        <th class="px-3 py-2 font-medium text-gray-700 dark:text-gray-100 border">Status</th>
                                                        <th class="px-3 py-2 font-medium text-gray-700 dark:text-gray-100 border">Action</th>



                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($blogsData as $category)
                                                        <tr class="hover:bg-gray-200 dark:hover:bg-gray-600 border-b">
                                                            <td class="px-3 py-2 text-gray-700 dark:text-gray-100 border">{{ $category->category_id }}</td>
                                                            <td class="px-3 py-2 text-gray-700 dark:text-gray-100 border">{{ $category->title }}</td>
                                                            <td class="px-3 py-2 text-gray-700 dark:text-gray-100 border">{{ $category->slug }}</td>
                                                            <td class="px-3 py-2 text-gray-700 dark:text-gray-100 border">{{ $category->content }}</td>
                                                            <td class="py-2 px-4 border-b">
                                                                @if($category->image)
                                                                    <img src="{{ asset('storage/' . $category->image) }}" alt="Blog Image" class="w-16 h-16 object-cover">
                                                                @else
                                                                    No Image
                                                                @endif
                                                            </td>                                                            <td class="px-3 py-2 text-gray-700 dark:text-gray-100 border">{{ $category->author }}</td>
                                                            <td class="px-3 py-2 text-gray-700 dark:text-gray-100 border">
                                                                <span class="text-xs font-semibold {{ $category->is_published ? 'text-green-500' : 'text-red-500' }}">
                                                                    {{ $category->is_published ? 'Published' : 'Draft' }}
                                                                </span>
                                                            </td>
                                                            <td class="px-3 py-2 text-gray-700 dark:text-gray-100 border flex items-center space-x-2">
                                                                
                                                                <form action="{{ route('admin.blogSetup.edit', $category->id) }}" method="POST" class="inline">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="text-blue-600 hover:text-blue-800">Edit</button>
                                                                </form>
                                                              <form action="{{ route('admin.blogSetup.destroy', $category->id) }}" method="POST" class="inline" 
                                                                      onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    
                                        <!-- Pagination -->
                                        <div class="mt-4 flex justify-between items-center text-xs">
                                            <div class="text-gray-700 dark:text-gray-300">
                                                Showing {{ $blogsData->firstItem() }} to {{ $blogsData->lastItem() }} of {{ $blogsData->total() }} entries
                                            </div>
                                            <div class="flex gap-1">
                                                {{ $blogsData->links() }}
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
                </div>
    
            </div>
        </body>
</x-admin-app-layout>
<script>
    document.getElementById('toggle_published').addEventListener('change', function () {
    document.getElementById('is_published').value = this.checked ? 1 : 0;
});

</script>