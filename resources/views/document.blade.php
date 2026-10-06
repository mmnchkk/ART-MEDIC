<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Документы</title>
</head>
<body>

    <h1>Документы</h1>

    @foreach ($documents as $document)
        <div>
            <h2>{{ $document->name }}</h2>

            <a href="{{ asset('storage/' . $document->document) }}" target="_blank">
                Открыть документ
            </a>
        </div>
    @endforeach

</body>
</html>