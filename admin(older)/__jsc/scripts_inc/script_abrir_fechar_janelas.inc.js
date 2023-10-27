/**
 * script_abrir_fechar_janelas.inc.js - <b>SCRIPT PARA ABRIR E FECHAR JANELAS DO SISTEMA</b>
 * Arquivo de inclusão do scripts.js para armazenar os script de Abrir e Fechar janelas do Sistema
 */


//    FECHA MENSAGENS DE ERRO
$('.trigger-box').on('click', '.ajax_close', function () {

    $('.trigger').fadeOut();
});

$('body').on('click', '.ajax_close', function () {

    $('.j_popup').fadeOut();
});
//    PARA FECHAR JANELA COM BOTAO ESC
$(document).bind('keydown', function (e) {

    if (e.which == 27) {
        $('.j_popup').fadeOut();
    }
});

//ABRIR JANELA E INSERIR DADOS DE EDIÇÃO DE COMENTÁRIOS

$('body').on('click', '.js_editar_comentario', function () {

    var id = $(this).attr('id');
    var author = $(this).parents('.comentarios-botoes').prevAll('.js_get_author').text();
    var content = $(this).parents('.comentarios-botoes').prevAll('.js_get_content').find('.texto').text();

    console.log(id, author, content);

    if (author === 'Usuário Sem Nome') {
        $('.comentario_edicao').find('form').find('input[name=comentario_author]').parent('span').remove();
    } else {
        $('.comentario_edicao').find('form').find('input[name=comentario_author]').val(author);
    }
    
    $('.comentario_edicao').find('form').find('input[name=comentario_id]').val(id);
    $('.comentario_edicao').find('form').find('textarea[name=comentario_content]').val(content);
    $('.j_popup').fadeIn();

    return false;
});


//GESTAO DE PEDIDOS

$("body").on('click', '.j_venda', function () {


    var id = $(this).attr('id');
    console.log(id);

    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: "detalhes_pedido", id: id},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {


            if (data.result) {

                $('.j_detalhes_pedido').html(data.result);
                $('.j_venda_carrinho').html(data.venda_carrinho);
                $('.j_total').html(data.venda_total);
                $('.j_total_carrinho').html(data.venda_total_frete);
                $(".fundo-pedido").css("cssText", "height: " + ($(".detalhes-pedido").position().bottom) + "px !important;");
            }


        }
    });
});
