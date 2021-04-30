@foreach ($lotes as $lote)
<div class="relatorio">
    @php
    $numcoletas = App\Models\Coleta::where('lote_id', $lote->id_lote)
    ->distinct()
    ->get('coleta');
    @endphp
    <table>
        <tr>
            <td colspan="4" class="border-0 text-center">
                <h3 style="padding-bottom: 10px;">Movimento diário de granjas</h3>
            </td>
        </tr>
        <tr>
            <td class="border-0"><img class="logo" src="{{ asset('storage/images/logo-jbs.png') }}" alt="JBS"></td>
            <td class="border-0">Data: {{ date('d/m/Y', strtotime($datarelatorio)) }}</td>
            <td class="border-0">Lote: {{ $lote->lote }}</td>
            <td class="border-0">Granja: {{ $empresa->razao_social }}</td>
        </tr>
    </table>
    <table>
        <tr class="bg-gray-light">
            <th class="text-center" style="width: 20%;">Postura</th>
            @foreach ($numcoletas as $num)
            <td>{{ $num->coleta }}ª col.</td>
            @endforeach
            <th style="width: 70px;">Totais</th>
        </tr>
        <tr>
            <td>Limpos do Ninho</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('limpos_ninho') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('limpos_ninho') }}
            </td>
        </tr>
        <tr>
            <td>Sujos Ninho</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('sujos_ninho') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('sujos_ninho') }}
            </td>
        </tr>
        <tr class="bg-gray">
            <th>Incubáveis Bons <small>(LIMPOS DO NINHO + SUJOS DO NINHO)</small></th>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('incubaveis_bons') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('incubaveis_bons') }}
            </td>
        </tr>
        <tr>
            <td>Ovos de Cama incubáveis</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('ovos_cama') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('ovos_cama') }}
            </td>
        </tr>
        <tr class="bg-gray">
            <th>Incubáveis <small>(LIMPOS DO NINHO + SUJOS DO NINHO + OVOS DE CAMA)</small></th>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('incubaveis') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('incubaveis') }}
            </td>
        </tr>
        <tr>
            <td>Duas Gemas</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('duas_gemas') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('duas_gemas') }}
            </td>
        </tr>
        <tr>
            <td>Pequenos</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('pequenos') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('pequenos') }}
            </td>
        </tr>
        <tr>
            <td>Trincados</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('trincados') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('trincados') }}
            </td>
        </tr>
        <tr>
            <td>Casca fina</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('casca_fina') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('casca_fina') }}
            </td>
        </tr>
        <tr>
            <td>Deformados</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('deformados') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('deformados') }}
            </td>
        </tr>
        <tr>
            <td>Frios</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('frios') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('frios') }}
            </td>
        </tr>
        <tr>
            <td>*Sujos <small>Não aproveitáveis</small></td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('sujos_cama') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('sujos_cama') }}
            </td>
        </tr>
        <tr>
            <td>*Esmagados/quebrados</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('esmagados_quebrados') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('esmagados_quebrados') }}
            </td>
        </tr>
        <tr>
            <td>Ovos de cama não incubáveis</td>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('cama_nao_incubaveis') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('cama_nao_incubaveis') }}
            </td>
        </tr>
        <tr class="bg-gray">
            <th>Comerciais <small>(DUAS GEMAS + PEQUENOS + TRINCADOS + CASCA FINA + DEFORMADOS + FRIOS)</small></th>
            @foreach ($numcoletas as $num)
            <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('comerciais') }}
            </td>
            @endforeach
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('comerciais') }}
            </td>
        </tr>
        <tr class="bg-gray-light">
            <th colspan="{{ $numcoletas->count() + 1 }}" class="text-left">Postura do dia
                <small>(LIMPOS DO NINHO + SUJOS DO NINHO + CAMA INCUBÁVEIS + DUAS GEMAS + PEQUENOS + TRINCADOS + CASCA FINA + DEFORMADOS + CAMA NÃO INCUBÁVEIS + FRIOS + SUJOS + ESMAGADOS/QUEBRADOS)</small>
            </th>
            <td class="bg-gray">
                {{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('postura_dia') }}
            </td>
        </tr>
<tr>
    <td colspan="{{ $numcoletas->count() + 2}}">*NÃO ENVIAR AO INCUBATÓRIO. DESTINAR A COMPOSTAGEM.</td>
</tr>
    </table>
