<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
    <h2>Регистрация курсанта</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label>Имя:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Пароль:</label>
            <input type="password" name="password" required>
            @error('password') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Подтверждение пароля:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Зарегистрироваться</button>
    </form>

    <p>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
</body>
</html>
