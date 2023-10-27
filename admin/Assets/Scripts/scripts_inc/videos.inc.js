/* 
 * Script: Posts Script (Scripts de Posts)
 * Author: Luiz Felipe C. Lopes
 * Date: 10/09/2018
 */

$(function () {

    HOME = $('link[rel=js_home]').attr('href');
    var path = HOME + '/Assets/Ajax/ajax.php';

    //    FILTRO POSTS
    $("body").on("change", ".js_filter_videos", function () {

        var acao = $(this).parents('form').find("input[name=action]").val();
        var status = $("#js_filter_status").find("option:selected").val();
        var search = $("#js_filter_search").val();

        console.log(acao, status, search);

        $.ajax({
            url: path,
            data: {action: acao, status: status, search: search},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }
            , success: function (data) {

                if (data.videos) {

                    $(".js_videos").html(data.videos);
                    $(".js_videos").append(data.paginator);

                } else {
                    $(".js_videos").html('Não há resultados para a sua pesquisa!');
                }

            }

        });


    });

    //    PESQUISAR POST
    $("body").on("keyup", ".js_search_video", function () {

        var acao = $(this).parents('form').find("input[name=action]").val();
        var status = $("#js_filter_status").find("option:selected").val();
        var search = $("#js_filter_search").val();

        console.log(acao, status, search);

        $.ajax({
            url: path,
            data: {action: acao, status: status, search: search},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }
            , success: function (data) {

                if (data.videos) {

                    $(".js_videos").html(data.videos);
                    $(".js_videos").append(data.paginator);

                } else {
                    $(".js_videos").html('Não há resultados para a sua pesquisa!');
                }

            }

        });


    });

//    PAGINAÇAO DE POSTS
    $(".js_videos").on('click', ".js_paginator .paginator li a", function () {

        var paginator = $(this).attr("attr-page");
        var acao = $(".js_paginator").attr("attr-action");
        var status = $("#js_filter_status").find("option:selected").val();
        var section = $(this).parents('.js_paginator').attr('attr-section');
        var category = $("#js_filter_category").find("option:selected").val();
        var search = $("#js_filter_search").val();

        console.log(acao, paginator, status, section, category, search);

        $.ajax({
            url: path,
            data: {action: acao, paginator: paginator, status: status, section: section, category: category, search: search},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

                if (data.videos) {

                    $(".js_videos").html(data.videos);
                    $(".js_videos").append(data.paginator);

                } else {
                    $(".js_videos").html('Não há resultados para a sua pesquisa!');
                }
            }

        });
        return false;
    });

});