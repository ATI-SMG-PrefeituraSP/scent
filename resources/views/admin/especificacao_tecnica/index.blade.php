@extends('layouts.app') 
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Especificações Técnicas</div>

            <div class="card-body">

                <a href="{{route('admin.especificacao_tecnica.novo')}}" class="btn btn-info">Novo Registro</a>
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
                            <td>Arquivo</td>

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
            ajax: '{!! route('admin.especificacao_tecnica.datatable') !!}',
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
                {data:'arquivo_caminho'},
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