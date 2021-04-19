@extends('layouts.app')

@section('content')
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
                        href="{{ route('coletas.index') }}">Acessar coletas</a> <i
                        class="fa fa-arrow-alt-circle-right"></i></p>
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
                    <p class="text-center m-0 p-2 text-secundary font-weight-bold">Semana atual:
                        {{ $semanaatual->semana }}</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="bg-white rounded shadow-sm border border-gray-500">
                <div class="">
                    <p class="text-center m-0 p-2 text-secundary font-weight-bold">De
                        {{ date('d/m/Y', strtotime($semanaatual->data_inicial)) }} à
                        {{ date('d/m/Y', strtotime($semanaatual->data_final)) }} </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="bg-white rounded shadow-sm border border-gray-500">
                <div class="">
                    <p class="text-center m-0 p-2 text-secundary font-weight-bold">Meta: {{ $semanaatual->producao }}%
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="bg-white rounded shadow-sm border border-gray-500">
                <div class="">
                    <p class="text-center m-0 p-2 text-secundary font-weight-bold">Média semana: {{ 50 }}%</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div>
            <canvas width="600" height="500" id="myChart"></canvas>ggfgdf
        </div>
    </div>

        <script>
            // === include 'setup' then 'config' above ===
            const config = {
                type: 'line',
            };
            const labels = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
            ];
            const data = {
                labels: labels,
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45],
                }]
            };
            var myChart = new Chart(
                document.getElementById('myChart'),
                config
            );

        </script>



@endsection
