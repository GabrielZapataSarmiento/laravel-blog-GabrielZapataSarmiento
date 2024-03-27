@extends('layouts.header')

@section('content')
    <div class="container mx-auto">
        @foreach($blogs as $blog)
            @if(!$blog->trashed())
            <a href="{{ route('blogs.show', ['id' => $blog->id]) }}" class="block my-8 bg-white rounded-lg shadow-md p-6 max-w-5xl mx-auto hover:shadow-lg transition duration-300">
                @else
                    <a class="block my-8 bg-white rounded-lg shadow-md p-6 max-w-5xl mx-auto hover:shadow-lg transition duration-300">
                        @endif
                <h2 class="text-xl font-bold">{{ $blog->title }}</h2>
                <p class="mt-2">{{ substr($blog->content, 0, 150) }}...</p>
                <div class="flex justify-between items-center mt-4">
                    @auth
                        @if(Auth::id() === $blog->user_id)
                            <div>
                                @if($blog->trashed())
                                    <form action="{{ route('blog.repost') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $blog->id }}">
                                        <button type="submit" class="mt-4 text-green-500 hover:text-green-600 font-bold">Repost</button>
                                    </form>
                                @else
                                    <form action="{{ route('blog.edit') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $blog->id }}">
                                        <button type="submit" class="mt-4 text-blue-500 hover:text-blue-600 font-bold">Edit</button>
                                    </form>
                                    <form action="{{ route('blog.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $blog->id }}">
                                        <button type="submit" class="mt-4 text-red-500 hover:text-red-600 font-bold">Delete</button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @endauth
                </div>
            </a>
        @endforeach

        <div class="flex justify-center mt-8">
            @if ($blogs->previousPageUrl())
                <a href="{{ $blogs->previousPageUrl() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">&laquo; Previous</a>
            @endif

            @if ($blogs->nextPageUrl())
                <a href="{{ $blogs->nextPageUrl() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">&raquo; Next</a>
            @endif
        </div>
    </div>
@endsection
