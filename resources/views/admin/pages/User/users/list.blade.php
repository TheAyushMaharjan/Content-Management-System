<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-50 leading-tight">
            {{ __('LIST OF USERS') }}
        </h2>
    </x-slot>
    <div x-data :class="$store.sidebar.isCollapsed ? 'ml-20' : 'ml-10'" class="py-6 transition-all duration-300">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
    
            <!-- View Permissions Section -->
            <div class="view bg-white overflow-hidden flex justify-between mb-6 items-center shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("View USERS") }}
                </div>
                <div class="create p-6">
                    <a class="bg-black text-gray-200 rounded-md px-4 py-2" href="{{route('admin.user.users.create')}}">Create</a>
                </div>
            </div>
    
            <!-- Table Section -->
            <div class="Table bg-white pt-10 shadow-sm sm:rounded-lg mb-6  px-4"> <!-- Added mb-6 -->
                <table id='categoryTable' class="w-full">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Name</th>
                            <th>roles</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->isNotEmpty())
                        @foreach($users as $user) <!-- Assuming $permissions is passed from the controller -->
                        <tr>
                            <td>{{ $user->id }}</td> <!-- Displays the row number -->
                            <td>{{ $user->name }}</td> <!-- Display the permission name -->
                            <td>{{ $user->roles->pluck('name')->implode(', ')}}</td> <!-- Display the permission name -->

                            <td>{{ $user->email}}</td> <!-- Display the permission name -->
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</td> <!-- Display the created_at date -->

                            <td>
                                <!-- Edit Button -->
                                <a class="bg-green-400 hover:bg-green-500 text-gray-700 rounded-md px-4 py-1 inline-block" href="{{route("admin.user.users.edit",$user->id)}}">Edit</a>
                            
                                <!-- Delete Button inside Form -->
                               
                                <form action="{{ route('admin.user.users.delete', $user->id) }}" method="POST" 
                                    class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-400 hover:bg-red-500 text-gray-700 rounded-md px-4 py-1 inline-block">Delete</button>
                                </form>

                            </td>
                            
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="my-4 bg-white">
                </div>
            </div>
        </div>
    </div>
    
</x-admin-app-layout>