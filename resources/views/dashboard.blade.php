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


           {{--  <table class="table-auto mt-5">
                <thead>
                  <tr>
                    <th>Projeto</th>
                    <th>Ação</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($projetos as $projeto)
                    <tr>
                        <td>{{ $projeto->titulo }}</td>
                        <td> <a href="{{ route('page.project', ['project_id' => $projeto->id]) }}" class="p-6">
                       Acessar</a></td>
                      </tr>
                    @endforeach

                </tbody>
              </tab --}}


<div class="relative overflow-x-auto mt-5">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('Titulo') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Data encerramento') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Ações') }}
                </th>

            </tr>
        </thead>
        <tbody>

            @foreach ($projetos as $projeto)


                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $projeto->titulo }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $projeto->data_encerramento }}
                        </td>
                        <td class="px-6 py-4">

                            <a href="{{ route('page.project', ['project_id' => $projeto->id]) }}" class="p-6">
                                {{ __('Acessar') }}</a>

                        </td>

                    </tr>
                    @endforeach

        </tbody>
    </table>
</div>

        </div>

        {{ $projetos->links() }}

    </div>
    </div>
</x-app-layout>
