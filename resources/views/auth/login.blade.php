<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
    <h2>Вход в систему</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Пароль:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Войти</button>
    </form>

    <p>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
</body>
</html>
