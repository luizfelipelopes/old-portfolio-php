/**
 * script_paginacao.inc.js - <b>SCRIPT PAGINACAO</b>
 * Arquivo de inclusão do scripts.js para a Paginação em REAL-TIME dos Itens do Sistema
 */

$("body").on('click', ".paginator li a", function () {
    
    var paginator = $(this).parents('.paginator');
    var id_categoria = ID_CAT;
    var is_secao = IS_SECAO;
    var pagina = $(this).attr("attr-page");
    var acao = $(".j_paginator").attr("attr-action");
    console.log(acao);

    if (acao === 'paginator_comentario_segment') {
        var segment = $(".j_paginator").attr("attr-segment");
        var title = $(".j_paginator").attr("attr-title");
        var grupo_type = $(".j_paginator").attr("attr-grupo-type");
        var cover = $(".j_paginator").attr("attr-cover");
        var join_id = $(".j_paginator").attr("attr-join-id");
        var tabela_join = $(".j_paginator").attr("attr-tabela-join");
        var sql_segment = $(".j_paginator").attr("attr-sql-segment");
        var coluna_type = $(".j_paginator").attr("attr-coluna-type");
        console.log(segment, title, grupo_type, cover, join_id, tabela_join, sql_segment, coluna_type);
    }


    if (acao === 'paginator_comentario') {
        var id_segment = $(".j_paginator").attr("attr-id-segment");
        var segment = $(".j_paginator").attr("attr-segment");
//        var grupo_type = $(".j_paginator").attr("attr-grupo-type");
        var coluna_type = $(".j_paginator").attr("attr-coluna-type");
        console.log(id_segment, segment, coluna_type);
    }

    $.ajax({
        url: 'ajax/ajax.php',
        data: (acao === 'paginator_comentario_segment' ? {action: acao, pagina: pagina, segment: segment, title: title, grupo_type: grupo_type, cover: cover, join_id: join_id, tabela_join: tabela_join, sql_segment: sql_segment, coluna_type: coluna_type} : (acao === 'paginator_comentario' ? {action: acao, pagina: pagina, id_segment: id_segment, segment: segment, coluna_type: coluna_type} : {action: acao, pagina: pagina, id_categoria: id_categoria, sec: is_secao})),
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (data) {

            if (data.result) {
                $('.js_paginator').find('.content').fadeOut();
                $(".j_paginator").remove();
                $(paginator).remove();
//                        $('.cursos').find('.content').fadeOut();
                var total = data.total;
                $('.js_paginator').find('.j_post_conteudo').html(data.result[0]);
////                        $('.cursos').find('.j_curso_conteudo').html(data.result[0]);
//
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
    return false;
});



