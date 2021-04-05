<form action="{{ route('consumos.busca') }}" method="post" class="inline">
    @method('POST')
    @csrf
    <div class="input-group mb-0">
        <input id="datasearch" type="text" name="search" class="form-control shadow-sm"
            placeholder="Buscar consumo por data" required>
        <div class="input-group-append">
            <button type="submit" class="btn btn-search shadow-sm"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
