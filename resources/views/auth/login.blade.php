<x-guest-layout>
    <h2>Вход в систему</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="remember"> Запомнить меня
            </label>
        </div>

        <button type="submit" class="btn">Войти</button>

        <div class="links">
            <a href="{{ route('register') }}">Нет аккаунта? Зарегистрироваться</a>
        </div>
    </form>
</x-guest-layout>
