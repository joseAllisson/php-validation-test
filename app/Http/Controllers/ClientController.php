<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query(); // Presumindo que você tem um modelo Client

        // Filtragem
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
    
        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
    
        // Ordenação
        $sortBy = $request->input('sort_by', 'created_at'); // Valor default é 'created_at'
        $sortOrder = $request->input('sort_order', 'desc'); // Valor default é 'desc'
    
        $query->orderBy($sortBy, $sortOrder);
    
        // Paginação (20 itens por página)
        $clients = $query->paginate(perPage: 20);
    
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna a view de criação com um cliente vazio
        return view('clients.form', ['client' => new Client()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados enviados pelo formulário
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:15',
            'is_active' => 'nullable|boolean',
        ]);

        // Criação do cliente
        Client::create($validated);

        // Redireciona para a lista de clientes com mensagem de sucesso
        return redirect()->route('clients.index')->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        // Exibe os detalhes de um cliente (opcional para CRUD básico)
        // return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        // Retorna a view de edição com os dados do cliente
        return view('clients.form', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        \Log::info('Antes da validação', $request->all());

        $client->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'is_active' => $request->has('is_active'),
        ]);
    
        \Log::info('Passou na validação');
    
        return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // Deleta o cliente
        $client->delete();

        // Redireciona para a lista de clientes com mensagem de sucesso
        return redirect()->route('clients.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
