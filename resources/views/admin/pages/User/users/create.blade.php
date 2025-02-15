<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-50 leading-tight">
            {{ __('Create User ') }}
        </h2>
    </x-slot>
    <div x-data :class="$store.sidebar.isCollapsed ? 'ml-20' : 'ml-10'" class="py-6 transition-all duration-300">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('admin.user.users.store')}}" method="post">
                        @csrf
                        <div>
                            <div class="container flex justify-between items-center">
                                <label for="" class="text-xl font-medium">Create new article</label>

                                <div class="create  ">
                                    <a class=" px-4 py-2 flex items-center" href="{{route('admin.user.users.index')}}"><i
                                            class="fa-solid fa-angle-left text-2xl p-3"></i> Back</a>
                                </div>
                            </div>
                            {{-- name --}}
                            <div class="container flex justify-between items-center">
                                <label for="" class="text-xl font-medium m-2">Name*</label> 
                            </div>
                            <div class="mb-3">
                                <input value="{{old('name')}}" name="name" placeholder="Enter the name"
                                    type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                <p class="text-red-400">{{$message}}</p>
                                @enderror
                            </div>

                             {{-- email --}}
                             <div class="container flex justify-between items-center">
                                <label for="" class="text-xl font-medium m-2">Email*</label> 
                            </div>
                            <div class="mb-3">
                                <input value="{{old('email')}}" name="email" placeholder="Enter the email"
                                type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                               
                                @error('email')
                                <p class="text-red-400">{{$message}}</p>
                                @enderror
                            </div>

                             {{-- password --}}
                                <div class="container flex justify-between items-center">
                                    <label for="password" class="text-xl font-medium m-2">Password*</label> 
                                </div>
                                <div class="mb-3">
                                    <input value="{{ old('password') }}" name="password" placeholder="Enter the password"
                                        type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                    @error('password')
                                        <p class="text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- confirm password --}}
                                <div class="container flex justify-between items-center">
                                    <label for="password_confirmation" class="text-xl font-medium m-2">Confirm Password*</label> 
                                </div>
                                <div class="mb-3">
                                    <input value="{{ old('password_confirmation') }}" name="password_confirmation" placeholder="Confirm the password"
                                        type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                    @error('password_confirmation')
                                        <p class="text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid grid-cols-4 mb-6">
                                    @if($roles->isNotEmpty())
                                    @foreach ($roles as $role )
                                    <div class="mt-3">
                                        <input   type="checkbox" id="role-{{$role->id}}" class="rounded" name="role[]"
                                        value="{{$role->name}}">
                                        <label for="role-{{$role->id}}">{{$role->name}}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                            <button class="bg-black text-gray-200 rounded-md px-4 py-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>