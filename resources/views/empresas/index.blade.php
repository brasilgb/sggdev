@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white" style="background-color: #062142;">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fas fa-building"></i> Empresa</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"> Empresa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form id="formlote" action="{{ route('empresas.create') }}" method="post" autocomplete="off"
            enctype="multipart/form-data">
            <div class="card-body p-4 ">

                @method('POST')
                @csrf

                <div class="form-group row">
                    <label for="logotipo" class="col-sm-3 col-form-label text-left">Logotipo <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <div class="custom-file">
                            <input id="logotipo" type="file" class="custom-file-input form-control-file" name="logotipo">
                            <label class="custom-file-label" for="logotipo">Selecione a imagem</label>
                        </div>

                        @error('logotipo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cnpj" class="col-sm-3 col-form-label text-left">CNPJ <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="cnpj" type="text" class="form-control" name="cnpj" value="{{ old('cnpj') }}">
                        @error('cnpj')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="razao_social" class="col-sm-3 col-form-label text-left">Razão social <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="razao_social" type="text" class="form-control" name="aviario"
                            value="{{ old('razao_social') }}">
                        @error('razao_social')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="endereco" class="col-sm-3 col-form-label text-left">Endereço <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="endereco" type="text" class="form-control" name="endereco"
                            value="{{ old('endereco') }}">
                        @error('endereco')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cidade" class="col-sm-3 col-form-label text-left">Cidade <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="cidade" type="text" class="form-control" name="cidade" value="{{ old('cidade') }}">
                        @error('cidade')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="uf" class="col-sm-3 col-form-label text-left">UF <span class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="uf" type="text" class="form-control" name="uf" value="{{ old('uf') }}">
                        @error('uf')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telefone" class="col-sm-3 col-form-label text-left">Telefone <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="telefone" type="text" class="form-control" name="telefone"
                            value="{{ old('telefone') }}">
                        @error('telefone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-left">E-mail <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                        @error('email')
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
                        <button id="btnaviario" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>

        $(document).ready(function() {
            $('.custom-file-input').on('change', function(e) {
                e.target.nextElementSibling.innerHTML = e.target.files[0].name;
            });
        });

    </script>
@endsection
