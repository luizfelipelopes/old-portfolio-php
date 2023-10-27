/* 
 * Script: E-mails Script (Scripts de E-mails)
 * Author: Luiz Felipe C. Lopes
 * Date: 01/10/2018
 */

$(function () {

    HOME = $('link[rel=js_home]').attr('href');
    var path = HOME + '/Assets/Ajax/ajax.php';

    //    FILTRAR LEADS
    $("body").on("change", ".js_filter_leads", function () {

        var acao = $(this).parents('form').find("input[name=action]").val();
        var date = $("#js_filter_date").val();
        var origin = $("#js_filter_origin").val();

        console.log(acao, date, origin);

        $.ajax({
            url: path,
            data: {action: acao, date: date, origin: origin},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }
            , success: function (data) {

                if (data.leads) {

                    $(".js_leads").html(data.leads);
                    $(".js_leads").append(data.paginator);

                } else {
                    $(".js_leads").html('Não há resultados para a sua pesquisa!');
                }

            }

        });


    });

//    PAGINAÇAO DE COMENTÁRIOS
    $(".js_leads").on('click', ".js_paginator .paginator li a", function () {

        var paginator = $(this).attr("attr-page");
        var acao = $(".js_paginator").attr("attr-action");
        var date = $("#js_filter_date").val();
        var origin = $("#js_filter_origin").val();

        console.log(acao, paginator, date, origin);

        $.ajax({
            url: path,
            data: {action: acao, paginator: paginator, date: date, origin: origin},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

                if (data.leads) {

                    $(".js_leads").html(data.leads);
                    $(".js_leads").append(data.paginator);

                } else {
                    $(".js_leads").html('Não há resultados para a sua pesquisa!');
                }

            }

        });
        return false;
    });

});