@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-body mt-1"><i class="fa fa-clock"></i> Períodos</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"> @if(isset($busca))  <a href="{{ route('periodos.index') }}">Períodos</a> / Busca @else Períodos @endif </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col text-left">
                    <button class="btn btn-primary shadow-sm border-white rounded" data-toggle="modal"
                        data-target=".modal-periodo"><i class="fa fa-plus"></i> Adicionar</button>
                </div>
                @include('parts/modal-periodo')
                <div class="col">
                    <form action="{{ route('periodos.busca') }}" method="post" class="inline">
                        @method('POST')
                        @csrf
                        <div class="input-group mb-0">
                            <input type="text" name="termo" class="form-control shadow-sm" placeholder="Buscar período"required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-search shadow-sm"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                @include("parts/flash-message")
                <table id="tb-periodos" class="table table-condensed table-striped mb-0">
                    <thead>
                        <tr class="text-left">
                            <th>Período</th>
                            <th>Ativo</th>
                            <th>Início</th>
                            <th>Término</th>
                            <th>Semanas</th>
                            <th style="width: 320px; min-width: 320px;"><i class="fa fa-level-down-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($periodos as $periodo)

                            <tr class="text-left">
                                <td class="align-middle">{{ $periodo->id_periodo }}</td>
                                <td class="align-middle"><span class="text-{{ $periodo->ativo ? 'success' : 'danger' }}"> <i
                                            class="fa fa-{{ $periodo->ativo ? 'check' : 'times' }}"></i></span></td>
                                <td class="align-middle">{{ date('d/m/Y', strtotime($periodo->data_inicial)) }}</td>
                                <td class="align-middle">{{ date('d/m/Y', strtotime($periodo->desativacao)) }}</td>
                                <td class="align-middle">{{ $periodo->semanas->count() }}</td>
                                <td class="align-middle">
                                    <button {{ $periodo->ativo ? '' : 'disabled' }} class="btn btn-primary border border-white shadow btn-semana"
                                        data-target="#numsemanasModal" data-toggle="modal"
                                        data-periodo="{{ $periodo->id_periodo }}"><i class="fa fa-plus"></i> Semanas</button>

                                    <button id="situacao" data-ativo="{{ $periodo->ativo}}"  data-id="{{ $periodo->id_periodo}}" style="{{ $periodo->ativo ? '' : 'padding-right: 30px!important' }}" class="btn btn-{{ $periodo->ativo ? 'danger' : 'success' }} border border-white shadow"><i class="fa fa-{{ $periodo->ativo ? 'times' : 'check' }}"></i>
                                        {{ $periodo->ativo ? 'Desativar' : 'Ativar' }}</button>

                                    <button {{ $periodo->ativo ? 'disabled' : '' }} class="btn btn-danger border border-white shadow" data-toggle="modal"
                                        onclick="deleteData({{ $periodo->id_periodo }})" data-target="#DeleteModal"><i
                                            class="fa fa-trash"></i> Excluir</button>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="alert alert-danger text-left"><i class="fa fa-exclamation-triangle"></i>
                                    @if (isset($busca))
                                    Não foram encontrados dados que correspondam com sua busca!
                                    @else
                                    Não há períodos cadastrados ou ativos, adicione ou ative um período para continuar!
                                    @endif
                                    </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($periodos->hasPages())
            <div class="card-footer pb-0">
                {{ $periodos->links() }}
            </div>
        @endif
    </div>
    <!-- Modal adiciona semanas -->
    <div class="modal fade" id="numsemanasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-adsemana" method="POST" action="{{ route('periodos.addsemanasperiodo') }}" accept-charset="UTF-8"
                    class="form-horizontal" autocomplete="off">
                    @method('post')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-clock"></i> Adicionar semanas
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group text-left">
                            <label for="numsemanas" class="col-form-label pb-0">N° Semanas:</label>
                            <input id="numsemanas" class="form-control @error('numsemanas') is-invalid @enderror"
                                name="numsemanas" type="text">
                            <input id="periodosemana" type="hidden" name="idperiodo" value="">
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
                        <p class="text-center">Tem certeza de que deseja excluir este período?<br>
                            <strong class="text-red">ATENÇÂO</strong><br> Será ecluido o período e as semanas pertencentes
                            ao mensmo.
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
            var url = '{{ route('periodos.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

        $(document).on("click", ".btn-semana", function() {
            id = $(this).attr('data-periodo');
            $(".modal-body #periodosemana").val(id);
        });

        // Valida form add semnas
        if ($("#form-adsemana").length > 0) {
        $("#form-adsemana").validate({

            rules: {
                numsemanas: {
                    required: true,
                    number: true
                },
            },
            messages: {

                numsemanas: {
                    required: "Preencha com o número de semanas!",
                    number: "O número de semanas deve ser inteiro!"
                },
            },
        })
    }


    $(document).on("click", "#situacao", function() {
            idperiodo = $(this).attr('data-id');
            ativo = $(this).attr('data-ativo');
            _token = "{{csrf_token()}}";
            $.ajax({
                type: 'POST',
                url: "{{route('periodos.ativaperiodo')}}",
                data: {'idperiodo': idperiodo, 'ativo': ativo, '_token': _token}
            }).done(function(response){
                if(response == true){
                   location.reload();
                }
            });

        });
    </script>
@endsection
