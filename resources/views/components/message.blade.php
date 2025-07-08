@if(Session::has('success'))
    <div class="px-5 py-3 text-sm text-white rounded-md bg-slate-700">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="px-5 py-3 text-sm text-black bg-red-200 rounded-md">
        {{ Session::get('error') }}
    </div>
@endif
