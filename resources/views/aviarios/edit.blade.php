@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fa fa-cube"></i> Aviarios</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('aviarios.index') }}">Aviários</a></li>
                            <li class="breadcrumb-item active">Editar</a></li>
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
        <form id="formlote" action="{{ route('aviarios.update', ['aviario' => $aviario->id_aviario]) }}" method="post">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Data de entrada do aviario <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="dataform" type="text" class="form-control" name="data_aviario"
                            value="{{ old('data_aviario', date('d/m/Y', strtotime($aviario->data_aviario))) }}">
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
                                <option value="{{ $aviario->lote_id }}" @if($aviario->lote_id == $aviario->lotes->id_lote) selected @endif>{{ $aviario->lotes->lote }}</option>
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
                        <input id="aviario" type="text" class="form-control" name="aviario" value="{{ old('aviario', $aviario->aviario) }}">
                        @error('aviario')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="macho" class="col-sm-3 col-form-label text-left">Boxes fêmeas <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex">
                        <div class="mr-2"><input id="femea_box1" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box1" value="{{ old('femea_box1', $aviario->femea_box1) }}" placeholder="Box 1"></div>
                        <div class="mr-2"><input id="femea_box2" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box2" value="{{ old('femea_box2', $aviario->femea_box2) }}" placeholder="Box 2"></div>
                        <div class="mr-2"><input id="femea_box3" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box3" value="{{ old('femea_box3', $aviario->femea_box3) }}" placeholder="Box 3"></div>
                        <div><input id="femea_box4" type="text" class="form-control avesfemeas compareaves" name="femea_box4"
                                value="{{ old('femea_box4', $aviario->femea_box4) }}" placeholder="Box 4"></div>
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
                                name="macho_box1" value="{{ old('macho_box1', $aviario->macho_box1) }}" placeholder="Box 1"></div>
                        <div class="mr-2"><input id="macho_box2" type="text" class="form-control avesmachos compareaves"
                                name="macho_box2" value="{{ old('macho_box2', $aviario->macho_box2) }}" placeholder="Box 2"></div>
                        <div class="mr-2"><input id="macho_box3" type="text" class="form-control avesmachos compareaves"
                                name="macho_box3" value="{{ old('macho_box3', $aviario->macho_box3) }}" placeholder="Box 3"></div>
                        <div><input id="macho_box4" type="text" class="form-control avesmachos compareaves" name="macho_box4"
                                value="{{ old('macho_box4', $aviario->macho_box4) }}" placeholder="Box 4"></div>
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
                                value="{{ old('femea', $aviario->femea) }}" placeholder="Fêmeas" readonly>
                                <input id="femeadb" type="hidden" value="{{ $aviario->femea }}">
                            <div id="dbfemea" class="bg-warning text-dark p-2 rounded-bottom border"
                                style="border: 1px solid #ced4da!important;display:none;"></div>
                        </div>
                        <div class="flex-fill">
                            <input id="avesmachos" type="text" class="form-control" name="macho"
                                value="{{ old('macho', $aviario->macho) }}" placeholder="Machos" readonly>
                                <input id="machodb" type="hidden" value="{{ $aviario->macho }}">
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
                        <button id="btnaviario" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('aviarios/scripts')
@endsection
