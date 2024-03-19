@extends('layouts.header')

@section('content')
    <!-- Main Content -->
    @foreach($blogs as $blog)
    <main class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Blog Posts -->
            <div class="col-span-2">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-2">{{ $blog->title }}</h2>
                        <p class="text-gray-700 mb-4">{{ substr($blog->content, 0, 15) }}...</p>
                        <a href="/view/{{ $blog->id }}" class="text-blue-600 hover:underline">Read more...</a>
                    </div>
                </div>
            </div>
            @auth
                @if(Auth::id() === $blog->user_id)
                    <aside class="col-span-1">
                        <div class="bg-white shadow-lg rounded-lg p-6 h-full">
                            <h2 class="text-lg font-bold mb-4">Actions</h2>
                            <ul>
                                <li><a href="{{ route('blog.edit', ['id' => $blog->id]) }}" class="text-blue-600 hover:underline">Edit</a></li>
                                <li><a href="/delete/{{ $blog->id }}" class="text-blue-600 hover:underline">Delete</a></li>
                            </ul>
                        </div>
                    </aside>
                @endif
            @endauth
        </div>
    </main>
    @endforeach
@endsection
