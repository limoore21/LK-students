<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой профиль</title>
</head>
<body>
    <center>
        <h2>Мой профиль</h2>

        <ul style="list-style:none; padding:0;">
            <li style="display:inline;"><a href="{{ route('dashboard') }}">На главную</a></li>
            <li style="display:inline; margin-left:10px;">
                <form action="{{ route('logout') }}" method="POST" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            </li>
        </ul>

        <hr width="400">

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <h3>Аватарка</h3>

        @if(auth()->user()->avatar_status === 'approved' && auth()->user()->avatar_path)
            <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="Аватар" width="150">
        @elseif(auth()->user()->avatar_status === 'pending')
            <p>Ваша аватарка находится на модерации у старшины.</p>
        @else
            <p>У вас пока нет одобренной аватарки.</p>
        @endif

        <br>

        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="avatar" required>
            <button type="submit">Загрузить</button>
        </form>
        @error('avatar') <p>{{ $message }}</p> @enderror
    </center>
</body>
</html>
