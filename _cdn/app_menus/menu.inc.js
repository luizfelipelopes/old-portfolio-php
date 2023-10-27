/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

//    SLIDE MENU MOBILE
    $('.j_menu_mobile').click(function (event) {

        event.stopPropagation();

        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
            $('.main_nav').animate({left: '0px'}, 300);
            $('.j_close').fadeIn(200);
        } else {
            $(this).removeClass('active');
            $('.main_nav').animate({left: '-100%'}, 300);
            $('.j_close').animate({left: '-200%'}, 300);
        }

    });

//    FECHA O MENU CLICANDO NO ICONE FECHAR
    $('.j_close').click(function () {
        $('.j_menu_mobile').removeClass('active');
        $('.main_nav').animate({left: '-100%'}, 300);
        $(this).animate({left: '-200%'}, 300);
    });

//    FECHA O MENU CLICANDO EM QUALQUER LUFAR FORA DO MENU
    $('html').click(function () {
        $('.j_menu_mobile').removeClass('active');
        $('.main_nav').animate({left: '-100%'}, 300);
        $('.j_close').animate({left: '-200%'}, 300);
    });

//SLIDE ANIMATE MENU

    $('.main_nav a[class!=link]').click(function () {

        var goto = $('.' + $(this).attr('href').replace('#', '')).position().top;

        $('html, body').animate({scrollTop: goto}, 1000);

        return false;
    });


// BOTÂO DE SUBIR  AO TOPO
    $('.j_back').click(function () {
        $('html, body').animate({scrollTop: 0}, 1000);
        return false;
    });


// APARECE ICONE TOPO PARA VOLTAR PARA O TOPO DA PÀGINA DE ACORDO COM A ROLAGEM DA TELA
    $(window).scroll(function () {

        if ($(this).scrollTop() > $('.main_header').outerHeight()) {
            $('.j_back').fadeIn(300);
        } else {
            $('.j_back').fadeOut(300);
        }


    });

});