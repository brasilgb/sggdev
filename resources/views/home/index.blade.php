@extends('layouts.app')

@section('content')
<script src="{{ asset('js/highcharts.js') }}"></script>
<script src="{{ asset('js/exporting.js') }}"></script>
<script src="{{ asset('js/export-data.js') }}"></script>
<script src="{{ asset('js/accessibility.js') }}"></script>
{{-- KPI Tabelas --}}
<div class="row">
    <div class="col-12">
        @include("parts/flash-message")
    </div>
</div>
@if ($segmento->segmento > 0)
<div class="row">
    <div class="col-12">
        <div class="p-2 mb-2 bg-gray-200 border border-white rounded shadow-sm">
            <h3 style="font: bold 1rem Sans-serif; text-shadow: 1px 1px #ffffff;" class="text-black-50 text-uppercase pt-2 text-center"><i class="fa fa-kiwi-bird"></i> SGGA - Sistema de Gerenciamento de Granjas Aviárias - Segmento
                @if ($segmento->segmento == 1)
                Frangos
                @else
                Perus
                @endif
            </h3>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-cyan shadow-sm border border-white rounded">
            <div class="inner">
                <h3>{{ $lotes->count() }}</h3>

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
                <h3>{{ $aviarios->count() }}</h3>

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
                <h3>{{ $mortalidades->where('data_coleta', \Carbon\Carbon::now())->sum('tot_ave') }}</h3>

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
                <h3>{{ $consumos->where('data_coleta', \Carbon\Carbon::now())->sum('femea') + $consumos->where('data_coleta', \Carbon\Carbon::now())->sum('macho') }}
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
            <div class="inner">
                <h3>{{ $coletas->where('data_coleta', \Carbon\Carbon::now())->sum('postura_dia') }}</h3>

                <p>Coleta do dia</p>
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
                    CO: {{ $estoqueovos->sum->comerciais }}<br>
                    &nbsp;IN: {{ $estoqueovos->sum->incubaveis }}<br>
                    TO: {{ $estoqueovos->sum->comerciais + $estoqueovos->sum->incubaveis }}
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
                    &nbsp;FÊ: {{ $estoqueaves->sum->femea }}<br>
                    MA: {{ $estoqueaves->sum->macho }}<br>
                    &nbsp;TO: {{ $estoqueaves->sum->femea + $estoqueaves->sum->macho }}<br>
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
                <h3> {{ $tarefas->count() }}</h3>
                <p>Tarefas abetas</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-tasks"></i>
            </div>
            <a href="{{ route('consumos.index') }}" class="small-box-footer">
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
                    <button type="submit" class="btn btn-app btn-light shadow-sm border border-white"><i
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
                    <button type="submit" class="btn btn-app btn-light shadow-sm border border-white"><i
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
                    <button type="submit" class="btn btn-app btn-light shadow-sm border border-white"><i
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
                <p class="text-center m-0 px-2 py-4 text-secundary font-weight-bold">
                    Semana:{{ $semanaatual->semana }}</p>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="bg-white rounded shadow-sm border border-gray-500">
            <div class="">
                <p class="text-center m-0 px-2 py-4 text-secundary font-weight-bold">De
                    {{ date('d/m/Y', strtotime($semanaatual->data_inicial)) }} à
                    {{ date('d/m/Y', strtotime($semanaatual->data_final)) }} </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="bg-white rounded shadow-sm border border-gray-500">
            <div class="">
                <p class="text-center m-0 px-2 py-4 text-secundary font-weight-bold">Meta:
                    {{ $semanaatual->producao }}% / Parcial: @if ($capitalizadas > 1) {{ $alcancada . '%' }} @else <i
                        class="fa fa-exclamation-triangle text-danger"></i> @endif
                </p>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="bg-white rounded shadow-sm border border-gray-500">
            <div class="">
                <p class="text-center m-0 px-2 py-4 text-secundary font-weight-bold">Média: @if ($capitalizadas > 1)
                    {{ $media . '%' }} @else <i class="fa fa-exclamation-triangle text-danger"></i> @endif
                </p>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col mt-3">
        @if ($capitalizadas > 1)
        <div class="rounded shadow-sm border border-gray-500" id="container" style="width:100%; height:400px;">
        </div>
        @else
        <div class="alert alert-info shadow-sm border border-white"><i
                class="fa fa-exclamation-triangle text-danger"></i> Capitalizar lotes para gerar gráfico.</div>
        @endif

    </div>
</div>

<script>
    // Gráfico produção semanal
        var producaosemana = <?php echo json_encode($producaosemana,
        JSON_NUMERIC_CHECK); ?>;    var datasemana = <?php echo json_encode($datasemana); ?>;    Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Produção da Semana'
            },
            subtitle: {
                text: 'Comparativo diário de produção semanal'
            },
            xAxis: {
                categories: datasemana
            },
            yAxis: {
                title: {
                    text: 'Produção %'
                },
                labels: {
                    format: '{value:f}'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: '% Produção geral por dia da Semana',
                data: producaosemana
            }]
        });

        // Gráfico Média semanal *********************************************************

</script>
@else
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card w-75 shadow-sm p-4 text-center border border-gray-500" style="margin-top: 20%;">
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
                <div class="col frango-img">

                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
