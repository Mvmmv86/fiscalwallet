<?php

namespace App\Services;

use App\Models\User;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorAuthService
{
    protected Google2FA $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * Gera uma nova chave secreta para 2FA
     */
    public function generateSecretKey(): string
    {
        return $this->google2fa->generateSecretKey();
    }

    /**
     * Gera o QR Code como SVG para o usuário escanear
     */
    public function generateQrCodeSvg(User $user, string $secretKey): string
    {
        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secretKey
        );

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);

        return $writer->writeString($qrCodeUrl);
    }

    /**
     * Verifica se o código OTP é válido
     */
    public function verifyCode(string $secretKey, string $code): bool
    {
        return $this->google2fa->verifyKey($secretKey, $code);
    }

    /**
     * Ativa o 2FA para um usuário
     */
    public function enable(User $user, string $secretKey, string $code): bool
    {
        if (!$this->verifyCode($secretKey, $code)) {
            return false;
        }

        $user->update([
            'two_factor_secret' => encrypt($secretKey),
            'two_factor_enabled' => true,
        ]);

        return true;
    }

    /**
     * Desativa o 2FA para um usuário
     */
    public function disable(User $user): void
    {
        $user->update([
            'two_factor_secret' => null,
            'two_factor_enabled' => false,
        ]);
    }

    /**
     * Verifica o código 2FA de um usuário autenticado
     */
    public function verify(User $user, string $code): bool
    {
        if (!$user->two_factor_enabled || !$user->two_factor_secret) {
            return true; // 2FA não está ativado
        }

        try {
            $secretKey = decrypt($user->two_factor_secret);
            return $this->verifyCode($secretKey, $code);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Verifica se o usuário tem 2FA ativado
     */
    public function isEnabled(User $user): bool
    {
        return $user->two_factor_enabled && $user->two_factor_secret;
    }
}
