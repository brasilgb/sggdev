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
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->limpos_ninho }}</th>
        </tr>
        <tr>
            <td>Sujos do Ninho</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->sujos_ninho }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->sujos_ninho }}</th>
        </tr>
        <tr>
            <td>Ovos de cama</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->ovos_cama }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->ovos_cama }}</th>
        </tr>
        <tr>
            <td>Duas Gemas</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->duas_gemas }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->duas_gemas }}</th>
        </tr>
        <tr>
            <td>Pequenos</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->pequenos }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->pequenos }}</th>
        </tr>
        <tr>
            <td>Trincados</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->trincados }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->trincados }}</th>
        </tr>
        <tr>
            <td>Casca fina</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->casca_fina }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->casca_fina }}</th>
        </tr>
        <tr>
            <td>Deformados</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->deformados }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->deformados }}</th>
        </tr>
        <tr>
            <td>Frios</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->frios }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->frios }}</th>
        </tr>
        <tr>
            <td>Sujos não aproveitaveis</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->sujos_cama }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->sujos_cama }}</th>
        </tr>
        <tr>
            <td>Esmagados e quebrados</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->esmagados_quebrados }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->esmagados_quebrados }}</th>
        </tr>
        <tr>
            <td>Ovos de cama não incubáveis</td>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->cama_nao_incubaveis }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->cama_nao_incubaveis }}</th>
        </tr>
        <tr class="bg-gray-200">
            <th>Comerciais</th>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->comerciais }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->comerciais }}</th>
        </tr>
        <tr class="bg-gray-200">
            <th>Incubáveis</th>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->incubaveis }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->incubaveis }}</th>
        </tr>
        <tr class="bg-gray-200">
            <th>Postura dia</th>
            @foreach ($aviarios->where('lote_id', $lote->id_lote) as $aviario)
                <td>{{ $coletas->where('id_aviario', $aviario->id_aviario)->sum->postura_dia }}</td>
            @endforeach
            <th class="bg-gray-200">{{ $coletas->where('lote_id', $lote->id_lote)->sum->postura_dia }}</th>
        </tr>
    </table>
    @if ($counter++ == 1)
        <div style="page-break-before: always;"> </div>
    @endif
@endforeach
