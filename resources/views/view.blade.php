@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ $blogPost->title }}</h1>
        <p class="text-lg text-gray-800 mb-4">{{ $blogPost->content }}</p>

        <div class="flex items-center mt-4">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2">Like</button>
            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Unlike</button>
        </div>

        <!-- Comment Form -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Leave a Comment</h2>
            <form action="#" method="post">
                @csrf
                <textarea name="comment" id="comment" class="w-full h-32 border-gray-300 rounded-md resize-none p-4" placeholder="Write your comment here..."></textarea>
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Submit</button>
            </form>
        </div>

        <!-- Comments Section -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Comments</h2>
                @foreach($blogPost->comments as $comment)
                    <div class="border border-gray-200 rounded-lg p-4 mb-4">
                        <p class="text-gray-800">{{ $comment->content }}</p>
                        <span class="text-sm text-gray-600">Posted by {{ $comment->username }}</span>
                    </div>
                @endforeach
            </div>
    </div>
@endsection
