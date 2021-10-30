@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fas fa-fw fa-users"></i> Usuários</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('usuarios.index') }}">Usuários</a></li>
                            <li class="breadcrumb-item active">Adicionar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('usuarios.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('usuarios/search')
                </div>
            </div>
        </div>
        <form id="formusuario" action="{{ route('usuarios.store') }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('POST')
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-left">Nome <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="name" type="text" class="form-control" name="name"
                            value="{{ old('name') }}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label text-left">Usuário <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="username" type="text" class="form-control" name="username"
                            value="{{ old('username') }}">
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
{{--
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-left">E-mail <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="email" type="email" class="form-control" name="email"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}

                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label text-left">Senha <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="password" type="password" class="form-control" name="password"
                            value="{{ old('password') }}">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-3 col-form-label text-left">Confirme a senha <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                            value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                @php
                    $funcao = [
                        '' => 'Selecione a função',
                        '0' => 'Administrador',
                        '1' => 'Operador'
                    ];
                @endphp
                <div class="form-group row">
                    <label for="funcao" class="col-sm-3 col-form-label text-left">Função <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <select id="funcao" type="funcao" class="custom-select" name="funcao">
                            @foreach ($funcao as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('funcao')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col pt-2">
                        <span class="text-danger">*Obrigatório</span>
                    </div>
                    <div class="col text-right">
                        <button id="btnusuario" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
   <script>
       $("#formusuario").validate({
        rules: {
            name: {
                required: true
            },
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            funcao: {
                required: true
            }
        },
        messages: {
            name: 'Digite um nome!',

            username: {
                required: 'Digite um usuario!'
            },
            password: {
                required: 'Digite a senha!',
                minlength: 'Mínimo 6 caracteres!'
            },
            password_confirmation: {
                required: 'Redigite a senha!',
                minlength: 'Mínimo 6 caracteres!',
                equalTo: "As senhas devem ser iguais!"
            },
            funcao: {
                required: 'Selecione a função'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });

   </script>
@endsection
