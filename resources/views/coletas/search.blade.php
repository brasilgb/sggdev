<form action="{{ route('coletas.busca') }}" method="post" class="inline">
    @method('POST')
    @csrf
    <div class="input-group mb-0">
        <input id="datasearch" type="text" name="search" class="form-control shadow-sm input-search"
            placeholder="Buscar por data de coleta" required>
        <div class="input-group-append">
            <button id="#search-btn" type="submit" class="btn btn-search shadow-sm"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
