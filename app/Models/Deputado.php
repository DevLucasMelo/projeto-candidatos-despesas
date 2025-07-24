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

        // Novos campos
        'dep_data_nascimento',
        'dep_municipio_nascimento',
        'dep_escolaridade',
        'dep_gab_id',
        'dep_sit_id',
        'dep_con_ele_id',
    ];

    // Relações existentes
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

    // Novas relações
    public function gabinete()
    {
        return $this->belongsTo(Gabinete::class, 'dep_gab_id', 'gab_id');
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class, 'dep_sit_id', 'sit_id');
    }

    public function condicaoEleitoral()
    {
        return $this->belongsTo(CondicaoEleitoral::class, 'dep_con_ele_id', 'con_ele_id');
    }

    public function redesSociais()
    {
       return $this->hasMany(RedeSocial::class, 'red_soc_dep_id', 'dep_id');
    }

    public function profissoes()
    {
        return $this->belongsToMany(Profissao::class, 'deputados_profissoes', 'dep_pro_dep_id', 'dep_pro_pro_id')
                    ->withPivot('dep_pro_id')
                    ->withTimestamps();
    }
}
