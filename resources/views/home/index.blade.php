@extends('layouts.app')

@section('content')

<script>
    jQuery(window).on('load', function($){
        atualizaRelogio();
    });
</script>
{{-- KPI Tabelas --}}
<div class="row">
    <div class="col-12">
        @include("parts/flash-message")
    </div>
</div>
@if ($segmento)
<div class="bg-gray-200 mb-3 p-2 shadow-sm border border-white rounded">
    <div class="row">
        <div class="col">
            <h3 style="font: bold 1rem Sans-serif; text-shadow: 1px 1px #ffffff;"
                class="text-black-50 text-uppercase pt-2 text-left"><i class="fa fa-chart-line"></i> SGGA - Sistema de
                Gerenciamento de Granjas Aviárias - Segmento
                @if($segmento->segmento == 1)
                Frangos
                @else
                Perus
                @endif
            </h3>
        </div>
        <div class="col-2 border-left">
            <div style="font: bold 1rem Sans-serif; text-shadow: 1px 1px #ffffff;" class="text-black-50 text-uppercase pt-2 text-left">
                <span id="data"></span>
                <span id="hora"></span>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-cyan shadow-sm border border-white rounded">
            <div class="inner">
                <h3>{{ !$lotes? '0' :$lotes->count() }}</h3>

                <p>Lotes</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('lotes.index') }}" class="small-box-footer">
                Acessar lotes <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green shadow-sm border border-white rounded">
            <div class="inner">
                <h3>{{ !$aviarios? '0' :$aviarios->count() }}</h3>

                <p>Aviários</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('aviarios.index') }}" class="small-box-footer">
                Acessar aviários <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow shadow-sm border border-white rounded">
            <div class="inner">
                <h3>{{ !$mortalidades? '0' :$mortalidades->where('data_mortalidade',date("Y-m-d", strtotime(\Carbon\Carbon::now())))->sum('tot_ave') }}</h3>

                <p>Mortalidade dia</p>
            </div>
            <div class="icon">
                <i class="fa fa-sort-amount-down-alt"></i>
            </div>
            <a href="{{ route('mortalidades.index') }}" class="small-box-footer">
                Acessar mortalidade <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red shadow-sm border border-white rounded">
            <div class="inner">
                <h3>{{ !$consumos? '0' :$consumos->where('data_consumo', date("Y-m-d", strtotime(\Carbon\Carbon::now())))->sum('femea') + $consumos->where('data_coleta', date("Y-m-d", strtotime(\Carbon\Carbon::now())))->sum('macho') }}
                    <small>Kg</small></h3>

                <p>Consumo ração dia</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-leaf"></i>
            </div>
            <a href="{{ route('consumos.index') }}" class="small-box-footer">
                Acessar consumo <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red shadow-sm border border-white rounded">
                <div class="inner pb-0">
                    <h4 style="margin-bottom: 0.8rem">
                        CO: {{ !$coletas? 0 :$coletas->where('data_coleta', date("Y-m-d", strtotime(\Carbon\Carbon::now())))->sum->comerciais }}<br>
                        &nbsp;IN: {{ !$coletas? 0 :$coletas->where('data_coleta', date("Y-m-d", strtotime(\Carbon\Carbon::now())))->sum->incubaveis }}<br>
                        TO: {{ !$coletas? 0 :$coletas->where('data_coleta', date("Y-m-d", strtotime(\Carbon\Carbon::now())))->sum->postura_dia }}
                    </h4>
                </div>
            <div class="icon">
                <i class="fa fa-cart-plus"></i>
            </div>
            <a href="{{ route('coletas.index') }}" class="small-box-footer">
                Acessar coletas <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow shadow-sm border border-white rounded">
            <div class="inner pb-0">
                <h4 style="margin-bottom: 0.8rem">
                    CO: {{ !$estoqueovos? 0 :$estoqueovos->sum->comerciais }}<br>
                    &nbsp;IN: {{ !$estoqueovos? '0' :$estoqueovos->sum->incubaveis }}<br>
                    TO: {{ !$estoqueovos? 0 :$estoqueovos->sum->comerciais + $estoqueovos->sum->incubaveis }}
                </h4>
            </div>
            <div class="icon">
                <i class="fa fa-egg"></i>
            </div>
            <a href="{{ route('aviarios.index') }}" class="small-box-footer">
                Estoque de ovos <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green shadow-sm border border-white rounded">
            <div class="inner pb-0">
                <h4 style="margin-bottom: 0.8rem">
                    &nbsp;FÊ: {{ !$estoqueaves? 0 :$estoqueaves->sum->femea }}<br>
                    MA: {{ !$estoqueaves? 0 :$estoqueaves->sum->macho }}<br>
                    &nbsp;TO: {{ !$estoqueaves? 0 :$estoqueaves->sum->femea + $estoqueaves->sum->macho }}<br>
                </h4>
            </div>
            <div class="icon">
                <i class="fa fa-kiwi-bird"></i>
            </div>
            <a href="{{ route('mortalidades.index') }}" class="small-box-footer">
                Estoque de aves <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-cyan shadow-sm border border-white rounded">
            <div class="inner">
                <h3> {{ $tarefas > 0 ? $tarefas->count() : 0 }}</h3>
                <p>Tarefas abetas</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-tasks"></i>
            </div>
            <a href="{{ route('geraltarefas.index') }}" class="small-box-footer">
                Acessar tarefas <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
