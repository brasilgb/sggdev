@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header pb-0 border-bottom border-white">
        <div class="row">
            <div class="col">
                <h4 class="text-left text-body mt-1"><i class="fa fa-cart-plus"></i> Coletas</h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"> <a href="{{ route('coletas.index') }}">Coletas</a></li>
                        <li class="breadcrumb-item active">Adicionar</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-header mb-2">
        <div class="row">
            <div class="col text-left">
                <button onclick="window.location='{{ route('coletas.index') }}'"
                    class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
            </div>

            <div class="col">
                @include('coletas/search')
            </div>
        </div>
    </div>
    <div class="card-body">
        @include("parts/flash-message")
        @if ($segmento->segmento == 1)
        @include('coletas/frangos/edit-frangos')
        @else
        @include('coletas/perus/edit-perus')
        @endif

    </div>
</div>
@if ($segmento->segmento == 1)
@include('coletas/frangos/scripts')
@else
@include('coletas/perus/scripts')
@endif

@endsection
