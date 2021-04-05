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


    // Valida form add semnas
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
