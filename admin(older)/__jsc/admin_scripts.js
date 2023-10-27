$(function () {

    BASE = $("#j_base_home").attr('href');
    HORA = $("#j_date_now").attr('href');
    ID_CAT = $("#j_id_cat").attr('href');
    IS_SECAO = $("#j_is_secao").attr('href');

//FAZ COM QUE SIDEBAR VÁ ATE O FIM DA TELA DE QUALQUER DISPOSITIVO
    $(".sidebar").css("cssText", "height: " + ($(".fim_sidebar").position().top + 100) + "px !important;");
    $(".fundo").css("cssText", "height: " + ($(".fim_sidebar").position().top - 50) + "px !important;");

    // LOGOUT
    $.getScript('__jsc/scripts_inc/script_login_logout.inc.js');

    // MENUS DO SISTEMA
    $.getScript('__jsc/scripts_inc/script_menu.inc.js');

    // PREVIA DE IMAGEM
    $.getScript('__jsc/scripts_inc/script_previa_imagem.inc.js');

    // GALERIAS
    $.getScript('__jsc/scripts_inc/script_galeria.inc.js');

    // ABRIR E FECHAR JANELAS
    $.getScript('__jsc/scripts_inc/script_abrir_fechar_janelas.inc.js');

    // EXCLUSÂO E CONFIRMAÇÂO
    $.getScript('__jsc/scripts_inc/script_exclusao_confirmacao.inc.js');

    // GERENCIAMENTO STATUS E DISPONIBILIDADE
    $.getScript('__jsc/scripts_inc/script_gerenciamento_status_disponibilidade.inc.js');

    // GERENCIAMENTO COMENTARIO E RESPOSTAS
    $.getScript('__jsc/scripts_inc/script_comentario_resposta.inc.js');

    // PESQUISA EM REAL-TIME
    $.getScript('__jsc/scripts_inc/script_pesquisa.inc.js');

    // FORMS
    $.getScript('__jsc/scripts_inc/script_forms.inc.js');

    // PAGINACAO
    $.getScript('__jsc/scripts_inc/script_paginacao.inc.js');

    // MATERIAIS
    $.getScript('__jsc/scripts_inc/script_materiais.inc.js');

    // ALUNOS
    $.getScript('__jsc/scripts_inc/script_alunos.inc.js');

    // FILTROS
    $.getScript('__jsc/scripts_inc/script_filtros.inc.js');

    // EXPORTAÇÂO E IMPORTAÇÂO DE DOCUMENTOS
    $.getScript('__jsc/scripts_inc/script_exportar_importar.inc.js');

    

    $("#calendar").datepicker({
        dateFormat: 'dd/mm/yy',
        onSelect: function (dateText) {

            var d = new Date();
            var h = ('0' + d.getHours()).slice(-2);
            var m = ('0' + d.getMinutes()).slice(-2);
//            var s = ('0' + d.getSeconds()).slice(-2);
            dateText = dateText + " " + h + ":" + m;
            $("#calendar").val(dateText);

        },
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        showOtherMonths: true,
        selectOtherMonths: true
    });


    //    MASCARA PARA HORAÁRIO
    $(".j_horario").mask("99/99/9999 99:99", {autoclear: false});

    $(".j_valor").maskMoney({
        thousands: '.',
        decimal: ',',
        symbolStay: true

    });
});