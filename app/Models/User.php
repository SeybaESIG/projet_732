<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_users';
    protected $primaryKey = 'users_id';
    protected $keyType = 'int';

    /**
     * Attributs mass-assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nom',
        'prenom',
        'email',
        'num_tel',
        'adresse',
        'ville_id',
        'mot_de_passe',
        'date_inscription',
        'google_id',
        'google_avatar_url',
        'google_access_token',
        'google_refresh_token',
        'google_token_expires_at',
    ];

    /**
     * Attributs cachés lors de la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mot_de_passe',
        'google_access_token',
        'google_refresh_token',
    ];

    /**
     * Casts automatiques.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_inscription' => 'datetime',
        'google_token_expires_at' => 'datetime',
        'google_access_token' => 'encrypted',
        'google_refresh_token' => 'encrypted',
    ];

    /**
     * Remplir automatiquement date_inscription à la création.
     */
    protected static function booted(): void
    {
        static::creating(function (self $user) {
            if (empty($user->date_inscription)) {
                $user->date_inscription = now();
            }
        });
    }

    /**
     * Champ mot_de_passe hashé automatiquement.
     */
    protected function motDePasse(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => filled($value) ? Hash::make($value) : null,
        );
    }

    /**
     * Spécifie à Laravel où trouver le mot de passe pour l'auth.
     */
    public function getAuthPassword(): ?string
    {
        return $this->mot_de_passe;
    }

    /**
     * Relation avec la ville.
     */
    public function ville(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    /**
     * Désactive le remember token (non utilisé avec l'OAuth Google).
     */
    public function getRememberTokenName(): ?string
    {
        return null;
    }
}
