@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white" style="background-color: #062142;">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fa fa-pallet"></i> Recebimentos</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('recebimentos.index') }}">Recebimentos</a></li>
                            <li class="breadcrumb-item active">Editar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('recebimentos.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('recebimentos/search')
                </div>
            </div>
        </div>
        <form id="formlote" action="{{ route('recebimentos.update', ['recebimento' => $recebimento->id_recebimento]) }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Data do recebimento <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="dataform" type="text" class="form-control" name="data_recebimento"
                            value="{{ old('data_recebimento', date('d/m/Y', strtotime($recebimento->data_recebimento))) }}">
                        @error('data_recebimento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="hora_recebimento" class="col-sm-3 col-form-label text-left">Hora do recebimento <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="hora_recebimento" type="text" class="form-control" name="hora_recebimento"
                            value="{{ old('hora_recebimento', date('H:i', strtotime($recebimento->hora_recebimento))) }}">
                        @error('hora_recebimento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lote" class="col-sm-3 col-form-label text-left">Lote <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <select id="lote_id" class="custom-select" name="lote_id">
                            <option value="">Selecione o lote</option>
                                <option value="{{ $recebimento->lotes->id_lote }}" @if ($recebimento->lotes->id_lote == $recebimento->lote_id) selected @endif>{{ $recebimento->lotes->lote }}</option>
                        </select>
                        @error('lote_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sexo_ave" class="col-sm-3 col-form-label text-left">Sexo da ave <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        @php
                            $sexo = [
                                'Fêmea' => 'Fêmea',
                                'Macho' => 'Macho'
                            ];
                        @endphp
                        <select name="sexo_ave" id="sexo_ave" class="custom-select">
                            @foreach ($sexo as $key => $value)
                                <option value="{{$key}}" @if ($recebimento->sexo == $key) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                        @error('recebimento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="quantidade" class="col-sm-3 col-form-label text-left">Quantidade (Kg) <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="quantidade" type="text" class="form-control" name="quantidade" value="{{ old('quantidade', $recebimento->quantidade) }}">
                        @error('quantidade')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nota_fiscal" class="col-sm-3 col-form-label text-left">Nota fiscal <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="nota_fiscal" type="text" class="form-control" name="nota_fiscal" value="{{ old('nota_fiscal', $recebimento->nota_fiscal) }}">
                        @error('nota_fiscal')
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
                        <button id="btnrecebimento" type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('recebimentos/scripts')
@endsection
