<div class="row mb-4">
    <div class="col-12">
        <div style="font-size: 1rem;" class="bg-gray-400 p-2 text-center">Relatório de estoque de aves - data do
            relatório: {{ date("d/m/Y", strtotime($datarelatorio)) }}</div>
    </div>
</div>

<table class="table table-bordered table-condensed mb2">
    <tr>
        <th colspan="3">Coletas</th><th colspan="3">Enviados</th><th colspan="3">Saldo</th><th colspan="3">Rep%</th>
    </tr>
    <tr class="bg-gray-200">
        <th>Comerciais</th>
        <th>Incubáveis</th>
        <th>Total</th>
        <th>Incubáveis</th>
        <th>Comerciais</th>
        <th>Total</th>
        <th>Incubáveis</th>
        <th>Comerciais</th>
        <th>Total</th>
        <th>Incubáveis</th>
        <th>Comerciais</th>
        <th>Total</th>
    </tr>
    <tr>
        <td>{{ $coletas->sum->comerciais }}</td>
        <td>{{ $coletas->sum->incubaveis }}</td>
        <td>{{ $coletas->sum->postura_dia }}</td>

        <td>{{ $envios->sum->comerciais }}</td>
        <td>{{ $envios->sum->incubaveis }}</td>
        <td>{{ $envios->sum->postura_dia }}</td>

        <td>{{ $coletas->sum->comerciais - $envios->sum->comerciais }}</td>
        <td>{{ $coletas->sum->incubaveis - $envios->sum->incubaveis }}</td>
        <td>{{ $coletas->sum->postura_dia - $envios->sum->postura_dia }}</td>

        <td>{{ number_format(($envios->sum->comerciais / $coletas->sum->comerciais) * 100, 2,',', '') }}%</td>
        <td>{{ number_format(($envios->sum->incubaveis / $coletas->sum->incubaveis) * 100, 2,',', '') }}%</td>
        <td>{{ number_format(($envios->sum->postura_dia / $coletas->sum->postura_dia) * 100, 2,',', '') }}%</td>
    </tr>
</table>
