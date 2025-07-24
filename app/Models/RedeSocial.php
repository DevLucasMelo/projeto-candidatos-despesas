<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedeSocial extends Model
{
    protected $primaryKey = 'red_soc_id';
    public $incrementing = true;
    protected $table = 'redes_sociais';
    
    protected $fillable = [
        'red_soc_dep_id',
        'red_soc_url',
    ];

    public function deputado()
    {
        return $this->belongsTo(Deputado::class, 'red_soc_dep_id', 'dep_id');
    }
}
