<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Личный кабинет
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Добро пожаловать, {{ Auth::user()->name }}!</h3>

                <p>Твоя текущая роль: <strong>{{ Auth::user()->role }}</strong></p>

                @if(Auth::user()->profile)
                    <div class="mt-4 p-4 bg-gray-50 rounded">
                        <h4 class="font-semibold mb-2">Данные профиля:</h4>
                        <p>ФИО: {{ Auth::user()->profile->last_name }} {{ Auth::user()->profile->first_name }} {{ Auth::user()->profile->middle_name }}</p>
                        <p>Группа: {{ Auth::user()->profile->group_name }} ({{ Auth::user()->profile->course }} курс)</p>
                    </div>
                @else
                    <p class="mt-4 text-yellow-600">Данные профиля еще не заполнены классным руководителем.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
