@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white" style="background-color: #062142;">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fas fa-fw fa-calendar-day"></i> Controle diário</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('lotes.index') }}">Controle diário</a></li>
                            <li class="breadcrumb-item active">Adicionar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('controlediarios.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('controlediarios/search')
                </div>
            </div>
        </div>
        <form id="formlote" action="{{ route('controlediarios.store') }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")
                <div class="alert alert-danger leitura-inicial-0" style="display: none;">
                    <i class="fa fa-exclamation-triangle"></i> Não há leitura anterior para este aviário, inicialmente os cálculos de consumo total e por ave estarão zerados, preencha com os dados de leitura do início do alojamento das aves.
                </div>
                @method('POST')
                @csrf

                    <div class="form-group row">
                        <label for="dataform" class="col-sm-3 col-form-label text-left">Data de leitura <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input id="dataform" type="text" class="form-control" name="data_controle"
                                value="{{ old('data_controle', date('d/m/Y', strtotime(now()))) }}">
                            @error('data_controle')
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
                        <label for="id_aviario" class="col-sm-3 col-form-label text-left">Aviário <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <select id="id_aviario" type="text" class="custom-select" name="aviario">
                                <option value="">Selecione o lote</option>
                            </select>
                            @error('aviario')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="temperatura_min" class="col-sm-3 col-form-label text-left">Temperatura (Min/Max) <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7 d-flex justify-content-init">
                            <div class="mr-2 flex-fill">
                                <input id="temperatura_min" type="text" class="form-control mr-2" name="temperatura_min"
                                    value="{{ old('temperatura_min') }}" placeholder="Min">
                            </div>
                            <div class="flex-fill">
                                <input id="temperatura_max" type="text" class="form-control" name="temperatura_max"
                                    value="{{ old('temperatura_max') }}" placeholder="Max">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="umidade" class="col-sm-3 col-form-label text-left">Umidade (%) <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input id="umidade" type="text" class="form-control" name="umidade"
                                value="{{ old('umidade') }}">
                            @error('umidade')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="leitura_agua" class="col-sm-3 col-form-label text-left">Leitura da água <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input id="leitura_agua" type="text" class="form-control" name="leitura_agua"
                                value="{{ old('leitura_agua') }}">
                            @error('leitura_agua')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="consumo" class="col-sm-3 col-form-label text-left">Consumo (Total/P. Ave) <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7 d-flex justify-content-init">
                            <div class="mr-2 flex-fill">
                                <input id="consumo_total" type="text" class="form-control mr-2" name="consumo_total"
                                    value="{{ old('consumo_total') }}" placeholder="Consumo total" readonly>
                            </div>
                            <div class="flex-fill">
                                <input id="consumo_ave" type="text" class="form-control" name="consumo_ave"
                                    value="{{ old('consumo_ave') }}" placeholder="Por ave" readonly>
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
                        <button id="btncontrolediario" type="submit"
                            class="btn btn-primary border border-white shadow mr-0"><i class="fa fa-save"></i>
                            Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('controlediarios/scripts')
    <script>
        $(function(){
            $("#id_aviario").change(function(){
                idlote = $("#lote_id").val();
                idaviario = $(this).val();
                // alert(idlote + ' -- ' + idaviario);
                $.ajax({
                    url: "{{ route('controlediarios.verificacontrole') }}",
                    type: 'POST',
                    dataType: 'JSON',
                    data:{
                        _token: "{{ csrf_token() }}",
                        idlote: idlote,
                        idaviario:idaviario
                        }
                }).done(function(response){
                    if(response.leitura > 0){
                        var aves = parseInt(response.aves);
                        var leitura_anterior = parseInt(response.leitura_anterior)
                        $("#leitura_agua").keyup(function (e) {
                            e.preventDefault();
                            leitura_atual = $(this).val();
                            $("#consumo_total").val(leitura_atual - leitura_anterior);
                            $("#consumo_ave").val(((leitura_atual - leitura_anterior)/aves).toFixed(2));
                        });
                    }else{
                    $(".leitura-inicial-0").show('fade');
                    $("#consumo_total, #consumo_ave").val(0);
                    }

                });
            });
        });
    </script>
@endsection

