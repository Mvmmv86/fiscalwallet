<?php

namespace App\Http\Controllers;

use App\Services\TwoFactorAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthController extends Controller
{
    public function __construct(
        protected TwoFactorAuthService $twoFactorService
    ) {}

    /**
     * Exibe a página de configuração do 2FA
     */
    public function show()
    {
        $user = Auth::user();

        if ($this->twoFactorService->isEnabled($user)) {
            return view('auth.two-factor.enabled');
        }

        // Gera nova chave secreta e armazena na sessão
        $secretKey = session('2fa_secret_key') ?? $this->twoFactorService->generateSecretKey();
        session(['2fa_secret_key' => $secretKey]);

        $qrCodeSvg = $this->twoFactorService->generateQrCodeSvg($user, $secretKey);

        return view('auth.two-factor.setup', [
            'secretKey' => $secretKey,
            'qrCodeSvg' => $qrCodeSvg,
        ]);
    }

    /**
     * Ativa o 2FA
     */
    public function enable(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = Auth::user();
        $secretKey = session('2fa_secret_key');

        if (!$secretKey) {
            return back()->withErrors(['code' => 'Sessao expirada. Por favor, tente novamente.']);
        }

        if (!$this->twoFactorService->enable($user, $secretKey, $request->code)) {
            return back()->withErrors(['code' => 'Codigo invalido. Por favor, tente novamente.']);
        }

        session()->forget('2fa_secret_key');

        return redirect()->route('perfil.seguranca')
            ->with('success', 'Autenticacao de dois fatores ativada com sucesso!');
    }

    /**
     * Desativa o 2FA
     */
    public function disable(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
            'password' => 'required|current_password',
        ]);

        $user = Auth::user();

        if (!$this->twoFactorService->verify($user, $request->code)) {
            return back()->withErrors(['code' => 'Codigo invalido.']);
        }

        $this->twoFactorService->disable($user);

        return redirect()->route('perfil.seguranca')
            ->with('success', 'Autenticacao de dois fatores desativada.');
    }

    /**
     * Página de verificação do 2FA no login
     */
    public function challenge()
    {
        if (!session('2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor.challenge');
    }

    /**
     * Verifica o código 2FA no login
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $userId = session('2fa_user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = \App\Models\User::find($userId);

        if (!$user || !$this->twoFactorService->verify($user, $request->code)) {
            return back()->withErrors(['code' => 'Codigo invalido.']);
        }

        // Login completo
        Auth::login($user, session('2fa_remember', false));
        session()->forget(['2fa_user_id', '2fa_remember']);

        return redirect()->intended(route('dashboard'));
    }
}
