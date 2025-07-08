<x-app-layout>
    <x-slot name="header">
          {{-- <div class="flex justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Create Role</h2>
            <a href="{{ route('users.edit') }}" class="px-5 py-3 text-sm text-white rounded-md bg-slate-700">EDIT</a>
        </div> --}}
         <div class="flex justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Create Users</h2>
               {{-- @can('create users') --}}
            <a href="{{ route('users.index') }}" class="px-5 py-3 text-sm text-white rounded-md bg-slate-700">CREATE</a>
             {{-- @endcan --}}
        </div>
       

    
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl">
        <x-message />


<div class="px-3 py-12 mb-4">
                <table class="w-full">
    <thead class="bg-gray-50" >
        <tr class="border-b">
            <th class="px-6 py-3 text-left " width="60">ID</th>
                    {{-- <th class="px-4 py-2">Action</th>  --}}

            <th class="px-6 py-4 text-left">NAME</th>
            <th class="px-6 py-4 text-left">EMAIL</th>
            <th class="px-6 py-4 text-left" width="180">ROLES</th>
            <th class="px-6 py-4 text-center" width="180">ACTION</th>

            
                </tr>
            </thead>
            <tbody>
{{-- <td class="px-4 py-2">
    {{ $user->getRoleNames()->implode(', ') }}
</td> --}}


                @foreach($users as $user)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            {{-- Debug ke liye --}}
                          {{-- <pre>{{ print_r($user->getRoleNames(), true) }}</pre> --}}
                            {{ $user->getRoleNames()->implode(', ') }}
                        </td>
                        <td class="px-4 py-2">
 @can('edit users')
 <a href="{{ route('users.edit', $user->id) }}" class="px-3 py-2 text-sm text-white rounded-md bg-slate-700 hover:bg-pink-600">Edit</a>
 @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </x-app-layout>
