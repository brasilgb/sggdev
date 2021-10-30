<script>
    $(function() {
        $(".compareovos").keyup(function(e) {
            var incubaveis = $("#incubaveis").val();
            var comerciais = $("#comerciais").val();
            var incubaveisdb = $("#incubaveisdb").val();
            var comerciaisdb = $("#comerciaisdb").val();
            $.ajax({
                url: "{{ route('envios.ovoslote') }}",
                dataType: "JSON",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    loteid: loteid
                }
            }).done(function(response) {

                if (incubaveis > response.incubaveis + parseInt(incubaveisdb)) {
                    $("#dbincubaveis").fadeIn().html(
                        'Ultrapassou o limite de <span class="text-weight-bolder bg-danger px-2 rounded shadow-sm text-white">' +
                        response.incubaveis + ' permitidos</span>');
                }else{

                    $("#incubaveis, #comerciais").attr("style",
                        "border-radius: 0.2rem 0.25rem 0 0!important");
                    $("#dbincubaveis").fadeIn().html(
                        'Incubáveis disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.incubaveis + '</span>');
                }

                if (comerciais > response.comerciais + parseInt(comerciaisdb)) {
                    $("#dbcomerciais").fadeIn().html(
                        'Ultrapassou o limite de <span class="text-weight-bolder bg-danger px-2 rounded shadow-sm text-white">' +
                        response.comerciais + ' permitidos</span>');
                }else{
                    $("#dbcomerciais").fadeIn().html(
                        'Comerciais disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.comerciais + '</span>');
                }

                if (incubaveis > response.incubaveis + parseInt(incubaveisdb) || comerciais > response.comerciais + parseInt(comerciaisdb)) {
                    $("#btnenvio").attr('disabled', true);
                } else {
                    $("#btnenvio").attr('disabled', false);
                }

            });
        });
    });

    // Ovos disponiveis
    $(function() {
        $("#lote_id").change(function(e) {
            e.preventDefault();
            loteid = $(this).val();
            if (loteid) {
                $.ajax({
                    url: "{{ route('envios.ovoslote') }}",
                    dataType: "JSON",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        loteid: loteid
                    }
                }).done(function(response) {
                    if (response.comerciais > 0 || response.incubaveis > 0) {
                        $("#incubaveis, #comerciais").attr('disabled', false);
                    }else{
                        $("#incubaveis, #comerciais").attr('disabled', true);
                    }

                    $("#incubaveis, #comerciais").attr("style",
                        "border-radius: 0.2rem 0.25rem 0 0!important");
                    $("#dbincubaveis").fadeIn().html(
                        'Incubáveis disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.incubaveis + '</span>');
                    $("#dbcomerciais").fadeIn().html(
                        'Comerciais disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.comerciais + '</span>');
                });
            } else {
                location.reload();
            }
        });
    });

    // Total envio de ovos
    $(function() {
        $(".totalenvio").keyup(function() {
            var total = 0;
            $(".totalenvio").each(function(index, element) {
                if ($(element).val()) {
                    total += parseInt($(element).val());
                }
            });
            if (Number.isInteger(total)) {
                $("#postura_dia").val(total);
            } else {
                $("#postura_dia").val('0');
            }

        });
    });
    // Valida form
    $("#formlote").validate({
        rules: {
            data_envio: {
                required: true
            },
            hora_envio: {
                required: true
            },
            lote_id: {
                required: true
            },
            incubaveis: {
                required: true,
                notEqual: '0',
                digits: true
            },
            comerciais: {
                required: true,
                digits: true,
                notEqual: '0'
            },
            postura_dia: {
                required: true,
                digits: true,
                notEqual: '0'
            }
        },
        messages: {
            data_envio: 'Selecione a data!',
            hora_envio: 'Selecione a hora!',
            lote_id: {
                required: 'Selecione o loteo!'
            },
            incubaveis: {
                required: 'Digite os incubáveis!',
                digits: 'Somente inteiros!',
                notEqual: 'Insira maior que "0"!'
            },
            comerciais: {
                required: 'Digite os comerciais!',
                digits: 'Somente inteiros!',
                notEqual: 'Insira maior que "0"!'
            },
            postura_dia: {
                required: 'Digite a postura do dia!',
                digits: 'Somente inteiros!',
                notEqual: 'Insira maior que "0"!'

            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });

</script>
