<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
</head>
<body>
    <h2>Привет, {{ auth()->user()->name }}!</h2>

    @if(auth()->user()->profile)
        <div style="border: 1px solid #ccc; padding: 10px; margin-top: 20px;">
            <h3>Твои данные:</h3>
            <p><strong>ФИО:</strong> {{ auth()->user()->profile->last_name }} {{ auth()->user()->profile->first_name }} {{ auth()->user()->profile->middle_name }}</p>
            <p><strong>Курс:</strong> {{ auth()->user()->profile->course }}</p>
            <p><strong>Группа:</strong> {{ auth()->user()->profile->group_name }}</p>
            <p><strong>Дата рождения:</strong> {{ auth()->user()->profile->date_of_birth }}</p>
        </div>
    @else
        <p style="color: orange;">Данные профиля еще не заполнены классным руководителем.</p>
    @endif

    <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit">Выйти</button>
    </form>
</body>
</html>
