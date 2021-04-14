<script>

    $(document).ready(function() {
            $('.custom-file-input').on('change', function(e) {
                e.target.nextElementSibling.innerHTML = e.target.files[0].name;
            });
        });

    // Valida form
    $("#formempresa").validate({
        rules: {
            logotipo: {
                required: true
            },
            cnpj: {
                required: true
            },
            razao_social: {
                required: true
            },
            endereco: {
                required: true
            },
            cidade: {
                required: true
            },
            uf: {
                required: true
            },
            telefone: {
                required: true
            },
            email: {
                required: true,
                email: true,
            }
        },
        messages: {
            logotipo: {
                required: 'Selecione a imagem!'
            },
            cnpj: 'Selecione a hora!',
            razao_social: {
                required: 'Digite a razão social!'
            },
            endereco: {
                required: 'Digite o endereço!'
            },
            cidade: {
                required: 'Digite a cidade!'
            },
            uf: {
                required: 'Digite o estado!'
            },
            telefone: {
                required: 'Digite o estado!'
            },
            email: {
                required: 'Digite o e-mail!',
                email: 'Email incorreto!'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });

</script>


