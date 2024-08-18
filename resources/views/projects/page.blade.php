<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Projeto: {{ $projeto->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('status'))
                    {{ session('status') }}
                @endif
                @include('projects.form-create-task')
            </div>

            @foreach ($tasks as $task)
                <a href="{{ route('page.task', ['task_id' => $task->id]) }}" class="p-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ $task->titulo }}
                        </div>
                    </div>
                </a>
                <br>
            @endforeach
        </div>
    </div>
</x-app-layout>
