<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Caixa para adicionar novo cliente --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a href="{{ route('clients.create') }}" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">
                        + Adicionar Cliente
                    </a>
                </div>
            </div>

            {{-- Caixa para exibir filtros --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="GET" action="{{ route('clients.index') }}" class="flex space-x-4">
                        <input type="text" name="name" placeholder="Filtrar por nome" value="{{ request('name') }}" class="input input-bordered" />
                        <input type="email" name="email" placeholder="Filtrar por email" value="{{ request('email') }}" class="input input-bordered" />
                        <button type="submit" class="btn btn-primary bg-blue-800 text-white p-4">Buscar</button>
                    </form>
                </div>
            </div>

            {{-- Caixa para exibir a lista de clientes --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">
                                    <a href="{{ route('clients.index', array_merge(request()->query(), ['sort_by' => 'name', 'sort_order' => (request('sort_by') == 'name' && request('sort_order') == 'asc') ? 'desc' : 'asc'])) }}">
                                        Nome
                                        @if (request('sort_by') == 'name')
                                            @if (request('sort_order') == 'asc')
                                                &#8593;
                                            @else
                                                &#8595;
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">
                                    <a href="{{ route('clients.index', array_merge(request()->query(), ['sort_by' => 'email', 'sort_order' => (request('sort_by') == 'email' && request('sort_order') == 'asc') ? 'desc' : 'asc'])) }}">
                                        Email
                                        @if (request('sort_by') == 'email')
                                            @if (request('sort_order') == 'asc')
                                                &#8593;
                                            @else
                                                &#8595;
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Telefone</th>
                                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-3 border-b text-center text-sm font-semibold text-gray-700">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td class="px-6 py-4 border-b text-sm text-gray-700">{{ $client->name }}</td>
                                    <td class="px-6 py-4 border-b text-sm text-gray-700">{{ $client->email }}</td>
                                    <td class="px-6 py-4 border-b text-sm text-gray-700">{{ $client->phone }}</td>
                                    <td class="px-6 py-4 border-b text-sm text-gray-700">
                                        <span class="{{ $client->is_active ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $client->is_active ? 'Ativo' : 'Inativo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 border-b text-center">
                                        <a href="{{ route('clients.edit', $client) }}" class="bg-yellow-500 text-white px-3 py-3 rounded hover:bg-yellow-600">
                                            Editar
                                        </a>
                                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 h-[43px] rounded hover:bg-red-600" onclick="return confirm('Tem certeza que deseja excluir?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Caixa para paginação --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    {{ $clients->links() }} {{-- Paginação --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
