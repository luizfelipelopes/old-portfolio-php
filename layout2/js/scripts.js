/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

//    alert('Carregado');
    
    var path = 'ajax/ajax.php';

    //    SUBMETE TODOS OS FORMS DO SISTEMA
    $('.js_content_form').on('submit', 'form', function () {

//        alert('Form');

        var form = $(this);
        var classeTinyMCE = form.find('#j_post').attr('class');
        if (classeTinyMCE !== undefined) {
            tinyMCE.triggerSave(true, true);
        }
        var dados = $(this).serializeArray();
        console.log(dados);
//        alert(dados);

        form.ajaxSubmit({
            url: path,
            data: dados,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.load').fadeIn(500);
            },
            success: function (data) {

                $('.load').fadeOut();

                if (data.caminho) {
                    window.location.href = data.caminho;
                }

                /*
                 * =====================================
                 * ==========GATILHOS GERAIS============
                 * =====================================
                 */

                // EXIBE MENSAGEM APÓS O CADASTRO DO COMENTÁRIO
                if (data.error) {
                    $('.trigger-box-suspenso').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                    $('.trigger-box-suspenso').fadeIn(400);
                    setTimeout(function () {
                        $('.trigger-box-suspenso').fadeOut();
                    }, 3000);
                    form.find('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
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


});