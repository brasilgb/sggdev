@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white" style="background-color: #062142;">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fas fa-fw fa-balance-scale"></i> Pesagens</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('pesagens.index') }}">Pesagens</a></li>
                            <li class="breadcrumb-item active">Adicionar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('pesagens.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('pesagens/search')
                </div>
            </div>
        </div>
        <form id="formpesagem" action="{{ route('pesagens.update', ['pesagem' => $pesagem->id_peso]) }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Data de pesagem <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="dataform" type="text" class="form-control" name="data_peso"
                            value="{{ old('data_peso', date('d/m/Y', strtotime($pesagem->data_peso))) }}">
                        @error('data_peso')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lote" class="col-sm-3 col-form-label text-left">Lote <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <select id="lote_id" type="text" class="custom-select" name="lote_id">
                                <option value="{{ $pesagem->lotes->id_lote }}">{{ $pesagem->lotes->lote }}</option>
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
                        <select id="id_aviario" type="text" class="custom-select" name="aviario_id">
                            <option value="{{ $pesagem->aviarios->id_aviario }}">{{ $pesagem->aviarios->aviario }}</option>
                        </select>
                        @error('aviario_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            <div class="form-group row">
                <label for="motivo" class="col-sm-3 col-form-label text-left">Semana <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <select name="semana" id="semana" class="custom-select">
                        <option value="{{ $pesagem->semanas->id_semana }}">{{ $pesagem->semanas->semana }}</option>
                    </select>
                    @error('semana')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

                <div class="form-group row">
                    <label for="macho" class="col-sm-3 col-form-label text-left">Boxes fêmeas <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex">
                        <div class="mr-2"><input id="femea_box1" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box1" value="{{ old('femea_box1', $pesagem->femea_box1) }}" placeholder="Box 1"></div>
                        <div class="mr-2"><input id="femea_box2" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box2" value="{{ old('femea_box2', $pesagem->femea_box2) }}" placeholder="Box 2"></div>
                        <div class="mr-2"><input id="femea_box3" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box3" value="{{ old('femea_box3', $pesagem->femea_box3) }}" placeholder="Box 3"></div>
                        <div><input id="femea_box4" type="text" class="form-control avesfemeas compareaves" name="femea_box4"
                                value="{{ old('femea_box4', $pesagem->femea_box4) }}" placeholder="Box 4"></div>
                        @error('macho')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="macho" class="col-sm-3 col-form-label text-left">Boxes machos <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex justify-content-center">
                        <div class="mr-2"><input id="macho_box1" type="text" class="form-control avesmachos compareaves"
                                name="macho_box1" value="{{ old('macho_box1', $pesagem->macho_box1) }}" placeholder="Box 1"></div>
                        <div class="mr-2"><input id="macho_box2" type="text" class="form-control avesmachos compareaves"
                                name="macho_box2" value="{{ old('macho_box2', $pesagem->macho_box2) }}" placeholder="Box 2"></div>
                        <div class="mr-2"><input id="macho_box3" type="text" class="form-control avesmachos compareaves"
                                name="macho_box3" value="{{ old('macho_box3', $pesagem->macho_box3) }}" placeholder="Box 3"></div>
                        <div><input id="macho_box4" type="text" class="form-control avesmachos compareaves" name="macho_box4"
                                value="{{ old('macho_box4', $pesagem->macho_box4) }}" placeholder="Box 4"></div>
                        @error('macho')
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
                        <button id="btnpesagem" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('pesagens/scripts')
@endsection
