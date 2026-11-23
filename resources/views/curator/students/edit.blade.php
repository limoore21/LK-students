<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование профиля</title>
</head>
<body>
    <center>
        <h2>Редактирование профиля: {{ $user->name }}</h2>

        <ul>
            <li><a href="{{ route('dashboard') }}">На главную</a></li>
            <li><a href="{{ route('curator.students.index') }}">Назад к списку</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            </li>
        </ul>

        <form action="{{ route('curator.students.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <table>
                <tr>
                    <td align="right"><label>Фамилия:</label></td>
                    <td>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->profile?->last_name) }}" required>
                        @error('last_name') <br><span>{{ $message }}</span> @enderror
                    </td>
                </tr>
                <tr>
                    <td align="right"><label>Имя:</label></td>
                    <td>
                        <input type="text" name="first_name" value="{{ old('first_name', $user->profile?->first_name) }}" required>
                        @error('first_name') <br><span>{{ $message }}</span> @enderror
                    </td>
                </tr>
                <tr>
                    <td align="right"><label>Отчество:</label></td>
                    <td>
                        <input type="text" name="middle_name" value="{{ old('middle_name', $user->profile?->middle_name) }}">
                    </td>
                </tr>
                <tr>
                    <td align="right"><label>Дата рождения:</label></td>
                    <td>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->profile?->date_of_birth) }}">
                    </td>
                </tr>
                <tr>
                    <td align="right"><label>Курс:</label></td>
                    <td>
                        <input type="number" name="course" value="{{ old('course', $user->profile?->course) }}" required>
                        @error('course') <br><span>{{ $message }}</span> @enderror
                    </td>
                </tr>
                <tr>
                    <td align="right"><label>Группа:</label></td>
                    <td>
                        <input type="text" name="group_name" value="{{ old('group_name', $user->profile?->group_name) }}" required>
                        @error('group_name') <br><span>{{ $message }}</span> @enderror
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><br><button type="submit">Сохранить</button></td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>
