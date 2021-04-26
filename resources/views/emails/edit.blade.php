@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fas fa-at"></i> E-mail</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"> E-mail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form id="formemail" action="{{ route('emails.update', ['email' => $email->id_email]) }}" method="post" autocomplete="off">
        <div class="card-body p-4 ">
            @include("parts/flash-message")

            @method('PUT')
            @csrf

            <div class="card-header bg-light pl-0 pb-0 mb-4">
                <h4 class="text-left mt-1 ml-0"><i class="fas fa-server"></i> Configurações do servidor de envio</h4>
            </div>

            <div class="form-group row">
                <label for="smtp" class="col-sm-3 col-form-label text-left">Servidor SMTP <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <div class="custom-file">
                        <input id="smtp" type="text" class="form-control @error('smtp') is-invalid @enderror"
                            name="smtp" value="{{ old('smtp', $email->smtp) }}">
                    </div>
                    @error('smtp')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="porta" class="col-sm-3 col-form-label text-left">Porta <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="porta" type="text" class="form-control @error('porta') is-invalid @enderror" name="porta"
                        value="{{ old('porta', $email->porta) }}">
                    @error('porta')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="seguranca" class="col-sm-3 col-form-label text-left">Segurança <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="seguranca" type="text" class="form-control @error('seguranca') is-invalid @enderror"
                        name="seguranca" value="{{ old('seguranca', $email->seguranca) }}">
                    @error('seguranca')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="usuario" class="col-sm-3 col-form-label text-left">Usuário <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror"
                        name="usuario" value="{{ old('usuario', $email->usuario) }}">
                    @error('usuario')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="senha" class="col-sm-3 col-form-label text-left">Senha <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="senha" type="password" class="form-control @error('senha') is-invalid @enderror" name="senha"
                        value="{{ old('senha', $email->senha) }}">
                    @error('senha')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-header bg-light pl-0 pb-0 mb-4">
                <h4 class="text-left mt-1 ml-0"><i class="fas fa-inbox"></i> Informações do envio</h4>
            </div>

            <div class="form-group row">
                <label for="remetente" class="col-sm-3 col-form-label text-left">Remetente <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="remetente" type="text" class="form-control @error('remetente') is-invalid @enderror"
                        name="remetente" value="{{ old('remetente', $email->remetente) }}">
                    @error('remetente')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="destinatario" class="col-sm-3 col-form-label text-left">Destinatários <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <textarea rows="3" id="destinatario" type="text"
                        class="form-control @error('destinatario') is-invalid @enderror" name="destinatario">{{ old('destinatario', $email->destinatario) }}</textarea>
                    @error('destinatario')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="assunto" class="col-sm-3 col-form-label text-left">Assunto <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="assunto" type="text" class="form-control @error('assunto') is-invalid @enderror"
                        name="assunto" value="{{ old('assunto', $email->assunto) }}">
                    @error('assunto')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="mensagem" class="col-sm-3 col-form-label text-left">Mensagem <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <textarea id="mensagem" type="text" class="form-control @error('mensagem') is-invalid @enderror"
                        name="mensagem">{{ old('mensagem', $email->mensagem) }}</textarea>
                    @error('mensagem')
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
@include('emails/scripts')
@endsection
