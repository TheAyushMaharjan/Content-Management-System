<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-900 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div x-data :class="$store.sidebar.isCollapsed ? 'ml-20' : 'ml-10'" class="py-12 transition-all duration-300">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-900 leading-tight">
            {{ __("You're logged in!") }}
        </h2>

        <div class="max-w-2xl pt-8 sm:px-6 lg:px-8">
            <div class="flex justify-start"> 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full md:w-3/4 lg:w-2/3"> <!-- Adjust width for smaller screens -->
                    <!-- Total Users Box -->
                    <div class="bg-white dark:bg-gray-100 border border-gray-200 shadow-sm rounded-lg p-6 h-32 flex flex-col justify-center items-center">
                        <h3 class="text-xl font-semibold text-gray-300 dark:text-gray-800">Total Users</h3>
                        <p class="text-2xl pt-4 font-bold text-green-500 dark:text-green-500">{{ $totalUser ?? 0}}</p>
                    </div>
        
                    <!-- Total editor Box -->
                    <div class="bg-white dark:bg-gray-100 border border-gray-200  shadow-sm rounded-lg p-6 h-32 flex flex-col justify-center items-center">
                        <h3 class="text-xl font-semibold text-gray-300 dark:text-gray-800">Total Editors</h3>
                        <p class="text-2xl pt-4 font-bold text-green-500 dark:text-green-500">{{ $totalEditor ?? 0 }}</p>
                    </div>
                    <!-- Total admin Box -->
                    <div class="bg-white dark:bg-gray-100 border border-gray-200  shadow-sm rounded-lg p-6 h-32 flex flex-col justify-center items-center">
                        <h3 class="text-xl font-semibold text-gray-300 dark:text-gray-800">Total Admin</h3>
                        <p class="text-2xl pt-4 font-bold text-green-500 dark:text-green-500">{{ $totalAdmin ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
