@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crea nuovo post</h1>

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

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        @method('POST')

        <!-- Input Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>

        <!-- Input Content -->
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
        </div>
        
        <!-- Select delle categorie -->
        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Nessuna</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : "" }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Checkboxes dei tags -->
        <div class="form-group">
            @foreach( $tags as $tag )
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="tag-{{$tag->id}}">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <input class="btn btn-success" type="submit" value="Crea nuovo post">
    </form>
</div>
@endsection