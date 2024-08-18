<section class="space-y-6">
    <x-primary-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'delete-task')">{{ __('Excluir task') }}</x-primary-button>

    <x-modal name="delete-task" focusable>

        <form method="post" action="{{ route('delete.task') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('tem certeza que quer excluir a task?') }}
            </h2>

            <input type="hidden" name="id" value="{{ $task->id }}">

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Excluir task') }}
                </x-primary-button>
            </div>

        </form>
    </x-modal>
</section>
