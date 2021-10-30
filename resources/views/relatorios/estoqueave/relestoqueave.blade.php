<div class="row mb-4">
    <div class="col-12">
        <div style="font-size: 1rem;" class="bg-gray-400 p-2 text-center">Relatório de estoque de aves - data do
            relatório: {{ date("d/m/Y", strtotime($datarelatorio)) }}</div>
    </div>
</div>

<table class="table table-bordered table-condensed mb2">
    <tr>
        <th colspan="3">Aviários</th><th colspan="3">Mortalidades</th><th colspan="3">Saldo</th><th colspan="3">Rep%</th>
    </tr>
    <tr class="bg-gray-200">
        <th>Fêmeas</th>
        <th>Machos</th>
        <th>Total</th>
        <th>Fêmeas</th>
        <th>Machos</th>
        <th>Total</th>
        <th>Fêmeas</th>
        <th>Machos</th>
        <th>Total</th>
        <th>Fêmeas</th>
        <th>Machos</th>
        <th>Total</th>
    </tr>
    <tr>
        <td>{{ $aviarios->sum->femea }}</td>
        <td>{{ $aviarios->sum->macho }}</td>
        <td>{{ $aviarios->sum->tot_ave }}</td>

        <td>{{ $mortalidades->sum->femea }}</td>
        <td>{{ $mortalidades->sum->macho }}</td>
        <td>{{ $mortalidades->sum->tot_ave }}</td>

        <td>{{ $aviarios->sum->femea - $mortalidades->sum->femea }}</td>
        <td>{{ $aviarios->sum->macho - $mortalidades->sum->macho }}</td>
        <td>{{ $aviarios->sum->tot_ave - $mortalidades->sum->tot_ave }}</td>

        <td>{{ number_format(($mortalidades->sum->femea / $aviarios->sum->femea) * 100, 2,',', '') }}%</td>
        <td>{{ number_format(($mortalidades->sum->macho / $aviarios->sum->macho) * 100, 2,',', '') }}%</td>
        <td>{{ number_format(($mortalidades->sum->tot_ave / $aviarios->sum->tot_ave) * 100, 2,',', '') }}%</td>
    </tr>
</table>
