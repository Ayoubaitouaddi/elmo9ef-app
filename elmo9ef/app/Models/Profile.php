<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profeil extends Model
{
    use HasFactory;

    protected $fillable = [
        'tasker_id', // Utiliser tasker_id
        'nom',
        'prenom',
        'CIN',
        'category_name',
        'service_name',
        'image',
        'adresse',
        'telephone',
    ];

    // Relation avec le modèle Tasker
    public function tasker()
    {
        return $this->belongsTo(Tasker::class, 'tasker_id');
    }
}