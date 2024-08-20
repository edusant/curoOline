<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Task: {{ $task->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('update-task', $task->id)
                @include('projects.form-update-task')
                @include('projects.form-delete-task')
            @endcan

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                Descrição: {{ $task->descricao }}
            </div>

            <br>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                Data vencimento: {{ $task->data_encerramento }}
            </div>

            @can('update-task', $task->id)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    @foreach ($userResponsaveis as $responsavel)
                    @if ($userResponsaveis->first())
                        Responsáveis:
                        <hr>
                    @endif
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                {{ $responsavel->name }} - {{ $responsavel->id }}
                            </div>
                        </div>
                    @endforeach

                    <a href="{{ route('page.task.associar', ['task_id' => $task->id]) }}">Gerenciar Responsáveis</a>

                </div>
            @endcan



        </div>
    </div>


</x-app-layout>
