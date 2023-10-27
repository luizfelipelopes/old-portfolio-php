/**
 * script_filtros.inc.js - <b>SCRIPT FILTROS</b>
 * Arquivo de inclusão do scripts.js para Filtros de Pesquisa do Sistema
 */

//    FILTRO POR STATUS
$("body").on("change", "select[name=filtro_pedido_status]", function () {

    var selecao = $(this).find("option:selected").val();
    console.log(selecao);
//        console.log(status);

    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: "filtrar_pedido_status", status: selecao},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {


            if (data.venda_carrinho) {

                $('.linha').fadeOut();

                $('.j_pedidos_real_time').html(data.venda_carrinho[0]);

                for (var i = 1; i < data.total; i++) {
                    $('.j_pedidos_real_time').append(data.venda_carrinho[i]);

                }

            } else if (data.venda_carrinho_total && selecao === 'todos') {

                $('.linha').fadeOut();

                $('.j_pedidos_real_time').html(data.venda_carrinho_total[0]);

                for (var i = 1; i < data.total; i++) {
                    $('.j_pedidos_real_time').append(data.venda_carrinho_total[i]);

                }

            } else {
                $('.linha').fadeOut();
            }
        }


    });


});


//    FILTRO POR DATA
$("body").on("change", "select[name=filtro_pedido_data]", function () {

    var selecao = $(this).find("option:selected").val();

    console.log(selecao);
//        console.log(status);

    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: "filtrar_pedido_data", data: selecao},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {


            if (data.venda_carrinho) {

                $('.linha').fadeOut();

                $('.j_pedidos_real_time').html(data.venda_carrinho[0]);

                for (var i = 1; i < data.total; i++) {
                    $('.j_pedidos_real_time').append(data.venda_carrinho[i]);

                }

            } else if (data.venda_carrinho_total && selecao === 'todos') {

                $('.linha').fadeOut();

                $('.j_pedidos_real_time').html(data.venda_carrinho_total[0]);

                for (var i = 1; i < data.total; i++) {
                    $('.j_pedidos_real_time').append(data.venda_carrinho_total[i]);

                }

            } else if (selecao === 'personalizado') {
                $('.j_popup_data_personalizado').fadeIn();
            } else {
                $('.linha').fadeOut();
            }
        }


    });


});

$("body").on("change", "select[name=filtro]", function (event) {

    var selecao = $(this).val();

    if (selecao === 'personalizado') {
        $('select[name=filtro]').val('todos');
        $('.j_popup_data_personalizado').fadeIn();
    }

});

//    FILTRO COMENTÁRIO POR TIPO
$("body").on("change", "select[name=filtro]", function () {

    var paginator = $('.paginator');
    var selecao = $(this).find("option:selected").val();
    var acao = $(this).attr("attr-action");

    if (selecao !== 'personalizado') {

        $.ajax({
            url: 'ajax/ajax.php',
            data: {action: acao, key: selecao},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }
            , success: function (data) {

                if (data.error) {
                    $('.js_paginator').find('.j_post_conteudo').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "</p>");
                }

                if (data.result_comentario) {

//                    $('.comentarios-linha').fadeOut();
                    $('.comentarios-linha').fadeOut();

                    $('.j_comentarios_real_time').html(data.result_comentario[0]);

                    for (var i = 1; i < data.total; i++) {
                        $('.j_comentarios_real_time').append(data.result_comentario[i]);

                    }

                }

                if (data.result) {

                    $('.js_paginator').find('.content').fadeOut();
                    $(".j_paginator").remove();
                    $(paginator).remove();

                    var total = data.total;
                    $('.js_paginator').find('.j_post_conteudo').html(data.result[0]);
//
                    if (data.total > 1) {
                        for (var i = 1; i < total; i++) {
                            $('.js_paginator').find('.j_post_conteudo').append(data.result[i]);
                        }
                    }

                    $('.js_paginator').find('.j_post_conteudo').append(data.action_paginator);
                    $('.js_paginator').find('.j_post_conteudo').append(data.paginator);
                    $('.js_paginator').find('.content').fadeIn();
                }


            }


        });
    }

});

//    FILTRO COMENTÁRIO POR SEGMENTO
$("body").on("change", "select[name=filtro_comentario_segment]", function () {

    var selecao = $(this).find("option:selected").val();

//    var pagina = $(this).attr("attr-page");

//    if (acao === 'paginator_comentario_segment') {
    var segment = $(".j_paginator").attr("attr-segment");
    var title = $(".j_paginator").attr("attr-title");
    var grupo_type = $(".j_paginator").attr("attr-grupo-type");
    var cover = $(".j_paginator").attr("attr-cover");
    var join_id = $(".j_paginator").attr("attr-join-id");
    var tabela_join = $(".j_paginator").attr("attr-tabela-join");
    var sql_segment = $(".j_paginator").attr("attr-sql-segment");
    var coluna_type = $(".j_paginator").attr("attr-coluna-type");
    console.log(segment, title, grupo_type, cover, join_id, tabela_join, sql_segment, coluna_type);
//    }

    console.log(selecao);
//        console.log(status);

    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: "filtrar_comentario_segment", filtro: selecao, segment: segment, title: title, grupo_type: grupo_type, cover: cover, join_id: join_id, tabela_join: tabela_join, sql_segment: sql_segment, coluna_type: coluna_type},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {


            if (data.result) {
                $('.js_paginator').find('.content').fadeOut();
//                        $('.cursos').find('.content').fadeOut();
                var total = data.total;
                $('.js_paginator').find('.j_post_conteudo').html(data.result[0]);
//                        $('.cursos').find('.j_curso_conteudo').html(data.result[0]);

                for (var i = 1; i < total; i++) {
                    $('.js_paginator').find('.j_post_conteudo').append(data.result[i]);
//                            $('.cursos').find('.j_curso_conteudo').append(data.result[i]);
                }

                $('.js_paginator').find('.j_post_conteudo').append(data.action_paginator);
                $('.js_paginator').find('.j_post_conteudo').append(data.paginator);
                $('.js_paginator').find('.content').fadeIn();
//                        $('.cursos').find('.content').fadeIn();

                data.result = null;
            }


        }


    });


});


//    FILTRO COMENTÁRIO POR PRODUTO
$("body").on("change", "select[name=filtro_comentario_produto]", function () {

    var selecao = $(this).find("option:selected").val();
    console.log(selecao);
//        console.log(status);

    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: "filtrar_comentario_produto", produto: selecao},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        }
        , success: function (data) {



            if (data.result_comentario) {

//                    $('.comentarios-linha').fadeOut();
                $('.comentarios-linha').fadeOut();


                $('.j_comentarios_real_time').html(data.result_comentario[0]);

                for (var i = 1; i < data.total; i++) {
                    $('.j_comentarios_real_time').append(data.result_comentario[i]);

                }

            }
        }


    });


});



