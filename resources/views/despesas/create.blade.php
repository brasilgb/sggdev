@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fas fa-fw fa-donate"></i> Despesas</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('despesas.index') }}">Despesas</a></li>
                            <li class="breadcrumb-item active">Adicionar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('despesas.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('despesas/search')
                </div>
            </div>
        </div>
        <form id="formdespesa" action="{{ route('despesas.store') }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('POST')
                @csrf

                <div class="form-group row">
                    <label for="vencimento" class="col-sm-3 col-form-label text-left">Data vencimento <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="data1" type="text" class="form-control" name="vencimento"
                            value="{{ old('vencimento', date('d/m/Y', strtotime(now()))) }}">
                            @error('vencimento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descritivo" class="col-sm-3 col-form-label text-left">Descritivo<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="descritivo" type="text" class="form-control" name="descritivo"
                            value="{{ old('descritivo') }}">
                        @error('descritivo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="valor" class="col-sm-3 col-form-label text-left">Valor<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="valor" type="text" class="form-control" name="valor"
                            value="{{ old('valor') }}">
                        @error('valor')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="observacao" class="col-sm-3 col-form-label text-left">Observação <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <textarea rows="3" id="observacao" type="text" class="form-control"
                            name="observacao">{{ old('observacao') }}</textarea>
                        @error('observacao')
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
                        <button id="btndespesa" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('despesas/scripts')
@endsection
