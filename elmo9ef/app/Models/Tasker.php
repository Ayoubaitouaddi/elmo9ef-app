<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'CIN',
        'category_name',
        'service_name',
        'image',
        'adresse',
        'telephone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profeil()
    {
        return $this->hasOne(Profeil::class, 'tasker_id');
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}