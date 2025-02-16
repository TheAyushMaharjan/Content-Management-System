<x-editor-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#E0E1DD] dark:text-[#E0E1DD] leading-tight">
            {{ __('Setting') }}
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
                <h2 class="font-bold text-xl  un text-gray-800 pt-3 dark:text-gray-900 leading-tight">
                    {{ __("Header Setting") }}
                </h2>
                <!-- Flexbox Layout for Form and Table -->
                <div class="flex gap-6 pt-6">
                    @can('store header')
                    <!-- Form Section with 40% width -->
                    <div class="w-full lg:w-2/5 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <form action="{{  route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-2">
                                <!-- Category Name and Icon Name in the same line -->
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Category Name -->
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Title
                                            *</label>
                                        <input type="text" name="title"
                                            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                            placeholder="Enter User name">
                                    </div>

                                    <!-- Icon Name -->
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Content
                                            *</label>
                                        <input type="text" name="content"
                                            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                            placeholder="Enter the name">
                                    </div>
                                </div>



                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Email -->
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                        <input type="text" name="email"
                                            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                            placeholder="Enter Email">
                                    </div>
                                    <!-- contact -->
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Contact
                                            *</label>
                                        <input type="contact" name="contact" class="w-full px-2 py-1 border border-gray-300
                                     dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100"
                                            placeholder="Enter the contact">

                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="image"
                                        class="block text-xs font-medium text-gray-700 dark:text-gray-300">Image</label>
                                    <input type="file" name="image" id="image"
                                        class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs dark:bg-gray-700 dark:text-gray-100">
                                </div>
                        
                            </div>


                            <!-- Form Buttons -->
                            <div class="mt-4 flex gap-2">
                                <button type="submit"
                                    class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">Save</button>
                                <button type="reset"
                                    class="px-3 py-1 bg-gray-300 text-gray-700 rounded text-xs hover:bg-gray-400">Reset</button>
                            </div>
                        </form>
                    </div>
                    @endcan
                    <!-- Table Section with 60% width -->
                    <div class="w-full lg:w-3/5 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                        <h2 class="text-gray-800 text-center dark:text-gray-100 text-2xl font-semibold mb-4">Heading Preview
                        </h2>

                        <!-- Table Container with Fixed Height -->
                        <div class="overflow-y-auto max-h-96 rounded-lg border border-gray-200 dark:border-gray-700">
                            <table id="categoryTable" class="w-full text-left border-collapse text-xs">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Title</th>
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Content</th>
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Logo</th>
                                           
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Email</th>
                                        <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Contact</th>
                                       <th
                                            class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-100 border-b dark:border-gray-600">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($heading as $index => $user)
                                    <tr
                                        class="hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200 border-b dark:border-gray-700">
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $user->title }}
                                        </td>
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $user->content }}</td>
                                        <td class="px-5 py-3">
                                            @if($user->image)
                                                <img src="{{ asset('storage/' . $user->image) }}" alt="Blog Image" class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                No Image
                                            @endif
                                        </td>                                      
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $user->email }}</td>
                                        <td class="px-5 py-3 text-gray-800 dark:text-gray-100">{{ $user->contact }}</td>
                                        
                                        <td class="px-5 py-3 flex items-center space-x-3">
                                            {{-- <a href="{{ route('admin.user.edit', $user->id) }}"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600 transition-colors">Edit</a> --}}
                                            <form action="{{ route('admin.setting.destroy', $user->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600 transition-colors ml-2">Delete</button>
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
                                Showing {{ $heading->firstItem() }} to {{ $heading->lastItem() }} of {{ $heading->total() }} entries
                            </div>
                            <div class="flex gap-1">
                                {{ $heading->links() }} <!-- This will display pagination links -->
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>

    </div>
    </body>
</x-admin-app-layout>