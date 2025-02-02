
<div class="container mx-auto">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Edit User</h2>

        <!-- Modal Content -->
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ $user->username }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Contact -->
            <div class="mb-4">
                <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                <input type="text" id="contact" name="contact" value="{{ $user->contact }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            {{-- password --}}
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="text" id="password" name="password" value="{{ $user->password }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" id="address" name="address" value="{{ $user->address }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="flex justify-between">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.user.manageUser') }}" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">Cancel</a>
            </div>
        </form>
    </div>
</div>

