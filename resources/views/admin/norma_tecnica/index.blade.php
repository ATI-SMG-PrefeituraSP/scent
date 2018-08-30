@extends('layouts.app') 
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Normas Técnicas</div>

            <div class="card-body">

                <a href="{{route('admin.norma_tecnica.novo')}}" class="btn btn-info">Novo Registro</a>
                <br><br>

                <table class="table table-striped datatable" id="tabela_registros">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Nome</td>
                            <td>Data</td>
                            <td>Norma</td>
                            <td>NBR</td>
                            <td>Palachave</td>
                            <td>Páginas</td>

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
            ajax: '{!! route('admin.norma_tecnica.datatable') !!}',
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
                { data: 'nome'},
                { data: 'data'},
                { data: 'norma'},
                { data: 'nbr'},
                { data: 'palachave'},
                { data: 'paginas'},
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