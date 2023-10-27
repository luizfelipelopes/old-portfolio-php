/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

    HOME = $("#j_base").attr('href');
    THEME = $("#j_theme").attr('href');
    var path = HOME + '/themes/' + THEME + '/ajax/ajax.php';

    $('footer').on('click', '.js_exibir_autor', function () {
        $('.js_autor').fadeIn();
        return false;
    });

    $('footer').on('click', '.js_exibir_termos', function () {
        $('.js_termos').fadeIn();
        return false;
    });

    $('body').on('click', '.ajax_close', function () {
        $('.j_popup').fadeOut();
    });

    //    PARA FECHAR JANELA COM BOTAO ESC
    $(document).bind('keydown', function (e) {

        if (e.which == 27) {
            $('.j_popup').fadeOut();
        }
    });

    /**
     * Evento responsável por controlar a compra do serviço e redirecionar para a página de pagamento
     */
    $('.botao_apresentacao_venda').on('click', '.js_buy_service', function () {

        var id = $(this).attr('id');
        var interest = $(this).attr('attr-interest');
        var mail = $(this).attr('attr-email');
        var name = $(this).attr('attr-name');
        console.log(id, mail, name, interest);

        $.ajax({
            url: path,
            data: {action: 'buy_service', id: id, mail: mail, name: name, interest: interest},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.js_modal_loading').fadeIn('fast');
            },
            success: function (data) {

                $('.js_modal_loading').fadeOut('fast');

                if (data.path) {
                    window.location.href = data.path;
                }

            }
        });


        return false;
    });

});