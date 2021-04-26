@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ url('css/pdf.css') }}">

<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fas fa-file-alt"></i> Movimento diário</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"> Movimento diário</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-body p-4 ">
        @include("parts/flash-message")
        <div class="row mb-4 pb-4 border-bottom" style="border-color: rgb(189, 188, 188)">
            <div class="col">
                <button type="button" name="" id="" class="btn btn-primary shadow-sm border border-white"><i
                        class="fa fa-print"></i> Imprimir</button>
            </div>
            <div class="col-3">
                <span class="navbar-text text-black-50">
                    Reenviar um relatório por data ->
                  </span>
            </div>
            <div class="col-3">

                <form action="{{ route('relatorios.enviarelatorio') }}" method="post" class="inline">
                    @method('POST')
                    @csrf
                    <div class="input-group mb-0">
                        <input id="datasearch" type="text" name="datarelatorio" class="form-control shadow-sm"
                            value="{{ date("d/m/Y", strtotime(now())) }}" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary shadow-sm"><i class="fab fa-telegram-plane"></i> Enviar</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

        @include('relatorios/relcoletas')

    </div>
</div>

@endsection
