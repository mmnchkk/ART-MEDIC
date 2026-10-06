<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Контакты</title>
</head>
<body>
    <h1>Контакты</h1>
    @if($contact)
        <h2>Адрес</h2>
            <p>{{ $contact->adress }}</p>
        <h2>Сообщения</h2>
            <p>{{ $contact->sms }}</p>
        <h2>Расписание</h2>
            <p>{{ $contact->schedule }}</p>
        <h2>Телефоны</h2>
            @foreach($contact->phones as $phone)
                <p>
                    {{ $phone->phone }}
                    — {{ $phone->description }}
                </p>
            @endforeach
        <h2>Почты</h2>
            @foreach($contact->mails as $mail)
                <p>
                  {{ $mail->mail }}
                 — {{ $mail->description }}
                </p>
            @endforeach
        @else
            <p>Контакты пока не заполнены.</p>
        @endif
</body>
</html>