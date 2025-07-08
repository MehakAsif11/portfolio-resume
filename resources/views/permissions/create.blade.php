<x-app-layout>
    <x-slot name="header">
        
 <div class="flex justify-between">
             <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Permissions/Create
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
             



<form action="{{ route('permissions.store') }}" method="POST">
    @csrf



    
    @csrf
<div>

<label for="" class="font-medium text-small">Name</label>
<div class="mb-3">
<input value="{{old('name')}}" name="name" placeholder="Enter Name" class="w-1/2 rounded-lg boder-gray-300 shadow-small">
</div>
@error('name')
<p class="text-red-950">{{$message}}</p>
    
@enderror
<button class="px-5 py-3 text-sm text-white rounded-md bg-slate-700"> SUBMIT </button>
</div>
</form>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
