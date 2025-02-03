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

<form action="{{ route('admin.blogSetup.update', $blogsData->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Use PUT for update operations -->

    <!-- Category Selection -->
    <div class="mb-4">
        <label for="category_id" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Category *</label>
        <select name="category_id" id="category_id"
            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
            required>
            <option value="" disabled>Select Category</option>
            @foreach ($category_name as $category)
                <option value="{{ $category->id }}" {{ $blogsData->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Title Input -->
    <div class="mb-4">
        <label for="title" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Title *</label>
        <input type="text" name="title" id="title"
            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
            value="{{ old('title', $blogsData->title) }}" required>
    </div>

    <!-- Slug Input -->
    <div class="mb-4">
        <label for="slug" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Slug *</label>
        <input type="text" name="slug" id="slug"
            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
            value="{{ old('slug', $blogsData->slug) }}" required>
    </div>

    <!-- Content Input -->
    <div class="mb-4">
        <label for="content" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Content *</label>
        <textarea name="content" id="content"
            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
            required>{{ old('content', $blogsData->content) }}</textarea>
    </div>

    <!-- Image Input -->
    <div class="mb-4">
        <label for="image" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Image</label>
        <input type="file" name="image" id="image"
            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100">
        @if ($blogsData->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $blogsData->image) }}" alt="Current Image" class="w-20 h-20 object-cover">
            </div>
        @endif
    </div>

    <!-- Author Input -->
    <div class="mb-4">
        <label for="author" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Author *</label>
        <input type="text" name="author" id="author"
            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
            value="{{ old('author', $blogsData->author) }}" required>
    </div>

    <!-- Publish Toggle -->
    <div class="flex items-center space-x-2 mb-4">
        <label for="toggle_published" class="text-xs font-medium text-gray-700 dark:text-gray-300">Publish *</label>
        <input type="hidden" name="is_published" id="is_published" value="{{ old('is_published', $blogsData->is_published) }}">
        <label for="toggle_published" class="relative inline-block w-10 h-5">
            <input type="checkbox" id="toggle_published" class="sr-only peer" 
                {{ old('is_published', $blogsData->is_published) ? 'checked' : '' }}>
            <div class="w-10 h-5 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-green-500 transition-all"></div>
            <div class="absolute left-1 top-0.5 w-4 h-4 bg-white dark:bg-gray-300 rounded-full transition-all peer-checked:left-5"></div>
        </label>
    </div>

    <!-- Submit Button -->
    <div class="mt-4 flex gap-2">
        <button type="submit"
            class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.blogSetup.blogSetup') }}"
            class="px-3 py-1 bg-gray-300 text-gray-700 rounded text-xs hover:bg-gray-400">Cancel</a>
    </div>
</form>
 </div>
        </div>
    </body>
</x-admin-app-layout>
<script>
    document.getElementById('toggle_published').addEventListener('change', function () {
        document.getElementById('is_published').value = this.checked ? 1 : 0;
    });
</script>
