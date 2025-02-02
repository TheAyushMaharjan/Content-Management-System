<nav x-data>
    <!-- Sidebar -->
    <div :class="$store.sidebar.isCollapsed ? 'w-20' : 'w-64'" 
         class="bg-[#10101E] shadow-lg h-screen p-4 pb-8 flex flex-col transition-all duration-300 fixed">
        <div class="whole flex flex-col h-full">
            <div class="Content flex-1 overflow-y-auto">
                <!-- Sidebar Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 x-show="!$store.sidebar.isCollapsed" class="text-xl font-bold text-[#9797A4]">CMS</h2>
                    <button @click="$store.sidebar.toggle()" class="text-[#9797A4] p-2 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" 
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 6h18M3 12h18M3 18h18"/>
                        </svg>
                    </button>
                </div>
        <!-- Sidebar Items -->
        <ul class="space-y-2 flex-1 overflow-y-auto">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" 
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12l9-9 9 9"/>
                        <path d="M9 21V9h6v12"/>
                    </svg>
                    <span x-show="!$store.sidebar.isCollapsed" class="ml-3">Dashboard</span>
                </a>
            </li>
            <!-- User Management -->
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" 
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 21v-2a4 4 0 0 0-4-4h-4a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        <span x-show="!$store.sidebar.isCollapsed" class="ml-3">User Management</span>
                    </summary>
                    <ul x-show="!$store.sidebar.isCollapsed" class="pl-4 mt-2  text-sm space-y-1">
                        <li><a href="{{route('admin.user.manageUser')}}" class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">Manage User</a></li>
                        <li><a href="#" class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">Manage Permission</a></li>
                    </ul>
                </details>
            </li>
            <!-- Blog Management -->
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" 
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <span x-show="!$store.sidebar.isCollapsed" class="ml-3">Blog Management</span>
                    </summary>
                    <ul x-show="!$store.sidebar.isCollapsed" class="pl-4 mt-2 text-sm space-y-1">
                        <li><a href="#" class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">Blog Category</a></li>
                        <li><a href="#" class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">Blog Setup</a></li>
                    </ul>
                </details>
            </li>
            <!-- Media Management -->
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" 
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 16l4-4 4 4 4-4 4 4 4-4"/>
                        </svg>
                        <span x-show="!$store.sidebar.isCollapsed" class="ml-3">Media Management</span>
                    </summary>
                    <ul x-show="!$store.sidebar.isCollapsed" class="pl-4 mt-2 text-sm space-y-1">
                        <li><a href="#" class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">Gallery Category Setup</a></li>
                        <li><a href="#" class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">Preview</a></li>
                    </ul>
                </details>
            </li>
            <!-- Settings -->
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" 
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M16.24 16.24l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M16.24 7.76l1.42-1.42"/>
                        </svg>
                        <span x-show="!$store.sidebar.isCollapsed" class="ml-3">Settings</span>
                    </summary>
                    <ul x-show="!$store.sidebar.isCollapsed" class="pl-4 mt-2 text-sm space-y-1">
                        <li><a href="#" class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">Website Heading & Logo Setting</a></li>
                        <li><a href="#" class="flex items-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">Footer Setting</a></li>
                    </ul>
                </div>
                </details>
            </li>
        </div>
            <!-- Profile and Logout -->
            <div class="User">
            <li class=" list-none border-t border-gray-700 ">
                <div class="px-4 pt-2">
                    <!-- Full Name and Email -->
                    <div x-show="!$store.sidebar.isCollapsed"  class="flex flex-col ">
                        <div class="font-medium  text-gray-800 dark:text-gray-200 text-sm">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                
                    <!-- Circle -->
                    <div x-show="$store.sidebar.isCollapsed" class="flex justify-center items-center">
                        <div class="w-10 h-10 bg-gray-800 text-white rounded-full flex justify-center items-center font-medium text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
                <div class="flex flex-col text-sm space-y-2">
                    <!-- Profile Link -->
                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center justify-center p-2 text-[#9797A4] hover:bg-gray-700 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" 
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM12 15v-2m0 6v-2m0-6v-2"/>
                        </svg>
                        <span x-show="!$store.sidebar.isCollapsed" class="ml-3">Profile</span>
                    </a>
                    

                    <!-- Log Out Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center justify-center p-2 w-full text-[#9797A4] hover:bg-gray-700 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" 
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <polyline points="16 17 21 12 16 7"/>
                                <line x1="21" y1="12" x2="9" y2="12"/>
                            </svg>
                            <span x-show="!$store.sidebar.isCollapsed" class="ml-3">Log Out</span>
                        </button>
                    </form>
                </div>
            </li>
        </div>

        </ul>
    </div>
</nav>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('sidebar', {
            isCollapsed: false,
            toggle() {
                this.isCollapsed = !this.isCollapsed;
            }
        });
    });
</script>