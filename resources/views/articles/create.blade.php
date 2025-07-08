<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Articles/Create
            </h2>
            <a href="{{ route('articles.index') }}"
               class="px-5 py-3 text-sm text-white rounded-md bg-slate-700">
                  ← Back to Articles
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Flash message -->
                    @if(Session::has('success'))
                        <div class="px-4 py-3 mb-4 text-green-800 bg-green-100 rounded">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <form action="{{ route('articles.store') }}" method="POST">
                        @csrf

                        <!-- Title -->
                        <label for="title" class="text-sm font-medium">Title</label>
                        <div class="mb-3">
                            <input id="title" value="{{ old('title') }}" name="title" type="text"
                                   placeholder="Title"
                                   class="w-1/2 border-gray-300 rounded-lg shadow-sm">
                        </div>
                        @error('title')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Text -->
                        <label for="text" class="text-sm font-medium">Text</label>
                        <div class="mb-3">
                            <textarea id="text" name="text" placeholder="Text" cols="30" rows="6"
                                      class="w-1/2 border-gray-300 rounded-lg shadow-sm">{{ old('text') }}</textarea>
                        </div>
                        @error('text')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Author -->
                        <label for="author" class="text-sm font-medium">Author</label>
                        <div class="mb-3">
                            <input id="author" value="{{ old('author') }}" name="author" type="text"
                                   placeholder="Author"
                                   class="w-1/2 border-gray-300 rounded-lg shadow-sm">
                        </div>
                        @error('author')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Submit Button -->
                        <button type="submit"
                                class="px-5 py-3 text-sm text-white rounded-md bg-slate-700">
                            SUBMIT
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
