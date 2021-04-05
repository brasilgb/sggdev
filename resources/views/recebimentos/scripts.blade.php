<script>
    // Valida form add semnas
    $("#formlote").validate({
        rules: {
            data_recebimento: {
                required: true
            },
            hora_recebimento: {
                required: true
            },
            lote_id: {
                required: true
            },
            sexo_ave: {
                required: true
            },
            quantidade: {
                required: true,
                number: true
            },
            nota_fiscal: {
                required: true
            }
        },
        messages: {
            data_recebimento: 'Selecione uma data!',
            hora_recebimento: 'Selecione uma hora!',
            lote_id: {
                required: 'Selecione o lote!'
            },
            sexo_ave: {
                required: 'Selecione o sexo da ave!'
            },
            quantidade: {
                required: 'Digite a quantidade!',
                number: 'Somente valores inteiros!'
            },
            nota_fiscal: {
                required: 'Digite o n° da nota fiscal!'

            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });
</script>
