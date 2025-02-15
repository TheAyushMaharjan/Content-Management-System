<x-editor-app-layout>

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-gray-100 font-sans">
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-2xl p-8 bg-white rounded-lg shadow-lg">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-3xl font-semibold text-gray-800">Edit Blog</h1>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.gallerySetup.update', $blogsData->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Category Selection -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category *</label>
                        <select name="category_id" id="category_id"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                            <option value="" disabled>Select Category</option>
                            @foreach ($gallery_category as $category)
                            <option value="{{ $category->id }}" {{ $blogsData->category_id == $category->id ? 'selected'
                                : '' }}>
                                {{ $category->gallery_category }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                        <input type="text" name="title" id="title"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            value="{{ old('title', $blogsData->title) }}" required>
                    </div>

                    <!-- Slug Input -->
                    <div class="mb-4">
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug *</label>
                        <input type="text" name="slug" id="slug"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            value="{{ old('slug', $blogsData->slug) }}" required>
                    </div>

                    <!-- Content Input -->
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">Content *</label>
                        <textarea name="content" id="content" rows="4"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>{{ old('content', $blogsData->content) }}</textarea>
                    </div>


                    <!-- Publish Toggle -->
                    <div class="flex items-center space-x-2 mb-4">
                        <label for="toggle_published"
                            class="text-xs font-medium text-gray-700 dark:text-gray-300">Publish *</label>
                        <input type="hidden" name="is_published" id="is_published"
                            value="{{ old('is_published', $blogsData->is_published) }}">
                        <label for="toggle_published" class="relative inline-block w-10 h-5">
                            <input type="checkbox" id="toggle_published" class="sr-only peer" {{ old('is_published',
                                $blogsData->is_published) ? 'checked' : '' }}>
                            <div
                                class="w-10 h-5 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-green-500 transition-all">
                            </div>
                            <div
                                class="absolute left-1 top-0.5 w-4 h-4 bg-white dark:bg-gray-300 rounded-full transition-all peer-checked:left-5">
                            </div>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.gallerySetup.gallerySetup') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-400">Cancel</a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('toggle_published').addEventListener('click', function () {
                const isPublishedInput = document.getElementById('is_published');
                const isPublished = isPublishedInput.value === '1';
                isPublishedInput.value = isPublished ? '0' : '1';
                this.setAttribute('aria-pressed', !isPublished);
            });
        </script>
    </body>
</x-editor-app-layout>