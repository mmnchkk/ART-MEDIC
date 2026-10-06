<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Новости</h1>
    @foreach ($uncos as $unco)
    <div>
        <h2>{{ $unco->title }}</h2>
        <p>{{ $unco->description }}</p>
        <p>{{ $unco->image }}</p>
        <img src="{{ asset('resources/news/' . $unco->image) }}" alt="{{ $unco->title }}">
    </div>
    @endforeach
</body>
</html>