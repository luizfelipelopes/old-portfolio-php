/**
 * script_forms.inc.js - <b>SCRIPT FORMS</b>
 * Arquivo de inclusão do scripts.js para armazenar dos Forms do Sistema
 */

//    SUBMETE TODOS OS FORMS DO SISTEMA
$('.js_content_form').on('submit', 'form', function () {

    $(".j_valor_descontado").prop("disabled", false);

    var form = $(this);
    var classeTinyMCE = form.find('#j_post').attr('class');
    if (classeTinyMCE !== undefined) {
        tinyMCE.triggerSave(true, true);
    }
    var dados = $(this).serializeArray();
    

    form.ajaxSubmit({
        url: 'ajax/ajax.php',
        data: dados,
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            $('.load').fadeIn(500);
        },
        success: function (data) {

            $('.load').fadeOut();

            if (data.error) {
                $('.trigger-box-suspenso').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                $('.trigger-box-suspenso').fadeIn(400);
                setTimeout(function () {
                    $('.trigger-box-suspenso').fadeOut();
                }, 3000);
                form.find('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
            }

//            MODAL DE FILTRO POR DATA PERSONALIZADA
            if (data.filtro_personalizado && data.result) {

                var paginator = $('.paginator');
                $('.js_paginator').find('.content').fadeOut();
                $(".j_paginator").remove();
                $(paginator).remove();
                var total = data.total;
                $('.js_paginator').find('.j_post_conteudo').html(data.result[0]);

                if (data.total > 1) {
                    for (var i = 1; i < total; i++) {
                        $('.js_paginator').find('.j_post_conteudo').append(data.result[i]);
                    }
                }

                $('.js_paginator').find('.j_post_conteudo').append(data.action_paginator);
                $('.js_paginator').find('.j_post_conteudo').append(data.paginator);
                $('.js_paginator').find('.content').fadeIn();

                $('select[name=filtro]').val('todos');
            }


            if (data.nota_total) {

                var id = "#" + form.find('input[name=nota_total]').attr('id');
                $(id).val(data.nota_total);
                if (data.nota_status) {
                    var id_status = "#" + form.find('.j_status').attr('id');
                    console.log(id_status);
                    form.find(".j_status").html(data.nota_status);
                }

            }

            if (data.result) {

                $('.aulas-criadas').find('.j_dinamic').fadeOut();
                var total = data.total;
                $('.aulas-criadas').find('.j_dinamic').html(data.result[0]);
                for (var i = 1; i < total; i++) {
                    $('.aulas-criadas').find('.j_dinamic').append(data.result[i]);
                }

                $('.aulas-criadas').find('.j_dinamic').fadeIn();
                data.result = null;
            }

            if (data.hide_field) {

                if (data.result_materiais) {


                    $('input[type=file]').val(null);
                    $('input[type=file]').fadeOut();
                    $('.j_up_material').find('.materiais-cadastrados').fadeOut();
                    var id_material = '#' + data.result_materiais[0]['material_id'];
                    $('.j_up_material').find('.j_lista_material').html('<span class="j_material_listado" id="' + data.result_materiais[0]['material_id'] + '"><span  class="coluna-material"> ' + data.result_materiais[0]['material_title'] + '</span> <a id="' + data.result_materiais[0]['material_id'] + '" class="btn btn-blue radius j_editar_material">Editar</a> <a class="btn btn-red radius j_excluir" attr-action="delete_material" id="' + data.result_materiais[0]['material_id'] + '" >Excluir</a></span> ');
                    console.log(id_material);
                    for (var i = 1; i < data.total_materiais; i++) {

                        var id_materiais = '#' + data.result_materiais[i]['material_id'];
                        console.log(id_materiais);
                        $('.j_up_material').find('.j_lista_material').append('<span class="j_material_listado" id="' + data.result_materiais[i]['material_id'] + '"> <span class="coluna-material"> ' + data.result_materiais[i]['material_title'] + '</span> <a id="' + data.result_materiais[i]['material_id'] + '" class="btn btn-blue radius j_editar_material">Editar</a> <a class="btn btn-red radius j_excluir" attr-action="delete_material" id="' + data.result_materiais[i]['material_id'] + '" >Excluir</a></span> ');
                    }
//                        $('.j_up_material').find('input[type=file]').val('');
//                        $('.materiais-cadastrados').fadeOut();
//                        $('.j_up_material').find('input[type=file]').fadeIn();
//                            $('.j_up_material').find('.materiais-cadastrados').fadeIn();
                }

            }

            if (data.result_comentarios) {

                var id = '#' + data.comentario_pai;
                console.log(id);

                $(id).children('.comentarios-resposta').find('.j_dinamic').fadeOut();
                var total = data.total;
                $(id).children('.comentarios-resposta').html(data.result_comentarios[0]);

                for (var i = 1; i < total; i++) {
                    $(id).children('.comentarios-resposta').append(data.result_comentarios[i]);
                }

                $(id).children('.comentarios-resposta').find('.j_dinamic').fadeIn();
                data.result_comentarios = null;
            }

            if (data.edicao_comentarios) {

                var comentario_id = "#" + data.comentario_id;
                $('.j_popup').fadeOut();

                if (data.comentario_author) {
                    $(comentario_id).find('.js_get_author').first().html(data.comentario_author);
                }

                $(comentario_id).find('.js_get_content').first().html(data.comentario_content);

            }




            if (!data.naolimpar) {

                $(".j_previa").attr('src', '');
                $('input[type=text], input[type=file]').val('');
                $('#calendar').val(HORA);
                $('textarea').val('');
                $('select').val('');
                $('.js_campo_oculto').fadeOut();
                $('.j_limpa_capa').html('<img title="" src="" class="j_previa"/>');
                $('.gallery_itens').html('');
                $(".j_desconto").prop("disabled", true);
                $(".j_valor_descontado").prop("disabled", true);
                $('input[type=radio]').prop('checked', false);
                $('input[type=checkbox]').prop('checked', false);

                if (classeTinyMCE !== undefined) {
                    tinyMCE.activeEditor.setContent('');
                }

            }

        }

    });
    return false;
});



