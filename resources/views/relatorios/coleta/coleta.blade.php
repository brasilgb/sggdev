@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fas fa-file-alt"></i> Coletas</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"> Coletas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-body p-4 ">
        @include("parts/flash-message")
        <div class="row mb-4 pb-4 border-bottom" style="border-color: rgb(189, 188, 188)">
            <div class="col-3">

                <form action="{{ route('relatorios.pdfcoleta') }}" method="post" class="inline" target="_blank">
                    @method('POST')
                    @csrf
                    <div class="input-group mb-0">
                        <input id="data1" type="text" name="datarelatorio" class="form-control shadow-sm"
                            value="{{ date('d/m/Y', strtotime(now())) }}" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary shadow-sm"><i class="fa fa-print"></i>
                                Imprimir</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-9">
                <span class="navbar-text text-black-50">
                    <- Imprime e/ou visualiza o relatório por data </span> </div> </div>
                    @if($coletas->count() > 0)
                        @if ($segmento->segmento == 1)
                        @include('relatorios/coleta/frangos/relcoleta')
                        @else
                        @include('relatorios/coleta/perus/relcoleta')
                        @endif
                    @else
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> Não há dados a serem mostrados!
                        </div>
                    @endif
            </div>
        </div>

        @endsection
