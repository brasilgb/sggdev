<form action="{{ route('lotes.busca') }}" method="post" class="inline">
    @method('POST')
    @csrf
    <div class="input-group mb-0">
        <input id="lote_search" type="text" name="termo" class="form-control shadow-sm"
            placeholder="Buscar lote" required>
        <input id="loteid" type="hidden" name="search">
        <div class="input-group-append">
            <button type="submit" class="btn btn-search shadow-sm"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
<script>
    // Auto complete jquery UI Lotes
    $(document).ready(function() {
            $("#lote_search").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{ route('aviarios.autocomplete') }}",
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
                    $('#lote_search').val(ui.item.label);
                    $('#loteid').val(ui.item.value);
                    return false;
                }
            });

        });
</script>
