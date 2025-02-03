<x-admin-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 font-sans">
        <div class="container mx-auto p-6">
            <!-- Header with Cancel Button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Edit Blog</h1>
            </div>

            <!-- Scrollable Form Container -->
            <div class="overflow-y-auto max-h-[calc(100vh-200px)] p-4 bg-white rounded-lg shadow-md">
                <!-- Edit Form -->
                <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                    <!-- Blog Category Dropdown -->
                    <div class="mb-4">
                        <label for="category_name" class="block text-sm font-medium text-gray-700">Category Name</label>
                        <input type="text" id="category_name" name="category_name"  value="{{ $blog->category_name }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>

                    <!-- Blog Title Input -->
                    <div class="mb-4">
                        <label for="icon_name" class="block text-sm font-medium text-gray-700">Icon Name</label>
                        <input type="text" id="icon_name" name="icon_name"   value="{{ $blog->icon_name }}"class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>

                    <!-- Slug Input -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" id="description" name="description"  value="{{ $blog->description }}"  class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
category
                       <!-- Toggle Switch for Publish -->
    <div class="flex items-center space-x-2">
        <label for="toggle_published" class="text-xs font-medium text-gray-700 dark:text-gray-300">Publish *</label>

        <!-- Hidden Input Field to Submit Value -->
        <input type="hidden" name="is_published" id="is_published" value="{{ $blog->is_published }}">

        <!-- Custom Toggle Switch -->
        <label for="toggle_published" class="relative inline-block w-10 h-5">
            <input type="checkbox" id="toggle_published" class="sr-only peer"
                @checked($blog->is_published) value="1" onchange="this.form.is_published.value = this.checked ? 1 : 0">
            <div class="w-10 h-5 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-green-500 transition-all"></div>
            <div class="absolute left-1 top-0.5 w-4 h-4 bg-white dark:bg-gray-300 rounded-full transition-all peer-checked:left-5"></div>
        </label>
    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-500 text-white px-4 pt-3 py-2 rounded-md hover:bg-blue-600">Save Changes</button>
                </form>
            </div>
        </div>
    </body>
</x-admin-app-layout>