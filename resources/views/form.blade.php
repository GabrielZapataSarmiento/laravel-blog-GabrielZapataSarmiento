@extends('layouts.header')

@section('content')
    <div class="max-w-7xl mx-auto">
        <form action="{{ $form_action }}" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-6">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter the title of your blog post" class="shadow appearance-none border rounded w-full py-3 px-4 text-lg text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" value="{{ $blogPost->title ?? old('title') ?? '' }}">
                @error('title')
                <p class="text-red-500 text-sm italic">{{ $message }}</p>
                @enderror
                <div class="mb-6">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                <textarea id="content" name="content" placeholder="Enter the content of your blog post" class="shadow appearance-none border rounded w-full h-48 py-3 px-4 text-lg text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content') border-red-500 @enderror">{{ $blogPost->content ?? old('content') ?? ''}}</textarea>
                    @error('content')
                    <p class="text-red-500 text-sm italic">{{ $message }}</p>
                    @enderror
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full focus:outline-none focus:shadow-outline w-full">
                    {{ $form_button }}</button>
            </div>
            <p class="text-center text-gray-500 text-xs">
            </p>
        </form>
    </div>

@endsection
