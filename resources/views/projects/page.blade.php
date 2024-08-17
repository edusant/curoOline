<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Projeto:  {{ $projeto->titulo }}
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

        </div>
    </div>
</x-app-layout>
