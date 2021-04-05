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
                            <li class="breadcrumb-item active">
                                @if (isset($busca)) <a
                                    href="{{ route('recebimentos.index') }}">Recebimentos</a> / Busca @else Recebimentos
                                @endif
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                        <button onclick="window.location='{{ route('recebimentos.create') }}'"
                            class="btn btn-primary shadow-sm border-white"><i class="fa fa-plus"></i> Adicionar</button>
                </div>

                <div class="col">
                    @include('recebimentos/search')
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                @include("parts/flash-message")
                <table id="tb-recebimentos" class="table table-condensed table-striped mb-0">
                    <thead>
                        <tr class="text-left">
                            <th>Lote</th>
                            <th>Sexo</th>
                            <th>Quantidade(Kg)</th>
                            <th>Nota fiscal</th>
                            <th>Data Hora</th>
                            <th style="width: 198px; min-width: 198px;"><i class="fa fa-level-down-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recebimentos as $recebimento)
                            <tr class="text-left">
                                <td class="align-middle">{{ $recebimento->lotes->lote }}</td>
                                <td class="align-middle">{{ $recebimento->sexo_ave }}</td>
                                <td class="align-middle">{{ $recebimento->quantidade }}</td>

                                <td class="align-middle">{{ $recebimento->nota_fiscal }}</td>
                                <td class="align-middle">{{ date('d/m/Y', strtotime($recebimento->data_recebimento)) }} {{ date('H:i', strtotime($recebimento->hora_recebimento)) }}</td>
                                <td class="align-middle">

                                    <button
                                        onclick="window.location='{{ route('recebimentos.edit', ['recebimento' => $recebimento->id_recebimento]) }}'"
                                        id="situacao" class="btn btn-primary border border-white shadow"><i
                                            class="fa fa-edit"></i> Editar</button>

                                    <button class="btn btn-danger border border-white shadow" data-toggle="modal"
                                        onclick="deleteData({{ $recebimento->id_recebimento }})" data-target="#DeleteModal"><i
                                            class="fa fa-trash"></i> Excluir</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="alert alert-danger text-left"><i class="fa fa-exclamation-triangle"></i>
                                    @if (isset($busca))
                                        Não foram encontrados dados que correspondam com sua busca!
                                    @else
                                        Não há recebimentos cadastrados, adicione um recebimento para continuar!
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($recebimentos->hasPages())
            <div class="card-footer pb-0">
                {{ $recebimentos->links() }}
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
                        <p class="text-center">Tem certeza de que deseja excluir este recebimento?</p>
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
            var url = '{{ route('recebimentos.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>

@endsection
