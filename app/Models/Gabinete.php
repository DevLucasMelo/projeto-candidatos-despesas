<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gabinete extends Model
{
    protected $primaryKey = 'gab_id';

    protected $fillable = [
        'gab_predio',
        'gab_sala',
        'gab_andar',
        'gab_telefone',
        'gab_email',
    ];
}
