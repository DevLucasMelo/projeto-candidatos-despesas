<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $table = 'despesas';

    protected $primaryKey = 'des_id';    
    public $incrementing = true;         
    protected $keyType = 'int';          

    protected $fillable = [
        'des_dep_id',      
        'des_cod_documento',
        'des_tipo_despesa',
        'des_fornecedor',
        'des_ano',
        'des_mes',
        'des_valor_documento',
        'des_valor_glosa',
        'des_valor_liquido',
        'des_data_documento',
    ];

    public function deputado()
    {
        return $this->belongsTo(Deputado::class, 'des_dep_id', 'dep_id');
    }
}
