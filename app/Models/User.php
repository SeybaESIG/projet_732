<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_users';

    /**
     * Attributs mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nom',
        'prenom',
        'email',
        'tel',
        'adresse',
        'id_ville',
        'dateInscription',
    ];

    /**
     * Attributs cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Casts d'attributs.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dateInscription' => 'datetime',
    ];

    /**
     * Remplir automatiquement dateInscription à la création.
     */
    protected static function booted(): void
    {
        static::creating(function (self $user) {
            if (empty($user->dateInscription)) {
                $user->dateInscription = now();
            }
        });
    }

    /**
     * Relation vers la ville (clé étrangère id_ville).
     */
    public function ville(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'id_ville');
    }
}
