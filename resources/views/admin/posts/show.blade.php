@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    <div>Slug: {{ $post->slug }}</div>

    <p>{{ $post->content }}</p>

</div>
@endsection