<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Installation extends Model
{
    use HasFactory;
    protected $casts = [
        'user_id' => 'array',
    ];

    protected $fillable = [
       'client_id','user_id','equipement','date_debut','date_fin',
       'status','description'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
