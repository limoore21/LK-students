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

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <hr width="400">

        <h3>Аватарка</h3>

        @if(auth()->user()->avatar_status === 'approved' && auth()->user()->avatar_path)
            <a href="{{ asset('storage/' . auth()->user()->avatar_path) }}" target="_blank">
                <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="Аватар" width="150">
            </a>
        @elseif(auth()->user()->avatar_status === 'pending')
            <p>Ваша аватарка находится на модерации у старшины.</p>
        @else
            <p>У вас пока нет одобренной аватарки.</p>
        @endif

        <br>

        @if(auth()->user()->avatar_path)
            <form action="{{ route('profile.avatar.destroy') }}" method="POST" style="display:inline; margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit">Удалить аватарку</button>
            </form>
        @endif

        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" style="display:inline; margin:0;">
            @csrf
            <input type="file" name="avatar" required>
            <button type="submit">Загрузить</button>
        </form>
        @error('avatar') <p>{{ $message }}</p> @enderror
    </center>
</body>
</html>
