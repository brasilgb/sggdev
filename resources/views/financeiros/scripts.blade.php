<script>
// Valida form
    $("#formfinanceiro").validate({
        rules: {
            valor_ovo: {
                required: true,
                number: true
            }
        },
        messages: {
            valor_ovo: {
                required: 'Digite o valor do ovo!',
                number: 'Somente números'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });

</script>


