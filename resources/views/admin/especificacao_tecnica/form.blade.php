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
                                'required' => true,
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
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="<?php if($errors->has('arquivo_caminho')) echo "text-danger" ?>">Arquivo</label>
                            <input type="text" name="arquivo_caminho" value="{{ isset($registro)? $registro->arquivo_caminho : old('arquivo_caminho') }}" class="form-control col-md-6  <?php if($errors->has('arquivo_caminho')) echo "is-invalid" ?>">
                            @if ($errors->has('arquivo_caminho'))
                                <span class="text-danger">
                                {{ $errors->first('arquivo_caminho') }}
                                </span>
                            @endif
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