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
                        <i class="fa fa-memory"></i>
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
                        <h3>{{ $consumos->where('data_coleta', \Carbon\Carbon::now())->sum('femea') + $consumos->where('data_coleta', \Carbon\Carbon::now())->sum('macho') }} <small>Kg</small></h3>

                        <p>Consumo ração</p>
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
        @if ($segmento->segmento > 0)
            <div class="col">
                <div class=" pt-2 bg-blue rounded shadow-sm border border-white">
                    <div class="">
                        <h5
                            class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                            Lotes</h5>
                    </div>
                    <div class="py-2 px-4">
                        <h1 class="text-light font-weight-bold">{{ $lotes->count() }}</h1>
                    </div>
                    <p class="border-top border-white text-white p-2 m-0 text-center"><a class="text-white"
                            href="{{ route('lotes.index') }}">Acessar lotes</a> <i
                            class="fa fa-arrow-alt-circle-right"></i>
                    </p>
                </div>
            </div>

            <div class="col">
                <div class=" pt-2 bg-orange rounded shadow-sm border border-white">
                    <div class="">
                        <h5
                            class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                            Aviários</h5>
                    </div>
                    <div class="py-2 px-4">
                        <h1 class="text-light font-weight-bold">{{ $aviarios->count() }}</h1>
                    </div>
                    <p class="border-top border-white text-white p-2 m-0 text-center"><a class="text-white"
                            href="{{ route('aviarios.index') }}">Acessar aviários</a> <i
                            class="fa fa-arrow-alt-circle-right"></i></p>
                </div>
            </div>

            <div class="col">
                <div class=" pt-2 bg-indigo rounded shadow-sm border border-white">
                    <div class="">
                        <h5
                            class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                            Coleta Dia</h5>
                    </div>
                    <div class="py-2 px-4">
                        <h1 class="text-light font-weight-bold">
                            {{ $coletas->where('data_coleta', \Carbon\Carbon::now())->sum('postura_dia') }}</h1>
                    </div>
                    <p class="border-top border-white text-white p-2 m-0 text-center"><a class="text-white"
                            href="{{ route('coletas.index') }}">Acessar coletas</a> <i
                            class="fa fa-arrow-alt-circle-right"></i>
                    </p>
                </div>
            </div>

            <div class="col">
                <div class=" pt-2 bg-red rounded shadow-sm border border-white">
                    <div class="">
                        <h5
                            class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                            Mortalidade Dia</h5>
                    </div>
                    <div class="py-2 px-4">
                        <h1 class="text-light font-weight-bold">
                            {{ $mortalidades->where('data_coleta', \Carbon\Carbon::now())->sum('tot_ave') }}</h1>
                    </div>
                    <p class="border-top border-white text-white p-2 m-0 text-center"><a class="text-white"
                            href="{{ route('lotes.index') }}">Acessar mortalidades</a> <i
                            class="fa fa-arrow-alt-circle-right"></i></p>
                </div>
            </div>

            <div class="col">
                <div class=" pt-2 bg-green rounded shadow-sm border border-white">
                    <div class="">
                        <h5
                            class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                            Cons. Ração Dia</h5>
                    </div>
                    <div class="py-2 px-4">
                        <h1 class="text-light font-weight-bold">
                            {{ $consumos->where('data_coleta', \Carbon\Carbon::now())->sum('femea') + $consumos->where('data_coleta', \Carbon\Carbon::now())->sum('macho') }}<span
                                style="font-size: 0.8rem;">Kg</span></h1>
                    </div>
                    <p class="border-top border-white text-white p-2 m-0 text-center"><a class="text-white"
                            href="{{ route('lotes.index') }}">Acessar cons. ração</a> <i
                            class="fa fa-arrow-alt-circle-right"></i></p>
                </div>
            </div>
    </div>
    {{-- KPI estoque --}}
    <div class="row mt-3">

        <div class="col-2">
            <div class="pt-2 bg-gray-200 rounded shadow-sm border border-white">
                <div class="">
                    <h5
                        class="px-2 pb-1 text-danger text-uppercase font-kpi font-weight-bold border-bottom border-secondary">
                        Enviar Relatório</h5>
                </div>
                <div class="p-2 text-center">
                    <form action="{{ route('relatorios.enviarelatorio') }}" method="post" class="inline">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="datarelatorio" value="{{ date('d/m/Y', strtotime(now())) }}">
                        <button type="submit" class="btn btn-lg btn-danger shadow-sm border border-white"><i
                                class="fa fa-file-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-2">
            <div class="pt-2 bg-gray-200 rounded shadow-sm border border-white">
                <div class="">
                    <h5
                        class="px-2 pb-1 text-danger text-uppercase font-kpi font-weight-bold border-bottom border-secondary">
                        Gerar backup</h5>
                </div>
                <div class="p-2 text-center">
                    <form action="{{ route('backups.gerabackup') }}" method="get" class="inline">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-lg btn-danger shadow-sm border border-white"><i
                                class="fa fa-database"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class=" pt-2 bg-indigo rounded shadow-sm border border-white">
                <div class="">
                    <h5 class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                        Estoque Ovos</h5>
                </div>
                <div class="p-2 row">
                    <div class="col-7 text-light font-weight-bold">Comerciais: {{ $estoqueovos->sum->comerciais }} <br>
                        Incubáveis: {{ $estoqueovos->sum->incubaveis }}</div>
                    <div style="font-size: 1.5rem;" class="col-5 text-light font-weight-bold text-center">
                        {{ $estoqueovos->sum->comerciais + $estoqueovos->sum->incubaveis }}</div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class=" pt-2 bg-orange rounded shadow-sm border border-white">
                <div class="">
                    <h5 class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                        Aves totais</h5>
                </div>
                <div class="p-2 row">
                    <div class="col-7 text-light font-weight-bold">Fêmeas: {{ $estoqueaves->sum->femea }} <br> Machos:
                        {{ $estoqueaves->sum->macho }}</div>
                    <div style="font-size: 1.5rem;" class="col-5 text-light font-weight-bold text-center">
                        {{ $estoqueaves->sum->femea + $estoqueaves->sum->macho }}</div>
                </div>
            </div>
        </div>

        <div class="col-2">
            <div class=" pt-2 bg-info rounded shadow-sm border border-white">
                <div class="">
                    <h5 class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                        Tarefas abertas</h5>
                </div>
                <div class="py-1 px-2">
                    <h1 class="text-light font-weight-bold">{{ $tarefas->count() }} </h1>
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
            <div class="card w-75 shadow-sm p-4 text-center border border-gray-500"
                style="margin-top: 20%;">
                <div class="row">
                    <div class="col">
                        <div class="" style="margin-top: 10%">
                            Para prosseguir será necessário preencher os dados de sua empresa corretamente.
                        </div>
                        <div class="text-center" style="margin-top: 10%">
                            <a class="btn btn-primary rounded border border-white shadow" href="{{ route('empresas.index') }}">
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
