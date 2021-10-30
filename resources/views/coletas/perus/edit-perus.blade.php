
<form id="formcoleta" action="{{ route('coletas.update', ['coleta' => $coleta->id_coleta]) }}" method="post" autocomplete="off">
    <div class="card-body px-4">

        @method('PUT')
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group row">
                    <label for="dataform" class="col-sm-5 col-form-label text-left">Data da coleta <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="dataform" type="text" class="form-control" name="data_coleta"
                            value="{{ old('data_coleta', date('d/m/Y', strtotime($coleta->data_coleta))) }}">
                        @error('data_coleta')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hora_coleta" class="col-sm-5 col-form-label text-left">Hora da coleta <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="hora_coleta" type="text" class="form-control" name="hora_coleta"
                            value="{{ old('hora_coleta', date('H:i', strtotime($coleta->hora_coleta))) }}">
                        @error('hora_coleta')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lote_id" class="col-sm-5 col-form-label text-left">Lote <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <select id="lote_id" type="text" class="custom-select" name="lote_id">
                            <option value="{{$coleta->lote_id}}">{{\App\Models\Lote::where('id_lote', $coleta->lote_id)->get('lote')->first()->lote}}</option>
                        </select>
                        @error('lote_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_aviario" class="col-sm-5 col-form-label text-left">Aviários <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <select id="id_aviario" type="text" class="custom-select" name="id_aviario">
                            @foreach (\App\Models\Aviario::where('lote_id', $coleta->lote_id)->get() as $item)
                                <option value="{{$item->id_aviario}}" @if($item->id_aviario == $coleta->id_aviario) selected @endif>{{$item->aviario}}</option>
                            @endforeach

                        </select>
                        @error('id_aviario')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="coleta" class="col-sm-5 col-form-label text-left">Coleta n° <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="coleta" type="text" class="form-control font-weight-bold" name="coleta"
                            value="{{ old('coleta', $coleta->coleta) }}" readonly>
                        @error('coleta')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="limpos_ninho" class="col-sm-5 col-form-label text-left">Limpos de ninho <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="limpos_ninho" type="text" class="form-control cleanzero nosubmit  incubaveisbons incubaveis posturadia" name="limpos_ninho"
                            value="{{ old('limpos_ninho', $coleta->limpos_ninho) }}" onkeydown="javascript:EnterTab('sujos_ninho',event)">
                        @error('limpos_ninho')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sujos_ninho" class="col-sm-5 col-form-label text-left">Sujos de ninho <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="sujos_ninho" type="text" class="form-control cleanzero nosubmit incubaveisbons incubaveis posturadia" name="sujos_ninho"
                            value="{{ old('sujos_ninho', $coleta->sujos_ninho) }}" onkeydown="javascript:EnterTab('ovos_cama',event)">
                        @error('sujos_ninho')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ovos_cama" class="col-sm-5 col-form-label text-left">Cama incubáveis<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="ovos_cama" type="text" class="form-control cleanzero nosubmit incubaveis posturadia" name="ovos_cama"
                            value="{{ old('ovos_cama', $coleta->ovos_cama) }}" onkeydown="javascript:EnterTab('duas_gemas',event)">
                        @error('ovos_cama')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="duas_gemas" class="col-sm-5 col-form-label text-left">Duas gemas <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="duas_gemas" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="duas_gemas"
                            value="{{ old('duas_gemas', $coleta->duas_gemas) }}" onkeydown="javascript:EnterTab('pequenos',event)">
                        @error('duas_gemas')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pequenos" class="col-sm-5 col-form-label text-left">Pequenos <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="pequenos" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="pequenos"
                            value="{{ old('pequenos', $coleta->pequenos) }}" onkeydown="javascript:EnterTab('trincados',event)">
                        @error('pequenos')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="trincados" class="col-sm-5 col-form-label text-left">Trincados <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="trincados" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="trincados"
                            value="{{ old('trincados', $coleta->trincados) }}" onkeydown="javascript:EnterTab('casca_fina',event)">
                        @error('trincados')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group row">
                    <label for="casca_fina" class="col-sm-5 col-form-label text-left"> Casca fina <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="casca_fina" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="casca_fina"
                            value="{{ old('casca_fina', $coleta->casca_fina) }}" onkeydown="javascript:EnterTab('deformados',event)">
                        @error('casca_fina')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="deformados" class="col-sm-5 col-form-label text-left">Deformados <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="deformados" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="deformados"
                            value="{{ old('deformados', $coleta->deformados) }}" onkeydown="javascript:EnterTab('frios',event)">
                        @error('deformados')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="frios" class="col-sm-5 col-form-label text-left">Frios <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="frios" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="frios"
                            value="{{ old('frios', $coleta->frios) }}" onkeydown="javascript:EnterTab('sujos_cama',event)">
                        @error('frios')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sujos_cama" class="col-sm-5 col-form-label text-left">Sujos não aproveitaveis <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="sujos_cama" type="text" class="form-control cleanzero nosubmit posturadia" name="sujos_cama"
                            value="{{ old('sujos_cama', $coleta->sujos_cama) }}" onkeydown="javascript:EnterTab('esmagados_quebrados',event)">
                        @error('sujos_cama')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="esmagados_quebrados" class="col-sm-5 col-form-label text-left"> Esmagados e quebrados <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="esmagados_quebrados" type="text" class="form-control cleanzero nosubmit posturadia" name="esmagados_quebrados"
                            value="{{ old('esmagados_quebrados', $coleta->esmagados_quebrados) }}" onkeydown="javascript:EnterTab('cama_nao_incubaveis',event)">
                        @error('esmagados_quebrados')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cama_nao_incubaveis" class="col-sm-5 col-form-label text-left"> Cama não incubáveis <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="cama_nao_incubaveis" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="cama_nao_incubaveis"
                            value="{{ old('cama_nao_incubaveis', $coleta->cama_nao_incubaveis) }}" onkeydown="javascript:EnterTab('enviar',event)">
                        @error('cama_nao_incubaveis')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="incubaveis_bons" class="col-sm-5 col-form-label text-left">Incubáveis bons <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="incubaveis_bons" type="text" class="form-control" name="incubaveis_bons"
                            value="{{ old('incubaveis_bons', $coleta->incubaveis_bons) }}" readonly>
                        @error('incubaveis_bons')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="incubaveis" class="col-sm-5 col-form-label text-left">Incubáveis <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="incubaveis" type="text" class="form-control" name="incubaveis"
                            value="{{ old('incubaveis', $coleta->incubaveis) }}" readonly>
                        @error('incubaveis')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="comerciais" class="col-sm-5 col-form-label text-left">Comerciais <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="comerciais" type="text" class="form-control" name="comerciais"
                            value="{{ old('comerciais', $coleta->comerciais) }}" readonly>
                        @error('comerciais')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="posturadia" class="col-sm-5 col-form-label text-left">Postura do Dia <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="posturadia" type="text" class="form-control" name="postura_dia"
                            value="{{ old('postura_dia', $coleta->postura_dia) }}" readonly>
                        @error('postura_dia')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col pt-2">
                <span class="text-danger">*Obrigatório</span>
            </div>
            <div class="col text-right">
                <button type="submit" class="btn btn-primary border border-white shadow mr-0" name="enviar"><i
                        class="fa fa-save"></i> Salvar</button>
            </div>
        </div>
    </div>
</form>
