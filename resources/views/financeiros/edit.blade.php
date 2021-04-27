@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fas fa-coins"></i> Financeiros</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"> Financeiros</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form id="formfinanceiro" action="{{ route('financeiros.update', ['financeiro' => $financeiro->id_financeiro]) }}" method="post" autocomplete="off">
        <div class="card-body p-4 ">
            @include("parts/flash-message")

            @method('PUT')
            @csrf
            <div class="card-header bg-light pl-0 pb-0 mb-4">
                <h4 class="text-left mt-1 ml-0"><i class="fas fa-egg"></i> Ovos</h4>
            </div>

            <div class="form-group row">
                <label for="basedados" class="col-sm-3 col-form-label text-left">Valor unitário <span
                        class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <div class="custom-file">
                        <input id="valor_ovo" type="text" class="form-control @error('valor_ovo') is-invalid @enderror"
                            name="valor_ovo" value="{{ old('valor_ovo', $financeiro->valor_ovo) }}">
                    </div>
                    @error('valor_ovo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
        </div>
    </form>
</div>
@include('financeiros/scripts')
@endsection
