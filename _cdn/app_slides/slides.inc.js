$(function () {

    /**
     * Script para execução de Slides no Sistema
     * @type String
     */

    var slideDestaque = '.slide_item';
    var slideSecundario = '.anunciante_item';

    var action = setInterval(function () {
        slideGo(slideDestaque);
    }, 6000);

    setInterval(function () {
        slideGo(slideSecundario);
    }, 6000);

    $('.slide_nav.go').click(function () {
        clearInterval(action);
        slideGo(slideDestaque);
    });

    $('.slide_nav.back').click(function () {
        clearInterval(action);
        slideBack(slideDestaque);
    });

    function slideGo(seletor) {

        if ($(seletor + '.first').next().size()) {
            $(seletor + '.first').fadeOut(400, function () {
                $(this).removeClass('first').next().fadeIn().addClass('first');
            });
        } else {

            $(seletor + '.first').fadeOut(400, function () {
                $(seletor).removeClass('first');
                $(seletor + ':eq(0)').fadeIn().addClass('first');
            });
        }
    }

    function slideBack(seletor) {

        if ($(seletor + '.first').index() === $(seletor).first().index()) {
            $(seletor + '.first').fadeOut(400, function () {
                $(this).removeClass('first');
                $(seletor + ':last-of-type').fadeIn().addClass('first');
            });
        } else {
            $(seletor + '.first').fadeOut(400, function () {
                $(this).removeClass('first').prev().fadeIn().addClass('first');
            });
        }

    }

});