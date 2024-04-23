<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Piece extends Model
{
    use HasFactory;
   

    protected $fillable = [
        'designation','reference','numserie','date_remplacement','qte','intervention_id','equipement_id','client_id','sousequipement_id'
    ];

    public function intervention(){

        return $this->belongsTo(Intervention::class);
    }

    public function equipement(){

        return $this->belongsTo(Equipement::class);
    }

    public function client(){

        return $this->belongsTo(Client::class);
    }

    public function sousequipement(){

        return $this->belongsTo(Sousequipement::class);
    }

}
