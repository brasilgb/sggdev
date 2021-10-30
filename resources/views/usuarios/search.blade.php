<form action="{{ route('usuarios.busca') }}" method="post" class="inline">
    @method('POST')
    @csrf
    <div class="input-group mb-0">
        <input id="usuario_search" type="text" name="termo" class="form-control shadow-sm"
            placeholder="Buscar usuário" required>
        <input id="usuarioid" type="hidden" name="search">
        <div class="input-group-append">
            <button type="submit" class="btn btn-search shadow-sm"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
<script>
    // Auto complete jquery UI Lotes
    $(document).ready(function() {
            $("#usuario_search").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{ route('usuarios.autocomplete') }}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: "{{ csrf_token() }}",
                            search: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#usuario_search').val(ui.item.label);
                    $('#usuarioid').val(ui.item.value);
                    return false;
                }
            });

        });
</script>
