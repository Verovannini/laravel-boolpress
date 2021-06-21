@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista dei post</h1>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Visualizza il contenuto</a>

                        <a class="btn btn-success" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Modifica</a>

                        <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <input class="btn btn-danger" type="submit" value="Elimina">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection