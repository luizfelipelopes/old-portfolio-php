/* 
 Created on : 03/09/2018, 14:58:49
 Author     : Luiz Felipe
 */

$(function () {

    HOME = $('link[rel=js_home]').attr('href');
    HORA = $("#js_date_now").attr('href');
    var path = HOME + '/Assets/Ajax/ajax.php';

    /**
     * LOGOUT
     */
    $('.js_logout').click(function () {

        $.post(path, {action: 'logout'}, function (data) {

            if (data.path) {
                window.location.href = data.path;
            }

        }, 'json');

        return false;
    });


    /**
     * MENU
     */

    // Click no ícone p/ exibir o Menu

    $('.main_header_top_menu_logo').on('click', '.js_click_menu', function () {

        $('.js_submenu ul').fadeOut();
        $('.js_menu_sidebar').toggle('400');
        $(this).toggleClass('inactive');

        if ($(window).width() >= 1183) {
            if ($(this).hasClass('inactive')) {
                $('main').css('cssText', 'flex-basis: 100%;');
            } else {
                $('main').css('cssText', 'flex-basis: calc(100% - 210px);');
            }
        }

    });


    // Exibir um submenu de um submenu clicado
    $('.js_menu_sidebar').on('click', '.js_submenu', function () {

        var heightUl = $(this).position().top;

        if ($(window).width() < 704) {
            $(this).find('ul').css('cssText', 'top: -' + heightUl + 'px !important;');
        }

        $('.js_submenu').not($(this)).find('ul').fadeOut();
        $(this).find('ul').toggle('400');

        return false;
    });


    // Anular comportamento de click do menu
    $('.js_menu_sidebar').on('click', '.js_submenu ul', function (e) {

        e.stopPropagation();

    });

    // Voltar do submenu para o menu
    $('.js_menu_sidebar').on('click', '.js_voltar', function () {

        $(this).parent('ul').toggle('400');

        return false;
    });


    //    Oculta menu ao clicar em qualquer lugar da tela fora do menu
    $('body').on('click', 'main', function () {

        if ($(window).width() < 704) {
            $('.js_menu_sidebar').fadeOut();
        } else {
            $('.js_submenu ul').fadeOut();
        }

        $('.js_menu_help').fadeOut();
        $('.js_menu_user').fadeOut();

    }

    );

    /**
     * TUTORIAL
     */

    $('.main_header_top_info').on('click', '.js_click_help', function () {

        $('.js_menu_help').toggle('100');

        return false;

    });

    /**
     * USUÁRIO
     */

    $('.main_header_group_user').on('click', '.js_click_user', function () {

        $('.js_menu_user').toggle('100');

        return false;

    });


    /**
     * EXCLUSÃO / CONFIRMAÇÃO
     */

    $('body').on('click', '.js_btn_delete', function () {

        var id = $(this).attr('id');
        var action = $(this).attr('attr-action');
        var parent = $(this).parents('.js_item').attr('attr-parent');

        $('.js_confirmation_delete_yes').attr('id', id);
        $('.js_confirmation_delete_yes').attr('attr-action', action);

        if (parent) {
            $('.js_confirmation_delete_yes').attr('attr-parent', parent);
        }

        $('.js_confirmation_delete').fadeIn();

        return false;
    });

//    Cancelar exclusão
    $('.js_buttons_delete').on('click', '.js_confirmation_delete_no', function () {

        $('.js_confirmation_delete').fadeOut('fast');
//        $(this).parents('.js_confirmation_delete').prev('.js_btn_delete').fadeIn();

        return false;
    });

    //    Confirmar exclusão
    $('.js_buttons_delete').on('click', '.js_confirmation_delete_yes', function () {

        var id = $(this).attr('id');
        var action = $(this).attr('attr-action');
        var parent = $(this).attr('attr-parent');
        var item = $('.js_item#' + id);

        $.post(path, {id: id, parent: parent, action: action}, function (data) {

            if (data.error) {
                $('.js_confirmation_delete').fadeOut('fast');
                $('.js_trigger_absolute').fadeIn();
                $('.js_trigger_absolute').html('<div class="trigger trigger-' + data.error[1] + (data.error[1] === 'success' ? ' icon-check' : (data.error[1] === 'info' ? ' icon-info-circle' : (data.error[1] === 'alert' ? ' icon-alert-triangle' : (data.error[1] === 'error' ? ' icon-error-circle' : '')))) + ' radius">' + data.error[0] + '</div>');
                setTimeout(function () {
                    $('.js_trigger_absolute').fadeOut();
                }, '6000');

                if (data.result) {
                    item.fadeOut();
                }

            }

        }, 'json');

        return false;
    });


    /**
     * MUDAR STATUS
     */

    $('main').on('click', '.js_status', function () {

        var id = $(this).attr('id');
        var status = $(this).attr('attr-status');
        var action = $(this).attr('attr-action');
        var item = $('.js_item#' + id);
//        console.log(path, id, status, action, item);

        $.post(path, {id: id, status: status, action: action}, function (data) {

            if (data.error) {
                $('.js_trigger_absolute').fadeIn();
                $('.js_trigger_absolute').html('<div class="trigger trigger-' + data.error[1] + (data.error[1] === 'success' ? ' icon-check' : (data.error[1] === 'info' ? ' icon-info-circle' : (data.error[1] === 'alert' ? ' icon-alert-triangle' : (data.error[1] === 'error' ? ' icon-error-circle' : '')))) + ' radius">' + data.error[0] + '</div>');
                setTimeout(function () {
                    $('.js_trigger_absolute').fadeOut();
                }, '4000');
            }

            if (data.result) {

                item.find('.js_container_status').html('<a id="' + id + '" attr-status="' + data.status + '" attr-action="' + action + '" title="Publicado" href="#" class="icon-' + (data.status === '1' ? 'check' : 'alert-triangle') + ' btn_status btn_status_published btn btn-small btn-' + (data.status === '1' ? 'green' : 'orange') + ' radius js_status">' + (data.status === '1' ? (data.legend ? data.legend : 'Publicado') : (data.legend ? data.legend : 'Rascunho')) + '</a>');
            }

        }, 'json');



        return false;
    });





    /**
     * TUTORIAIS
     */
    // Abrir modal com o video tutorial ao clicar na opção do drop-down
    $('.js_menu_help').on('click', '.menu_tutorial_section ol li', function () {

        var link = $(this).attr('attr-video');

        $('.js_modal_tutorial').find('.js_iframe_tutorial').html('<iframe src="https://www.youtube.com/embed/' + link + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
        $('.js_modal_tutorial').fadeIn('fast');

        return false;

    });

    // Fecha modal do tutorial
    $('.js_modal_tutorial').on('click', '.modal_container_tutorial .js_close_tutorial', function () {

        $('.js_modal_tutorial').fadeOut('fast');
        $('.js_modal_tutorial').find('.js_iframe_tutorial').html('');

        return false;

    });


    /**
     * FORM GLOBAL DO SISTEMA
     */
    $('main').on('submit', 'form[class != js_form_modal]', function () {

        var form = $(this);
        var classeTinyMCE = form.find('#js_post').attr('class');
        var dados = '';

        // Identifica se há algum textarea carregando o plugin tinyMCE (Editor de Texto)
        if (classeTinyMCE !== undefined) {
            tinyMCE.triggerSave(true, true);
            dados = $(this).serializeArray();
        } else {
            dados = $(this).serialize();
        }

        form.ajaxSubmit({

            url: path,
            data: dados,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.js_modal_loading').fadeIn('fast'); // Exibe barra de carregamento enquanto o cadastro/edição é executado
            }, success: function (data) {

                $('.js_modal_loading').fadeOut('fast'); // Oculta barra de carregamento ao concluir cadastro/edição

                if (data.path) {
                    window.location.href = data.path;
                }

                // Exibe menssagem enviada pelo sistema, caso tenha alguma
                if (data.error) {
                    $('.js_trigger_absolute').fadeIn();
                    $('.js_trigger_absolute').html('<div class="trigger trigger-' + data.error[1] + (data.error[1] === 'success' ? ' icon-check' : (data.error[1] === 'info' ? ' icon-info-circle' : (data.error[1] === 'alert' ? ' icon-alert-triangle' : (data.error[1] === 'error' ? ' icon-error-circle' : '')))) + ' radius">' + data.error[0] + '</div>');
                    setTimeout(function () {
                        $('.js_trigger_absolute').fadeOut();
                    }, '4000');
                }

                // Limpa o formulário
                if (!data.noclear) {

                    $('.js_video_left_preview').fadeOut('fast');
                    $('.js_video_preview .embed-container iframe').attr('src', 'https://www.youtube.com/embed/');
                    $('.js_preview_image').attr('src', '');
                    $('input[type=text], input[type=file], input[type=password], textarea').val('');
//                    $('select').val(null);
                    if (!$('select option:first').val()) {
                        $('select').val(null);
                    } else {
                        $('select').val($('select option:first').val());
                    }

//                    $('select').get('0').prop('selected', true);
                    $('#calendar').val(HORA);
                    $('input[type=checkbox]').prop('checked', true);
                    if (classeTinyMCE !== undefined) {
                        tinyMCE.activeEditor.setContent('');
                    }
                }

                if (data.create_comment) {
                    $('#' + data.id + '.js_item').find('.js_comments_answers_itens').append(data.create_comment);
                }
                
                if(data.sections){
                    $('.js_sections').html(data.sections);
                }

            }

        });

        return false;

    });

    /**
     * FORM QUE ESTÃO EM MODAIS NO SISTEMA
     */
    $('main').on('submit', '.js_form_modal', function () {

        var form = $(this);
        var dados = $(this).serialize();
        console.log(dados);

        form.ajaxSubmit({

            url: path,
            data: dados,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
//                $('.js_modal_loading').fadeIn('fast');
            }, success: function (data) {

                // Exibe menssagem enviada pelo sistema, caso tenha alguma
                if (data.error) {
                    $('.js_trigger_absolute').fadeIn();
                    $('.js_trigger_absolute').html('<div class="trigger trigger-' + data.error[1] + (data.error[1] === 'success' ? ' icon-check' : (data.error[1] === 'info' ? ' icon-info-circle' : (data.error[1] === 'alert' ? ' icon-alert-triangle' : (data.error[1] === 'error' ? ' icon-error-circle' : '')))) + ' radius">' + data.error[0] + '</div>');
                    setTimeout(function () {
                        $('.js_trigger_absolute').fadeOut();
                    }, '4000');
                }

                // Limpa o formulário
                if (!data.noclear) {

                    $('.js_video_left_preview').fadeOut('fast');
                    $('.js_video_preview .embed-container iframe').attr('src', 'https://www.youtube.com/embed/');
                    $('.js_preview_image').attr('src', '');
                    $('input[type=text], input[type=file], input[type=password], textarea').val('');
//                    $('select').val(null);
                    if (!$('select option:first').val()) {
                        $('select').val(null);
                    } else {
                        $('select').val($('select option:first').val());
                    }

                    $('#calendar').val(HORA);
                    $('input[type=checkbox]').prop('checked', true);

                }


                if (data.update_comment) {

                    console.log(data.result['id']);
                    $('#' + data.result['id']).find((data.result['child'] ? '.js_comment_info_child' : '.js_comment_info_parent') + ' h3').text(data.result['nome']);
                    $('#' + data.result['id']).find((data.result['child'] ? '.js_comment_info_child' : '.js_comment_info_parent') + ' .js_comment_content').text(data.result['content']);
                    $('.js_modal_form_edit_comment').fadeOut('fast');
                }


            }

        });

        return false;

    });


    //    PREVIA DE IMAGEM UPADA
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".js_preview_image").attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }

    }

    $(".js_change_image_preview").change(function () {
        readURL(this);
    });


//    Previa de Video Esquerda
    $('form').on('keyup', '.js_keyup_preview_left', function () {

        if ($(this).val().length > 0) {
            $('.js_video_preview').fadeIn('fast');
            $('.js_video_preview .embed-container').html('<iframe src="https://www.youtube.com/embed/' + $(this).val() + '" frameborder="0" allowfullscreen></iframe>');
        } else {
            $('.js_video_preview').fadeOut('fast');
            $('.js_video_preview .embed-container').html('');
        }

    });

    //    Previa de Video Direita
    $('form').on('keyup', '.js_keyup_preview_right', function () {

        if ($(this).val().length > 0) {
            $('.js_video_preview .embed-container').html('<iframe src="https://www.youtube.com/embed/' + $(this).val() + '" frameborder="0" allowfullscreen></iframe>');
        } else {
            $('.js_video_preview .embed-container').html('<iframe src="https://www.youtube.com/embed/" frameborder="0" allowfullscreen></iframe>');
        }

    });


    // Sair de Modais Com as Teclas ESC
    $('body').on('keydown', document, function (e) {

        // se tecla  ESC for pressionada
        if (e.keyCode == 27) {
            $('.js_modal').fadeOut('fast');
        }
    });

    // Sair de Modais Com o botão cancelar
    $('main').on('click', '.js_close_modal', function () {

        $('.js_modal').fadeOut('fast');

    });


    $("#calendar").datepicker({
        dateFormat: 'dd/mm/yy',
        onSelect: function (dateText) {

            var d = new Date();
            var h = ('0' + d.getHours()).slice(-2);
            var m = ('0' + d.getMinutes()).slice(-2);
//            var s = ('0' + d.getSeconds()).slice(-2);
            dateText = dateText + " " + h + ":" + m;
            $("#calendar").val(dateText);

        },
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        showOtherMonths: true,
        selectOtherMonths: true
    });


});