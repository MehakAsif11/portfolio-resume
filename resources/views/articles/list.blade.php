<x-app-layout>
    <x-slot name="header">
        
     <div class="flex justify-between">
             <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Articles') }}

        </h2>
    {{-- <a href="{{route('articles.create')}}" 
    class="px-5 py-3 text-sm text-white rounded-md bg-slate-700"
    >CREATE</a>
        </div> --}}



        
          @can('create users')
            <a href="{{ route('articles.create') }}"
               class="px-5 py-3 text-sm text-white rounded-md bg-slate-700 hover:bg-slate-900">
                CREATE
            </a>
                @endcan
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}
<x-message></x-message>




<table class="w-full">
    <thead class="bg-gray-50" >
        <tr class="border-b">
            <th class="px-6 py-3 text-left " width="60">id</th>
            <th class="px-6 py-3 text-left">NAME</th>
            <th class="px-6 py-3 text-left">AUTHOR</th>
            <th class="px-6 py-3 text-left" width="180">CREATED</th>
            <th class="px-6 py-3 text-center" width="180">ACTION</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @if ($articles->isNotEmpty())
        @foreach ($articles as $article )

        <tr class="border-b">
          <td class="px-6 py-3 text-left">
            {{ $article->id }}
          </td>
          <td class="px-6 py-3 text-left">
            {{ $article->title }}
          </td>
          <td class="px-6 py-3 text-left">
                     {{ $article->author }}
          </td>
          <td class="px-6 py-3 text-left">
                     {{\Carbon\Carbon:: parse ($article->created_at )->format('d M,Y')}}
          </td>
          <td class="px-6 py-3 text-center">
                   @can('edit articles')

<a href=" {{ route("articles.edit",$article->id) }}" class="px-3 py-2 text-sm text-white rounded-md bg-slate-700 hover:bg-success-600">EDIT</a>
                   @endcan
          @can('delete articles')

<a href="javascript:void(0)" onclick="deleteArticle({{ $article->id }})" class="px-3 py-2 text-sm text-white rounded-md bg-slate-700 hover:bg-red-600" >DELETE</a>
 @endcan
                    </td>
        </tr>

     @endforeach
    @endif
    @if(Session::has('success'))
    <div class="px-4 py-2 mb-4 text-white bg-green-500 rounded">
        {{ Session::get('success') }}
    </div>
@endif

    </tbody>
</table>
<div class="my-3">
    {{ $articles->links() }}


    </div>
    </div>
    </div>

 {{-- <x-slot name="script">
<script type="text/javascript"> 
function deleteArticle(id) {
if(confirm ("Are you sure you want to delete?")) {
  $.ajax({
    url: '{{ route("articles.destroy") }}',
    type: 'delete',
    data: {id:id},
    dataType: 'json',
    headers: {
        'x-csrf-token' :'{{ csrf_token() }}'
    },
success: function(response){
 window.location.href = '{{ route("articles.index") }}';
    }
});

    }}
    
</script> </x-slot> --}}

<script>
function deleteArticle(id) {
    if (confirm("Are you sure you want to delete?")) {
        $.ajax({
            url: '/articles/' + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status) {
                    // Remove deleted row without reload
                    $('#article-row-' + id).fadeOut(300, function () {
                        $(this).remove();
                    });
                } else {
                    alert('Delete failed.');
                }
            },
            // error: function () {
            //     alert('Server error occurred.');
            // }
        });
    }
}
</script>

 </x-app-layout>