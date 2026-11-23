<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Модерация аватарок</title>
</head>
<body>
    <center>
        <h2>Модерация аватарок</h2>

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
                <th>Курсант</th>
                <th>Фото</th>
                <th>Действие</th>
            </tr>
            @foreach($pendingUsers as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>
                    @if($user->avatar_path)
                        <a href="{{ asset('storage/' . $user->avatar_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="Аватар" width="100">
                        </a>
                    @endif
                </td>
                <td>
                    <form action="{{ route('sergeant.avatars.approve', $user) }}" method="POST" style="display:inline; margin:0;">
                        @csrf
                        <button type="submit">Одобрить</button>
                    </form>
                    <form action="{{ route('sergeant.avatars.reject', $user) }}" method="POST" style="display:inline; margin:0; margin-left:5px;">
                        @csrf
                        <button type="submit">Отклонить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </center>
</body>
</html>
