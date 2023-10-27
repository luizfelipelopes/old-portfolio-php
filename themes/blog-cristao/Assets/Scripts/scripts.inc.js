/* 
 * <b>Scripts.js</b>: script responsável pelos eventos gerais do site
 * Criado em: 04/01/2019 às 08:51
 * Author: Luiz Felipe C. Lopes
 */

$(function () {
    

    var path = 'ajax/ajax.php';
    var screen = $('body').width(); // Captura Resolução Atual

    // IMPEDE QUE O MENU SUMA AO CLICAR NO CORPO DO SITE EM DISPOSITIVOS DESKTOP's
    if (screen >= 883) {
        $('.menu').removeClass('main_nav');
    }

//    SLIDE MENU MOBILE
    $('.js_menu_mobile').click(function (event) {

        event.stopPropagation();

        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
            $('.main_nav').animate({left: '0px'}, 300);
            $('.js_close').fadeIn(200);
        } else {
            $(this).removeClass('active');
            $('.main_nav').animate({left: '-100%'}, 300);
            $('.js_close').animate({left: '-200%'}, 300);
        }

    });

//    FECHA O MENU CLICANDO NO ICONE FECHAR
    $('.js_close').click(function () {
        $('.js_menu_mobile').removeClass('active');
        $('.main_nav').animate({left: '-100%'}, 300);
        $(this).animate({left: '-200%'}, 300);
    });

//    FECHA O MENU CLICANDO EM QUALQUER LUGAR FORA DO MENU
    $('html').click(function () {
        $('.js_menu_mobile').removeClass('active');
        $('.main_nav').animate({left: '-100%'}, 300);
        $('.js_close').animate({left: '-200%'}, 300);

    });

    $('header, main, footer').click(function () {
        
        $('.js_search').removeClass('active');

        if (screen >= 883) {
            $('.js_search').removeClass('active_underline');
            $('.js_search_form').css('cssText', 'display: none !important;');
        } else {
            $('.js_search').animate({right: '0'}, 300);
            $('.js_search_form').animate({right: '-100%'}, 300);
        }

    });


//    SEARCH
    $('.js_search').click(function () {

        if (screen >= 883) {
            console.log('desktop');
            if (!$(this).hasClass('active_underline')) {
                $(this).addClass('active_underline');
                $('.js_search_form').css('cssText', 'display: block !important;');
            } else {
                $(this).removeClass('active_underline');
                $('.js_search_form').css('cssText', 'display: none !important;');
            }

        } else {
            console.log('mobile');

            if (!$(this).hasClass('active')) {
                $(this).addClass('active');
                $(this).animate({right: '320px'}, 300);
                $('.js_search_form').animate({right: '0'}, 300);
            } else {
                $(this).removeClass('active');
                $(this).animate({right: '0'}, 300);
                $('.js_search_form').animate({right: '-100%'}, 300);
            }


        }


        return false;
    });




});