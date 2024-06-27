<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Modalite;

class EquipementDemo extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'code','modele','marque',
        'designation','numserie','modalite_id',
        'fiche_technique','date_entree','garantie'
    ];

    public function modalite(){
        return $this->belongsTo(Modalite::class);
    }
}
