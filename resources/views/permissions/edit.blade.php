<x-app-layout>
    <x-slot name="header">
        
 <div class="flex justify-between">
             <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Permissions/Edit
        </h2>
    <a href="{{route('permissions.index')}}"
    class="px-5 py-3 text-sm text-white rounded-md bg-slate-700"
    >     ← Back to Permissions</a>

        </div>





    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900">
           

{{-- <form action=" {{route ('permissions.update',$permission->id )}} " method="get">
    @csrf
<div>

<label for="" class="font-medium text-small">Name</label>
<div class="mb-3">
<input value="{{old('name' ,$permission->name)}}" name="name" placeholder="Enter Name" class="w-1/2 rounded-lg boder-gray-300 shadow-small">
</div>
@error('name')
<p class="text-red-950">{{$message}}</p>
    
@enderror
  @foreach ($permissions as $permission)
    <label>
        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
            {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
        {{ $permission->name }}
    </label>
@endforeach
<button class="px-5 py-3 text-sm text-white rounded-md bg-slate-700"> UPDATE </button>
</div>
</form> --}}


<form action="{{ route('permissions.update', $permission->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name" class="text-sm font-medium">Name</label>
    <div class="mb-3">
        <input type="text" name="name" value="{{ old('name', $permission->name) }}"
               class="w-1/2 border-gray-300 rounded-lg shadow-sm" placeholder="Enter Permission Name">
        @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="px-5 py-3 text-sm text-white rounded-md bg-slate-700">
        UPDATE
    </button>
</form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
