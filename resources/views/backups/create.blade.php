@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fas fa-server"></i> Backup</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"> Backup</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    <form id="formemail" action="{{ route('backups.store') }}" method="post" autocomplete="off">
        <div class="card-body p-4 ">
            @include("parts/flash-message")

            @method('POST')
            @csrf
            <div class="card-header bg-light pl-0 pb-0 mb-4">
                <h4 class="text-left mt-1 ml-0"><i class="fas fa-upload"></i> Informações de backup</h4>
            </div>
            {{-- <div class="form-group row">
                <label for="basedados" class="col-sm-3 col-form-label text-left">Base de dados <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <div class="custom-file">
                        <input id="basedados" type="text" class="form-control @error('basedados') is-invalid @enderror"
                            name="basedados" value="{{ old('basedados') }}">
                    </div>
                    @error('basedados')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="usuario" class="col-sm-3 col-form-label text-left">Usuario <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario"
                        value="{{ old('usuario') }}">
                    @error('usuario')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="senha" class="col-sm-3 col-form-label text-left">Senha <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="senha" type="password" class="form-control @error('senha') is-invalid @enderror"
                        name="senha" value="{{ old('senha') }}">
                    @error('senha')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div> --}}

            <div class="form-group row">
                <label for="local" class="col-sm-3 col-form-label text-left">Local <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="local" type="text" class="form-control @error('local') is-invalid @enderror"
                        name="local" value="{{ old('local') }}" placeholder="G:\backup">
                    @error('local')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="agendamento" class="col-sm-3 col-form-label text-left">Agendamento <small class="text-secondary"><i>(Inserir hora)</i></small></label>
                <div class="col-sm-7">
                    <input id="agendamento" type="text" class="form-control @error('agendamento') is-invalid @enderror" name="agendamento"
                        value="{{ old('agendamento') }}">
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
@include('backups/scripts')
@endsection
