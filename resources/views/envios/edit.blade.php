@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fa fa-truck"></i> Envios</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('envios.index') }}">Envios</a></li>
                            <li class="breadcrumb-item active">Editar </a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('envios.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('envios/search')
                </div>
            </div>
        </div>
        <form id="formlote" action="{{ route('envios.update', ['envio' => $envio->id_envio]) }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Data <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="dataform" type="text" class="form-control" name="data_envio"
                            value="{{ old('data_envio', date('d/m/Y', strtotime($envio->data_envio))) }}">
                        @error('data_envio')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Hora <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="hora_envio" type="text" class="form-control" name="hora_envio"
                            value="{{ old('hora_envio', date('H:i', strtotime($envio->hora_envio))) }}">
                        @error('data_envio')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lote" class="col-sm-3 col-form-label text-left">Lote <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <select id="lote_id" type="text" class="custom-select" name="lote_id">
                                <option value="{{ $envio->lotes->id_lote }}">{{ $envio->lotes->lote }}</option>
                        </select>
                        @error('lote_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lote" class="col-sm-3 col-form-label text-left">Incubáveis <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="incubaveis" type="text" class="form-control totalenvio compareovos" name="incubaveis"
                            value="{{ old('incubaveis', $envio->incubaveis) }}">
                            <input type="hidden" id="incubaveisdb" value="{{$envio->incubaveis}}">
                        <div id="dbincubaveis" class="bg-warning text-dark p-2 rounded-bottom border"
                            style="border: 1px solid #ced4da!important;display:none;"></div>
                        @error('incubaveis')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lote" class="col-sm-3 col-form-label text-left">Comerciais <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="comerciais" type="text" class="form-control totalenvio compareovos" name="comerciais"
                            value="{{ old('comerciais', $envio->comerciais) }}">
                            <input type="hidden" id="comerciaisdb" value="{{$envio->comerciais}}">
                        <div id="dbcomerciais" class="bg-warning text-dark p-2 rounded-bottom border"
                            style="border: 1px solid #ced4da!important;display:none;"></div>
                        @error('comerciais')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lote" class="col-sm-3 col-form-label text-left">Envio total <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="postura_dia" type="text" class="form-control" name="postura_dia"
                            value="{{ old('postura_dia', $envio->postura_dia) }}" readonly>
                        <div id="dbpostura" class="bg-warning text-dark p-2 rounded-bottom border"
                            style="border: 1px solid #ced4da!important;display:none;"></div>
                        @error('postura_dia')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col pt-2">
                        <span class="text-danger">*Obrigatório</span>
                    </div>
                    <div class="col text-right">
                        <button id="btnenvio" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('envios/scripts')
    <script>
            $(function() {
            loteid = $("#lote_id").val();
            if (loteid) {
                $.ajax({
                    url: "{{ route('envios.ovoslote') }}",
                    dataType: "JSON",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        loteid: loteid
                    }
                }).done(function(response) {

                    $("#incubaveis, #comerciais").attr("style",
                        "border-radius: 0.2rem 0.25rem 0 0!important");
                    $("#dbincubaveis").fadeIn().html(
                        'Incubáveis disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.incubaveis + '</span>');
                    $("#dbcomerciais").fadeIn().html(
                        'Comerciais disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.comerciais + '</span>');
                });
            }
    });
    </script>
@endsection
