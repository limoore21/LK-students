<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список курсантов</title>
</head>
<body>
    <center>
        <h2>Панель классного руководителя</h2>

        <ul style="list-style:none; padding:0;">
            <li style="display:inline;"><a href="{{ route('dashboard') }}">На главную</a></li>
            <li style="display:inline; margin-left:10px;">
                <form action="{{ route('logout') }}" method="POST" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            </li>
        </ul>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Имя (Аккаунт)</th>
                <th>ФИО</th>
                <th>Группа</th>
                <th>Действие</th>
            </tr>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>
                    {{ $student->profile ? $student->profile->last_name . ' ' . $student->profile->first_name : 'Не заполнено' }}
                </td>
                <td>{{ $student->profile ? $student->profile->group_name : '-' }}</td>
                <td>
                    <a href="{{ route('curator.students.edit', $student) }}">Редактировать</a>
                </td>
            </tr>
            @endforeach
        </table>
    </center>
</body>
</html>
