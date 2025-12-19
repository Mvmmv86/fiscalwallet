<?php

namespace App\Http\Controllers;

use App\Models\UserSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Lista todas as sessões ativas do usuário
     */
    public function index()
    {
        $user = Auth::user();
        $sessions = $user->sessions()
            ->orderBy('last_activity_at', 'desc')
            ->get();

        return view('perfil.sessoes', [
            'sessions' => $sessions,
            'currentSessionId' => session()->getId(),
        ]);
    }

    /**
     * Encerra uma sessão específica
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = Auth::user();

        $session = $user->sessions()->where('id', $id)->first();

        if (!$session) {
            return back()->withErrors(['session' => 'Sessão não encontrada.']);
        }

        // Não permite encerrar a sessão atual por aqui
        if ($session->session_id === session()->getId()) {
            return back()->withErrors(['session' => 'Use o botão de logout para encerrar a sessão atual.']);
        }

        $session->delete();

        return back()->with('success', 'Sessão encerrada com sucesso!');
    }

    /**
     * Encerra todas as sessões exceto a atual
     */
    public function destroyAll(): RedirectResponse
    {
        $user = Auth::user();
        $currentSessionId = session()->getId();

        $user->sessions()
            ->where('session_id', '!=', $currentSessionId)
            ->delete();

        return back()->with('success', 'Todas as outras sessões foram encerradas!');
    }
}
