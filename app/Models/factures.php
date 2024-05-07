<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factures extends Model
{
    use HasFactory;
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'factures';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'produit_id',
        'commandes_id',
        'qty',
        
    ];
    public function client()
    {
        return $this->belongsTo(client::class, 'client_id');
    }
    public function produit()
    {
        return $this->belongsTo(produit::class, 'produit_id');
    }
    public function commandes()
    {
        return $this->belongsTo(commandes::class, 'commandes_id');
    }
}
