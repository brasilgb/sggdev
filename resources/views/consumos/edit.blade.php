@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white" style="background-color: #062142;">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fas fa-fw fa-leaf"></i> Consumos</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('consumos.index') }}">Consumos</a></li>
                            <li class="breadcrumb-item active">Adicionar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('consumos.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('consumos/search')
                </div>
            </div>
        </div>
        <form id="formlote" action="{{ route('consumos.update', ['consumo' => $consumo->id_consumo]) }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Data do abastecimento <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="dataform" type="text" class="form-control" name="data_consumo"
                            value="{{ old('data_consumo', date('d/m/Y', strtotime($consumo->data_consumo))) }}">
                        @error('data_consumo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lote" class="col-sm-3 col-form-label text-left">Lote <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <select id="lote_id" type="text" class="custom-select" name="lote_id">
                                <option value="{{ $consumo->lotes->id_lote }}" @if($consumo->lote_id == $consumo->lotes->id_lote) selected @endif>{{ $consumo->lotes->lote }}</option>
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
                            <option value="{{ $consumo->aviarios->id_aviario }}" @if($consumo->aviario_id == $consumo->aviarios->id_aviario) selected @endif>{{ $consumo->aviarios->aviario }}</option>
                        </select>
                        @error('aviario_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="macho" class="col-sm-3 col-form-label text-left">Boxes fêmeas (Kg em ração) <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex">
                        <div class="mr-2"><input id="femea_box1" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box1" value="{{ old('femea_box1', $consumo->femea_box1) }}" placeholder="Box 1" ></div>
                        <div class="mr-2"><input id="femea_box2" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box2" value="{{ old('femea_box2', $consumo->femea_box2) }}" placeholder="Box 2" ></div>
                        <div class="mr-2"><input id="femea_box3" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box3" value="{{ old('femea_box3', $consumo->femea_box3) }}" placeholder="Box 3" ></div>
                        <div><input id="femea_box4" type="text" class="form-control avesfemeas compareaves" name="femea_box4"
                                value="{{ old('femea_box4', $consumo->femea_box4) }}" placeholder="Box 4" ></div>
                        @error('macho')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="macho" class="col-sm-3 col-form-label text-left">Boxes machos (Kg em ração)<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex justify-content-center">
                        <div class="mr-2"><input id="macho_box1" type="text" class="form-control avesmachos compareaves"
                                name="macho_box1" value="{{ old('macho_box1', $consumo->macho_box1) }}" placeholder="Box 1" ></div>
                        <div class="mr-2"><input id="macho_box2" type="text" class="form-control avesmachos compareaves"
                                name="macho_box2" value="{{ old('macho_box2', $consumo->macho_box2) }}" placeholder="Box 2" ></div>
                        <div class="mr-2"><input id="macho_box3" type="text" class="form-control avesmachos compareaves"
                                name="macho_box3" value="{{ old('macho_box3', $consumo->macho_box3) }}" placeholder="Box 3" ></div>
                        <div><input id="macho_box4" type="text" class="form-control avesmachos compareaves" name="macho_box4"
                                value="{{ old('macho_box4', $consumo->macho_box4) }}" placeholder="Box 4" ></div>
                        @error('macho')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="femea" class="col-sm-3 col-form-label text-left">Fêmea/macho (Kg em ração) <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex justify-content-init">
                        <div class="mr-2 flex-fill">
                            <input id="avesfemeas" type="text" class="form-control mr-2" name="femea"
                                value="{{ old('femea', $consumo->femea) }}" placeholder="Fêmeas" readonly>
                        </div>
                        <div class="flex-fill">
                            <input id="avesmachos" type="text" class="form-control" name="macho"
                                value="{{ old('macho', $consumo->macho) }}" placeholder="Machos" readonly>
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
                        <button id="btnconsumo" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('consumos/scripts')
@endsection
