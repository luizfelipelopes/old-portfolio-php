/**
 * script_pesquisa.inc.js - <b>SCRIPT PESQUISA</b>
 * Arquivo de inclusão do scripts.js para armazenar os script de Pesquisa em REAL-TIME do Sistema
 */

$('body').on("keyup", ".j_pesquisar", function () {

    var id_categoria = ID_CAT;
    var is_secao = IS_SECAO;
    var pesquisa = $(this).val();
    var acao = $(this).attr('attr-pesquisa');
    console.log(acao, id_categoria, is_secao);
    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: acao, s: pesquisa, id_categoria: id_categoria, sec: is_secao},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (data) {

            if (data.error && pesquisa !== '') {
                $('.trigger-box').fadeIn();
                $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                $('.posts').find('.content').fadeOut();
            }else{
                $('.trigger-box').fadeOut('fast');
            }

            if (data.success && pesquisa !== '') {

                if (data.result) {
                    $('.posts').find('.content').fadeOut();
//                        $('.cursos').find('.content').fadeOut();
                    var total = data.total;
                    $('.posts').find('.j_post_conteudo').html(data.result[0]);
//                        $('.cursos').find('.j_curso_conteudo').html(data.result[0]);

                    for (var i = 1; i < total; i++) {
                        $('.posts').find('.j_post_conteudo').append(data.result[i]);
//                            $('.cursos').find('.j_curso_conteudo').append(data.result[i]);
                    }

                    $('.posts').find('.j_post_conteudo').append(data.action_paginator);
                    $('.posts').find('.j_post_conteudo').append(data.paginator);
                    $('.posts').find('.content').fadeIn();
//                        $('.cursos').find('.content').fadeIn();

                    data.result = null;
                }

            }

            if (pesquisa === '') {
//                    $('.trigger-box').fadeOut();
//                    $('.cursos').find('.j_curso_conteudo').fadeOut();
//                    $('.cursos').find('.content').fadeIn();

                $('.posts').find('.content').fadeOut();
//                        $('.cursos').find('.content').fadeOut();
                var total = data.total;
                $('.posts').find('.j_post_conteudo').html(data.result[0]);
//                        $('.cursos').find('.j_curso_conteudo').html(data.result[0]);

                for (var i = 1; i < total; i++) {
                    $('.posts').find('.j_post_conteudo').append(data.result[i]);
//                            $('.cursos').find('.j_curso_conteudo').append(data.result[i]);
                }

                $('.posts').find('.j_post_conteudo').append(data.action_paginator);
                $('.posts').find('.j_post_conteudo').append(data.paginator);
                $('.posts').find('.content').fadeIn();
//                        $('.cursos').find('.content').fadeIn();

                data.result = null;
            }

        }

    });
});
