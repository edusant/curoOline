<section class="space-y-6">
    <x-primary-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'update-task')">{{ __('Atualizar task') }}</x-primary-button>

    <x-modal name="update-task" focusable>
        <form method="post" action="{{ route('update.task') }}" class="p-6">
            @csrf
            @method('put')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Atualizar task') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="titulo" value="{{ __('Titulo') }}" class="sr-only" />

                <x-text-input id="titulo" value="{{ $task->titulo }}" name="titulo" type="text"
                    class="mt-1 block w-3/4" placeholder="{{ __('Titulo do projeto') }}" />
                <x-input-error :messages="$errors->userDeletion->get('titulo')" class="mt-2" />

                <textarea id="message" rows="4" class="mt-1 block w-3/4"
                 placeholder="Descrição da task" name="descricao">{{ $task->descricao }}</textarea>

                <label for=""> {{ __('Data encerramento do projeto') }}</label>
                <input type="date" value="{{ $task->data_encerramento }}" name="data_encerramento"
                    id="date_encerramento">

                <select id="status" value="concluida" name="status" class="mt-1 block w-3/4">
                    <option {{ $task->status == config('statustasks.pendente') ? 'selected' : '' }}
                        value="{{config('statustasks.pendente')}}"> {{ __('Pendente') }} </option>

                    <option {{ $task->status == config('statustasks.em_progresso') ? 'selected' : '' }}
                         value="{{config('statustasks.em_progresso')}}">{{ __('Em Progresso ') }}
                    </option>

                    <option {{ $task->status == config('statustasks.concluida') ? 'selected' : '' }}
                        value="concluida">{{ __('Concluída') }}</option>

                </select>

                <input type="hidden" name="task_id" value="{{ $task->id }}">
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Atualizar task') }}
                </x-primary-button>

            </div>
        </form>
    </x-modal>
</section>
