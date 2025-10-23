<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enchere extends Model
{
    protected $table = 'tb_enchere';

    // adapter la clé primaire si nécessaire
    // protected $primaryKey = 'enchere_id';

    // si la table n'a pas created_at/updated_at :
    // public $timestamps = false;

    protected $fillable = [
        'montant',
        'annonce_id',
        'user_id',
        // ajouter d'autres colonnes si besoin
    ];

    protected $casts = [
        'montant' => 'decimal:2',
    ];

    public function annonce(): BelongsTo
    {
        return $this->belongsTo(Annonce::class, 'annonce_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // exemple d'accessor
    public function getMontantFormatAttribute(): string
    {
        return number_format((float) $this->montant, 2, ',', ' ');
    }
}
