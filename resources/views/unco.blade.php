<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/unco.css'])
    <title>Document</title>
</head>

<body>
    <!-- <h1>Новости</h1>
    @foreach ($uncos as $unco)
    <div>
        <h2>{{ $unco->title }}</h2>
        <p>{!! $unco->description !!}</p>
        <p>{{ $unco->image }}</p>
        <img src="{{ asset('resources/news/' . $unco->image) }}" alt="{{ $unco->title }}">
    </div>
    @endforeach -->


    <div class="news">
        @foreach ($uncos as $unco)
        <div class="news-navigation">
            <a href="/">Арт-Медика</a>
            <span>&gt;</span>
            <a href="/news">
                <p>Новости</p>
            </a>
            <span>&gt;</span>
            <p>“Освежиться, но не более”</p>
        </div>

        <div class="news-title">
            <div class="news-title-nav">
                <h1>Хирургия</h1>
                <!-- <img src="{{ Vite::asset('resources/image/arrow-right.svg') }}" alt="Новости"> -->
            </div>

            <p class="news-title-description">
                {{ $unco->title }}
            </p>
        </div>

        <div class="news-description">
            <div class="news-description-img">
                <img src="{{ asset('storage/' . $unco->image) }}" alt="{{ $unco->title }}">
                <!-- <img src="{{ Vite::asset('resources/image/news3.svg') }}" alt="Фотография"> -->
            </div>
            <div class="news-description-text">
                {!! $unco->description !!}
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>