$(".form-search").submit(function () {

    var pesquisa = $(this).val();
    var form = $(this);
    var dados = $(this).serializeArray();
    form.ajaxSubmit({
        url: 'ajax/ajax.php',
        data: dados,
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            $('.load').fadeIn(500);
        },
        success: function (data) {

            if (data.error && pesquisa !== '') {
//                    $('.trigger-box').fadeIn();
//                    $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                $('.posts').find('.content').fadeOut();
//                    $('.cursos').find('.content').fadeOut();
            }

            if (data.success && pesquisa !== '') {
//                    $('.trigger-box').fadeIn();
//                    $('.trigger-box').html("<p class=\"trigger " + data.success[1] + "\">" + data.success[0] + "<span class=\"ajax_close\">X</span></p>");


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


//FORM PARA FILTRO DE DATAS PERSONALIZADO
$(".pedido-personalizado").submit(function () {

    var form = $(this);
    var dados = $(this).serializeArray();
    form.ajaxSubmit({
        url: 'ajax/ajax.php',
        data: dados,
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {

            $('.fundo-pedido').fadeOut();
            $('select[name=filtro_pedido_data]').find('option[value=todos]').prop('selected', true);

            if (data.venda_carrinho) {



                $('.linha').fadeOut();

                $('.j_pedidos_real_time').html(data.venda_carrinho[0]);

                for (var i = 1; i < data.total; i++) {
                    $('.j_pedidos_real_time').append(data.venda_carrinho[i]);

                }

            }



        }
    });
});

//VISIBILIDADE DOS CAMPOS
$("input[name=isca_arquivo_url]").change(function(){
   
   if($(this).val() === '1'){
       $('input[name=isca_file]').parents('label').fadeOut();
       $('.js_video_option').fadeIn();
       $('input[name=isca_url]').parents('label').fadeIn();
   }else{
       $('input[name=isca_file]').parents('label').fadeIn();
       $('.js_video_option').fadeOut();
       $('input[name=isca_url]').parents('label').fadeOut();
   }
   
//   console.log('funcionando');
   
//   return false;
    
});