@extends('layouts.app')

@section('content')
<script src="{{ asset('js/highcharts.js') }}"></script>
<script src="{{ asset('js/exporting.js') }}"></script>
<script src="{{ asset('js/export-data.js') }}"></script>
<script src="{{ asset('js/accessibility.js') }}"></script>
<div class="row">
    <div class="col">
        <div class=" pt-2 bg-blue rounded shadow-sm border border-white">
            <div class="">
                <h5 class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                    Lotes</h5>
            </div>
            <div class="py-3 px-4">
                <h1 class="text-light font-weight-bold">{{ $lotes }}</h1>
            </div>
            <p class="border-top border-white text-white p-2 m-0"><a class="text-white"
                    href="{{ route('lotes.index') }}">Acessar lotes</a> <i class="fa fa-arrow-alt-circle-right"></i>
            </p>
        </div>
    </div>

    <div class="col">
        <div class=" pt-2 bg-orange rounded shadow-sm border border-white">
            <div class="">
                <h5 class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                    Aviários</h5>
            </div>
            <div class="py-3 px-4">
                <h1 class="text-light font-weight-bold">{{ $aviarios }}</h1>
            </div>
            <p class="border-top border-white text-white p-2 m-0"><a class="text-white"
                    href="{{ route('aviarios.index') }}">Acessar aviários</a> <i
                    class="fa fa-arrow-alt-circle-right"></i></p>
        </div>
    </div>

    <div class="col">
        <div class=" pt-2 bg-indigo rounded shadow-sm border border-white">
            <div class="">
                <h5 class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                    Coleta Dia</h5>
            </div>
            <div class="py-3 px-4">
                <h1 class="text-light font-weight-bold">{{ $coletas }}</h1>
            </div>
            <p class="border-top border-white text-white p-2 m-0"><a class="text-white"
                    href="{{ route('coletas.index') }}">Acessar coletas</a> <i class="fa fa-arrow-alt-circle-right"></i>
            </p>
        </div>
    </div>

    <div class="col">
        <div class=" pt-2 bg-red rounded shadow-sm border border-white">
            <div class="">
                <h5 class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                    Mortalidade Dia</h5>
            </div>
            <div class="py-3 px-4">
                <h1 class="text-light font-weight-bold">{{ $mortalidades }}</h1>
            </div>
            <p class="border-top border-white text-white p-2 m-0"><a class="text-white"
                    href="{{ route('lotes.index') }}">Acessar mortalidades</a> <i
                    class="fa fa-arrow-alt-circle-right"></i></p>
        </div>
    </div>

    <div class="col">
        <div class=" pt-2 bg-green rounded shadow-sm border border-white">
            <div class="">
                <h5 class="px-2 pb-1 text-white text-uppercase font-kpi font-weight-bold border-bottom border-white">
                    Cons. Ração Dia</h5>
            </div>
            <div class="py-3 px-4">
                <h1 class="text-light font-weight-bold">{{ $consumos->sum('femea') + $consumos->sum('macho') }}<span
                        style="font-size: 0.8rem;">Kg</span></h1>
            </div>
            <p class="border-top border-white text-white p-2 m-0"><a class="text-white"
                    href="{{ route('lotes.index') }}">Acessar cons. ração</a> <i
                    class="fa fa-arrow-alt-circle-right"></i></p>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col">
        <div class="bg-white rounded shadow-sm border border-gray-500">
            <div class="">
                <p class="text-center m-0 px-2 py-4 text-secundary font-weight-bold">Semana:{{ $semanaatual->semana }}</p>
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
                <p class="text-center m-0 px-2 py-4 text-secundary font-weight-bold">Meta: {{ $semanaatual->producao }}% / Parcial: {{ $alcancada }}%</p>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="bg-white rounded shadow-sm border border-gray-500">
            <div class="">
                <p class="text-center m-0 px-2 py-4 text-secundary font-weight-bold">Média: {{ $media }}%</p>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col mt-4">
        <div class="rounded shadow-sm border border-gray-500" id="container" style="width:100%; height:400px;"></div>
    </div>
</div>


<script>
    // Gráfico produção semanal

var producaosemana = <?php echo json_encode($producaosemana, JSON_NUMERIC_CHECK)?>;
var datasemana     = <?php echo json_encode($datasemana)?>;

    Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Produção da Semana'
    },
    subtitle: {
        text: 'Comparativo diário de produção total'
    },
    xAxis: {
        categories:datasemana
    },
    yAxis: {
        title: {
            text: 'Produção %'
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
        name: 'Dias da Semana',
        data: producaosemana
    }]
});

// Gráfico Média semanal *********************************************************

</script>



@endsection
