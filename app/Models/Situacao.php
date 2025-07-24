<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    protected $table = 'situacoes'; 

    protected $primaryKey = 'sit_id'; 
    protected $fillable = ['sit_nome']; 

    public function deputados()
    {
        return $this->hasMany(Deputado::class, 'dep_sit_id', 'sit_id');
    }
}
