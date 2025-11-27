<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ville extends Model
{
    protected $table = 'tb_villes';
    protected $primaryKey = 'ville_id';

    protected $fillable = [
        'nom',
        'name',
        'code_postal',
        'pays_id',
    ];

    public function pays(): BelongsTo
    {
        return $this->belongsTo(Pays::class, 'pays_id', 'pays_id');
    }

    public function getLabelAttribute(): string
    {
        return $this->nom ?? $this->name ?? '';
    }
}
