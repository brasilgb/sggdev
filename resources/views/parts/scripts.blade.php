<script>
    $('#data_inicial, #datafcap, #datamcap, #dataform, #datasearch, #data1, #data2').datepicker({
        dateFormat: 'dd/mm/yy',
        closeText: "Fechar",
        prevText: "&#x3C;Anterior",
        nextText: "Próximo&#x3E;",
        currentText: "Hoje",
        monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro",
            "Outubro", "Novembro", "Dezembro"
        ],
        monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        dayNames: ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira",
            "Sábado"
        ],
        dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        weekHeader: "Sm",
        firstDay: 1
    });

    $('#data_inicial, #datafcap, #datamcap, #dataform, #datasearch, #data1, #data2').inputmask('99/99/9999');
    $("#hora_coleta, #hora_envio, #hora_recebimento, #hora1, #hora2").inputmask("99:99");
    // Maiúsculas
    $(function() {
        $("#lote, #lote_search").keyup(function() {
            toup = $(this).val();
            $(this).val(toup.toUpperCase());
        });
    });
    // Enter no preenchimento de campos
function EnterTab(InputId, Evento) {

if (Evento.keyCode == 13) {
    document.getElementById(InputId).focus();
    document.getElementById(InputId).select();
}
}
</script>
