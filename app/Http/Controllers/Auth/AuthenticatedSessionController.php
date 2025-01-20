<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validação adicional para o reCAPTCHA
        $request->validate([
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Por favor, confirme que você não é um robô.',
        ]);
        
        // Verificar o token do reCAPTCHA com o Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('NOCAPTCHA_SECRET'), // Sua chave secreta do reCAPTCHA
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);
    
        // Validar a resposta do Google
        if (! $response->json('success')) {
            throw new HttpResponseException(back()->withErrors([
                'g-recaptcha-response' => 'Falha na verificação do reCAPTCHA.',
            ]));
        }
    
        // Continuar com o login se o reCAPTCHA for validado
        $request->authenticate();
    
        $request->session()->regenerate();
    
        return redirect()->intended(route('clients.index'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
