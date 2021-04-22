
    <div class="card">
        <div class="card-body">
            @foreach ($lotes as $lote)
                <div class="row">
                    <div class="col">
                        @php
                            $numcoletas = App\Models\Coleta::where('lote_id', $lote->id_lote)
                                ->distinct()
                                ->get('coleta');
                        @endphp
                        <table class="table table-bordered text-uppercase">
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h5>Movimento diário de granjas</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Logo</td>
                                <td>Data: {{ date('d/m/Y', strtotime($datarelatorio)) }}</td>
                                <td>Lote: {{ $lote->lote }}</td>
                                <td>Granja:</td>
                            </tr>
                        </table>
                        <table class="table table-bordered text-uppercase">
                            <tr>
                                <th class="text-center">Postura</th>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $num->coleta }}ª col.</td>
                                @endforeach
                                <th>Totais</th>
                            </tr>
                            <tr>
                                <td>Limpos do Ninho</td>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('limpos_ninho') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('limpos_ninho') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Sujos Ninho</td>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('sujos_ninho') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('sujos_ninho') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Incubáveis Bons <small>(LIMPOS DO NINHO + SUJOS DO NINHO)</small></th>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('incubaveis_bons') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('incubaveis_bons') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Ovos de Cama</td>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('ovos_cama') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('ovos_cama') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Incubáveis <small>(LIMPOS DO NINHO + SUJOS DO NINHO + OVOS DE CAMA)</small></th>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('incubaveis') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('incubaveis') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Duas Gemas</td>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('duas_gemas') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('duas_gemas') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Refugos</td>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('refugos') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('refugos') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Deformados</td>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('deformados') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('deformados') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Sujos</td>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('sujos_cama') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('sujos_cama') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Trincados</td>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('trincados') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('trincados') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Comerciais <small>(DUAS GEMAS + REFUGO + DEFORMADOS +SUJOS + TRINCADOS)</small></th>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('comerciais') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('comerciais') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Eliminados <small>(Quebrados + pequenos)</small></td>
                                @foreach ($numcoletas as $num)
                                    <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->where('coleta', $num->coleta)->sum('eliminados') }}
                                    </td>
                                @endforeach
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('eliminados') }}
                                </td>
                            </tr>
                            <tr>
                                <th colspan="{{ $numcoletas->count() + 1 }}" class="text-left">Postura do dia
                                    <small>(LIMPOS DO NINHO + SUJOS DO NINHO + OVOS DE CAMA + DUAS GEMAS + REFUGOS +
                                        DEFORMADOS
                                        +
                                        SUJOS +
                                        TRINCADOS + ELIMINADOS)</small>
                                </th>
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum('postura_dia') }}
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <tr>
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
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <tr>
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
                    </div>
                    <div class="col">
                        <table class="table table-bordered">
                            <tr>
                                <th>Controle de estoque de ovos</th>
                                <th>Comerciais</th>
                                <th>Incubáveis</th>
                            </tr>

                            <tr>
                                <th>SALDO ANTERIOR
                                    <small>SALDO ATUAL EM ESTOQUE</small>
                                </th>
                                <td>{{ $estoqueovos->where('lote_id', $lote->id_lote)->sum->comerciais + $envios->where('lote_id', $lote->id_lote)->where('data_envio', $datarelatorio)->sum->comerciais }}</td>
                                <td>{{ $estoqueovos->where('lote_id', $lote->id_lote)->sum->incubaveis + $envios->where('lote_id', $lote->id_lote)->where('data_envio', $datarelatorio)->sum->incubaveis }}</td>
                            </tr>
                            <tr>
                                <th>Produzidos <small>TOTAL DO MOVIMENTO DIÁRIO</small></th>
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum->comerciais }}</td>
                                <td>{{ $coletas->where('lote_id', $lote->id_lote)->where('data_coleta', $datarelatorio)->sum->incubaveis }}</td>
                            </tr>
                            <tr>
                                <th>Enviado para o incubatório</th>
                                <td>{{ $envios->where('lote_id', $lote->id_lote)->where('data_envio', $datarelatorio)->sum->comerciais }}</td>
                                <td>{{ $envios->where('lote_id', $lote->id_lote)->where('data_envio', $datarelatorio)->sum->incubaveis }}</td>
                            </tr>
                            <tr>
                                <th>Saldo atual</th>
                                <td>{{ $estoqueovos->where('lote_id', $lote->id_lote)->sum->comerciais }}</td>
                                <td>{{ $estoqueovos->where('lote_id', $lote->id_lote)->sum->incubaveis }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

