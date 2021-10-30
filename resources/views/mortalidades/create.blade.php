@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fas fa-fw fa-kiwi-bird"></i> Mortalidades</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('mortalidades.index') }}">Mortalidades</a></li>
                            <li class="breadcrumb-item active">Adicionar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('mortalidades.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('mortalidades/search')
                </div>
            </div>
        </div>
        <form id="formlote" action="{{ route('mortalidades.store') }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('POST')
                @csrf

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Data da baixa <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="dataform" type="text" class="form-control" name="data_mortalidade"
                            value="{{ old('data_mortalidade', date('d/m/Y', strtotime(now()))) }}">
                        @error('data_mortalidade')
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
                        <select id="id_aviario" type="text" class="custom-select" name="id_aviario">
                            <option value="">Selecione o lote</option>
                        </select>
                        @error('id_aviario')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @php
                $causas = [
                    '1' => 'Arranhado',
                    '2' => 'Calor',
                    '3' => 'Inprodutiva',
                    '4' => 'Prolapso',
                    '5' => 'Refugo',
                    '6' => 'Outros'
                ]
            @endphp

            <div class="form-group row">
                <label for="motivo" class="col-sm-3 col-form-label text-left">Causa <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <select name="motivo" id="motivo" class="custom-select">
                        <option value="">Selecione a causa</option>
                        @foreach ($causas as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('motivo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

                <div class="form-group row">
                    <label for="macho" class="col-sm-3 col-form-label text-left">Boxes fêmeas <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7 d-flex">
                        <div class="mr-2"><input id="femea_box1" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box1" value="{{ old('femea_box1') }}" placeholder="Box 1" disabled></div>
                        <div class="mr-2"><input id="femea_box2" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box2" value="{{ old('femea_box2') }}" placeholder="Box 2" disabled></div>
                        <div class="mr-2"><input id="femea_box3" type="text" class="form-control mr-2 avesfemeas compareaves"
                                name="femea_box3" value="{{ old('femea_box3') }}" placeholder="Box 3" disabled></div>
                        <div><input id="femea_box4" type="text" class="form-control avesfemeas compareaves" name="femea_box4"
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
                        <div class="mr-2"><input id="macho_box1" type="text" class="form-control avesmachos compareaves"
                                name="macho_box1" value="{{ old('macho_box1') }}" placeholder="Box 1" disabled></div>
                        <div class="mr-2"><input id="macho_box2" type="text" class="form-control avesmachos compareaves"
                                name="macho_box2" value="{{ old('macho_box2') }}" placeholder="Box 2" disabled></div>
                        <div class="mr-2"><input id="macho_box3" type="text" class="form-control avesmachos compareaves"
                                name="macho_box3" value="{{ old('macho_box3') }}" placeholder="Box 3" disabled></div>
                        <div><input id="macho_box4" type="text" class="form-control avesmachos compareaves" name="macho_box4"
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
                                <input id="femeadb" type="hidden" value="0">
                            <div id="dbfemea" class="bg-warning text-dark p-2 rounded-bottom border"
                                style="border: 1px solid #ced4da!important;display:none;"></div>
                        </div>
                        <div class="flex-fill">
                            <input id="avesmachos" type="text" class="form-control" name="macho"
                                value="{{ old('macho') }}" placeholder="Machos" readonly>
                                <input id="machodb" type="hidden" value="0">
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
                        <button id="btnmortalidade" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('mortalidades/scripts')
@endsection
