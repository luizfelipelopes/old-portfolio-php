$(function () {
//    alert('Funcionando');
    HOME = $("#j_base").attr('href');
    console.log(HOME);

//    /**
//     * RESOLUÇÃO DE IMAGENS (LAZY IMAGES)
//     */
//
//    document.addEventListener("DOMContentLoaded", function () {
//
//        var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
//        console.log(lazyImages);
//        
//        
//        if ("IntersectionObserver" in window && "IntersectionObserverEntry" in window && "intersectionRatio" in window.IntersectionObserverEntry.prototype) {
//            let lazyImageObserver = new IntersectionObserver(function (entries, observer) {
//                entries.forEach(function (entry) {
//                    if (entry.isIntersecting) {
//                        let lazyImage = entry.target;
//                        lazyImage.src = lazyImage.dataset.src;
//                        lazyImage.srcset = lazyImage.dataset.srcset;
//                        lazyImage.classList.remove("lazy");
//                        lazyImageObserver.unobserver(lazyImage);
//                    }
//                });
//            });
//
//            lazyImages.forEach(function (lazyImage) {
//                lazyImageObserver.observer(lazyImage);
//            });
//        }
//
//    });

//DEBUG PARA CONFIGURAR RESOLUÇÂO DE IMAGENS
    $('.debug').each(function () {
//            $(this).after('<p style="color:#fff; background:#333; padding: 10px">' + $(this).width() + 'px</p>')
    });

//    SUBMETE TODOS OS FORMS DO SISTEMA
    $('body').on('submit', 'form[id != search]', function () {

        console.log('Entrou');

        var form = $(this);
        var classeTinyMCE = form.find('#j_post').attr('class');
        if (classeTinyMCE !== undefined) {
            tinyMCE.triggerSave(true, true);
        }
        var dados = $(this).serializeArray();
        console.log(dados, HOME);

        form.ajaxSubmit({
            url: HOME + '/_cdn/ajax/ajax.php',
            data: dados,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.js_modal_loading').fadeIn(500);
                $('.load').fadeIn(500);
            },
            success: function (data) {

                $('.js_modal_loading').fadeOut();
                $('.load').fadeOut();

                if (data.caminho) {
                    window.location.href = data.caminho;
                }

                /*
                 * =====================================
                 * ==========APP COMENTÀRIOS============
                 * =====================================
                 */

                if (data.comentario_item) { // INSERE RESPOSTA DINAMICAMENTE E MUDA AS PALAVRAS DA OPCAO RESPONDER

                    if (data.resposta) {
                        $("#" + data.resposta).nextAll('.js_append_resposta').append(data.comentario_item);
                        form.fadeOut('fast');
                        $("#" + data.resposta).find('.js_responder').text('Responder');
                    } else {
                        $('.js_append_comment').prepend(data.comentario_item);
                        $('.js_comentario_post').find('.trigger').remove();

                    }

                    $('.js_total_comentario').text(data.total_comentarios);

                } else {
                    if (data.resposta) {
                        form.fadeOut('fast');
                        $("#" + data.resposta).find('.js_responder').text('Responder');
                    }
                }


                /*
                 * =====================================
                 * ==========GATILHOS GERAIS============
                 * =====================================
                 */

                // EXIBE MENSAGEM APÓS O CADASTRO DO COMENTÁRIO
                if (data.error) {
//                    console.log('<div class="trigger trigger-' + data.error[1] + (data.error[1] === 'success' ? ' icon-check' : (data.error[1] === 'info' ? ' icon-info-circle' : (data.error[1] === 'alert' ? ' icon-alert-triangle' : (data.error[1] === 'error' ? ' icon-error-circle' : '')))) + ' radius">' + data.error[0] + '</div>');
                    $('.js_trigger_absolute').fadeIn(400);
                    $('.js_trigger_absolute').html('<div class="trigger trigger-' + data.error[1] + (data.error[1] === 'success' ? ' icon-check' : (data.error[1] === 'info' ? ' icon-info-circle' : (data.error[1] === 'alert' ? ' icon-alert-triangle' : (data.error[1] === 'error' ? ' icon-error-circle' : '')))) + ' radius">' + data.error[0] + '</div>');
                    setTimeout(function () {
                        $('.js_trigger_absolute').fadeOut();
                    }, 4000);
                    
//                    form.find('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");;
                }
//
//  
                // LIMPA TODOS OS CAMPOS DO FORMULÁRIO    
                if (!data.naolimpar) {

                    $(".j_previa").attr('src', '');
                    $('input[type=text], input[type=email], input[type=file]').val('');
//                    $('#calendar').val(HORA);
                    $('textarea').val('');
                    $('select').val('');
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


    //    VERIFICAR E ATUALIZAR STATUS DE POST AUTOMATICAMENTE
//    setInterval(function () {
//
//        $.post(path, {action: 'atualizar_status_post_realtime'}, function (data) {
//
//            if (data.error) {
//                console.log(data.error);
//            }
//
//        }, 'json');
//
//    }, '600000');


});