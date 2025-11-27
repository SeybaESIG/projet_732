<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enchere extends Model
{
    protected $table = 'tb_enchere';
    protected $primaryKey = 'enchere_id';

    protected $fillable = [
        'titre',
        'description',
        'prix_depart',
        'prix',
        'date_debut',
        'date_fin',
        'date_proposition',
        'annonce_id',
        'user_id',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'prix_depart' => 'decimal:2',
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'date_proposition' => 'datetime',
    ];

    public function annonce(): BelongsTo
    {
        return $this->belongsTo(Annonce::class, 'annonce_id', 'annonce_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'users_id');
    }

    public function getMontantFormatAttribute(): string
    {
        $value = $this->prix_depart ?? $this->prix ?? 0;

        return number_format((float) $value, 2, ',', ' ');
    }
}
