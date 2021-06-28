<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Ciao amministratore</h1>

        <p>Un nuovo post è stato creato, il titolo è: {{ $post->title }}. <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}">Clicca qui</a> per vederlo</p>
    </div>
</body>
</html>