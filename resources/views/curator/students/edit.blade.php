<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактирование профиля курсанта
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-6">
                    {{ $user->name }} ({{ $user->email }})
                </h3>

                <form action="{{ route('curator.students.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Фамилия *</label>
                            <input type="text" name="last_name"
                                   value="{{ old('last_name', $user->profile?->last_name) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Имя *</label>
                            <input type="text" name="first_name"
                                   value="{{ old('first_name', $user->profile?->first_name) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Отчество</label>
                            <input type="text" name="middle_name"
                                   value="{{ old('middle_name', $user->profile?->middle_name) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Дата рождения</label>
                            <input type="date" name="date_of_birth"
                                   value="{{ old('date_of_birth', $user->profile?->date_of_birth) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Курс *</label>
                            <input type="number" name="course"
                                   value="{{ old('course', $user->profile?->course) }}"
                                   min="1" max="6" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Группа *</label>
                            <input type="text" name="group_name"
                                   value="{{ old('group_name', $user->profile?->group_name) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-3">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Сохранить
                        </button>
                        <a href="{{ route('curator.students.index') }}"
                           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Отмена
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
