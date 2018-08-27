@extends('layouts.app') 
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Normas Técnicas</div>

            <div class="card-body">

                <form method="post" action="{{route('admin.norma_tecnica.salvar')}}"  class="form-horizontal">

                    {{-- Campo necessário para verificar que o norma_tecnica logado é o que está fazendo a alteração --}}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{isset($registro)? $registro->id : "" }}" >

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('nome')) echo "text-danger" ?>">Nome</label>
                            <input type="text" name="nome" value="{{ isset($registro)? $registro->nome : old('nome') }}" class="form-control  <?php if($errors->has('nome')) echo "is-invalid" ?>">
                            @if ($errors->has('nome'))
                                <span class="text-danger">
                                {{ $errors->first('nome') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('data')) echo "text-danger" ?>">Data</label>
                            <input type="text" name="data" value="{{ isset($registro)? $registro->data : old('data') }}" class="form-control  <?php if($errors->has('data')) echo "is-invalid" ?>">
                            @if ($errors->has('data'))
                                <span class="text-danger">
                                {{ $errors->first('data') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('norma')) echo "text-danger" ?>">Norma</label>
                            <input type="text" name="norma" value="{{ isset($registro)? $registro->norma : old('norma') }}" class="form-control  <?php if($errors->has('norma')) echo "is-invalid" ?>">
                            @if ($errors->has('norma'))
                                <span class="text-danger">
                                {{ $errors->first('norma') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('nbr')) echo "text-danger" ?>">NBR</label>
                            <input type="text" name="nbr" value="{{ isset($registro)? $registro->nbr : old('nbr') }}" class="form-control  <?php if($errors->has('nbr')) echo "is-invalid" ?>">
                            @if ($errors->has('nbr'))
                                <span class="text-danger">
                                {{ $errors->first('nbr') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('palachave')) echo "text-danger" ?>">Palachave</label>
                            <input type="text" name="palachave" value="{{ isset($registro)? $registro->palachave : old('palachave') }}" class="form-control  <?php if($errors->has('palachave')) echo "is-invalid" ?>">
                            @if ($errors->has('palachave'))
                                <span class="text-danger">
                                {{ $errors->first('palachave') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="<?php if($errors->has('paginas')) echo "text-danger" ?>">Páginas</label>
                            <input type="text" name="paginas" value="{{ isset($registro)? $registro->paginas : old('paginas') }}" class="form-control  <?php if($errors->has('paginas')) echo "is-invalid" ?>">
                            @if ($errors->has('paginas'))
                                <span class="text-danger">
                                {{ $errors->first('paginas') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                    </div>
                </form>
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