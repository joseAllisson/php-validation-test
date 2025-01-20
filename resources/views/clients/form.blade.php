<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $client->id ? 'Editar Cliente' : 'Novo Cliente' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Formulário -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form action="{{ $client->id ? route('clients.update', $client) : route('clients.store') }}" method="POST">
                        @csrf
                        @if($client->id)
                            @method('PUT')
                        @endif

                        <!-- Campo Nome -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $client->name) }}" class="border px-4 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}" class="border px-4 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Telefone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $client->phone) }}" class="border px-4 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('phone')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Ativo -->
                        <div class="mb-4 flex items-center">
                            <label for="is_active" class="mr-2">Ativo</label>
                            <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $client->is_active) ? 'checked' : '' }} class="h-5 w-5 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Botão de Salvar -->
                        <button type="submit" class="bg-blue-500 text-black px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Salvar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
