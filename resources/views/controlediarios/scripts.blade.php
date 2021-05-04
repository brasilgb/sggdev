<script>
    $(function() {
        $("#lote_id").change(function(e) {
            e.preventDefault;
            idlote = $(this).val();
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "{{ route('aviarios.aviarioslote') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    idlote: idlote
                }
            }).done(function(response) {
                $('#id_aviario').children().remove();
                $('#id_aviario').append("<option value=''> Selecione o aviário</option>");
                $.each(response, function(key, value) {
                    $("#id_aviario").append("<option value=" + key + ">" + value +
                        "</option>");
                });
            });
        });
    });

    $(function() {
        $("#id_aviario").change(function() {
            idlote = $("#lote_id").val();
            idaviario = $(this).val();
            $.ajax({
                url: "{{ route('controlediarios.verificacontrole') }}",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: "{{ csrf_token() }}",
                    idlote: idlote,
                    idaviario: idaviario
                }
            }).done(function(response) {
                if (response.leitura > 0) {
                    $(".leitura-inicial-0").hide('fade');
                    var aves = parseInt(response.aves);
                    var leitura_anterior = parseInt(response.leitura_anterior)
                    $("#leitura_create").keyup(function(e) {
                        e.preventDefault();
                        leitura_atual = parseInt($(this).val());
                        $("#consumo_total").val(leitura_atual - leitura_anterior);
                        $("#consumo_ave").val(((leitura_atual - leitura_anterior) /
                            aves).toFixed(2));
                    });
                } else {
                    $(".leitura-inicial-0").show('fade');
                    $("#consumo_total, #consumo_ave").val(0);
                }
            });
        });
    });
    $(function() {
        $("#leitura_edit").keyup(function(e) {
            idlote = $("#lote_id").val();
            idaviario = $("#id_aviario").val();
            idcontrole = $("#idcontrole").val();
            leitura_agua = parseInt($("#leitura_agua").val());
            $.ajax({
                url: "{{ route('controlediarios.editacontrole') }}",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: "{{ csrf_token() }}",
                    idlote: idlote,
                    idaviario: idaviario,
                    idcontrole: idcontrole
                }
            }).done(function(response) {
                if (response.leitura_inicial > 0) {
                    $("#formlote :input").attr('disabled', true);
                } else {
                    var aves = parseInt(response.aves);
                    var leitura_anterior = parseInt(response.leitura_anterior)
                    e.preventDefault();
                    $("#consumo_total").val(leitura_agua - leitura_anterior);
                    $("#consumo_ave").val(((leitura_agua - leitura_anterior) / aves).toFixed(
                        2));
                }
            });
        });
    });
    $("#formlote").validate({
        rules: {
            data_controle: {
                required: true
            },
            lote_id: {
                required: true
            },
            aviario: {
                required: true
            },
            temperatura_min: {
                required: true,
                number: true
            },
            temperatura_max: {
                required: true,
                number: true
            },
            umidade: {
                required: true,
                number: true
            },
            leitura_agua: {
                digits: true
            },
            consumo_total: {
                digits: true
            },
            consumo_ave: {
                number: true
            }
        },
        messages: {
            data_controle: 'Selecione uma data para o aviario!',
            lote_id: {
                required: 'Selecione o lote do aviário!'
            },
            aviario: {
                required: 'Selecione o lote e lote/aviário!'
            },
            temperatura_min: {
                required: 'Digite a temp. mín.!',
                number: 'Somente números!'
            },
            temperatura_max: {
                required: 'Digite a temp. max.!',
                number: 'Somente números!'
            },
            umidade: {
                required: 'Digite a umidade!',
                number: 'Somente números!'
            },
            leitura_agua: {
                required: 'Digite a leitura d´agua!',
                digits: 'Somente inteiros!'
            },
            consumo_total: {
                required: 'Consumo do aviário!',
                digits: 'Somente inteiros!'
            },
            consumo_ave: {
                required: 'Consumo por aves!',
                number: 'Somente números!'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });
</script>
