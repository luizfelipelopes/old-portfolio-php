/* 
 * Script: Posts Comments Script (Scripts de Posts que Possuem Comentários)
 * Author: Luiz Felipe C. Lopes
 * Date: 26/09/2018
 */

$(function () {

    HOME = $('link[rel=js_home]').attr('href');
    var path = HOME + '/Assets/Ajax/ajax.php';

    
    //    PESQUISAR POST
    $("body").on("keyup", ".js_search_post_comment", function () {

        var acao = $(this).parents('form').find("input[name=action]").val();
        var search = $("#js_filter_search").val();

//        console.log(acao, search);

        $.ajax({
            url: path,
            data: {action: acao, search: search},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }
            , success: function (data) {

                if (data.posts) {

                    $(".js_posts_comments").html(data.posts);
                    $(".js_posts_comments").append(data.paginator);

                } else {
                    $(".js_posts_comments").html('Não há resultados para a sua pesquisa!');
                }

            }

        });


    });

//    PAGINAÇAO DE POSTS
    $(".js_posts_comments").on('click', ".js_paginator .paginator li a", function () {

        var paginator = $(this).attr("attr-page");
        var acao = $(".js_paginator").attr("attr-action");
        var search = $("#js_filter_search").val();

        console.log(acao, paginator, search);

        $.ajax({
            url: path,
            data: {action: acao, paginator: paginator, search: search},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

                if (data.posts) {

                    $(".js_posts_comments").html(data.posts);
                    $(".js_posts_comments").append(data.paginator);

                } else {
                    $(".js_posts_comments").html('Não há resultados para a sua pesquisa!');
                }
            }

        });
        return false;
    });

});