<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projetos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('status'))
                    {{ session('status') }}
                @endif
                @include('projects.form-create-projects')
            </div>
            @foreach ($projetos as $projeto)
            <a href="{{route('page.project', ['project_id' => $projeto->id])}}" class="p-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ $projeto->titulo }}
                    </div>
                    </a>
                </div>
            @endforeach

            {{ $projetos->links() }}
        </div>
    </div>
</x-app-layout>
