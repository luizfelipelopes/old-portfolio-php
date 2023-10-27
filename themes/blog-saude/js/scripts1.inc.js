/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

    var path = 'ajax/ajax.php';

////    SLIDE MENU MOBILE
//    $('.j_menu_mobile').click(function (event) {
//
//        console.log('slide');
//        event.stopPropagation();
//
//        if (!$(this).hasClass('active')) {
//            $(this).addClass('active');
//            $('.main_nav').animate({left: '0px'}, 300);
//            $('.j_close').fadeIn(200);
//        } else {
//            $(this).removeClass('active');
//            $('.main_nav').animate({left: '-100%'}, 300);
//            $('.j_close').animate({left: '-200%'}, 300);
//        }
//
//    });
//
////    FECHA O MENU CLICANDO NO ICONE FECHAR
//    $('.j_close').click(function () {
//        $('.j_menu_mobile').removeClass('active');
//        $('.main_nav').animate({left: '-100%'}, 300);
//        $(this).animate({left: '-200%'}, 300);
//    });
//


    //    SLIDE SEARCH
    $('.js_search_icon').click(function (event) {

        console.log('Clique');

        event.stopPropagation();

        if (!$(this).parents('.js_search').hasClass('active')) {
            $(this).parents('.js_search').addClass('active');
            if ($(window).width() >= 960) {
                $(this).parents('.js_search').animate({right: '-10px'}, 300);
            } else {
                $(this).parents('.js_search').animate({right: '-50px'}, 300);
            }
//            $('.j_close').fadeIn(200);
        } else {
            $(this).parents('.js_search').removeClass('active');
            if ($(window).width() >= 960) {
                $(this).parents('.js_search').animate({right: '-210px'}, 300);
            } else {
                $(this).parents('.js_search').animate({right: '-280px'}, 300);
            }

//            $('.j_close').animate({left: '-200%'}, 300);
        }

    });

    //    FECHA O MENU CLICANDO EM QUALQUER LUFAR FORA DO MENU
    $('header, footer, section, article, nav, .bloco_slide').click(function () {
        $('.js_search').removeClass('active');
        if ($(window).width() >= 960) {
            $('.js_search').animate({right: '-210px'}, 300);
        } else {
            $('.js_search').animate({right: '-280px'}, 300);
        }
    });

});