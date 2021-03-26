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
                                <input id="coleta" type="text" class="form-control" name="coleta"
                                    value="{{ old('coleta') }}">
                                @error('coleta')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="limpos_ninho" class="col-sm-4 col-form-label text-left">Limpos de ninho <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="limpos_ninho" type="text" class="form-control" name="limpos_ninho"
                                    value="{{ old('limpos_ninho') }}">
                                @error('limpos_ninho')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sujos_ninho" class="col-sm-4 col-form-label text-left">Sujos de ninho <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="sujos_ninho" type="text" class="form-control" name="sujos_ninho"
                                    value="{{ old('sujos_ninho') }}">
                                @error('sujos_ninho')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ovos_cama" class="col-sm-4 col-form-label text-left">Ovos de cama <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="ovos_cama" type="text" class="form-control" name="ovos_cama"
                                    value="{{ old('ovos_cama') }}">
                                @error('ovos_cama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="duas_gemas" class="col-sm-4 col-form-label text-left">Duas gemas <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="duas_gemas" type="text" class="form-control" name="duas_gemas"
                                    value="{{ old('duas_gemas') }}">
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
                                <input id="refugos" type="text" class="form-control" name="refugos"
                                    value="{{ old('refugos') }}">
                                @error('refugos')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deformados" class="col-sm-4 col-form-label text-left">Deformados <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="deformados" type="text" class="form-control" name="deformados"
                                    value="{{ old('deformados') }}">
                                @error('deformados')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sujos_cama" class="col-sm-4 col-form-label text-left">Sujos de cama <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="sujos_cama" type="text" class="form-control" name="sujos_cama"
                                    value="{{ old('sujos_cama') }}">
                                @error('sujos_cama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="trincados" class="col-sm-4 col-form-label text-left">Trincados <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="trincados" type="text" class="form-control" name="trincados"
                                    value="{{ old('trincados') }}">
                                @error('trincados')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="eliminados" class="col-sm-4 col-form-label text-left">Eliminados <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="eliminados" type="text" class="form-control" name="eliminados"
                                    value="{{ old('eliminados') }}">
                                @error('eliminados')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="incubaveis_bons" class="col-sm-4 col-form-label text-left">Incubáveis bons <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="incubaveis_bons" type="text" class="form-control" name="incubaveis_bons"
                                    value="{{ old('incubaveis_bons') }}">
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
                                    value="{{ old('incubaveis') }}">
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
                                    value="{{ old('comerciais') }}">
                                @error('comerciais')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postura_dia" class="col-sm-4 col-form-label text-left">Postura do Dia <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="postura_dia" type="text" class="form-control" name="postura_dia"
                                    value="{{ old('postura_dia') }}">
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
                        <button type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(function(){
            $("#lote_id").change(function(){
                idlote = $(this).val();
                alert(idlote);
            });
        });
        // Valida form add semnas
        $("#formcoleta").validate({
            rules: {
                data_coleta: {
                    required: true
                },
                hora_coleta: {
                    required: true,
                },
                lote_id: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                id_aviario: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                coleta: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                limpos_ninho: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                sujos_ninho: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                ovos_cama: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                duas_gemas: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                refugos: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                deformados: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                sujos_cama: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                trincados: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                eliminados: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                incubaveis_bons: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                incubaveis: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                comerciais: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                postura_dia: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                }
            },
            messages: {
                data_coleta: 'Selecione uma data para o coleta!',
                hora_coleta: 'Selecione uma hora para o coleta!',
                lote_id: {
                    required: 'Selecione o lote!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                id_aviario: {
                    required: 'Selecione o lote e/ou aviário!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                coleta: {
                    required: 'Insira o número da coleta!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                limpos_ninho: {
                    required: 'Insira os ovos limpos de ninho!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                sujos_ninho: {
                    required: 'Insira os ovos sujos de ninho!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                ovos_cama: {
                    required: 'Insira os ovos de cama!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                duas_gemas: {
                    required: 'Insira os ovos com duas gemas!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                refugos: {
                    required: 'Insira os ovos de refugo!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                deformados: {
                    required: 'Insira os ovos deformados!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                sujos_cama: {
                    required: 'Insira os ovos sujos de cama!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                trincados: {
                    required: 'Insira os ovos trincados!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                eliminados: {
                    required: 'Insira os ovos eliminados!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                incubaveis_bons: {
                    required: 'Insira os ovos incubáveis bons!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                incubaveis: {
                    required: 'Insira os ovos incubáveis!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                comerciais: {
                    required: 'Insira os ovos comerciais!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                },
                postura_dia: {
                    required: 'Insira a postura do dia!',
                    digits: true,
                    notEqual: 'Insira valores maior que "0"!'
                }
            }
        });
        jQuery.validator.addMethod("notEqual", function(value, element,
            param) { // Adding rules for Amount(Not equal to zero)
            return this.optional(element) || value != '0';
        });

    </script>
@endsection
