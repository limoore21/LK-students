<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мой профиль
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-6">Данные профиля</h3>

                @if(Auth::user()->profile)
                    <div class="space-y-4">
                        <div>
                            <span class="font-semibold">ФИО:</span>
                            <span class="ml-2">
                                {{ Auth::user()->profile->last_name }}
                                {{ Auth::user()->profile->first_name }}
                                {{ Auth::user()->profile->middle_name }}
                            </span>
                        </div>
                        <div>
                            <span class="font-semibold">Дата рождения:</span>
                            <span class="ml-2">{{ Auth::user()->profile->date_of_birth ? Auth::user()->profile->date_of_birth->format('d.m.Y') : 'Не указана' }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Курс:</span>
                            <span class="ml-2">{{ Auth::user()->profile->course }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Группа:</span>
                            <span class="ml-2">{{ Auth::user()->profile->group_name }}</span>
                        </div>
                    </div>
                @else
                    <p class="text-yellow-600">Данные профиля еще не заполнены классным руководителем.</p>
                @endif

                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">← Назад на главную</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
