@extends('layouts.app') 
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Especificações Técnicas</div>

            <div class="card-body">

                {{ Form::open(['url' => route('admin.especificacao_tecnica.salvar'), 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}

                    {{-- Campo necessário para verificar que o especificacao_tecnica logado é o que está fazendo a alteração --}}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{isset($registro)? $registro->id : "" }}" >

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('nome_produto')) echo "text-danger" ?>">Nome do Produto</label>
                            <input type="text" name="nome_produto" value="{{ isset($registro)? $registro->nome_produto : old('nome_produto') }}" class="form-control  <?php if($errors->has('nome_produto')) echo "is-invalid" ?>">
                            @if ($errors->has('nome_produto'))
                                <span class="text-danger">
                                {{ $errors->first('nome_produto') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('data_criacao')) echo "text-danger" ?>">Data de Criação</label>
                            <input data-mask="00/00/0000" type="text" name="data_criacao" value="{{ isset($registro)? App\Biblioteca::dateTostr($registro->data_criacao) : old('data_criacao') }}" class="form-control  <?php if($errors->has('data_criacao')) echo "is-invalid" ?>">
                            @if ($errors->has('data_criacao'))
                                <span class="text-danger">
                                {{ $errors->first('data_criacao') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('diretorio_word')) echo "text-danger" ?>">Diretório Word</label>
                            <input type="text" name="diretorio_word" value="{{ isset($registro)? $registro->diretorio_word : old('diretorio_word') }}" class="form-control  <?php if($errors->has('diretorio_word')) echo "is-invalid" ?>">
                            @if ($errors->has('diretorio_word'))
                                <span class="text-danger">
                                {{ $errors->first('diretorio_word') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('arquivo_word')) echo "text-danger" ?>">Arquivo Word</label>
                            <input type="text" name="arquivo_word" value="{{ isset($registro)? $registro->arquivo_word : old('arquivo_word') }}" class="form-control  <?php if($errors->has('arquivo_word')) echo "is-invalid" ?>">
                            @if ($errors->has('arquivo_word'))
                                <span class="text-danger">
                                {{ $errors->first('arquivo_word') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('codigo_suprimentos')) echo "text-danger" ?>">Código Suprimentos</label>
                            <input type="text" name="codigo_suprimentos" value="{{ isset($registro)? $registro->codigo_suprimentos : old('codigo_suprimentos') }}" class="form-control  <?php if($errors->has('codigo_suprimentos')) echo "is-invalid" ?>">
                            @if ($errors->has('codigo_suprimentos'))
                                <span class="text-danger">
                                {{ $errors->first('codigo_suprimentos') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('unidade')) echo "text-danger" ?>">Unidade</label>
                            <input type="text" name="unidade" value="{{ isset($registro)? $registro->unidade : old('unidade') }}" class="form-control  <?php if($errors->has('unidade')) echo "is-invalid" ?>">
                            @if ($errors->has('unidade'))
                                <span class="text-danger">
                                {{ $errors->first('unidade') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('itens')) echo "text-danger" ?>">Nº de Itens</label>
                            <input type="number" name="itens" value="{{ isset($registro)? $registro->itens : old('itens') }}" class="form-control  <?php if($errors->has('itens')) echo "is-invalid" ?>">
                            @if ($errors->has('itens'))
                                <span class="text-danger">
                                {{ $errors->first('itens') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('tipo_especificacao_id')) echo "text-danger" ?>">Tipo de Especificação</label>
                            
                            {{Form::select('tipo_especificacao_id', $tipo_especificacaos, (isset($registro)? $registro->tipo_especificacao_id : old('tipo_especificacao_id')), [
                                'placeholder' => 'Selecione',
                                'class' => ($errors->has('tipo_especificacao_id'))? "form-control select2 is-invalid":"form-control select2"
                            ])}}
                            @if ($errors->has('tipo_especificacao_id'))
                                <span class="text-danger">
                                {{ $errors->first('tipo_especificacao_id') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('data_revisao')) echo "text-danger" ?>">Data da Revisão</label>
                            <input data-mask="00/00/0000" type="text" name="data_revisao" value="{{ isset($registro)? App\Biblioteca::dateTostr($registro->data_revisao) : old('data_revisao') }}" class="form-control  <?php if($errors->has('data_revisao')) echo "is-invalid" ?>">
                            @if ($errors->has('data_revisao'))
                                <span class="text-danger">
                                {{ $errors->first('data_revisao') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('codigo_catmat')) echo "text-danger" ?>">Código CATMAT</label>
                            <input type="text" name="codigo_catmat" value="{{ isset($registro)? $registro->codigo_catmat : old('codigo_catmat') }}" class="form-control  <?php if($errors->has('codigo_catmat')) echo "is-invalid" ?>">
                            @if ($errors->has('codigo_catmat'))
                                <span class="text-danger">
                                {{ $errors->first('codigo_catmat') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('combinacao')) echo "text-danger" ?>">Combinação</label>
                            <input type="text" name="combinacao" value="{{ isset($registro)? $registro->combinacao : old('combinacao') }}" class="form-control  <?php if($errors->has('combinacao')) echo "is-invalid" ?>">
                            @if ($errors->has('combinacao'))
                                <span class="text-danger">
                                {{ $errors->first('combinacao') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('ativo')) echo "text-danger" ?>">Ativo?</label>
                            {{Form::select('ativo', [1=>'Sim', 0=>'Não'], (isset($registro)? $registro->ativo : old('ativo')), [
                                'class' => ($errors->has('ativo'))? "form-control select2 is-invalid":"form-control select2"
                            ])}}
                            
                            @if ($errors->has('ativo'))
                                <span class="text-danger">
                                {{ $errors->first('ativo') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('revisao')) echo "text-danger" ?>">Revisão</label>
                            {{Form::select('revisao', [1=>'Sim', 0=>'Não'], (isset($registro)? $registro->revisao : old('revisao')), [
                                'placeholder' => 'Selecione',
                                'class' => ($errors->has('revisao'))? "form-control select2 is-invalid":"form-control select2"
                            ])}}
                            
                            @if ($errors->has('revisao'))
                                <span class="text-danger">
                                {{ $errors->first('revisao') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('itens_revisados')) echo "text-danger" ?>">Nº Itens Revisados</label>
                            <input type="number" name="itens_revisados" value="{{ isset($registro)? $registro->itens_revisados : old('itens_revisados') }}" class="form-control  <?php if($errors->has('itens_revisados')) echo "is-invalid" ?>">
                            @if ($errors->has('itens_revisados'))
                                <span class="text-danger">
                                {{ $errors->first('itens_revisados') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('objeto')) echo "text-danger" ?>">Objeto</label>
                            <input type="text" name="objeto" value="{{ isset($registro)? $registro->objeto : old('objeto') }}" class="form-control  <?php if($errors->has('objeto')) echo "is-invalid" ?>">
                            @if ($errors->has('objeto'))
                                <span class="text-danger">
                                {{ $errors->first('objeto') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('descritivo')) echo "text-danger" ?>">Descritivo</label>
                            <input type="text" name="descritivo" value="{{ isset($registro)? $registro->descritivo : old('descritivo') }}" class="form-control  <?php if($errors->has('descritivo')) echo "is-invalid" ?>">
                            @if ($errors->has('descritivo'))
                                <span class="text-danger">
                                {{ $errors->first('descritivo') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('transferido')) echo "text-danger" ?>">Transf. Supri</label>
                            {{Form::select('transferido', [1=>'Sim', 0=>'Não'], (isset($registro)? $registro->transferido : old('transferido')), [
                                'placeholder' => 'Selecione',
                                'class' => ($errors->has('transferido'))? "form-control select2 is-invalid":"form-control select2"
                            ])}}
                            
                            @if ($errors->has('transferido'))
                                <span class="text-danger">
                                {{ $errors->first('transferido') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('identificacao')) echo "text-danger" ?>">Identificação</label>
                            <input type="text" name="identificacao" value="{{ isset($registro)? $registro->identificacao : old('identificacao') }}" class="form-control  <?php if($errors->has('identificacao')) echo "is-invalid" ?>">
                            @if ($errors->has('identificacao'))
                                <span class="text-danger">
                                {{ $errors->first('identificacao') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('numero_supri')) echo "text-danger" ?>">Nº SUPRI</label>
                            <input type="text" data-mask="000000-0" name="numero_supri" value="{{ isset($registro)? $registro->numero_supri : old('numero_supri') }}" class="form-control  <?php if($errors->has('numero_supri')) echo "is-invalid" ?>">
                            @if ($errors->has('numero_supri'))
                                <span class="text-danger">
                                {{ $errors->first('numero_supri') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('codigo_bec')) echo "text-danger" ?>">Código BEC</label>
                            <input type="text" name="codigo_bec" value="{{ isset($registro)? $registro->codigo_bec : old('codigo_bec') }}" class="form-control  <?php if($errors->has('codigo_bec')) echo "is-invalid" ?>">
                            @if ($errors->has('codigo_bec'))
                                <span class="text-danger">
                                {{ $errors->first('codigo_bec') }}
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('obs')) echo "text-danger" ?>">Observação</label>
                            <textarea type="text" name="obs" class="form-control  <?php if($errors->has('obs')) echo "is-invalid" ?>">{{ isset($registro)? $registro->obs : old('obs') }}</textarea>
                            @if ($errors->has('obs'))
                                <span class="text-danger">
                                {{ $errors->first('obs') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('arquivo_caminho')) echo "text-danger" ?>">Arquivo</label>
                            <br>
                            <input style="display: inline" id="arquivo_caminho" type="text" name="arquivo_caminho" value="{{ isset($registro)? $registro->arquivo_caminho : old('arquivo_caminho') }}" class="form-control col-md-10  <?php if($errors->has('arquivo_caminho')) echo "is-invalid" ?>">
                            @if ($errors->has('arquivo_caminho'))
                                <span class="text-danger">
                                {{ $errors->first('arquivo_caminho') }}
                                </span>
                            @endif

                            <button style="display: inline" class="btn btn-warning" type="button" onclick="copiarParaClipboard('arquivo_caminho')">Copiar</button>
                        </div>
                    </div>



                    <br>
                    <div class="row">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready( function () {
        $('#tabela_registros').DataTable();
    } );

</script>
@endsection