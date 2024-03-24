@extends('layouts.header')

@section('content')
    @foreach($blogs as $blog)
        <main class="container mx-auto px-4 py-8">
            <div class="grid flex justify-center grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Blog Posts -->
                <div class="col-span-2">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold mb-2">{{ $blog->title }}</h2>
                            <p class="text-gray-700 mb-4">{{ substr($blog->content, 0, 150) }}...</p>
                            <a href="/view/{{ $blog->id }}" class="text-blue-600 hover:underline">Read more...</a>
                        </div>
                        @auth
                            @if(Auth::id() === $blog->user_id)
                                <div class="p-4 bg-gray-100">
                                    <ul class="flex justify-between">
                                        <li><a href="{{ route('blog.edit', ['id' => $blog->id]) }}" class="text-blue-600 hover:underline">Edit</a></li>
                                        <li><a href="blog/delete/{{ $blog->id }}" class="text-blue-600 hover:underline">Delete</a></li>
                                    </ul>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </main>


    @endforeach
    <div class="pagination flex justify-center mt-8">
        @if ($blogs->previousPageUrl())
            <a href="{{ $blogs->previousPageUrl() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">&laquo; Previous</a>
        @endif

        @if ($blogs->nextPageUrl())
            <a href="{{ $blogs->nextPageUrl() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">&raquo; Next</a>
        @endif
    </div>
@endsection
