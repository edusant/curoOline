<section class="space-y-6">

</header>

<x-primary-button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'delete-project')"
>{{ __('Excluir projeto') }}</x-primary-button>

<x-modal name="delete-project" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('delete.project') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Excluindo projeto') }}
        </h2>
        <input type="hidden" name="project_id" value="{{ $projeto->id }}">

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-primary-button class="ms-3">
                {{ __('Excluir projeto') }}
            </x-primary-button>

        </div>

    </form>
</x-modal>
</section>
