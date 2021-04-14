<script>

    $(document).ready(function() {
        $('.custom-file-input').on('change', function(e) {
            e.target.nextElementSibling.innerHTML = e.target.files[0].name;
        });
    });
    // Valida form add semnas
    $("#formempresa").validate({
        rules: {
            logotipo: {
                required: true
            },
            cnpj: {
                required: true,
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
                email: true
            }
        },
        messages: {
            logotipo: 'Selecione o Logotipo!',
            cnpj: 'Digite o CNPJ!',
            razao_social: {
                required: 'Digite a razão social!'
            },
            endereco: {
                required: 'Digite o endereço!'
            },
            cidade: {
                required: 'Digite a Cidade!'
            },
            uf: {
                required: 'Digite o Estado!'
            },
            telefone: {
                required: 'Digite o telefone!'
            },
            email: {
                required: 'Digite o E-mail!',
                email: 'Digite um e-mail válido!'
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });
</script>
