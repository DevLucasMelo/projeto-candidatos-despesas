<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $primaryKey = 'par_id';
    protected $fillable = ['par_nome'];

    public function deputados()
    {
        return $this->hasMany(Deputado::class, 'dep_par_id', 'par_id');
    }
}

