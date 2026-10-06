<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отзывы</title>
</head>
<body>
    <h1>Отзывы</h1>
    @foreach ($reviews as $review)
    <div>
        <h2>{{ $review->first_name }} {{ $review->middle_name }} {{ $review->last_name }}</h2>
        <p>Рейтинг: {{ $review->rating }}</p>
        <p>{{ $review->desc_story }}</p>
        <p>{{ $review->desc_like }}</p>
        <p>Дата: {{ $review->date }}</p>
    </div>
    @endforeach
</body>
</html>