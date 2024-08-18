<section class="space-y-6">

    </header>

    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'update-project')"
    >{{ __('Atualizar projeto') }}</x-primary-button>

    <x-modal name="update-project" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('update.project') }}" class="p-6">
            @csrf
            @method('put')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Atualizando projeto') }}
            </h2>



            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Titulo') }}" class="sr-only" />

                <x-text-input
                    id="titulo"
                    name="titulo"
                    value="{{ $projeto->titulo }}"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Titulo do projeto') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('titulo')" class="mt-2" />



                <textarea id="message" rows="4"
                class="mt-1 block w-3/4" placeholder="Descrição do projeto" name="descricao"
                >{{ $projeto->descricao }}</textarea>

                <label for="">   {{ __('Data encerramento do projeto') }}</label>
                <input type="date"value="{{ $projeto->data_encerramento }}"
                name="data_encerramento" id="date_encerramento">
                <input type="hidden" name="id" value="{{ $projeto->id }}">


            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Atualizar projeto') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
