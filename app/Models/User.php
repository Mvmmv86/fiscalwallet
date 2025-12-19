<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'document',
        'birth_date',
        'avatar_url',
        'address_cep',
        'address_street',
        'address_number',
        'address_complement',
        'address_neighborhood',
        'address_city',
        'address_state',
        'two_factor_enabled',
        'two_factor_secret',
        'notification_email_pendencias',
        'notification_email_declaracoes',
        'notification_email_operacoes',
        'notification_email_marketing',
        'notification_push_pendencias',
        'notification_push_declaracoes',
        'notification_push_operacoes',
        'onboarding_completed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
            'two_factor_enabled' => 'boolean',
            'notification_email_pendencias' => 'boolean',
            'notification_email_declaracoes' => 'boolean',
            'notification_email_operacoes' => 'boolean',
            'notification_email_marketing' => 'boolean',
            'notification_push_pendencias' => 'boolean',
            'notification_push_declaracoes' => 'boolean',
            'notification_push_operacoes' => 'boolean',
            'onboarding_completed' => 'boolean',
        ];
    }

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function declarations(): HasMany
    {
        return $this->hasMany(Declaration::class);
    }

    public function pendencies(): HasMany
    {
        return $this->hasMany(Pendency::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(UserSession::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class)->where('status', 'active');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function chatbotMessages(): HasMany
    {
        return $this->hasMany(ChatbotMessage::class);
    }

    public function getFullAddressAttribute(): ?string
    {
        if (!$this->address_street) {
            return null;
        }

        return "{$this->address_street}, {$this->address_number}" .
            ($this->address_complement ? " - {$this->address_complement}" : '') .
            " - {$this->address_neighborhood}, {$this->address_city}/{$this->address_state}" .
            " - CEP: {$this->address_cep}";
    }
}
