<x-admin-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-gray-100 font-sans">
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-2xl p-8 bg-white rounded-lg shadow-lg">
                <!-- Header with Cancel Button -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Edit Gallery Category</h1>
                </div>

                <!-- Scrollable Form Container -->
                <div class="overflow-y-auto max-h-[calc(100vh-200px)] p-4 bg-white rounded-lg shadow-md">
                    <!-- Edit Form -->
                    <form action="{{ route('admin.galleryCategory.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="gallery_category" class="block text-sm font-medium text-gray-700">Gallery Category</label>
                            <input type="text" id="gallery_category" name="gallery_category" value="{{ $blog->gallery_category }}"
                                   class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- Blog Title Input -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <input type="text" id="content" name="content" value="{{ $blog->content }}"
                                   class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- Publish Toggle -->
                        <div class="flex items-center space-x-2 mb-4">
                            <label for="toggle_published" class="text-xs font-medium text-gray-700 dark:text-gray-300">Publish *</label>
                            <input type="hidden" name="is_published" id="is_published" value="{{ old('is_published', $blog->is_published) }}">
                            <label for="toggle_published" class="relative inline-block w-10 h-5">
                                <input type="checkbox" id="toggle_published" class="sr-only peer" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                                <div class="w-10 h-5 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-green-500 transition-all"></div>
                                <div class="absolute left-1 top-0.5 w-4 h-4 bg-white dark:bg-gray-300 rounded-full transition-all peer-checked:left-5"></div>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        document.getElementById('toggle_published').addEventListener('click', function () {
            const isPublishedInput = document.getElementById('is_published');
            const isPublished = isPublishedInput.value === '1';
            isPublishedInput.value = isPublished ? '0' : '1';
            this.setAttribute('aria-pressed', !isPublished);
        });
    </script>
</x-admin-app-layout>