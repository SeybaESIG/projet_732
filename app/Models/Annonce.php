<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Annonce extends Model
{
    protected $table = 'tb_annonces';
    protected $primaryKey = 'annonce_id';
    public $timestamps = false;

    protected $fillable = [
        'titre',
        'description',
        'prix',
        'date_publication',
        'statut',
        'user_id',
        'ville_id',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'date_publication' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'users_id');
    }

    public function ville(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_id', 'ville_id');
    }

    public function encheres(): HasMany
    {
        return $this->hasMany(Enchere::class, 'annonce_id', 'annonce_id');
    }
}
