@extends('layouts.app')

@section('content')

<div class="row">
    <table>
        <tr>
            <th class="text-center">Postura</th>
            @foreach ($numcoletas as $num)
                <td>{{ $num->coleta }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Limpos do Ninho</td>
            @foreach ($coletas as $coleta)
            <td>{{ $coleta->limpos_ninho }}</td>
        @endforeach
        </tr>
        <tr>
            <td>Sujos Ninho</td>
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


