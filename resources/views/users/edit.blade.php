<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit User
            </h2>
            <a href="{{ route('users.index') }}"
               class="px-4 py-2 text-sm text-white bg-gray-800 rounded-md">
                ← Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl p-6 mx-auto bg-white rounded-lg shadow-md">
            @if($errors->any())
                <div class="mb-4">
                    <ul class="text-red-600 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Name:</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- Roles --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Assign Roles:</label>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                       

              @foreach($roles as $role)
    <label class="text-sm font-medium">
        <input type="checkbox" name="roles[]" value="{{ $role->name }}"
            {{ in_array($role->name, old('roles', $user->getRoleNames()->toArray() ?? [])) ? 'checked' : '' }}>
        {{ $role->name }}
    </label>
@endforeach
      </div>
                </div>

                {{-- Permissions --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Assign Permissions:</label>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        @foreach($permissions as $permission)
                            <label class="text-sm font-medium">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    {{ $user->permissions->pluck('name')->contains($permission->name) ? 'checked' : '' }}>
                                {{ $permission->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Submit --}}
                <div class="mt-6">
                    <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-gray-800 rounded-md">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
