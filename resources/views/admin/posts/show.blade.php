@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    <div>Slug: {{ $post->slug }}</div>

    <p>{{ $post->content }}</p>

    <a class="btn btn-success" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Modifica</a>

</div>
@endsection