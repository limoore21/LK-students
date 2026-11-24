<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Личный кабинет курсанта
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-6">Добро пожаловать, {{ Auth::user()->name }}!</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Мой профиль --}}
                    <a href="{{ route('profile.show') }}" class="block p-6 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                        <h4 class="font-semibold text-lg mb-2">Мой профиль</h4>
                        <p class="text-sm text-gray-600">ФИО, дата рождения, курс, группа</p>
                    </a>

                    {{-- Загрузить аватарку --}}
                    <a href="{{ route('avatar.upload') }}" class="block p-6 bg-green-50 rounded-lg hover:bg-green-100 transition">
                        <h4 class="font-semibold text-lg mb-2">Загрузить аватарку</h4>
                        <p class="text-sm text-gray-600">Загрузка на модерацию старшине</p>
                    </a>

                    @if(Auth::user()->role === 'sergeant' || Auth::user()->role === 'admin')
    <a href="{{ route('sergeant.avatars.index') }}" class="block p-6 bg-purple-50 rounded-lg hover:bg-purple-100 transition border border-purple-200">
        <h4 class="font-semibold text-lg mb-2">Модерация аватарок</h4>
        <p class="text-sm text-gray-600">Одобрить или отклонить аватарки курсантов</p>
    </a>
@endif
                    @if(Auth::user()->role === 'curator' || Auth::user()->role === 'admin')
    <a href="{{ route('curator.students.index') }}" class="block p-6 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition border border-indigo-200">
        <h4 class="font-semibold text-lg mb-2">Управление курсантами</h4>
        <p class="text-sm text-gray-600">Заполнить ФИО, группу, курс</p>
    </a>
@endif
                    {{-- Статус аватарки --}}
                    <div class="block p-6 bg-gray-50 rounded-lg">
                        <h4 class="font-semibold text-lg mb-2">Статус аватарки</h4>
                        <p class="text-sm text-gray-600">
                            @if(Auth::user()->avatar_status === 'none')
                                <span class="text-gray-500">Не загружена</span>
                            @elseif(Auth::user()->avatar_status === 'pending')
                                <span class="text-yellow-600">На модерации</span>
                            @elseif(Auth::user()->avatar_status === 'approved')
                                <span class="text-green-600">Одобрена</span>
                            @elseif(Auth::user()->avatar_status === 'rejected')
                                <span class="text-red-600">Отклонена</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
