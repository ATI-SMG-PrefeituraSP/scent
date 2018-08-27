<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class NormaTecnica extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Atributos que permitem inserção em massa direto do request
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'data', 'norma', 'nbr', 'palachave', 'paginas',
    ];
}
