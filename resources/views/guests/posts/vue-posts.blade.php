@extends('layouts.app')

@section('header-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection

@section('footer-scripts')
    <script src="{{ asset('js/posts.js') }}"></script>
@endsection

@section('content')
    <div id="root">
        <div class="container">
            <h1>@{{ title }}</h1>

            <div class="row">
                <div v-for="post in posts" class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">

                            <h3>@{{ post.title }}</h3>
                            <div v-if="post.category.length > 0">Categoria: @{{ post.category }}</div>
                            <div>@{{ post.content }}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

