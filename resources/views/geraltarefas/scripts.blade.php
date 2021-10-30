<script>
  // Valida form add semnas
    $("#formlote").validate({
        rules: {
            data_inicio: {
                required: true
            },
            hora_inicio: {
                required: true
            },
            data_previsao: {
                required: true
            },
            hora_previsao: {
                required: true
            },
            descritivo: {
                required: true
            },
           descricao: {
                required: true
            }
        },
        messages: {
            data_inicio: 'Selecione a data de início!',
            hora_inicio: 'Selecione a hora de início!',
            data_previsao: 'Selecione a data de início!',
            hora_previsao: 'Selecione a data de início!',
            descritivo: {
                required: 'Digite um descritivo (título)!'
            },
            descricao: {
                required: 'Digite a descrição!'
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
