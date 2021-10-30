<script>
// Valida form
    $("#formemail").validate({
        rules: {
            basedados: {
                required: true
            },
            usuario: {
                required: true
            },
            senha: {
                required: true
            },
            local: {
                required: true
            }
        },
        messages: {
            basedados: 'Digite a base de dados!',
            usuario: {
                required: 'Digite o usuário!'
            },
            senha: {
                required: 'Digite a senha!'
            },
            local: {
                required: 'Digite o local do backup!'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });

</script>


