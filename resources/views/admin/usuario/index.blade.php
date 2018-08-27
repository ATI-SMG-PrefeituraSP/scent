@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Usuários</div>

                <div class="card-body">
                    
                    <a href="{{route('admin.usuario.novo')}}" class="btn btn-info" >Novo Registro</a>
                    <br><br>

                    <table class="table table-striped datatable" id="tabela_registros">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Login</td>
                                <td>Nome</td>
                                <td>E-mail</td>

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
                ajax: '{!! route('admin.usuario.datatable') !!}',
                language: dataTableLang,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'username', name: 'username' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
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
