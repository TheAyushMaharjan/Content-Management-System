<x-editor-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#E0E1DD] dark:text-[#E0E1DD] leading-tight">
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
                <h2 class="font-bold text-xl  text-gray-800 pt-3 dark:text-gray-900 leading-tight">
                    {{ __("Blog Category") }}
                </h2>
                <!-- Flexbox Layout for Form and Table -->
                <div class="flex gap-6 pt-6">
                    <!-- Category Management Form Table (left side) -->
                    <div class="w-full lg:w-2/5 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <form action="{{ route('admin.blog.store') }}" method="POST">
                            @csrf
                            <div class="space-y-2">
                                <h2 class="text-gray-700 text-center dark:text-gray-100 text-2xl font-bold py-2">
                                    Category Form</h2>
                                <div>
                                    <label
                                        class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Category
                                        Name *</label>
                                    <input type="text" name="category_name"
                                        class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                        placeholder="Enter Category Name" required>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Icon
                                        Name *</label>
                                    <input type="text" name="icon_name"
                                        class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                        placeholder="Enter Icon Name (e.g., fa fa-icon)" required>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                                    <textarea name="description"
                                        class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                        placeholder="Enter Description" style="resize: none;"></textarea>
                                </div>

                                <!-- Toggle Switch for Publish -->
                                <div class="flex items-center space-x-2">
                                    <label for="toggle_published"
                                        class="text-xs font-medium text-gray-700 dark:text-gray-300">Publish *</label>

                                    <!-- Custom Toggle Switch -->
                                    <label for="toggle_published" class="relative inline-block w-10 h-5">
                                        <input type="checkbox" id="toggle_published" name="is_published" value="1"
                                            class="sr-only peer">
                                        <div
                                            class="w-10 h-5 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-green-500 transition-all">
                                        </div>
                                        <div
                                            class="absolute left-1 top-0.5 w-4 h-4 bg-white dark:bg-gray-300 rounded-full transition-all peer-checked:left-5">
                                        </div>
                                    </label>
                                </div>


                                <div class="mt-4 flex gap-2">
                                    <button type="submit"
                                        class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">Save</button>
                                    <button type="reset"
                                        class="px-3 py-1 bg-gray-300 text-gray-700 rounded text-xs hover:bg-gray-400">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Category List Table (right side) -->
                    <div class="w-full lg:w-3/5 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                        <h2 class="text-gray-800 text-center dark:text-gray-100 text-2xl font-semibold mb-4">Category
                            List</h2>

                        <div class="overflow-y-auto max-h-96 rounded-lg border border-gray-200 dark:border-gray-700">
                            <table id="categoryTable" class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Category Name</th>
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Icon Name</th>
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Description</th>
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Status</th>
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogsData as $category)
                                    <tr
                                        class="hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200 border-b dark:border-gray-700">
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{
                                            $category->category_name }}</td>
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $category->icon_name
                                            }}</td>
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $category->description
                                            }}</td>
                                        <td class="px-5 py-3">
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-medium {{ $category->is_published ? 'bg-green-100 text-green-600 dark:bg-green-600 dark:text-green-100' : 'bg-red-100 text-red-600 dark:bg-red-600 dark:text-red-100' }}">
                                                {{ $category->is_published ? 'Published' : 'Draft' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3 flex items-center space-x-3">
                                            @can('edit blog category')
                                            <a href="{{ route('admin.blog.edit', $category->id) }}"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600 transition-colors">Edit</a>
                                            @endcan

                                            @can('delete blog category')
                                            <form action="{{ route('admin.blog.destroy', $category->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600 transition-colors">Delete</button>
                                            </form>
                                            @endcan

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

    </div>
    </body>
</x-admin-app-layout>