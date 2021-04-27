<div class="row mb-4">
    <div class="col-12">
        <div style="font: bold italic 1rem sans-serif" class="bg-gray-400 p-2 text-center">Data do relatório: {{ date("d/m/Y", strtotime($datarelatorio)) }}</div>
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
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td style="width: 15%">Aviários</td>
        <td>{{ $aviario->aviario }}</td>
        @endforeach
        <th style="width: 8%" class="bg-gray-200">Total</th>
    </tr>
    <tr>
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td>Limpos do Ninho</td>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->limpos_ninho }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->limpos_ninho }}</th>
    </tr>
    <tr>
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td>Sujos do Ninho</td>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->sujos_ninho }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->sujos_ninho }}</th>
    </tr>
    <tr>
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td>Ovos de cama</td>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->ovos_cama }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->ovos_cama }}</th>
    </tr>
    <tr>
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td>Duas Gemas</td>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->duas_gemas }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->duas_gemas }}</th>
    </tr>
    <tr>
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td>Refugos</td>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->refugos }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->refugos }}</th>
    </tr>
    <tr>
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td>Deformados</td>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->deformados }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->deformados }}</th>
    </tr>
    <tr>
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td>Sujos</td>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->sujos }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->sujos }}</th>
    </tr>
    <tr>
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td>Trincados</td>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->trincados }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->trincados }}</th>
    </tr>
    <tr>
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <td>Eliminados</td>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->eliminados }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->eliminados }}</th>
    </tr>
    <tr class="bg-gray-200">
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <th>Comerciais</th>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->comerciais }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->comerciais }}</th>
    </tr>
    <tr class="bg-gray-200">
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <th>Incubáveis</th>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->incubaveis }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->incubaveis }}</th>
    </tr>
    <tr class="bg-gray-200">
        @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
        <th>Postura  dia</th>
        <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->postura_dia }}</td>
        @endforeach
        <th class="bg-gray-200">{{ $coletas->sum->postura_dia }}</th>
    </tr>
</table>
@if ($counter++ % 2 == 0)
<div style="page-break-before: always;"> </div>
@endif
@endforeach
