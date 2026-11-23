<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
</head>
<body>
    <center>
        <h2>Привет, {{ auth()->user()->name }}!</h2>

        @if(auth()->user()->avatar_status === 'approved' && auth()->user()->avatar_path)
            <a href="{{ asset('storage/' . auth()->user()->avatar_path) }}" target="_blank">
                <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="Аватар" width="100">
            </a>
        @endif

        <ul style="list-style:none; padding:0;">
            @if(auth()->user()->role !== 'sergeant')
                <li style="display:inline;"><a href="{{ route('profile.edit') }}">Мой профиль</a></li>
            @endif

            @if(auth()->user()->role === 'curator')
                <li style="display:inline; margin-left:10px;"><a href="{{ route('curator.students.index') }}">Список курсантов</a></li>
            @endif

            @if(auth()->user()->role === 'sergeant')
                <li style="display:inline; margin-left:10px;"><a href="{{ route('sergeant.avatars.index') }}">Модерация аватарок</a></li>
            @endif

            <li style="display:inline; margin-left:10px;">
                <form action="{{ route('logout') }}" method="POST" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            </li>
        </ul>

        <hr width="400">

        @if(auth()->user()->profile)
            <h3>Твои данные:</h3>
            <table>
                <tr>
                    <td align="right"><strong>ФИО:</strong></td>
                    <td>{{ auth()->user()->profile->last_name }} {{ auth()->user()->profile->first_name }} {{ auth()->user()->profile->middle_name }}</td>
                </tr>
                <tr>
                    <td align="right"><strong>Курс:</strong></td>
                    <td>{{ auth()->user()->profile->course }}</td>
                </tr>
                <tr>
                    <td align="right"><strong>Группа:</strong></td>
                    <td>{{ auth()->user()->profile->group_name }}</td>
                </tr>
                <tr>
                    <td align="right"><strong>Дата рождения:</strong></td>
                    <td>{{ auth()->user()->profile->date_of_birth }}</td>
                </tr>
            </table>
        @else
            <p>Данные профиля еще не заполнены классным руководителем.</p>
        @endif
    </center>
</body>
</html>
