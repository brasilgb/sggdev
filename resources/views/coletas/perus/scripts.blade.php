<script>

    // ===========================Cálculos coleta diária===========================
    $(function() {
        $(".incubaveis").keyup(function() {
            var incubaveis = 0;
            $(".incubaveis").each(function(index, element) {
                if ($(element).val()) {
                    incubaveis += parseInt($(element).val());
                }
            });
            $("#incubaveis").val(incubaveis).addClass('bg-gray-light');
        });
    });

    // Incubaveis bons
    $(function() {
        $(".incubaveisbons").keyup(function() {
            var incubaveisbons = 0;
            $(".incubaveisbons").each(function(index, element) {
                if ($(element).val()) {
                    incubaveisbons += parseInt($(element).val());
                }
            });
            $("#incubaveisbons").val(incubaveisbons).addClass('bg-gray-light');
        });
    });
    // Comerciais
    $(function() {
        $(".comerciais").keyup(function() {
            var comerciais = 0;
            $(".comerciais").each(function(index, element) {
                if ($(element).val()) {
                    comerciais += parseInt($(element).val());
                }
            });
            $("#comerciais").val(comerciais).addClass('bg-gray-light');
        });
    });

    // Postura do dia
    $(function() {
        $(".posturadia").keyup(function() {
            var posturadia = 0;
            $(".posturadia").each(function(index, element) {
                if ($(element).val()) {
                    posturadia += parseInt($(element).val());
                }
            });
            $("#posturadia").val(posturadia).addClass('bg-gray-light');
        });
    });
    // Limpa ou adiciona  ao campos da coleta
    $(function() {
        $(".cleanzero").focusin(function() {
            valor = $(this).val();
            if (valor === '0') {
                $(this).val('');
            }
        });
    });
    $(function() {
        $(".cleanzero").focusout(function() {
            valor = $(this).val();
            if (valor === '') {
                $(this).val('0');
            }
        });
    });
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
                $('#id_aviario').children().remove();
                $('#id_aviario').append("<option value=''> Selecione o aviário</option>");
                $.each(response, function(key, value) {
                    $("#id_aviario").append("<option value=" + key + ">" + value +
                        "</option>");
                });

            });
        });
    });

    $(function() {
        $("#id_aviario").change(function(e) {
            e.preventDefault;
            datacoleta = FormataStringData($('#dataform').val());
            idaviario = $(this).val();
            idlote = $("#lote_id").val();
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "{{ route('coletas.numcoleta') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    idaviario: idaviario,
                    idlote: idlote,
                    datacoleta: datacoleta
                }
            }).done(function(response) {
                $("#coleta").val(response);
            });
        });
    });
    // Valida form add semnas
    $("#formcoleta").validate({
        rules: {
            data_coleta: {
                required: true
            },
            hora_coleta: {
                required: true,
            },
            lote_id: {
                required: true,
                digits: true
            },
            id_aviario: {
                required: true,
                digits: true
            },
            coleta: {
                required: true,
                digits: true
            },
            limpos_ninho: {
                required: true,
                digits: true
            },
            sujos_ninho: {
                required: true,
                digits: true
            },
            ovos_cama: {
                required: true,
                digits: true
            },
            duas_gemas: {
                required: true,
                digits: true
            },
            pequenos: {
                required: true,
                digits: true
            },
            trincados: {
                required: true,
                digits: true
            },
            casca_fina: {
                required: true,
                digits: true
            },
            deformados: {
                required: true,
                digits: true
            },
            frios: {
                required: true,
                digits: true
            },
            sujos_cama: {
                required: true,
                digits: true
            },
            esmagados_quebrados: {
                required: true,
                digits: true
            },
            cama_nao_incubaveis: {
                required: true,
                digits: true
            },
            incubaveis_bons: {
                required: true,
                digits: true
            },
            incubaveis: {
                required: true,
                digits: true
            },
            comerciais: {
                required: true,
                digits: true
            },
            postura_dia: {
                required: true,
                digits: true
            }
        },
        messages: {
            data_coleta: 'Selecione uma data para o coleta!',
            hora_coleta: 'Selecione uma hora para o coleta!',
            lote_id: {
                required: 'Selecione o lote!',
                digits: true
            },
            id_aviario: {
                required: 'Selecione o lote e/ou aviário!',
                digits: true
            },
            coleta: {
                required: 'Insira o número da coleta!',
                digits: true
            },
            limpos_ninho: {
                required: 'Insira os ovos limpos de ninho!',
                digits: true
            },
            sujos_ninho: {
                required: 'Insira os ovos sujos de ninho!',
                digits: true
            },
            ovos_cama: {
                required: 'Insira os ovos de cama incubáveis!',
                digits: true
            },
            duas_gemas: {
                required: 'Insira os ovos com duas gemas!',
                digits: true
            },
            pequenos: {
                required: 'Insira os ovos de pequenos!',
                digits: true
            },
            trincados: {
                required: 'Insira os ovos trincados!',
                digits: true
            },
            casca_fina: {
                required: 'Insira os ovos casca fina!',
                digits: true
            },
            deformados: {
                required: 'Insira os ovos deformados!',
                digits: true
            },
            frios: {
                required: 'Insira os ovos frios!',
                digits: true
            },
            sujos_cama: {
                required: 'Insira os ovos sujos não aproveitáveis!',
                digits: true
            },
            esmagados_quebrados: {
                required: 'Insira os ovos esmagados quebrados!',
                digits: true
            },
            cama_nao_incubaveis: {
                required: 'Insira os ovos cama não incubáveis!',
                digits: true
            },
            incubaveis_bons: {
                required: 'Insira os ovos incubáveis bons!',
                digits: true
            },
            incubaveis: {
                required: 'Insira os ovos incubáveis!',
                digits: true
            },
            comerciais: {
                required: 'Insira os ovos comerciais!',
                digits: true
            },
            postura_dia: {
                required: 'Insira a postura do dia!',
                digits: true
            }
        }
    });
    jQuery.validator.addMethod("notEqual", function(value, element,
        param) { // Adding rules for Amount(Not equal to zero)
        return this.optional(element) || value != '0';
    });

</script>
