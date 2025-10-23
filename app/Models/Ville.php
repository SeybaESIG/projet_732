<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ville extends Model
{
    // Nom de la table (modifier si différent)
    protected $table = 'tb_villes';

    // Décommenter et adapter si la clé primaire n'est pas "id"
    // protected $primaryKey = 'id_ville';

    // Si la table n'a pas created_at/updated_at :
    // public $timestamps = false;

    // Champs autorisés pour l'assignation de masse (adapter)
    protected $fillable = [
        'name',     // remplacer par le nom réel de la colonne (ex: "ville")
        'slug',
        'pays_id',  // clé étrangère vers la table pays
        // ajouter d'autres colonnes si besoin
    ];

    // Relation : une ville appartient à un pays
    public function pays(): BelongsTo
    {
        return $this->belongsTo(Pays::class, 'pays_id');
    }

    // Exemple d'accessor simple (optionnel)
    public function getLabelAttribute(): string
    {
        return $this->name ?? '';
    }
}
