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
                            <li class="breadcrumb-item active">
                                @if (isset($busca)) <a
                                    href="{{ route('lotes.index') }}">Lotes</a> / Busca @else Lotes @endif
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                        <button onclick="window.location='{{ route('lotes.create') }}'"
                            class="btn btn-primary shadow-sm border-white"><i class="fa fa-plus"></i> Adicionar</button>
                </div>

                <div class="col">
                    @include('lotes/search')
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                @include("parts/flash-message")
                <table id="tb-lotes" class="table table-condensed table-striped mb-0">
                    <thead>
                        <tr class="text-left">
                            <th>Lote</th>
                            <th>Fêmeas</th>
                            <th class="bg-gray-300 border-top border-gray-400">Capit. / Data</th>
                            <th>Machos</th>
                            <th class="bg-gray-300 border-top border-gray-400">Capit. / Data</th>
                            <th>Tot. Aves</th>
                            <th>Aviários</th>
                            <th>Cadastro</th>
                            <th style="width: 314px; min-width: 314px;"><i class="fa fa-level-down-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lotes as $lote)

                            <tr class="text-left">
                                <td class="align-middle">{{ $lote->lote }}</td>
                                <td class="align-middle">{{ $lote->femea }}</td>
                                <td
                                    class="align-middle  {{ $lote->femea_capitalizada ? 'text-success' : 'text-danger' }}">
                                    @if ($lote->femea_capitalizada)
                                        {{ $lote->femea_capitalizada }} <strong class="text-dark">/</strong>
                                        {{ date('d/m/Y', strtotime($lote->data_femea_capitalizada)) }}

                                    @else
                                        Não capitalizada
                                    @endif
                                </td>
                                <td class="align-middle">{{ $lote->macho }}</td>
                                <td
                                    class="align-middle {{ $lote->macho_capitalizado ? 'text-success' : 'text-danger' }}">
                                    @if ($lote->macho_capitalizado)
                                        {{ $lote->macho_capitalizado }} <strong class="text-dark">/</strong>
                                        {{ date('d/m/Y', strtotime($lote->data_macho_capitalizado)) }}
                                    @else
                                        Não capitalizado
                                    @endif

                                </td>
                                <td class="align-middle">{{ $lote->femea + $lote->macho }}</td>
                                <td class="align-middle">{{ $lote->aviarios->count() }}</td>
                                <td class="align-middle">{{ date('d/m/Y', strtotime($lote->data_lote)) }}</td>
                                <td class="align-middle">

                                    <button data-toggle="modal" value="{{ $lote->id_lote }}" data-target="#CapitalizaModal"
                                        class="btn btn-light border border-white shadow avecap"><i
                                            class="fas fa-chart-line"></i> Capitalizar</button>

                                    <button onclick="window.location='{{ route('lotes.edit', ['lote' => $lote->id_lote]) }}'"
                                        id="situacao" class="btn btn-primary border border-white shadow"><i
                                            class="fa fa-edit"></i> Editar</button>

                                    <button class="btn btn-danger border border-white shadow" data-toggle="modal"
                                        onclick="deleteData({{ $lote->id_lote }})" data-target="#DeleteModal"><i
                                            class="fa fa-trash"></i> Excluir</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="alert alert-danger text-left"><i class="fa fa-exclamation-triangle"></i>
                                    @if (isset($busca))
                                        Não foram encontrados dados que correspondam com sua busca!
                                    @else
                                        Não há lotes cadastrados, adicione um lote para continuar!
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($lotes->hasPages())
            <div class="card-footer pb-0">
                {{ $lotes->links() }}
            </div>
        @endif
    </div>

    <div class="modal fade" id="CapitalizaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="capitalizaaves" action="{{ route('lotes.capitalizar') }}" method="post" autocomplete="off">
                    @method('post')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cubes"></i> Capitalização de lotes</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">
                        <input id="lotecap" type="hidden" name="idlote" value="">
                        <div class="row">
                            <div class="col">
                                <div class="form-group text-left">
                                    <label for="" class="col-form-label">N° Fêmeas:</label>
                                    <input id="femeacap" type="text" name="femea_capitalizada" class="form-control">
                                    @error('femea_capitalizada')
                                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                                            {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group text-left">
                                    <label for="" class="col-form-label">N° Machos:</label>
                                    <input id="machocap" type="text" name="macho_capitalizado" class="form-control">
                                    @error('macho_capitalizado')
                                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group text-left">
                                    <label for="" class="col-form-label">Data de capitalização:</label>
                                    <input id="datafcap" type="text" name="data_femea_capitalizada" class="form-control">
                                    @error('data_femea_capitalizada')
                                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                                            {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group text-left">
                                    <label for="" class="col-form-label">Data de capitalização:</label>
                                    <input id="datamcap" type="text" name="data_macho_capitalizado" class="form-control">
                                    @error('data_macho_capitalizado')
                                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary border border-white shadow" data-dismiss="modal"><i
                                class="fa fa-sign-out-alt"></i> Sair</button>
                        <button type="submit" class="btn btn-primary border border-white shadow"><i class="fa fa-save"></i>
                            Salvar</button>
                    </div>
                </form>
            </div>
        </div>
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
                        <p class="text-center">Tem certeza de que deseja excluir este lote?<br>
                            <strong class="text-red">ATENÇÂO</strong><br> Será ecluido o lotes, os aviários e dados
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
            var url = '{{ route('lotes.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }


        $(document).on("click", ".avecap", function(e) {
            e.preventDefault();
            //$("#capitalizaaves").refresh();
            _token = "{{ csrf_token() }}";
            idlote = $(this).val();
            $("#lotecap").val(idlote);
            $.ajax({
                type: 'POST',
                url: "{{ route('lotes.showcapitalizada') }}",
                data: {
                    '_token': _token,
                    'idlote': idlote
                }
            }).done(function(response) {

                $("#femeacap").val(response.capfemea);
                $("#machocap").val(response.capmacho);
                $("#datafcap").val(response.datafemea);
                $("#datamcap").val(response.datamacho);

            });
        });

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
