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
    $("#cnpj").inputmask("99.999.999/9999-99");
    $("#telefone").inputmask("(99)9999-9999");
    $("#celular").inputmask("(99)9999-99999");
    $("#agendamento").inputmask("99:99");

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

$(function(){
    setInterval(function(){
        $.ajax({
        url: "{{ route('backups.executabackup') }}",
        type: "GET"
       })
     }, 1000);
});
</script>
