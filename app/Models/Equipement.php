<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sousequipement;

class Equipement extends Model
{
    use HasFactory;
    use softDeletes;


    protected $fillable = [
        'code','modele','marque',
        'designation','numserie','modalite_id','client_id',
        'software','date_installation','plan_prev','garantie','document'
    ];

    public function modalite(){
        return $this->belongsTo(Modalite::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function sousequipements(): HasMany
    {
        return $this->hasMany(Sousequipement::class);
    }

    public function accessoires(): HasMany
    {
        return $this->hasMany(Accessoire::class);
    }
    public function contrat()
    {
        return $this->hasOne(Contrat::class);
    }

    public function pieces():HasMany
    {
        return $this->HasMany(Piece::class);
    }
}
