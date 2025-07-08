<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create New User
            </h2>
            <a href="{{ route('users.index') }}"
               class="px-5 py-3 text-sm text-white rounded-md bg-slate-700">
                ← Back to Users
            </a>
        </div>
    </x-slot>

    {{-- <div class="py-10">
        <div class="max-w-4xl p-6 mx-auto bg-white rounded shadow"> --}}
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-300 rounded">
                    <ul class="pl-5 text-sm list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password"
                           class="w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>

                {{-- Confirm Password --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>

                {{-- Roles --}}
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Assign Roles</label>
                    <div class="grid grid-cols-2 gap-2">
                   
{{-- @foreach($roles as $role)
    <label class="text-sm font-medium">
        <input type="checkbox" name="roles[]" value="{{ $role->name }}"
            {{ in_array($role->name, old('roles', $user->getRoleNames()->toArray() ?? [])) ? 'checked' : '' }}>
        {{ $role->name }}
    </label>
@endforeach --}}

@foreach($roles as $role)
    <label class="text-sm font-medium">
        <input type="checkbox" name="roles[]" value="{{ $role->name }}"
            {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>
        {{ $role->name }}
    </label>
@endforeach


                    </div>
                </div>

                {{-- Permissions --}}
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Assign Permissions</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($permissions as $permission)
                            <label class="flex items-center space-x-2 text-sm text-gray-800">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                       {{ is_array(old('permissions')) && in_array($permission->name, old('permissions')) ? 'checked' : '' }}>
                                <span>{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-gray-800 rounded-md">
                        Create User
                    </button>
                </div>
            </form>

                </div>
            </div>
        </div>
    </div>
        {{-- </div>
    </div> --}}
</x-app-layout>
