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
                            <li class="breadcrumb-item active">
                                @if (isset($busca)) <a
                                    href="{{ route('coletas.index') }}">Coletas</a> / Busca @else Coletas @endif
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                        <button onclick="window.location='{{ route('coletas.create') }}'"
                            class="btn btn-primary shadow-sm border-white"><i class="fa fa-plus"></i> Adicionar</button>
                </div>

                <div class="col">
                    @include('coletas/search')
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                @include("parts/flash-message")
                <table id="tb-coletas" class="table table-condensed table-striped mb-0">
                    <thead>
                        <tr class="text-left">
                            <th>Coleta</th>
                            <th>Lote</th>
                            <th>Aviário</th>
                            <th>Incubáveis</th>
                            <th>Comerciais</th>
                            <th>Postura Dia</th>
                            <th>Data Hora</th>
                            <th style="width: 314px; min-width: 314px;"><i class="fa fa-level-down-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coletas as $coleta)

                            <tr class="text-left">
                                <td class="align-middle">{{ $coleta->coleta }}</td>
                                <td class="align-middle">{{ $coleta->lote }}</td>
                                <td class="align-middle">{{ $coleta->aviario }}</td>
                                <td class="align-middle">{{ $coleta->incubaveis }}</td>
                                <td class="align-middle">{{ $coleta->comerciais }}</td>
                                <td class="align-middle">{{ $coleta->postura_dia }}</td>
                                <td class="align-middle">{{ date('d/m/Y', strtotime($coleta->data_coleta)) }}</td>
                                <td class="align-middle">

                                    <button onclick="window.location='{{ route('coletas.edit', ['coleta' => $coleta->id_coleta]) }}'"
                                        id="situacao" class="btn btn-primary border border-white shadow"><i
                                            class="fa fa-edit"></i> Editar</button>

                                    <button class="btn btn-danger border border-white shadow" data-toggle="modal"
                                        onclick="deleteData({{ $coleta->id_coleta }})" data-target="#DeleteModal"><i
                                            class="fa fa-trash"></i> Excluir</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="alert alert-danger text-left"><i class="fa fa-exclamation-triangle"></i>
                                    @if (isset($busca))
                                        Não foram encontrados dados que correspondam com sua busca!
                                    @else
                                        Não há coletas cadastradas, adicione um coleta!
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($coletas->hasPages())
            <div class="card-footer pb-0">
                {{ $coletas->links() }}
            </div>
        @endif
    </div>

    <div id="DeleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-danger">
                        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Confirmar exclusão</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <p class="text-center">Tem certeza de que deseja excluir este coleta?<br>
                            <strong class="text-red">ATENÇÂO</strong><br> Será ecluido o coletas, os aviários e dados
                            pertencentes
                            ao mesmo.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary border border-white shadow" data-dismiss="modal"><i
                                class="fa fa-sign-out-alt"></i> Sair</button>
                        <button type="submit" name="" class="btn btn-danger border border-white shadow" data-dismiss="modal"
                            onclick="formSubmit()"><i class="fa fa-trash"></i> Excluir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function deleteData(id) {
            var id = id;
            var url = '{{ route('coletas.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

        // Valida form add semnas
        if ($("#capitalizaaves").length > 0) {
            $("#capitalizaaves").validate({

                rules: {
                    femea_capitalizada: {
                        required: true,
                        number: true,
                        notEqual: true
                    },
                    macho_capitalizado: {
                        required: true,
                        number: true,
                        notEqual: true
                    },
                    data_femea_capitalizada: {
                        required: true
                    },
                    data_macho_capitalizado: {
                        required: true
                    },
                },
                messages: {

                    femea_capitalizada: {
                        required: "Preencha com núm. de fêmeas!",
                        number: "Somente números inteiros!",
                        notEqual: 'Insira valores maior que "0"!'
                    },
                    macho_capitalizado: {
                        required: "Preencha com núm. de machos!",
                        number: "Somente números inteiros!",
                        notEqual: 'Insira valores maior que "0"!'
                    },
                    data_femea_capitalizada: {
                        required: "Preencha com a data!"
                    },
                    data_macho_capitalizado: {
                        required: "Preencha com a data!"
                    },
                },
            })
        }

        jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
            return this.optional(element) || value != '0';
        });

    </script>
@endsection
