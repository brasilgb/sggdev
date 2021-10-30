@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fa fa-cubes"></i> Lotes</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"> <a href="{{ route('lotes.index') }}">Lotes</a></li>
                            <li class="breadcrumb-item active">Adicionar</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button onclick="window.location='{{ route('lotes.index') }}'"
                        class="btn btn-primary shadow-sm border-white"><i class="fa fa-angle-left"></i> Voltar</button>
                </div>

                <div class="col">
                    @include('lotes/search')
                </div>
            </div>
        </div>
        <form id="formlote" action="{{ route('lotes.store') }}" method="post" autocomplete="off">
            <div class="card-body px-4">
                @include("parts/flash-message")

                @method('POST')
                @csrf

                <div class="form-group row">
                    <label for="dataform" class="col-sm-3 col-form-label text-left">Data de entrada do lote <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="dataform" type="text" class="form-control" name="data_lote"
                            value="{{ old('data_lote', date('d/m/Y', strtotime(now()))) }}">
                        @error('data_lote')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lote" class="col-sm-3 col-form-label text-left">Identificação do lote <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="lote" type="text" class="form-control" name="lote" value="{{ old('lote') }}">
                        @error('lote')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="femea" class="col-sm-3 col-form-label text-left">Aves fêmeas <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="femea" type="text" class="form-control" name="femea" value="{{ old('femea') }}">
                        @error('femea')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="macho" class="col-sm-3 col-form-label text-left">Aves machos <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        <input id="macho" type="text" class="form-control" name="macho" value="{{ old('macho') }}">
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
                        <button type="submit" class="btn btn-primary border border-white shadow mr-0"><i
                                class="fa fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        // Valida form add semnas
        $("#formlote").validate({
            rules: {
                data_lote: {
                    required: true
                },
                lote: {
                    required: true,
                    remote: {
                        url: "{{ route('lotes.checklote') }}",
                        type: "post",
                        data: {
                            _token: function() {
                                return "{{ csrf_token() }}"
                            },
                            lote: function() {
                                return $("#lote").val();
                            }
                        }
                    }
                },
                femea: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                },
                macho: {
                    required: true,
                    digits: true,
                    notEqual: '0'
                }
            },
            messages: {
                data_lote: 'notEqual: 'Insira valores maior que "0"!'Selecione uma data para o lote!',
                lote: {
                    required: 'notEqual: 'Insira valores maior que "0"!'Insira uma identificação para o lote!',
                    remote: 'notEqual: 'Insira valores maior que "0"!'Identificação do lote em uso, escolha outra!'
                },
                femea: {
                    required: 'notEqual: 'Insira valores maior que "0"!'Insira o número de fêmeas para o lote!',
                    digits: 'notEqual: 'Insira valores maior que "0"!'Insira somente números inteiros!',
                    notEqual: 'notEqual: 'Insira valores maior que "0"!'Insira valores maior que "0"!'
                },
                macho: {
                    required: 'notEqual: 'Insira valores maior que "0"!'Insira o número de machos para o lote!',
                    digits: 'notEqual: 'Insira valores maior que "0"!'Insira somente números inteiros!',
                    notEqual: 'notEqual: 'Insira valores maior que "0"!'Insira valores maior que "0"!'

                }
            }
        });
        jQuery.validator.addMethod("notEqual", function(value, element, param) { // Adding rules for Amount(Not equal to zero)
            return this.optional(element) || value != '0';
        });

    </script>
@endsection
