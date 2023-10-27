/**
 * script_comentario_resposta.inc.js - <b>SCRIPT COMENTÁRIO E RESPOSTA</b>
 * Arquivo de inclusão do scripts.js para armazenar os script de Comentários e Respostas do Sistema
 */

//AÇÔES DOS BOTÔES DE RESPOSTA=======================================================================
$('body').on('click', '.j_responder', function () {
    var idRespostas = "#" + $(this).parents('.comentarios-linha').children(".comentarios-resposta").attr('id');
    var idTextArea = "#" + $(this).parents('.comentarios-linha').children(".j_resposta").attr('id');
    $(idRespostas).fadeToggle();
    $(idTextArea).fadeToggle();
    return false;
});

$('body').on('click', '.j_cancelar_resposta', function () {
    $(this).parents('.comentarios-linha').children(".j_resposta").fadeOut();
    return false;
});


//AÇÔES DOS BOTÔES DE RESPOSTA=======================================================================


//    BOTOÊS DE GERENCIMANETO DE COMENTÁRIOS=====================================================
$("body").on('click', '.j_mais', function () {

    var id = $(this).parents('span').attr('id');
    $(this).parents('.j_parcial').fadeOut();
    $("#" + id).find('.j_completo').fadeIn(900);

    return false;
});
$("body").on('click', '.j_menos', function () {

    var id = $(this).parents('span').attr('id');
    $(this).parents('.j_completo').fadeOut();
    $("#" + id).find('.j_parcial').fadeIn(900);

    return false;
});

$("body").on('click', '.j_mais_resposta', function () {

    var id = $(this).attr('id');
    var idCompletoResposta = '#j_completo_resposta_' + id;


    $(this).parents('.j_parcial_resposta').fadeOut();
    $(idCompletoResposta).fadeIn(900);

    return false;
});

$("body").on('click', '.j_menos_resposta', function () {

    var id = $(this).attr('id');
    var idMenosResposta = '#j_parcial_resposta_' + id;

    $(this).parents('.j_completo_resposta').fadeOut();
    $(idMenosResposta).fadeIn(900);

    return false;
});

$('body').on('click', '.j_aprovado', function () {

    var id = $(this).parents('.comentarios-botoes').attr('id');
    var relacao = $(this).parents('.comentarios-botoes').attr('attr-relacao');
    var idBotao = $(this).attr('id');
    var idPronto = "#" + idBotao;
    console.log(idBotao, relacao);
    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: "mudar_status_comentario", id: id},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {

            if (data.error) {
                $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
            }

            $(idPronto).parents('.comentarios-botoes-status').find(idPronto).fadeOut('fast');
            $(idPronto).parents('.comentarios-botoes-status').find('.j_aprovado').fadeOut('fast');
            $(idPronto).parents('.comentarios-botoes-status').append('<a title="Pendente" id=' + id + (relacao === 'pai' ? '_pai' : '_filho') + ' class="btn btn-yellow radius shorticon shorticon-pendente m-top1 j_espera"></a>');
        }


    });
});

$('body').on('click', '.j_espera', function () {

    var id = $(this).parents('.comentarios-botoes').attr('id');
    var relacao = $(this).parents('.comentarios-botoes').attr('attr-relacao');
    var idBotao = $(this).attr('id');
    var idPronto = "#" + idBotao;
    console.log(idBotao, relacao);

    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: "mudar_status_comentario", id: id},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {

            $(idPronto).parents('.comentarios-botoes-status').find(idPronto).fadeOut('fast');
            $(idPronto).parents('.comentarios-botoes-status').find('.j_espera').fadeOut('fast');
            $(idPronto).parents('.comentarios-botoes-status').append('<a title="Aprovado" id=' + id + (relacao === 'pai' ? '_pai' : '_filho') + ' class="btn btn-green radius shorticon shorticon-publicado j_aprovado"></a>');
        }


    });
});
//    BOTOÊS DE GERENCIMANETO DE COMENTÁRIOS=====================================================



