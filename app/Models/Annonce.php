<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Annonce extends Model
{
    protected $table = 'tb_annonces';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'prix_initial',
        'user_id',
        'ville_id',
        'etat',
    ];

    protected $casts = [
        'prix_initial' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ville(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    public function encheres(): HasMany
    {
        return $this->hasMany(Enchere::class, 'annonce_id');
    }
}
