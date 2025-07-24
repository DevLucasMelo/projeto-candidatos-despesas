<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profissao extends Model
{
    protected $primaryKey = 'pro_id';
    protected $table = 'profissoes';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'pro_nome',
    ];

    public function deputados()
    {
        return $this->belongsToMany(Deputado::class, 'deputado_profissao', 'pro_id', 'dep_id');
    }
}
