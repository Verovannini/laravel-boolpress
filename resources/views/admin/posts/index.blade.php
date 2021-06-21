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


                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection