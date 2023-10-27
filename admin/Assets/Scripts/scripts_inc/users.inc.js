/* 
 * Script: Users Script (Scripts de Usuários)
 * Author: Luiz Felipe C. Lopes
 * Date: 25/09/2018
 */

$(function () {

    HOME = $('link[rel=js_home]').attr('href');
    var path = HOME + '/Assets/Ajax/ajax.php';

    
    //    PESQUISAR POST
    $("body").on("keyup", ".js_search_user", function () {

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

                if (data.users) {

                    $(".js_users").html(data.users);
                    $(".js_users").append(data.paginator);

                } else {
                    $(".js_users").html('Não há resultados para a sua pesquisa!');
                }

            }

        });


    });

//    PAGINAÇAO DE POSTS
    $(".js_users").on('click', ".js_paginator .paginator li a", function () {

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

                if (data.users) {

                    $(".js_users").html(data.users);
                    $(".js_users").append(data.paginator);

                } else {
                    $(".js_users").html('Não há resultados para a sua pesquisa!');
                }
            }

        });
        return false;
    });

});