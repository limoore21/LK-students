<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Модерация аватарок курсантов
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($pendingUsers->isEmpty())
                    <p class="text-gray-600 text-center py-8">На данный момент нет аватарок, ожидающих модерации. 🎉</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Курсант</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Группа</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Текущая ава</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($pendingUsers as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->profile ? $user->profile->group_name : 'Не указана' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->avatar_path)
                                            <img src="{{ Storage::url($user->avatar_path) }}" alt="Avatar" class="h-12 w-12 rounded-full object-cover border">
                                        @else
                                            <span class="text-gray-400">Нет</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <form action="{{ route('sergeant.avatars.approve', $user) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-xs">
                                                Одобрить
                                            </button>
                                        </form>
                                        <form action="{{ route('sergeant.avatars.reject', $user) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs" onclick="return confirm('Отклонить и удалить аватарку?')">
                                                Отклонить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">← Назад на главную</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
