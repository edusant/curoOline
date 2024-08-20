<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            descrição: {{ $projeto->titulo }}
        </h2>
        <p class="font-semibold"> Projeto: {{ $projeto->descricao }}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('status'))
                    {{ session('status') }}
                @endif

                @can('update-project', $projeto->id)
                    @include('projects.form-create-task')
                    @include('projects.form-add-user')
                    @include('projects.form-update-projects')
                    @include('projects.form-delete-projects')
                @endcan
                <form class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-city">
                                {{ __('De (Vencimento)') }}
                            </label>
                            <input name="de" value="{{request('de')}}"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="de-date" type="date">
                        </div>

                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-zip">
                                {{ __('Até (Vencimento)') }}
                            </label>
                            <input name="ate" value="{{request('ate')}}"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="ate-date" type="date">
                        </div>

                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-state">
                                {{ __('Status') }}
                            </label>
                            <div class="relative">
                                <select name="status"
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-state">
                                    <option value="{{request('status')}}">{{ __('Todos') }}</option>
                                    <option value="{{ config('statustasks.pendente') }}">{{ __('Pendente') }}</option>
                                    <option value="{{config('statustasks.em_progresso')}}">
                                    {{__('Em progresso') }}</option>
                                    <option>Concluída</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">
                            Filtrar
                        </button>

                        <input value=" {{ __('baixar relatório') }}" name="baixar_excel"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                        </input>

                    </div>
                </form>

            </div>


            <div class="relative overflow-x-auto mt-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Titulo') }}
                            </th>

                            <th scope="col" class="px-6 py-3">
                                {{ __('Data vencimento') }}
                            </th>

                            <th scope="col" class="px-6 py-3">
                                {{ __('Status') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Ações') }}
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($tasks as $task)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $task->titulo }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $task->data_encerramento }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->status }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('page.task', ['task_id' => $task->id]) }}"
                                        class="p-6">
                                        {{ __('Acessar') }}</a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
