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
                $("#femea_box1, #femea_box2, #femea_box3, #femea_box4, #macho_box1, #macho_box2, #macho_box3, #macho_box4").attr('disabled', false);
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
            data_aviario: {
                required: true
            },
            lote_id: {
                required: true
            },
            aviario_id: {
                required: true
            },
            femea_box1: {
                required: true,
                digits: true
            },
            macho_box1: {
                required: true,
                digits: true
            },
            femea_box2: {
                digits: true
            },
            macho_box2: {
                digits: true
            },
            femea_box3: {
                digits: true
            },
            macho_box3: {
                digits: true
            },
            femea_box4: {
                digits: true
            },
            macho_box4: {
                digits: true
            }
        },
        messages: {
            data_aviario: 'Selecione uma data para o aviario!',
            lote_id: {
                required: 'Selecione o lote do aviário!'
            },
            aviario_id: {
                required: 'Selecione o lote e aviário!'
            },
            femea_box1: {
                required: 'Digite o Kg ração!',
                digits: 'Somente inteiros!'
            },
            macho_box1: {
                required: 'Digite o Kg ração!',
                digits: 'Somente inteiros!'

            },
            femea_box2: {
                digits: 'Somente inteiros!'
            },
            macho_box2: {
                digits: 'Somente inteiros!'
            },
            femea_box3: {
                digits: 'Somente inteiros!'
            },
            macho_box3: {
                digits: 'Somente inteiros!'
            },
            femea_box4: {
                digits: 'Somente inteiros!'
            },
            macho_box4: {
                digits: 'Somente inteiros!'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });


    $(".avesfemeas").keyup(function() {
        var femeas = 0;
        $(".avesfemeas").each(function(index, element) {
            if ($(element).val()) {
                femeas += parseInt($(element).val());
            }
        });
        $("#avesfemeas").val(femeas);
    });

    $(".avesmachos").keyup(function() {
        var machos = 0;
        $(".avesmachos").each(function(index, element) {
            if ($(element).val()) {
                machos += parseInt($(element).val());
            }
        });
        $("#avesmachos").val(machos);
    });

</script>
