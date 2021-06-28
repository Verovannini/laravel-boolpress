@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica post: {{ $post->title }}</h1>

    <!-- Print Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Nessuna</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : "" }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Checkboxes dei tags -->
        <div class="form-group">
            @foreach( $tags as $tag )
                <div class="form-check">
                    @if ($errors->any())
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                    @else
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                    @endif

                    <label class="form-check-label" for="tag-{{$tag->id}}">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <!-- Input file per caricare le immagini -->
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="cover-image" name="cover-image">
                <label class="custom-file-label" for="cover-image">Scegli immagine di copertina</label>
            </div>
        </div>

        <div class="form-group">
            @if ($post->cover)
                <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
            @endif
        </div>

        <input class="btn btn-success" type="submit" value="Modifica">
    </form>
</div>
@endsection