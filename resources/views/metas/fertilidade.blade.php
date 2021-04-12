@extends('layouts.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header pb-0 border-bottom border-white" style="background-color: #062142;">
            <div class="row">
                <div class="col">
                    <h4 class="text-left text-white mt-1"><i class="fas fa-kiwi-bird"></i> Fertilidade <span class="badge badge-warning"><small>{{ $semanas->count() }} Semanas</small></span></h4>
                </div>
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-1 pb-1 float-right bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"> Fertilidade</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <div class="d-flex align-content-start flex-wrap">
                @foreach ($semanas as $fertilidade)
                <div class="w-25">
                    <div class="bg-gray-400 m-1 p-2 shadow-sm rounded-lg text-gray-200" style="border:2px solid #fff;">
                        <div>Semana: <span class="badge badge-primary">{{ $fertilidade->semana }}</span></div>
                        <div>{{ date("d/m/Y", strtotime($fertilidade->data_inicial)) }} à
                            {{ date("d/m/Y", strtotime($fertilidade->data_final)) }}</div>
                        <div class=""><input id="semana{{ $fertilidade->id_semana }}" style=" @if($fertilidade->fertilidade < 1) border: 1px solid rgb(184, 184, 184)!important; @endif"
                                class="form-control altermeta @if($fertilidade->fertilidade > 0) bg-success border-white @endif"
                                val-semana="{{ $fertilidade->id_semana }}" val-field="fertilidade" type="text" name=""
                                value="{{ $fertilidade->fertilidade }}"  onkeydown="javascript:EnterTab('semana{{ $fertilidade->id_semana + 1 }}',event)"></div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <script>
        $(function(){
                $(".altermeta").keyup(function(e){
                    e.preventDefault();
                    field = $(this).attr("val-field");
                    meta = $(this).val();
                    idsemana = $(this).attr("val-semana");
                    $.ajax({
                        url: "{{ route('metas.updatemeta') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            idsemana: idsemana,
                            field: field,
                            meta: meta
                        }
                        }).done(function(response){
                            if(meta > 0){
                                $("#semana"+response.semanaid).addClass('bg-success border-white');
                            }else{
                                $("#semana"+response.semanaid).removeClass('bg-success');
                            }
                    });
                });
            });
    </script>
@endsection
