@extends('layouts.app')

@section('content')

<div class="row">
    <table class="table table-bordered  table-dark">
        <tr>
            <td colspan="{{$numcoletas->count()+2}}"><h1>Movimento diário de granjas</h1></td>
        </tr>
        <tr>
            <th class="text-center">Postura</th>
            @foreach ($numcoletas as $coleta)
                <td>{{ $coleta->coleta }}ª col.</td>
            @endforeach
            <th>Totais</th>
        </tr>
        <tr>
            <td>Limpos do Ninho</td>
            @foreach ($numcoletas as $coleta)
            <td>{{ $coleta->where('data_coleta', $datarelatorio)->where('coleta', $coleta->coleta)->sum('limpos_ninho') }}</td>
            @endforeach
            <td>{{ $coleta->where('data_coleta', $datarelatorio)->sum('limpos_ninho') }}</td>
        </tr>
        <tr>
            <td>Sujos Ninho</td>
            @foreach ($numcoletas as $coleta)
            <td>{{ $coleta->where('data_coleta', $datarelatorio)->where('coleta', $coleta->coleta)->sum('sujos_ninho') }}</td>
            @endforeach
            <td>{{ $coleta->where('data_coleta', $datarelatorio)->sum('sujos_ninho') }}</td>
        </tr>
        <tr>
            <th>Totais de Incubáveis Bons <small>Limpos do ninho + Sujos do ninho</small></th>
        </tr>
        <tr>
            <td>Ovos de Cama</td>
        </tr>
        <tr>
            <th>Total de incubáveis <small>Limpos do ninho + sujos de ninho + ovos de cama</small></th>
        </tr>
        <tr>
            <td>Duas Gemas</td>
        </tr>
        <tr>
            <td>Refugos</td>
        </tr>
        <tr>
            <td>Deformados</td>
        </tr>
        <tr>
            <td>Sujos</td>
        </tr>
        <tr>
            <td>Trincados</td>
        </tr>
        <tr>
            <th>Total de Comerciais</th>
        </tr>
        <tr>
            <td>Eliminados</td>
        </tr>
        <tr>
            <th class="text-center">Postura do dia</th>
        </tr>

    </table>
</div>

@endsection


