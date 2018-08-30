@extends('layouts.app') 
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Especificações Técnicas</div>

            <div class="card-body" style="overflow: scroll">

                <a href="{{route('admin.especificacao_tecnica.novo')}}" class="btn btn-info">Novo Registro</a>

                @if(isset($_GET['inativos']))
                    <a href="{{route('admin.especificacao_tecnica.index')}}" class="btn btn-success">Exibir ativos</a>
                @else 
                    <a href="{{route('admin.especificacao_tecnica.index', ['inativos'=>true])}}" class="btn btn-primary">Exibir inativos</a>
                @endif
                <br><br>

                <table class="table table-striped datatable" id="tabela_registros">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Nome do produto</td>
                            <td>Criação</td>
                            <td>Cód. Suprimentos</td>
                            <td>Unidade</td>
                            <td>Tipo de Especificação</td>
                            <td>Revisão</td>
                            <td>Cód. CATMAT</td>
                            <td>Combinação</td>
                            <td>Ativo</td>

                            <td>Ações</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        dataTable = $('#tabela_registros').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{!! route('admin.especificacao_tecnica.datatable', ['inativos'=> isset($_GET['inativos'])]) !!}',
            language: dataTableLang,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    text: 'Copiar',
                    className: 'btn btn-warning'
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'btn btn-warning'
                }
            ],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nome_produto'},
                { data: 'data_criacao'},
                { data: 'codigo_suprimentos'},
                { data: 'unidade'},
                { data: 'tipo_especificacao'},
                {data: 'data_revisao'},
                {data:'codigo_catmat'},
                {data:'combinacao'},
                {data:'ativo'},
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            fnDrawCallback: function() {
                //inicializa todos os tooltips
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });

</script>
@endsection