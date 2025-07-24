<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CondicaoEleitoral extends Model
{
    protected $table = 'condicoes_eleitorais';
    
    protected $primaryKey = 'con_ele_id'; 

    protected $fillable = ['con_ele_nome']; 

    public function deputados()
    {
        return $this->hasMany(Deputado::class, 'dep_con_ele_id', 'con_ele_id');
    }
}
