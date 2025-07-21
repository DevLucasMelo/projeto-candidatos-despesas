<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deputado extends Model
{
    protected $primaryKey = 'dep_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'dep_id',
        'dep_nome',
        'dep_uri',
        'dep_url_foto',
        'dep_uf_id',
        'dep_par_id',
    ];

    public function despesas()
    {
        return $this->hasMany(Despesa::class, 'des_dep_id', 'dep_id');
    }

    public function uf()
    {
        return $this->belongsTo(Uf::class, 'dep_uf_id', 'uf_id');
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'dep_par_id', 'par_id');
    }
}
