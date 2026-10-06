<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вопросы и ответы</title>
</head>
<body>
    <h1>Вопросы и ответы</h1>
    @foreach ($quesAnss as $quesAns)
    <div>
        <h2>{{ $quesAns->question }}</h2>
        <p>{{ $quesAns->answer }}</p>
    </div>
    @endforeach
</body>
</html>