<script>
  // Valida form add semnas
    $("#formdespesa").validate({
        rules: {
            vencimento: {
                required: true
            },
            descritivo: {
                required: true
            },
            valor: {
                required: true,
                number:true
            }
        },
        messages: {
            vencimento: 'Selecione a data do vencimento!',
            descritivo: {
                required: 'Digite um descritivo (título)!'
            },
            valor: {
                required: 'Digite o valor!',
                number: 'Somente números inteiros ou decimais com ponto!'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });
</script>
