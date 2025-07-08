<x-app-layout>
    <x-slot name="header">
        
         <div class="flex justify-between">
           
        
            <h2 class="text-xl font-semibold text-gray-800"> User Updated</h2>
            <a href="{{ route('users.index') }}" class="px-5 py-2 mb-4 text-sm text-white rounded-md bg-slate-700">BACK</a>
        </div>
        <h2  class="px-5 py-3 text-sm text-center text-white rounded-md bg-slate-700 hover:bg-slate-900">Assign Roles to User</h2>
    </x-slot>
    
  <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"



                    
    <form action="{{ route('users.update', $user->id) }}" method="get">
       
    @csrf
    @method('PUT')
     <div class="mb-4">
    <label  class="px-5 py-3 text-sm text-center text-white rounded-md bg-slate-700 hover:bg-slate-900">Role Name</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-1/2 text-center border-gray-300 rounded-lg shadow-sm"> 
   </div>
    {{-- Roles --}}
       <div class="mb-4">
    @foreach($roles as $role)
        <label>
            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
            {{ $role->name }}
        </label>
    @endforeach
</div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Assign Permissions</label>
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                @foreach ($permissions as $permission)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="permission[]" value="{{ $permission->name }}" class="mr-2">
                                        {{ $permission->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
<button class="px-5 py-3 text-sm text-white rounded-md bg-slate-700"> UPDATE </button>
</form>
  </div>
            </div>
        </div>
    </div>


</x-app-layout>
