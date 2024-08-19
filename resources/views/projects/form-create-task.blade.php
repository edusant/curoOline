<section class="space-y-6">
    <header>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Tasks do projeto.') }}
        </p>
    </header>

    <x-primary-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'create-task')">{{ __('Criar nova task') }}</x-primary-button>

    <x-modal name="create-task" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('create.task') }}" class="p-6">
            @csrf
            @method('post')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Criando nova task') }}
            </h2>



            <div class="mt-6">
                <x-input-label for="titulo" value="{{ __('Titulo') }}" class="sr-only" />

                <x-text-input id="titulo" name="titulo" type="text" class="mt-1 block w-3/4"
                    placeholder="{{ __('Titulo do projeto') }}" />
                <x-input-error :messages="$errors->userDeletion->get('titulo')" class="mt-2" />



                <textarea id="message" rows="4" class="mt-1 block w-3/4"
                placeholder="Descrição da task" name="descricao"></textarea>

                <label for=""> {{ __('Data encerramento do projeto') }}</label>
                <input type="date" name="data_encerramento" id="date_encerramento">

                <select id="status" value="concluida" name="status" class="mt-1 block w-3/4">
                    <option value="{{config('statustasks.pendente')}}">Pendente</option>
                    <option value="em_progresso">Em Progresso</option>
                    <option value="concluida">Concluída</option>
                </select>

                <input type="hidden" name="project_id" value="{{ $projeto->id }}">

            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Criar projeto') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
