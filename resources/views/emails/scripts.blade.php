<script>
// Valida form
    $("#formemail").validate({
        rules: {
            smtp: {
                required: true
            },
            porta: {
                required: true,
                number: true
            },
            seguranca: {
                required: true
            },
            usuario: {
                required: true
            },
            senha: {
                required: true
            },
            remetente: {
                required: true
            },
            destinatario: {
                required: true
            },
            assunto: {
                required: true
            },
            mensagem: {
                required: true
            }
        },
        messages: {
            smtp: 'Digite o servidor SMTP!',
            porta: {
                required: 'Digite a porta!',
                number: 'Somente números'
            },
            seguranca: {
                required: 'Digite o tipo de segurança!'
            },
            usuario: {
                required: 'Digite o usuário!'
            },
            senha: {
                required: 'Digite a senha!'
            },
            remetente: {
                required: 'Digite o remetente!'
            },
            destinatario: {
                required: 'Digite o destinatário!'
            },
            assunto: {
                required: 'Digite o assunto!'
            },
            mensagem: {
                required: 'Digite a mensagem!'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });

</script>


