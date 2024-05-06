<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produit';

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'categorie_id',
        'quantite_stock',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'categorie_id');
    }
}
