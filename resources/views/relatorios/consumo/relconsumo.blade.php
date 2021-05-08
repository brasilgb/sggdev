<div class="row mb-4">
    <div class="col-12">
        <div style="font-size: 1rem;" class="bg-gray-400 p-2 text-center">Relatório de consumo de ração - data do
            relatório: {{ date('d/m/Y', strtotime($datarelatorio)) }}</div>
    </div>
</div>
@foreach ($lotes as $lote)
    <table class="table table-bordered table-condensed mb2">
        <tr>
            <th colspan="12" style="font-size: 1.1rem;" class="text-center bg-gray-400">Consumo diário do lote {{ $lote->lote }}:
                {{ $consumos->where('lote_id', $lote->id_lote)->sum->femea +  $consumos->where('lote_id', $lote->id_lote)->sum->macho }}
            </th>
        </tr>
        <tr class="text-center">
            <th class="bg-gray-400"></th>
            <th colspan="5" class="bg-gray-200">Fêmea</th>
            <th colspan="5" class="bg-gray-300">Macho</th>
            <th class="bg-gray-400">Total</th>
        </tr>
        <tr class="text-center">
            <th class="bg-gray-400">Aviário</th>
            <th class="bg-gray-200">Box1</th>
            <th class="bg-gray-200">Box2</th>
            <th class="bg-gray-200">Box3</th>
            <th class="bg-gray-200">Box4</th>
            <th class="bg-gray-200">Total</th>
            <th class="bg-gray-300">Box1</th>
            <th class="bg-gray-300">Box2</th>
            <th class="bg-gray-300">Box3</th>
            <th class="bg-gray-300">Box4</th>
            <th class="bg-gray-300">Total</th>
            <th class="bg-gray-400">Aviário</th>
        </tr>

            @foreach ($aviarios as $aviario)
             <tr>
                <td class="bg-gray-400">{{ $aviario->aviario }}</td>

                <td>{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->femea_box1 }}</td>

                <td>{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->femea_box2 }}</td>

                <td>{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->femea_box3 }}</td>

                <td>{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->femea_box4 }}</td>

                <td class="bg-gray-200">{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->femea }}</td>

                <td>{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->macho_box1 }}</td>

                <td>{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->macho_box2 }}</td>

                <td>{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->macho_box3 }}</td>

                <td>{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->macho_box4 }}</td>

                <td class="bg-gray-300">{{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->macho }}</td>
                <td class="bg-gray-400">
                    {{ $consumos->where('aviario_id', $aviario->id_aviario)->sum->femea + $consumos->where('aviario_id', $aviario->id_aviario)->sum->macho }}
                </td>
            @endforeach

            {{-- <td>{{ number_format(($mortalidades->sum->femea / $aviarios->sum->femea) * 100, 2,',', '') }}%</td>
        <td>{{ number_format(($mortalidades->sum->macho / $aviarios->sum->macho) * 100, 2,',', '') }}%</td>
        <td>{{ number_format(($mortalidades->sum->tot_ave / $aviarios->sum->tot_ave) * 100, 2,',', '') }}%</td> --}}
        </tr>
    </table>
@endforeach
