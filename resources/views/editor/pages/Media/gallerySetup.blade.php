<x-editor-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-[#E0E1DD] leading-tight">
            {{ __('Media Management') }}
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
                    {{ __("Media Setup") }}
                </h2>
                <!-- Flexbox Layout for Form and Table -->
                <div class="flex gap-6 pt-6">
                    <!-- Category Management Form Table (left side) -->

                    <div class="w-full lg:w-2/5 bg-white dark:bg-[#1B263B] p-4 rounded-lg shadow-sm">
                        <form action="{{ route('admin.gallerySetup.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class=" space-y-2">
                            <div class="mb-4">
                                <label for="category_id"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300">Category
                                    *</label>
                                    <select name="category_id" id="category_id"
                                    class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                    required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($gallery_category as $category)
                                        <option value="{{ $category->id }}">{{ $category->gallery_category }}</option>
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
                        <label for="slug" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Slug
                            *</label>
                        <input type="text" name="slug" id="slug"
                            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                            required>
                    </div>

                    <!-- Content Input -->
                    <div class="mb-4">
                        <label for="content" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Content
                            *</label>
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
                <div class="w-full lg:w-3/5 bg-white dark:bg-[#1B263B] p-6 rounded-2xl shadow-lg">
                    <h2 class="text-gray-800 dark:text-gray-100 text-2xl font-semibold text-center mb-4">Category List</h2>
                
                    <div class="overflow-y-auto max-h-96 rounded-lg border border-gray-200 dark:border-gray-700">
                        <table id="categoryTable" class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">Category</th>
                                    <th class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">Title</th>
                                    <th class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">Slug</th>
                                    <th class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">Content</th>
                                    <th class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">Image</th>
                                    <th class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">Status</th>
                                    <th class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mediaData as $category)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200 border-b dark:border-gray-700">
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $category->category_id }}</td>
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $category->title }}</td>
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $category->slug }}</td>
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $category->content }}</td>
                                        <td class="py-2 px-4 border-b">
                                            @if($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}" alt="Blog Image" class="w-16 h-16 object-cover rounded-md">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td class="px-5 py-3">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $category->is_published ? 'bg-green-100 text-green-600 dark:bg-green-600 dark:text-green-100' : 'bg-red-100 text-red-600 dark:bg-red-600 dark:text-red-100' }}">
                                                {{ $category->is_published ? 'Published' : 'Draft' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3 flex justify-center items-center space-x-3">
                                            <a href="{{ route('admin.gallerySetup.edit', $category->id) }}"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600 transition-colors">Edit</a>
                                            
                                            <form action="{{ route('admin.gallerySetup.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600 transition-colors">Delete</button>
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
                            Showing {{ $mediaData->firstItem() }} to {{ $mediaData->lastItem() }} of {{ $mediaData->total() }} entries
                        </div>
                        <div class="flex gap-1">
                            {{ $mediaData->links() }}
                        </div>
                    </div>
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