@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white" style="background-color: #062142;">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fa fa-cube"></i> Aviários</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('lotes.index') }}">Aviários</a></li>
                            <li class="breadcrumb-item active">Adicionar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('aviarios.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('aviarios/search')
                </div>
            </div>
        </div>
        <form id="formlote" action="{{ route('aviarios.store') }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('POST')
                @csrf

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Data de entrada do aviario <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="dataform" type="text" class="form-control" name="data_aviario"
                            value="{{ old('data_aviario', date('d/m/Y', strtotime(now()))) }}">
                        @error('data_aviario')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lote" class="col-sm-3 col-form-label text-left">Lote <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
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
                    <label for="lote" class="col-sm-3 col-form-label text-left">Identificação do aviário <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="aviario" type="text" class="form-control" name="aviario" value="{{ old('aviario') }}">
                        @error('aviario')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="macho" class="col-sm-3 col-form-label text-left">Boxes fêmeas <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex">
                        <div class="mr-2"><input id="femea_box1" type="text" class="form-control mr-2 avesfemeas"
                                name="femea_box1" value="{{ old('femea_box1') }}" placeholder="Box 1" disabled></div>
                        <div class="mr-2"><input id="femea_box2" type="text" class="form-control mr-2 avesfemeas"
                                name="femea_box2" value="{{ old('femea_box2') }}" placeholder="Box 2" disabled></div>
                        <div class="mr-2"><input id="femea_box3" type="text" class="form-control mr-2 avesfemeas"
                                name="femea_box3" value="{{ old('femea_box3') }}" placeholder="Box 3" disabled></div>
                        <div><input id="femea_box4" type="text" class="form-control avesfemeas" name="femea_box4"
                                value="{{ old('femea_box4') }}" placeholder="Box 4" disabled></div>
                        @error('macho')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="macho" class="col-sm-3 col-form-label text-left">Boxes machos <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex justify-content-center">
                        <div class="mr-2"><input id="macho_box1" type="text" class="form-control avesmachos"
                                name="macho_box1" value="{{ old('macho_box1') }}" placeholder="Box 1" disabled></div>
                        <div class="mr-2"><input id="macho_box2" type="text" class="form-control avesmachos"
                                name="macho_box2" value="{{ old('macho_box2') }}" placeholder="Box 2" disabled></div>
                        <div class="mr-2"><input id="macho_box3" type="text" class="form-control avesmachos"
                                name="macho_box3" value="{{ old('macho_box3') }}" placeholder="Box 3" disabled></div>
                        <div><input id="macho_box4" type="text" class="form-control avesmachos" name="macho_box4"
                                value="{{ old('macho_box4') }}" placeholder="Box 4" disabled></div>
                        @error('macho')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="femea" class="col-sm-3 col-form-label text-left">Aves fêmeas/macho <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex justify-content-init">
                        <div class="mr-2 flex-fill">
                            <input id="avesfemeas" type="text" class="form-control mr-2" name="femea"
                                value="{{ old('femea') }}" placeholder="Fêmeas" readonly>
                                <div id="dbfemea" class="bg-warning text-dark p-2 rounded-bottom border" style="border: 1px solid #ced4da!important;display:none;"></div>
                        </div>
                        <div class="flex-fill">
                            <input id="avesmachos" type="text" class="form-control" name="macho"
                                value="{{ old('macho') }}" placeholder="Machos" readonly>
                                <div id="dbmacho" class="bg-warning text-dark p-2 rounded-bottom border" style="border: 1px solid #ced4da!important;display:none;"></div>
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
        $(function() {
            $("#lote_id").change(function(e) {
                e.preventDefault();
                loteid = $(this).val();
                if(loteid){
                $.ajax({
                    url: "{{ route('aviarios.aviarioslote') }}",
                    dataType: "JSON",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        loteid: loteid
                    }
                }).done(function(response) {

                    $("#femea_box1, #femea_box2, #femea_box3, #femea_box4, #macho_box1, #macho_box2, #macho_box3, #macho_box4").attr('disabled', false);
                    $("#avesfemeas, #avesmachos").attr("style", "border-radius: 0.2rem 0.25rem 0 0!important");
                    $("#dbfemea").fadeIn().html('Fêmeas disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' + response.femea + '</span>');
                    $("#dbmacho").fadeIn().html('Machos disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' + response.macho + '</span>');

                });
                }else{
                    location.reload();
                }
            });
        });
        // Valida form add semnas
        $("#formlote").validate({
            rules: {
                data_aviario: {
                    required: true
                },
                lote_id: {
                    required: true
                },
                aviario: {
                    required: true
                },
                femea_box1: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                macho_box1: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                }
            },
            messages: {
                data_aviario: 'Selecione uma data para o aviario!',
                lote_id: {
                    required: 'Selecione o lote do aviário!'
                },
                aviario: {
                    required: 'Digite a identificação do aviário!'
                },
                femea_box1: {
                    required: 'Digite o n° de fêmeas!',
                    digits: 'Somente inteiros!',
                    notEqual: 'Insira maior que "0"!'
                },
                macho_box1: {
                    required: 'Digite o n° de machos!',
                    digits: 'Somente inteiros!',
                    notEqual: 'Insira maior que "0"!'

                }
            }
        });
        jQuery.validator.addMethod("notEqual", function(value, element,
            param) { // Adding rules for Amount(Not equal to zero)
            return this.optional(element) || value != '0';
        });


        $(".avesfemeas").keyup(function() {
            var femeas = 0;
            $(".avesfemeas").each(function(index, element) {
                if ($(element).val()) {
                    femeas += parseInt($(element).val());
                }
            });
            $("#avesfemeas").val(femeas);
        });

        $(".avesmachos").keyup(function() {
            var machos = 0;
            $(".avesmachos").each(function(index, element) {
                if ($(element).val()) {
                    machos += parseInt($(element).val());
                }
            });
            $("#avesmachos").val(machos);
        });

    </script>
@endsection
