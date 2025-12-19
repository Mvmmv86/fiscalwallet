<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePersonalDataRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateNotificationsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PerfilController extends Controller
{
    /**
     * Exibe a página principal do perfil
     */
    public function index(): View
    {
        $user = Auth::user();

        return view('perfil.index', [
            'user' => $user,
            'subscription' => $user->subscription,
            'plan' => $user->subscription?->plan,
        ]);
    }

    /**
     * Exibe a página de dados pessoais
     */
    public function dadosPessoais(): View
    {
        return view('perfil.dados-pessoais', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Atualiza os dados pessoais do usuário
     */
    public function updatePersonalData(UpdatePersonalDataRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->update($request->validated());

        return back()->with('success', 'Dados pessoais atualizados com sucesso!');
    }

    /**
     * Atualiza a senha do usuário
     */
    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Senha atualizada com sucesso!');
    }

    /**
     * Exibe a página de segurança (2FA)
     */
    public function seguranca(): View
    {
        $user = Auth::user();

        return view('perfil.seguranca', [
            'user' => $user,
            'twoFactorEnabled' => $user->two_factor_enabled,
        ]);
    }

    /**
     * Exibe a página de notificações
     */
    public function notificacoes(): View
    {
        $user = Auth::user();

        return view('perfil.notificacoes', [
            'user' => $user,
            'preferences' => $user->notification_preferences ?? [
                'email_operations' => true,
                'email_declarations' => true,
                'email_pendencies' => true,
                'email_newsletter' => false,
                'push_operations' => true,
                'push_declarations' => true,
                'push_pendencies' => true,
            ],
        ]);
    }

    /**
     * Atualiza as preferências de notificação
     */
    public function updateNotifications(UpdateNotificationsRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->update([
            'notification_preferences' => $request->validated(),
        ]);

        return back()->with('success', 'Preferências de notificação atualizadas!');
    }

    /**
     * Exibe a página de planos
     */
    public function planos(): View
    {
        $user = Auth::user();
        $plans = \App\Models\Plan::where('is_active', true)
            ->orderBy('price_monthly')
            ->get();

        return view('perfil.planos', [
            'user' => $user,
            'plans' => $plans,
            'currentPlan' => $user->subscription?->plan,
            'subscription' => $user->subscription,
        ]);
    }

    /**
     * Exibe a página de sessões ativas
     */
    public function sessoes(): View
    {
        $user = Auth::user();
        $sessions = $user->sessions()
            ->orderBy('last_activity_at', 'desc')
            ->get();

        return view('perfil.sessoes', [
            'user' => $user,
            'sessions' => $sessions,
            'currentSessionId' => session()->getId(),
        ]);
    }
}
