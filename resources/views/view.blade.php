@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <p class="text-lg text-gray-800 mb-4">{{ $blogPost->username }}</p>
        <h1 class="text-3xl font-bold mb-4">{{ $blogPost->title }}</h1>
        <p class="text-lg text-gray-800 mb-4">{{ $blogPost->content }}</p>

        <div class="flex flex-col mt-4">
            <span class="text-gray-600 mb-2">{{ $likes }}</span>
            <div class="flex">
                <form action="{{ route('view.like.add', ['id' => $blogPost->id]) }}" method="post">
                    @csrf
                    <button name="like" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2">Like</button>
                </form>
            </div>
        </div>
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Leave a Comment</h2>
            <form action="{{ route('view.comment.add', ['id' => $blogPost->id]) }}" method="post">
                @csrf
                <textarea name="comment" id="comment" class="w-full h-32 border-gray-300 rounded-md resize-none p-4" placeholder="Write your comment here..."></textarea>
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Submit</button>
            </form>
        </div>
        <!-- Comments Section -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Comments</h2>
            @foreach($comments as $comment)
                <div class="border border-gray-200 rounded-lg p-4 mb-4">
                    <p class="text-gray-800">{{ $comment->content }}</p>
                    <span class="text-sm text-gray-600">Posted by {{ $comment->username }}</span>
                    @auth
                        @if(Auth::id() === $comment->user_id)
                    <form action="{{ route('view.comment.delete') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        <input type="hidden" name="user_id" value="{{ $comment->user_id }}">
                        <input type="hidden" name="blog_id" value="{{ $blogPost->id }}">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-2 my-2">Delete</button>
                    </form>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>

    </div>
@endsection
