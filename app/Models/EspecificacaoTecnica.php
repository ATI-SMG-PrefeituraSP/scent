<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EspecificacaoTecnica extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Atributos que permitem inserção em massa direto do request
     *
     * @var array
     */
    protected $fillable = [
        'nome_produto', 'data_criacao', 'diretorio_word', 'arquivo_word', 'codigo_suprimentos', 'unidade', 'itens', 'tipo_especificacao_id', 'data_revisao', 'codigo_catmat', 'combinacao', 'arquivo_caminho', 'revisao', 'itens_revisados', 'ativo', 'objeto', 'descritivo', 'transferido', 'identificacao', 'numero_supri', 'obs'
    ];

    /**
     * Preenche a chave estrangeira
     */
    public function tipo_especificacao()
    {
        return $this->hasOne(TipoEspecificacao::class, 'id', 'tipo_especificacao_id');
    }
}
