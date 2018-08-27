@extends('layouts.app') 
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Especificações Técnicas</div>

            <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('admin.especificacao_tecnica.upload')}}">
                    {{-- Campo necessário para verificar que o cargo logado é o que está fazendo a alteração --}}
                    {{ csrf_field() }}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p>Carregue um arquivo .xml no campo abaixo para importar os dados para o sistema:</p>
                    <input type="file" name="arquivo" class="form-control">

                    <br>
                    <button type="submit" class="btn btn-info">Importar</button>
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