/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

    var path = 'ajax/ajax.php';

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

});