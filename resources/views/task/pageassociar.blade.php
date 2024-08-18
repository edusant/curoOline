<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Task: {{ $task->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                Adicionar resposável
            </div>
            <form action="{{route('func.task.associar')}}" method="post">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach ($usersProject as $user)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                {{ $user->name }} - <button type="submit" name="user_id" value="{{$user->id}}">Associar usuário</button>
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="task_id" value="{{$task->id}}">
                </div>
            </form>

        </div>
    </div>


</x-app-layout>
