/* 
 * Script: Posts Comments Script (Scripts de Posts que Possuem Comentários)
 * Author: Luiz Felipe C. Lopes
 * Date: 26/09/2018
 */

$(function () {

    HOME = $('link[rel=js_home]').attr('href');
    var path = HOME + '/Assets/Ajax/ajax.php';


    $('.js_item').on('click', '.js_more_comments', function () {

        var id = $(this).parents('.js_item').attr('id');
        
        $('.js_item#'+id).find('.js_complete_comment').fadeIn(function(){
            $(this).find('.js_less_comments').fadeIn();
            $('#'+id).find('.js_more_comments').fadeOut();
            $(this).find('.js_less_comments').replaceWith('<span style="width:100%;" class="cards_comments_info_comment_more js_less_comments">ocultar</span>');
        });
        
        $('.js_item#'+id).find('.js_hidden_comment').fadeOut();
        
        return false

    });

    $('.js_item').on('click', '.js_less_comments', function () {

        var id = $(this).parents('.js_item').attr('id');
        
        $('.js_item#'+id).find('.js_hidden_comment').fadeIn(function(){
            $(this).find('.js_more_comments').fadeIn();
            $('#'+id).find('.js_less_comments').fadeOut();
            
        });
        
        $('.js_item#'+id).find('.js_complete_comment').fadeOut();
        
        return false

    });

    $('main').on('click', '.js_show_answers', function () {

        var id = $(this).parents('.js_item').attr('id');
        var action = $(this).attr('attr-action');
        var answer = $(this).parent('.comments_moderate_item_buttons').next('.js_comments_answers');

//        console.log(id, action, answer);

        $.post(path, {action: action, id: id}, function (data) {

            if (data.result) {
//                console.log(data.result);
                answer.find('.js_comments_answers_itens').html(data.result);
            } else {
                answer.find('.js_comments_answers_itens').html('');
            }

            answer.toggle();
            answer.toggleClass('active');


//        console.log($(this).parent('.comments_moderate_item_buttons').next('.js_comments_answers').attr('class'));

            if (answer.hasClass('active')) {
                var Myheight = $('footer').position().top + 100;
                $('.js_menu_sidebar').css('cssText', 'height: ' + Myheight + 'px !important;');
            } else {
                var Myheight = $('footer').position().top - 650;
                $('.js_menu_sidebar').css('cssText', 'height: ' + Myheight + 'px !important;');
            }


        }, 'json');

        return false;
    });

    $('main').on('click', '.js_hidden_answer', function () {

        $(this).parent('.js_comments_answers').toggle();
        $(this).parent('.js_comments_answers').toggleClass('active');
        var Myheight = $('footer').position().top - 650;
        $('.js_menu_sidebar').css('cssText', 'height: ' + Myheight + 'px !important;');

    });

    /**
     * MODAL EDIÇÃO DE COMENTÁRIOS
     */

    // Abrir modal para editar comentário
    $('body').on('click', '.js_btn_edit', function () {

        var id = $(this).attr('id');
        var action = $(this).attr('attr-action');
        console.log(id, action);

        $.post(path, {action: action, id: id}, function (data) {

            if (data.result) {

                $('input[name=comentario_id]').val(data.result['comentario_id']);
                $('input[name=comentario_author]').val(data.result['comentario_author']);
                $('.js_modal_form_edit_comment textarea[name=comentario_content]').val(data.result['comentario_content']);
                $('.js_modal_form_edit_comment').fadeIn();

            }


        }, 'json');

        return false;
    });


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

    //    PESQUISAR COMENTÁRIO
    $("body").on("change", ".js_filter_comments", function () {

        var acao = $(this).parents('form').find("input[name=action]").val();
        var id = $(this).parents('form').find("input[name=post_id]").val();
        var status = $("#js_filter_status").val();

        console.log(acao, status, id);

        $.ajax({
            url: path,
            data: {action: acao, status: status, id: id},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }
            , success: function (data) {

                if (data.comments) {

                    $(".js_comments").html(data.comments);
                    $(".js_paginator").replaceWith(data.paginator);

                } else {
                    $(".js_comments").html('Não há resultados para a sua pesquisa!');
                }

            }

        });


    });

//    PAGINAÇAO DE COMENTÁRIOS
    $(".js_comments_container").on('click', ".js_paginator .paginator li a", function () {

        var paginator = $(this).attr("attr-page");
        var acao = $(".js_paginator").attr("attr-action");
        var id = $(".js_paginator").attr("attr-post");
        var status = $("#js_filter_status").val();

        console.log(acao, paginator, status, id);

        $.ajax({
            url: path,
            data: {action: acao, paginator: paginator, status: status, id: id},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

                if (data.comments) {

                    $(".js_comments").html(data.comments);
                    $(".js_paginator").replaceWith(data.paginator);

                } else {
                    $(".js_comments").html('Não há resultados para a sua pesquisa!');
                }
            }

        });
        return false;
    });

});