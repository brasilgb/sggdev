@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white" style="background-color: #062142;">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fa fa-cart-plus"></i> Coletas</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('coletas.index') }}">Coletas</a></li>
                            <li class="breadcrumb-item active">Adicionar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('coletas.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('coletas/search')
                </div>
            </div>
        </div>
        <form id="formcoleta" action="{{ route('coletas.store') }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('POST')
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="dataform" class="col-sm-4 col-form-label text-left">Data da coleta <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="dataform" type="text" class="form-control" name="data_coleta"
                                    value="{{ old('data_coleta', date('d/m/Y', strtotime(now()))) }}">
                                @error('data_coleta')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hora_coleta" class="col-sm-4 col-form-label text-left">Hora da coleta <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="hora_coleta" type="text" class="form-control" name="hora_coleta"
                                    value="{{ old('hora_coleta', date('H:i', strtotime(now()))) }}">
                                @error('hora_coleta')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lote_id" class="col-sm-4 col-form-label text-left">Lote <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select id="lote_id" type="text" class="custom-select" name="lote_id">
                                    <option value="">Selecione o lote</option>
                                    @foreach ($lotes as $lote)
                                        <option value="{{ $lote->id_lote }}">{{ $lote->lote }}</option>
                                    @endforeach
                                </select>
                                @error('lote_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_aviario" class="col-sm-4 col-form-label text-left">Aviários <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select id="id_aviario" type="text" class="custom-select" name="id_aviario">
                                    <option value="">Selecione o lote</option>
                                </select>
                                @error('id_aviario')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coleta" class="col-sm-4 col-form-label text-left">Coleta n° <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="coleta" type="text" class="form-control font-weight-bold" name="coleta"
                                    value="{{ old('coleta') }}" readonly>
                                @error('coleta')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="limpos_ninho" class="col-sm-4 col-form-label text-left">Limpos de ninho <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="limpos_ninho" type="text" class="form-control cleanzero nosubmit  incubaveisbons incubaveis posturadia" name="limpos_ninho"
                                    value="{{ old('limpos_ninho', '0') }}" onkeydown="javascript:EnterTab('sujos_ninho',event)">
                                @error('limpos_ninho')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sujos_ninho" class="col-sm-4 col-form-label text-left">Sujos de ninho <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="sujos_ninho" type="text" class="form-control cleanzero nosubmit incubaveisbons incubaveis posturadia" name="sujos_ninho"
                                    value="{{ old('sujos_ninho', '0') }}" onkeydown="javascript:EnterTab('ovos_cama',event)">
                                @error('sujos_ninho')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ovos_cama" class="col-sm-4 col-form-label text-left">Ovos de cama <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="ovos_cama" type="text" class="form-control cleanzero nosubmit incubaveis posturadia" name="ovos_cama"
                                    value="{{ old('ovos_cama', '0') }}" onkeydown="javascript:EnterTab('duas_gemas',event)">
                                @error('ovos_cama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="duas_gemas" class="col-sm-4 col-form-label text-left">Duas gemas <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="duas_gemas" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="duas_gemas"
                                    value="{{ old('duas_gemas', '0') }}" onkeydown="javascript:EnterTab('refugos',event)">
                                @error('duas_gemas')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group row">
                            <label for="refugos" class="col-sm-4 col-form-label text-left">Refugos <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="refugos" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="refugos"
                                    value="{{ old('refugos', '0') }}" onkeydown="javascript:EnterTab('deformados',event)">
                                @error('refugos')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deformados" class="col-sm-4 col-form-label text-left">Deformados <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="deformados" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="deformados"
                                    value="{{ old('deformados', '0') }}" onkeydown="javascript:EnterTab('sujos_cama',event)">
                                @error('deformados')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sujos_cama" class="col-sm-4 col-form-label text-left">Sujos de cama <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="sujos_cama" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="sujos_cama"
                                    value="{{ old('sujos_cama', '0') }}" onkeydown="javascript:EnterTab('trincados',event)">
                                @error('sujos_cama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="trincados" class="col-sm-4 col-form-label text-left">Trincados <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="trincados" type="text" class="form-control cleanzero nosubmit comerciais posturadia" name="trincados"
                                    value="{{ old('trincados', '0') }}" onkeydown="javascript:EnterTab('eliminados',event)">
                                @error('trincados')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="eliminados" class="col-sm-4 col-form-label text-left">Eliminados <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="eliminados" type="text" class="form-control cleanzero nosubmit posturadia" name="eliminados"
                                    value="{{ old('eliminados', '0') }}" onkeydown="javascript:EnterTab('enviar',event)">
                                @error('eliminados')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="incubaveisbons" class="col-sm-4 col-form-label text-left">Incubáveis bons <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="incubaveisbons" type="text" class="form-control" name="incubaveis_bons"
                                    value="{{ old('incubaveis_bons', '0') }}" readonly>
                                @error('incubaveis_bons')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="incubaveis" class="col-sm-4 col-form-label text-left">Incubáveis <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="incubaveis" type="text" class="form-control" name="incubaveis"
                                    value="{{ old('incubaveis', '0') }}" readonly>
                                @error('incubaveis')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comerciais" class="col-sm-4 col-form-label text-left">Comerciais <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="comerciais" type="text" class="form-control" name="comerciais"
                                    value="{{ old('comerciais', '0') }}" readonly>
                                @error('comerciais')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="posturadia" class="col-sm-4 col-form-label text-left">Postura do Dia <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="posturadia" type="text" class="form-control" name="postura_dia"
                                    value="{{ old('postura_dia', '0') }}" readonly>
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
    </div>
    @include('coletas/scripts')
@endsection
