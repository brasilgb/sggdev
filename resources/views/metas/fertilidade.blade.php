@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white" style="background-color: #062142;">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fas fa-kiwi-bird"></i> Fertilidade <span class="badge badge-warning"><small>{{ $semanas->count() }} Semanas</small></span></h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"> Fertilidade</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <div class="d-flex align-content-start flex-wrap">
                @foreach ($semanas as $producao)
                <div class="w-25">
                    <div class="bg-gray-400 m-1 p-2 shadow-sm rounded-lg text-gray-200" style="border:2px solid #fff;">
                    <div>Semana: <span class="badge badge-primary">{{ $producao->semana }}</span></div>
                    <div>{{ date("d/m/Y", strtotime($producao->data_inicial)) }} à {{ date("d/m/Y", strtotime($producao->data_final)) }}</div>
                    <div class=""><input class="form-control" type="text" value="{{ $producao->producao }}"></div>
                </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
