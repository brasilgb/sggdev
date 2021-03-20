<!-- Large modal -->
<div class="modal fade modal-periodo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="form-periodo" method="POST" action="{{ route('periodos.store') }}" accept-charset="UTF-8"
                class="form-horizontal" autocomplete="off">
                @method('POST')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-clock"></i> Iniciar período</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group text-left">
                        <label for="semana_inicial" class="col-form-label pb-0">Semana inicial:</label>
                        <input id="semana_inicial" class="form-control @error('semana_inicial') is-invalid @enderror"
                            name="semana_inicial" type="text">
                        @error('semana_inicial')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group text-left">
                        <label for="semana_final" class="col-form-label pb-0">Semana final:</label>
                        <input id="semana_final" class="form-control @error('semana_final') is-invalid @enderror"
                            name="semana_final" type="text">
                        @error('semana_final')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group  text-left">
                        <label for="data_inicial" class="col-form-label pb-0" autofocus="">Data do início:</label>
                        <input id="data_inicial" class="form-control @error('data_inicial') is-invalid @enderror"
                            name="data_inicial" type="text" value="{{date("d/m/Y", strtotime(now()))}}">
                        @error('data_inicial')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
<script>
    if ($("#form-periodo").length > 0) {
        $("#form-periodo").validate({

            rules: {
                semana_inicial: {
                    required: true
                },

                semana_final: {
                    required: true,
                },

                data_inicial: {
                    required: true,
                },
            },
            messages: {

                semana_inicial: {
                    required: "Preencha com a semana inicial!",
                },
                semana_final: {
                    required: "Preencha com a semana final!",
                },

                data_inicial: {
                    required: "Preencha com a data inicial do período!",
                },
            },
        })
    }
</script>
