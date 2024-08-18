<section class="space-y-6 mt-1">


    <x-primary-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'add-user')">{{ __('ver/adicionar usuários') }}</x-primary-button>

    <x-modal name="add-user" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('add.user') }}" class="p-6">
            @csrf
            @method('post')

            @foreach ($usersProject as $user)
            @if($user->first())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h6 class="text-gray-900">
                    {{ __('Usuários cadastrados') }}
                </h6>
            </div>
            @endif
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ $user->name }}
                    </div>
                </div>
            @endforeach

            <div class="mt-6">

                <x-input-label for="email" value="{{ __('Email') }}" class="sr-only" />

                <x-text-input id="email" name="email" type="email" class="mt-1 block w-3/4"
                    placeholder="{{ __('Email do usuário') }}" />
                <x-input-error :messages="$errors->userDeletion->get('email')" class="mt-2" />
                <input type="hidden" name="project_id" value="{{ $projeto->id }}">


            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Adicionar novo usuário') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
