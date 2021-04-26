@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fa fa-chart-line"></i> Produção</h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"> Produção</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-body p-2">


            <table class="table table-condensed table-striped mb-0">
                <tr>
                    <th>Semana</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Produção% <span class="badge badge-danger">{{ $producao->count() }} semanas</span></th>
                </tr>
                @foreach ($producao as $item)
<tr>
    <td>{{ $item->semana }}</td><td>{{ date("d/m/Y", strtotime($item->data_inicial)) }}</td><td>{{ date("d/m/Y", strtotime($item->data_final)) }}</td><td><input type="text" class="form-control" value="{{ $item->producao }}" name=""></td>
</tr>
@endforeach
            </table>

        </div>
    </div>

    <script>

    </script>

@endsection