</div>
<div class="relatorio">
    <table>
        <tr class="bg-gray">
            <th>Aviários</th>
            @php
            $runaviarios = $aviarios->where('lote_id', $lote->id_lote);
            @endphp
            @foreach ($runaviarios as $aviario)
            <td>{{ $aviario->aviario }}</td>
            @endforeach
            <td>Totais</td>
        </tr>
        <tr>
            <th>N° Fêmeas</th>
            @foreach ($runaviarios as $aviario)
            <td>{{ $aviario->femea }}</td>
            @endforeach
            <td>{{ $aviarios->where('lote_id', $lote->id_lote)->sum->femea }}</td>
        </tr>
        <tr>
            <th>Ovos Totais</th>
            @foreach ($runaviarios as $aviario)
            <td>{{ $coletas->where('data_coleta', $datarelatorio)->where('id_aviario', $aviario->id_aviario)->sum->postura_dia }}
            </td>
            @endforeach
            <td>{{ $coletas->where('data_coleta', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->postura_dia }}
            </td>
        </tr>
        <tr>
            <th>Produção%</th>
            @foreach ($runaviarios as $aviario)
            <td>{{ number_format(($coletas->where('data_coleta', $datarelatorio)->where('id_aviario', $aviario->id_aviario)->sum->postura_dia * 100) / $aviarios->sum->femea, 2, ',', '.') }}
            </td>
            @endforeach
            <td>{{ number_format(($coletas->where('data_coleta', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->postura_dia * 100) / $aviarios->sum->femea, 2, ',', '.') }}
            </td>
        </tr>
        <tr>
            <th>Ovos Incubáveis</th>
            @foreach ($runaviarios as $aviario)
            <td>{{ $coletas->where('data_coleta', $datarelatorio)->where('id_aviario', $aviario->id_aviario)->sum->incubaveis }}
            </td>
            @endforeach
            <td>{{ $coletas->where('data_coleta', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->incubaveis }}
            </td>
        </tr>
        <tr>
            <th>Aproveitamento%</th>
            @foreach ($runaviarios as $aviario)
            <td>{{ number_format(($coletas->where('data_coleta', $datarelatorio)->where('id_aviario', $aviario->id_aviario)->sum->incubaveis * 100) / $aviarios->sum->femea, 2, ',', '.') }}
            </td>
            @endforeach
            <td>{{ number_format(($coletas->where('data_coleta', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->incubaveis * 100) / $aviarios->sum->femea, 2, ',', '.') }}
            </td>
        </tr>

    </table>
</div>
<div class="relatorio">
    <table style="margin: 0;padding: 0;">
        <tr>
            <td style="margin: 0 5px 0 0;vertical-align: top; border: 0;">
                <table style="margin-left: 0;">
                    <tr class="bg-gray">
                        <th>Mortalidades</th>
                        <th>Machos</th>
                        <th>Fêmeas</th>
                        <th>Totais</th>
                    </tr>
                    <tr>
                        <th>Aves anteriores</th>
                        <td>{{ $estoqueaves->where('lote', $lote->id_lote)->sum->macho + $mortalidades->where('data_mortalidade', $datarelatorio)->where('lote', $lote->id_lote)->sum->macho }}
                        </td>
                        <td>{{ $estoqueaves->where('lote', $lote->id_lote)->sum->femea + $mortalidades->where('data_mortalidade', $datarelatorio)->where('lote', $lote->id_lote)->sum->femea }}
                        </td>
                        <td>{{ $estoqueaves->where('lote', $lote->id_lote)->sum->tot_ave + $mortalidades->where('data_mortalidade', $datarelatorio)->where('lote', $lote->id_lote)->sum->tot_ave }}
                        </td>
                    </tr>
                    <tr>
                        <th>Arranhado</th>
                        <td>{{ $mortalidades->where('motivo', '1')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->macho }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '1')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->femea }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '1')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->tot_ave }}
                        </td>
                    </tr>
                    <tr>
                        <th>Calor</th>
                        <td>{{ $mortalidades->where('motivo', '2')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->macho }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '2')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->femea }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '2')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->tot_ave }}
                        </td>
                    </tr>
                    <tr>
                        <th>Inprodutivas</th>
                        <td>{{ $mortalidades->where('motivo', '3')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->macho }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '3')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->femea }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '3')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->tot_ave }}
                        </td>
                    </tr>
                    <tr>
                        <th>Prolapso</th>
                        <td>{{ $mortalidades->where('motivo', '4')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->macho }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '4')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->femea }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '4')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->tot_ave }}
                        </td>
                    </tr>
                    <tr>
                        <th>Refugo</th>
                        <td>{{ $mortalidades->where('motivo', '5')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->macho }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '5')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->femea }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '5')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->tot_ave }}
                        </td>
                    </tr>
                    <tr>
                        <th>Outros</th>
                        <td>{{ $mortalidades->where('motivo', '6')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->macho }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '6')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->femea }}
                        </td>
                        <td>{{ $mortalidades->where('motivo', '6')->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->tot_ave }}
                        </td>
                    </tr>
                    <tr>
                        <th>Total Mortas</th>
                        <td>{{ $mortalidades->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->macho }}
                        </td>
                        <td>{{ $mortalidades->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->femea }}
                        </td>
                        <td>{{ $mortalidades->where('data_mortalidade', $datarelatorio)->where('lote_id', $lote->id_lote)->sum->tot_ave }}
                        </td>
                    </tr>
                    <tr>
                        <th>Aves atuais</th>
                        <td>{{ $estoqueaves->where('lote', $lote->id_lote)->sum->macho }}</td>
                        <td>{{ $estoqueaves->where('lote', $lote->id_lote)->sum->femea }}</td>
                        <td>{{ $estoqueaves->where('lote', $lote->id_lote)->sum->tot_ave }}</td>
                    </tr>
                </table>
            </td>
            <td style="margin: 0 0 0 5px;vertical-align: top; border: 0;">
                <table style="margin-right: 0;">
                    <tr class="bg-gray">
                        <th>Controle de estoque de ovos</th>
                        <th>Comerciais</th>
                        <th>Incubáveis</th>
                    </tr>

                    <tr>
                        <th>SALDO ANTERIOR
                            <small>SALDO ATUAL EM ESTOQUE</small>
                        </th>
                        <td>{{ $estoqueovos->where('lote_id', $lote->id_lote)->sum->comerciais + $envios->where('lote_id', $lote->id_lote)->where('data_envio', $datarelatorio)->sum->comerciais }}
                        </td>
                        <td>{{ $estoqueovos->where('lote_id', $lote->id_lote)->sum->incubaveis + $envios->where('lote_id', $lote->id_lote)->where('data_envio', $datarelatorio)->sum->incubaveis }}
                        </td>
                    </tr>
                    <tr>
                        <th>Produzidos <small>TOTAL DO MOVIMENTO DIÁRIO</small></th>
                        <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum->comerciais }}
                        </td>
                        <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum->incubaveis }}
                        </td>
                    </tr>
                    <tr>
                        <th>Enviado para o incubatório</th>
                        <td>{{ $envios->where('lote_id', $lote->id_lote)->where('data_envio', $datarelatorio)->sum->comerciais }}
                        </td>
                        <td>{{ $envios->where('lote_id', $lote->id_lote)->where('data_envio', $datarelatorio)->sum->incubaveis }}
                        </td>
                    </tr>
                    <tr>
                        <th>Saldo atual</th>
                        <td>{{ $estoqueovos->where('lote_id', $lote->id_lote)->sum->comerciais }}</td>
                        <td>{{ $estoqueovos->where('lote_id', $lote->id_lote)->sum->incubaveis }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="page-break-before: always;"> </div>
@endforeach
<div class="relatorio">
    <table>
        <tr><td class="bg-gray-light" colspan="{{ $aviarios->count() + 2 }}"><h3>Produção e aproveitamento total do dia</h3></td></tr>
        <tr class="bg-gray">
            <th>Aviários</th>
            @foreach ($aviarios as $aviario)
            <td>{{ $aviario->aviario }}</td>
            @endforeach
            <td>Totais</td>
        </tr>
        <tr>
            <th>N° Fêmeas</th>
            @foreach ($aviarios as $aviario)
            <td>{{ $aviarios->where('aviario', $aviario->id_aviario)->sum->femea }}</td>
            @endforeach
            <td>{{ $aviarios->sum->femea }}</td>
        </tr>
        <tr>
            <th>Ovos Totais</th>
            @foreach ($aviarios as $aviario)
            <td>{{ $coletas->where('data_coleta', $datarelatorio)->where('id_aviario', $aviario->id_aviario)->sum->postura_dia }}
            </td>
            @endforeach
            <td>{{ $coletas->where('data_coleta', $datarelatorio)->sum->postura_dia }}
            </td>
        </tr>
        <tr>
            <th>Produção%</th>
            @foreach ($aviarios as $aviario)
            <td>{{ number_format(($coletas->where('data_coleta', $datarelatorio)->where('id_aviario', $aviario->id_aviario)->sum->postura_dia * 100) / $aviarios->sum->femea, 2, ',', '.') }}
            </td>
            @endforeach
            <td>{{ number_format(($coletas->where('data_coleta', $datarelatorio)->sum->postura_dia * 100) / $aviarios->sum->femea, 2, ',', '.') }}
            </td>
        </tr>
        <tr>
            <th>Ovos Incubáveis</th>
            @foreach ($aviarios as $aviario)
            <td>{{ $coletas->where('data_coleta', $datarelatorio)->where('id_aviario', $aviario->id_aviario)->sum->incubaveis }}
            </td>
            @endforeach
            <td>{{ $coletas->where('data_coleta', $datarelatorio)->sum->incubaveis }}
            </td>
        </tr>
        <tr>
            <th>Aproveitamento%</th>
            @foreach ($aviarios as $aviario)
            <td>{{ number_format(($coletas->where('data_coleta', $datarelatorio)->where('id_aviario', $aviario->id_aviario)->sum->incubaveis * 100) / $aviarios->sum->femea, 2, ',', '.') }}
            </td>
            @endforeach
            <td>{{ number_format(($coletas->where('data_coleta', $datarelatorio)->sum->incubaveis * 100) / $aviarios->sum->femea, 2, ',', '.') }}
            </td>
        </tr>
    </table>
</div>
