@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Usuários</div>

            <div class="card-body">

                <form method="post" action="{{route('admin.usuario.minha_conta.salvar')}}"  class="form-horizontal">

                    {{-- Campo necessário para verificar que o usuário logado é o que está fazendo a alteração --}}
                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{isset($user)? $user->id : "" }}" >
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required" <?php if($errors->has('name')) echo "text-danger" ?>>Nome</label>
                            <input required type="text" name="name" value="{{ isset($user)? $user->name : old('name') }}" class="form-control  <?php if($errors->has('name')) echo "is-invalid" ?>">
                            @if ($errors->has('name'))
                                <span class="text-danger">
                                {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required <?php if($errors->has('username')) echo "text-danger" ?>">Usuário</label>
                            <input required type="text" name="username" value="{{ isset($user)? $user->username : old('username') }}" class="form-control  <?php if($errors->has('username')) echo "is-invalid" ?>">
                            @if ($errors->has('username'))
                                <span class="text-danger">
                                {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required <?php if($errors->has('email')) echo "text-danger" ?>">E-mail</label>
                            <input required type="email" name="email" value="{{ isset($user)? $user->email : old('email') }}" class="form-control   <?php if($errors->has('email')) echo "is-invalid" ?>">
                            @if ($errors->has('email'))
                                <span class="text-danger">
                                {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required <?php if($errors->has('password')) echo "text-danger" ?>">Senha</label>
                            <input type="password" name="password" class="form-control  <?php if($errors->has('password')) echo "is-invalid" ?>">
                            @if ($errors->has('password'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6 <?php if($errors) echo "has-error" ?>">
                            <label class="required <?php if($errors->has('password_confirmation')) echo "text-danger" ?>">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" class="form-control   <?php if($errors->has('password_confirmation')) echo "is-invalid" ?>">
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
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
