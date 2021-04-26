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

            @include('relatorios/relcoletas')

        </div>
    </div>

@endsection
