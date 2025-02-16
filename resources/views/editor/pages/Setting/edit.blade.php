

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Header') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('editor.setting.update',$articles->id)}}" method="post">
                        @csrf
                        <div>
                            <div class="container flex justify-between items-center">
                                <label for="" class="text-xl font-medium">Update Form</label>

                                <div class="create  ">
                                    <a class=" px-4 py-2 flex items-center" href="{{route('articles.index')}}"><i
                                            class="fa-solid fa-angle-left text-2xl p-3"></i> Back</a>
                                </div>
                            </div>
                            {{-- Title --}}
                            <div class="container flex justify-between items-center">
                                <label for="" class="text-xl font-medium m-2">Title*</label> 
                            </div>
                            <div class="mb-3">
                                <input value="{{old('title',$articles->title)}}" name="title" placeholder="Enter the title"
                                    type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('title')
                                <p class="text-red-400">{{$message}}</p>
                                @enderror
                            </div>

                             {{-- content --}}
                             <div class="container flex justify-between items-center">
                                <label for="" class="text-xl font-medium m-2">Content</label> 
                            </div>
                            <div class="mb-3">
                                <textarea name="content" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                placeholder="Enter the content">{{ old('content', $articles->content) }}</textarea>
                            
                                @error('content')
                                <p class="text-red-400">{{$message}}</p>
                                @enderror
                            </div>
                            {{-- email --}}
                            <div class="container flex justify-between items-center">
                                <label for="" class="text-xl font-medium m-2">email</label> 
                            </div>
                            <div class="mb-3">
                                <textarea name="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                placeholder="Enter the email">{{ old('email', $articles->email) }}</textarea>
                            
                                @error('email')
                                <p class="text-red-400">{{$message}}</p>
                                @enderror
                            </div>

                             {{-- Author --}}
                             <div class="container flex justify-between items-center">
                                <label for="" class="text-xl font-medium m-2">contact*</label> 
                            </div>
                            <div class="mb-3">
                                <input value="{{old('contact',$articles->contact)}}" name="contact" placeholder="Enter the author"
                                    type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('contact')
                                <p class="text-red-400">{{$message}}</p>
                                @enderror
                            </div>
                            <button class="bg-black text-gray-200 rounded-md px-4 py-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>