<script>
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
        aviarioid = $("#id_aviario").val();
            if (aviarioid) {
                $.ajax({
                    url: "{{ route('mortalidades.avesaviario') }}",
                    dataType: "JSON",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        aviarioid: aviarioid
                    }
                }).done(function(response) {
                    $("#avesfemeas, #avesmachos").attr("style",
                        "border-radius: 0.2rem 0.25rem 0 0!important");
                    $("#dbfemea").fadeIn().html(
                        'Fêmeas disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.femea + '</span>');
                    $("#dbmacho").fadeIn().html(
                        'Machos disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.macho + '</span>');
                });
            }
    });

    $(function() {
        $(".compareaves").keyup(function(e) {
            var avesfemeas = $("#avesfemeas").val();
            var avesmachos = $("#avesmachos").val();
            var femeadb = $("#femeadb").val();
            var machodb = $("#machodb").val();

            $.ajax({
                url: "{{ route('mortalidades.avesaviario') }}",
                dataType: "JSON",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    aviarioid: aviarioid
                }
            }).done(function(response) {
                if (avesfemeas > response.femea + parseInt(femeadb)) {
                    $("#dbfemea").fadeIn().html(
                        'Ultrapassou o limite de <span class="text-weight-bolder bg-danger px-2 rounded shadow-sm text-white">' +
                        response.femea + ' permitidos</span>');
                } else {

                    $("#avesfemeas, #avesmachos").attr("style",
                        "border-radius: 0.2rem 0.25rem 0 0!important");
                    $("#dbfemea").fadeIn().html(
                        'Fêmeas disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.femea + '</span>');
                }

                if (avesmachos > response.macho + parseInt(machodb)) {
                    $("#dbmacho").fadeIn().html(
                        'Ultrapassou o limite de <span class="text-weight-bolder bg-danger px-2 rounded shadow-sm text-white">' +
                        response.macho + ' permitidos</span>');
                } else {
                    $("#dbmacho").fadeIn().html(
                        'Machos disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.macho + '</span>');
                }

                if (avesfemeas > response.femea + parseInt(femeadb) || avesmachos > response.macho + parseInt(machodb)) {
                    $("#btnaviario").attr('disabled', true);
                } else {
                    $("#btnaviario").attr('disabled', false);
                }

            });
        });
    });

    $(function() {
        $("#id_aviario").change(function(e) {
            e.preventDefault();
            aviarioid = $(this).val();
            if (aviarioid) {
                $.ajax({
                    url: "{{ route('mortalidades.avesaviario') }}",
                    dataType: "JSON",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        aviarioid: aviarioid
                    }
                }).done(function(response) {

                    $("#femea_box1, #femea_box2, #femea_box3, #femea_box4, #macho_box1, #macho_box2, #macho_box3, #macho_box4")
                        .attr('disabled', false);
                    $("#avesfemeas, #avesmachos").attr("style",
                        "border-radius: 0.2rem 0.25rem 0 0!important");
                    $("#dbfemea").fadeIn().html(
                        'Fêmeas disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.femea + '</span>');
                    $("#dbmacho").fadeIn().html(
                        'Machos disponíveis <span class="text-weight-bolder bg-primary px-2 rounded shadow-sm text-white">' +
                        response.macho + '</span>');

                });
            } else {
                location.reload();
            }
        });
    });

    // Valida form add semnas
    $("#formlote").validate({
        rules: {
            data_aviario: {
                required: true
            },
            lote_id: {
                required: true
            },
            id_aviario: {
                required: true
            },
            motivo: {
                required: true
            },
            femea_box1: {
                required: true,
                digits: true
            },
            macho_box1: {
                required: true,
                digits: true
            },
            femea_box2: {
                digits: true
            },
            macho_box2: {
                digits: true
            },
            femea_box3: {
                digits: true
            },
            macho_box3: {
                digits: true
            },
            femea_box4: {
                digits: true
            },
            macho_box4: {
                digits: true
            }
        },
        messages: {
            data_aviario: 'Selecione uma data para o aviario!',
            lote_id: {
                required: 'Selecione o lote do aviário!'
            },
            id_aviario: {
                required: 'Selecione o lote e aviário!'
            },
            motivo: {
                required: 'Selecione a causa da morte!'
            },
            femea_box1: {
                required: 'Digite o n° de fêmeas!',
                digits: 'Somente inteiros!'
            },
            macho_box1: {
                required: 'Digite o n° de machos!',
                digits: 'Somente inteiros!'

            },
            femea_box2: {
                digits: 'Somente inteiros!'
            },
            macho_box2: {
                digits: 'Somente inteiros!'
            },
            femea_box3: {
                digits: 'Somente inteiros!'
            },
            macho_box3: {
                digits: 'Somente inteiros!'
            },
            femea_box4: {
                digits: 'Somente inteiros!'
            },
            macho_box4: {
                digits: 'Somente inteiros!'
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
