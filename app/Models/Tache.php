<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Tache extends Model
{
    use HasFactory; 
    use softDeletes;


    protected $casts = [
        'user' => 'array',
    ];

    protected $fillable = [ 

        'user','type','fournisseur','date','commentaire',
    ];

}
