<section class="space-y-6 mt-1">


    <x-primary-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'show-user')">{{ __('Ver usuários') }}</x-primary-button>

    <x-modal name="show-user" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="mt-6">
            @foreach ($usersProject as $user)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ $user->name }}
                        </div>
                    </div>
            @endforeach
        </div>
    </x-modal>
</section>