</div>

{{-- KPI estoque --}}
<div class="row mt-0">

    <div class="col-3">
        <div class="pt-2 bg-orange rounded shadow-sm border border-white">

            <div class="p-2 text-center">
                <form action="{{ route('relatorios.enviarelatorio') }}" method="post" class="inline">
                    @method('POST')

                    @csrf
                    <input type="hidden" name="datarelatorio" value="{{ date('d/m/Y', strtotime(now())) }}">
                    <button @if($coletas->count() == 0) disabled @endif type="submit" class="btn btn-app btn-light shadow-sm border border-white"><i
                            class="fa fa-file-alt"></i>Enviar Relatório</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="pt-2 bg-teal rounded shadow-sm border border-white">

            <div class="p-2 text-center">
                <form action="{{ route('backups.gerabackup') }}" method="get" class="inline">
                    @method('PUT')
                    @csrf
                    <button @if(!$backup) disabled @endif type="submit" class="btn btn-app btn-light shadow-sm border border-white"><i
                            class="fa fa-database"></i>Gerar backup</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="pt-2 bg-pink rounded shadow-sm border border-white">

            <div class="p-2 text-center">
                <form action="{{ route('coletas.index') }}" method="get" class="inline">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-app btn-light shadow-sm border border-white"><i
                            class="fa fa-cart-plus"></i>Efetuar coleta</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="pt-2 bg-indigo rounded shadow-sm border border-white">

            <div class="p-2 text-center">
                <form action="{{ route('envios.index') }}" method="get" class="inline">
                    @method('PUT')
                    @csrf
                    <button @if(!$coletas) disabled @endif type="submit" class="btn btn-app btn-light shadow-sm border border-white"><i
                            class="fa fa-truck"></i>Enviar ovos</button>
                </form>
            </div>
        </div>
    </div>

</div>

{{-- KPI produção --}}
<div class="row mt-3">

    <div class="col">
        <div class="bg-white rounded shadow-sm border border-gray-500">
            <div class="">
                <p class="text-center pt-2"><span class="text-teal">Semana</span> / <span class="text-indigo">Meta</span></p>
                <h1 class="text-center m-0 px-2 py-4 text-secundary font-weight-bold" style="font-size: 2.65rem;">
                    <span class="text-teal">{{ empty($semanaatual->semana)? '0' : $semanaatual->semana}}</span>
                    /
                    <span class="text-indigo">{{ empty($semanaatual->producao)? '0' : $semanaatual->producao}}<small style="font-size: 14px">%</small></span>
                </h1>
            </div>

            <div class=" '00/00/0000' ">
                <p class="text-center m-0 py-2 text-secundary font-weight-bold text-black-50">&nbsp;&nbsp;&nbsp;&nbsp;
                   Início:
                    {{ empty($semanaatual->semana) ? '00/00/0000' :  date('d/m/Y', strtotime($semanaatual->data_inicial)) }} <br>
                    Término:
                    {{ empty($semanaatual->semana) ? '00/00/0000' : date('d/m/Y', strtotime($semanaatual->data_final)) }} </p>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="bg-white rounded shadow-sm border border-gray-500 p-1">
            <div id="container-media" class="chart-container" style="height: 200px;"></div>
        </div>

    </div>

    <div class="col">
        <div class="bg-white rounded shadow-sm border border-gray-500 p-1">
            <div id="container-meta" class="chart-container" style="height: 200px;"></div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col mt-3">
        @if ($capitalizadas > 1 and $coletas->count() > 0 )
        <div class="rounded shadow-sm border border-gray-500" id="container" style="width:100%; height:400px;">
        </div>
        @else
        <div class="alert alert-info shadow-sm border border-white"><i
                class="fa fa-exclamation-triangle text-danger"></i> Para gerar gráfico, os lotes devem estar capitalizados, assim como as metas de produção e coletas cadastradas.</div>
        @endif

    </div>
</div>

@else
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card w-25 shadow-sm p-4 text-center border border-gray-500" style="margin-top: 20%;">
            <div class="row">
                <div class="col">
                    <div class="" style="margin-top: 10%">
                        Para prosseguir será necessário preencher os dados de sua empresa corretamente.
                    </div>
                    <div class="text-center" style="margin-top: 10%">
                        <a class="btn btn-primary rounded border border-white shadow"
                            href="{{ route('empresas.index') }}">
                            Prosseguir <i class="fa fa-angle-double-right"></i></a></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
