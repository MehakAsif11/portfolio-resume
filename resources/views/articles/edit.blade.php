<x-app-layout>
    <x-slot name="header">
        
 <div class="flex justify-between">
             <h2 class="text-xl font-semibold leading-tight text-gray-800">
  Articles/Edit
        </h2>
    <a href="{{route('articles.index')}}" 
    class="px-5 py-3 text-sm text-white rounded-md bg-slate-700"
    >     ← Back to Articles</a>

        </div>





    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                 <div class="p-6 text-gray-900">
{{-- <form action=" {{route ('articles.update',$article->id)}} " method="get"> --}}
    <form action="{{ route('articles.update', $article->id) }}" method="POST">

    @csrf
    @method('PUT')
   
<div>





    

    

<label for="" class="font-medium text-small">Title</label>
<div class="mb-3">
<input value="{{old('title',$article->title)}}" name="title" type="text" placeholder="title" class="w-1/2 rounded-lg boder-gray-300 shadow-small">
</div>
@error('title')
<p class="text-red-950">{{$message}}</p>
@enderror
<label for="" class="font-medium text-small">Text</label>
<div class="mb-3">
    <textarea name="text" id="text"  type="text" placeholder="Text" cols="30" rows="10"  class="w-1/2 rounded-lg boder-gray-300 shadow-small" >{{old('text',$article->text)}}</textarea>
{{-- <input value="{{old('title')}}" name="title" placeholder="title" class="w-1/2 rounded-lg boder-gray-300 shadow-small"> --}}
</div>
@error('text')
<p class="text-red-950">{{$message}}</p>
@enderror
<label for="" class="font-medium text-small">Author</label>
<div class="mb-3">
<input value="{{old('author',$article->author)}}" name="author" type="text" placeholder="author" class="w-1/2 rounded-lg boder-gray-300 shadow-small">
</div>
@error('author')
<p class="text-red-950">{{$message}}</p>
@enderror
<button class="px-5 py-3 text-sm text-white rounded-md bg-slate-700"> UPDATE </button>
</div>

</form>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
