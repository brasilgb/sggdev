<div class="row mb-4">
    <div class="col-12">
        <div style="font-size: 1rem;" class="bg-gray-400 p-2 text-center">Data do relatório:
            {{ date('d/m/Y', strtotime($datarelatorio)) }}</div>
    </div>
</div>
@php
$counter = 1;
@endphp
@foreach ($lotes as $lote)

    <table class="table table-bordered table-condensed mb2">
        <tr class="bg-gray-200">
            <th colspan="{{ $aviarios->where('lote_id', $lote->id_lote)->count() + 2 }}">
                Lote: {{ $lote->lote }}
            </th>
        </tr>
        <tr>
            <td style="width: 15%">Aviários</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $aviario->aviario }}</td>
            @endforeach
            <th style="width: 8%" class="bg-gray-200">Total</th>
        </tr>
        <tr>
            <td>Limpos do Ninho</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->limpos_ninho }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->limpos_ninho }}</th>
        </tr>
        <tr>
            <td>Sujos do Ninho</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->sujos_ninho }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->sujos_ninho }}</th>
        </tr>
        <tr>
            <td>Ovos de cama</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->ovos_cama }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->ovos_cama }}</th>
        </tr>
        <tr>
            <td>Duas Gemas</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->duas_gemas }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->duas_gemas }}</th>
        </tr>
        <tr>
            <td>Refugos</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->refugos }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->refugos }}</th>
        </tr>
        <tr>
            <td>Deformados</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->deformados }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->deformados }}</th>
        </tr>
        <tr>
            <td>Sujos</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->sujos }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->sujos }}</th>
        </tr>
        <tr>
            <td>Trincados</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->trincados }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->trincados }}</th>
        </tr>
        <tr>
            <td>Eliminados</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->eliminados }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->eliminados }}</th>
        </tr>
        <tr class="bg-gray-200">
            <th>Comerciais</th>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->comerciais }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->comerciais }}</th>
        </tr>
        <tr class="bg-gray-200">
            <th>Incubáveis</th>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->incubaveis }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->incubaveis }}</th>
        </tr>
        <tr class="bg-gray-200">
            <th>Postura dia</th>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->postura_dia }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->sum->postura_dia }}</th>
        </tr>
    </table>
    @if ($counter++ % 2 == 0)
        <div style="page-break-before: always;"> </div>
    @endif
@endforeach
