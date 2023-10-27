/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    HOME = $("#j_base").attr('href');

// EXIBE O CAMPO PARA ESCRITA DO COMENTÁRIO
    $('body').on('click', '.js_responder', function () {

        var post_id = $(this).parents('.comentario').attr('attr-post');
        var comentario = $(this).parents('.comentario').attr('id');

        if ($(this).text() === 'Cancelar') { // CANCELA A OPÇÂO DE CADASTRO DE COMENTÁRIO, OCULTANDO O FORM E MUDANDO A PALAVRA 'CANCELAR' PARA 'RESPONDER'
            $(this).text('Responder');

            $("#" + comentario).nextAll('.js_append_form_comentario').html('');

        } else if ($(this).text() === 'Responder') { // EXIBE A OPCÇÂO DE RESPONDER UM COMENTÀRIO EXIBINDO O FORM E MUDANDO A PALABRA 'RESPONDER' PARA 'CANCELAR'
            $(this).text('Cancelar');

            $.post(HOME + '/_cdn/ajax/ajax.php', {action: 'responder_comentario', post_id: post_id, comentario: comentario}, function (data) {
                if (data.textarea) {
                    $("#" + comentario).nextAll('.js_append_form_comentario').html(data.textarea);
                }
            }, 'json');

        }

        return false;

    });

});