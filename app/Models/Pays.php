<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pays extends Model
{
    protected $table = 'tb_pays';
    protected $primaryKey = 'pays_id';

    // Si la table n'a pas de created_at/updated_at
    public $timestamps = false;

    protected $fillable = ['code_iso_pays', 'name'];

    public function villes(): HasMany
    {
        return $this->hasMany(Ville::class, 'pays_id', 'pays_id');
    }
}
