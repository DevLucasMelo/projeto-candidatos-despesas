<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    protected $primaryKey = 'uf_id';
    protected $fillable = ['uf_sigla'];

    public function deputados()
    {
        return $this->hasMany(Deputado::class, 'dep_uf_id', 'uf_id');
    }
}

