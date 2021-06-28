@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    @if ($post->cover)
        <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
    @endif

    <div>Slug: {{ $post->slug }}</div>

    @if($post_category)
        <div>Categoria: {{ $post_category->name }}</div>
    @endif

    <div>
        <span>Tags:</span>
        @foreach($post_tags as $tag)
            <span>{{ $tag->name }}{{ $loop->last ? '' : ', ' }}</span>
        @endforeach
        
    </div>

    <p>{{ $post->content }}</p>

    <a class="btn btn-success" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Modifica</a>

</div>
@endsection