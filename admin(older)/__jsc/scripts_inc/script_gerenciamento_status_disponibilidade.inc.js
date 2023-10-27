/**
 * script_gerenciamento_status_disponibilidade.inc.js - <b>SCRIPT PARA GERENCIAMENTO DE STATUS E DISPONIBILIDADE</b>
 * Arquivo de inclusão do scripts.js para armazenar os script de Gerenciamento de Status e Disponibilidade de Itens do Sistema
 */


$('body').on('click', '.j_publicado', function () {

    var botao = $(this);
    var id = $(this).parents('.posts-item').attr('id');
    var acao = $(this).attr('attr-status');
    var idPronto = "#" + id;
    console.log(id);
    console.log(acao);
    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: acao, id: id},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {

            botao.remove();
//            $(idPronto).children('.j_publicado').fadeOut();
            if (acao === 'mudar_status_cupom') {
                $(idPronto).append('<a attr-status="mudar_status_cupom" class="btn btn-yellow radius cupons-item-status j_pendente shorticon shorticon-pendente"></a>');
            } else if (acao === 'mudar_status_destaque') {
                $(idPronto).append('<a title="Pendente" attr-status="mudar_status_destaque" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
            } else if (acao === 'mudar_status_produto') {
                $(idPronto).append('<a attr-status="mudar_status_produto" class="btn btn-yellow radius posts-item-status-post j_pendente shorticon shorticon-pendente"></a>');
            } else if (acao === 'mudar_destaque_video') {
                $(idPronto).append('<a title="Sem Destaque" attr-status="mudar_destaque_video" class="btn btn-yellow radius item-destaque j_pendente shorticon shorticon-sem-destaque"></a>');
            } else {
                $(idPronto).append('<a title="Pendente" attr-status="' + acao + '" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
            }

        }


    });
});

$('body').on('click', '.j_pendente', function () {

    var botao = $(this);
    var id = $(this).parents('.posts-item').attr('id');
    var acao = $(this).attr('attr-status');
    var idPronto = "#" + id;
    console.log(id, acao);
    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: acao, id: id},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {
            botao.remove();
//            $(idPronto).children('.j_pendente').remove();
            if (acao === 'mudar_status_cupom') {
                $(idPronto).append('<a attr-status="mudar_status_cupom" class="btn btn-green radius cupons-item-status j_publicado shorticon shorticon-publicado"></a>');
            } else if (acao === 'mudar_status_destaque') {
                $(idPronto).append('<a title="Pendente" attr-status="mudar_status_destaque" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>');
            } else if (acao === 'mudar_status_produto') {
                $(idPronto).append('<a attr-status="mudar_status_produto" class="btn btn-green radius posts-item-status-post j_publicado shorticon shorticon-publicado"></a>');
            } else if (acao === 'mudar_destaque_video') {
                $(idPronto).append('<a title="Em destaque" attr-status="mudar_destaque_video" class="btn btn-green radius item-destaque j_publicado shorticon shorticon-destaque"></a>');
            } else {
                $(idPronto).append('<a title="Publicado" attr-status="' + acao + '" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>');
            }

        }


    });
});
//    CONTROLE DE ESTOQUE DOS PRODUTOS
$('body').on('click', '.j_disponivel', function () {

    var botao = $(this);
    var id = $(this).parents('.posts-item').attr('id');
    var acao = $(this).attr('attr-disponibilidade');
    var idPronto = "#" + id;
    console.log(id);
    console.log(acao);
    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: acao, id: id},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {
            botao.remove();
//            $(idPronto).children('.j_disponivel').fadeOut();
            $(idPronto).append('<a title="Indisponível" attr-disponibilidade="mudar_disponibilidade_produto" class="btn btn-orange radius produtos-item-disponibilidade j_indisponivel shorticon shorticon-indisponivel"></a>');
        }


    });
});

$('body').on('click', '.j_indisponivel', function () {

    var id = $(this).parents('.posts-item').attr('id');
    var acao = $(this).attr('attr-disponibilidade');
    var idPronto = "#" + id;
    console.log(id);
    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: acao, id: id},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {
            $(idPronto).children('.j_indisponivel').fadeOut();
            $(idPronto).append('<a title="Disponivel" attr-disponibilidade="mudar_disponibilidade_produto" class="btn btn-green radius produtos-item-disponibilidade j_disponivel shorticon shorticon-disponivel"></a>');
        }


    });
});