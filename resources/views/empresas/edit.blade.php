@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fas fa-building"></i> Empresa</h4>
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
    <form id="formempresa" action="{{ route('empresas.update', ['empresa' => $empresa->id_empresa]) }}" method="post"
        autocomplete="off" enctype="multipart/form-data">
        <div class="card-body p-4 ">

            @include("parts/flash-message")

            @method('PUT')
            @csrf
            <div class="card-header bg-light pl-0 pb-0 mb-4">
                <h4 class="text-left mt-1 ml-0"><i class="fas fa-industry"></i> Informações da empresa</h4>
            </div>

            <div class="form-group row">
                <div class="col-sm-3 text-left"></div>
                <div class="col-sm-7">
                    @if ($empresa->logotipo)
                    <img id="thumbnail" value="{{ $empresa->logotipo }}" class="thumbnail"
                        src="{{ asset("storage/thumbnail/{$empresa->logotipo}")}}" alt="{{ $empresa->empresa }}">
                    <a class="text-danger font-weight-bold text-jg" id="delimagem" href="#"
                        value="{{ $empresa->id_empresa }}" title="Excluir imagem">&times;</a>
                    @else
                    <img height="80" id="thumbnail" value="{{ $empresa->logotipo }}" class="thumbnail"
                        src="{{ asset("storage/empresa/sggaicon.png")}}" alt="">
                    @endif


                    <input type="hidden" name="logotipodb" value="{{ $empresa->logotipo }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="logotipo" class="col-sm-3 col-form-label text-left">Logotipo <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <div class="custom-file">
                        <input id="logotipo" type="file"
                            class="custom-file-input @error('logotipo') is-invalid @enderror" name="logotipo"
                            value="{{ old('logotipo', $empresa->logotipo) }}">
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
                    <input id="cnpj" type="text" class="form-control @error('cnpj') is-invalid @enderror" name="cnpj"
                        value="{{ old('cnpj', $empresa->cnpj) }}">
                    @error('cnpj')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="razao_social" class="col-sm-3 col-form-label text-left">Razão social <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="razao_social" type="text"
                        class="form-control @error('razao_social') is-invalid @enderror" name="razao_social"
                        value="{{ old('razao_social', $empresa->razao_social) }}">
                    @error('razao_social')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="segmento" class="col-sm-3 col-form-label text-left">Segmento <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <div class="form-check form-check-inline">
                        <input name="segmento" class="form-check-input" type="radio"
                            id="inlineRadio1" value="1" {{(old('segmento', $empresa->segmento) == '1') ? 'checked' : ''}}>
                        <label class="form-check-label" for="inlineRadio1">Frangos</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="segmento" class="form-check-input" type="radio"
                            id="inlineRadio2" value="2" {{(old('segmento', $empresa->segmento) == '2') ? 'checked' : ''}}>
                        <label class="form-check-label" for="inlineRadio2">Perus</label>
                    </div>
                    @error('segmento')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="endereco" class="col-sm-3 col-form-label text-left">Endereço <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="endereco" type="text" class="form-control @error('endereco') is-invalid @enderror"
                        name="endereco" value="{{ old('endereco', $empresa->endereco) }}">
                    @error('endereco')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="cidade" class="col-sm-3 col-form-label text-left">Cidade <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="cidade" type="text" class="form-control @error('cidade') is-invalid @enderror"
                        name="cidade" value="{{ old('cidade', $empresa->cidade) }}">
                    @error('cidade')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="uf" class="col-sm-3 col-form-label text-left">UF <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="uf" type="text" class="form-control @error('uf') is-invalid @enderror" name="uf"
                        value="{{ old('uf', $empresa->uf) }}">
                    @error('uf')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="telefone" class="col-sm-3 col-form-label text-left">Telefone <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="telefone" type="text" class="form-control @error('telefone') is-invalid @enderror"
                        name="telefone" value="{{ old('telefone', $empresa->telefone) }}">
                    @error('telefone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="celular" class="col-sm-3 col-form-label text-left">Celular <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror"
                        name="celular" value="{{ old('celular', $empresa->celular) }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label text-left">E-mail <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email', $empresa->email) }}">
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
@include('empresas/scripts')
<script>
    $(function(){
            $("#delimagem").click(function(e){
                e.preventDefault();
                idempresa = $(this).attr('value');
                thumbnail = $("#thumbnail").attr('value');
                $.ajax({
                    type: "POST",
                    url: "{{ route('empresas.delimagem') }}",
                    data:{
                        _token: "{{ csrf_token() }}",
                        idempresa: idempresa,
                        thumbnail: thumbnail
                        }
                }).done(function(Response){
                    location.reload();
                });
            })
        });
</script>
@endsection
