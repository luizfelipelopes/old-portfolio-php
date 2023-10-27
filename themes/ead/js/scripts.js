$(function () {

//    setInterval(function(){
//        location.reload();
//    }, 2000);



//    SLIDE MENU MOBILE
    $('.j_menu_mobile').click(function () {

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

    $('.j_close').click(function () {
        $(this).removeClass('active');
        $('.main_nav').animate({left: '-100%'}, 300);
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



    $(window).scroll(function () {

        if ($(this).scrollTop() > $('.main_header').outerHeight()) {
            $('.j_back').fadeIn(300);
        } else {
            $('.j_back').fadeOut(300);
        }


    });


    //    COMPRAS ==================================================================================

    $('body').on('click', '.j_comprar', function () {

        var id = $(this).attr('id');
        var valor = $(this).attr('attr-valor');
        console.log(id, valor);

       $('.j_cadastrar').fadeOut();



        $.ajax({
            url: '../_cdn/ajax/ajax.php',
            data: {action: 'comprar', produto_id: id, produto_valor: valor},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {


                if (data.logado) {


                    if (data.caminho) {
                        window.location.href = data.caminho;
                    }


                } else {
                    $('.j_processo_compra').fadeIn();
//                    $('.j_cadastrar').fadeOut();
                    $('.j_opcoes').fadeIn();
                }

            }

        });

        return false;
    });

    $('body').on('click', '.j_botao_entrar', function () {

        $('.j_opcoes').fadeOut();
        $('.j_entrar').fadeIn();

    });

    $('body').on('click', '.j_botao_cadastrar', function () {

        $('.j_opcoes').fadeOut();
        $('.j_cadastrar').fadeIn();


    });


    $('body').on('submit', 'form[id!="form_login"]', function () {

        var form = $(this);
        var dados = $(this).serialize();
//        var path = null;

        form.ajaxSubmit({
            url: '../_cdn/ajax/ajax.php',
            data: dados,
            type: 'POST',
            dataType: 'json',
            beforeSubmit: function () {
                $('.load').fadeIn();
            },
            success: function (data) {

                if (data.caminho) {
                    window.location.href = data.caminho;
                }

                if (data.error) {

                    setInterval(function () {
                        $('.load').fadeOut();
                    }, 2000);

//                    form.find('input[type!=submit], select, textarea').val('');

                    $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                    $('.trigger-box-suspenso').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                    $('.trigger-box-suspenso').fadeIn(400);

                    setInterval(function () {
                        $('.trigger-box-suspenso').fadeOut();
                    }, 3000);

                }

                if (data.logado) {
                    $('.j_entrar_cadastrar').fadeOut();
                    $('.j_quantidade').fadeIn();
                }


            }

        });

        return false;
    });



    $('body').on('submit', '#form_login', function () {

        var form = $(this);
        var dados = $(this).serialize();
//        var path = null;

        form.ajaxSubmit({
            url: '_cdn/ajax/ajax.php',
            data: dados,
            type: 'POST',
            dataType: 'json',
            beforeSubmit: function () {

                $('.load').fadeIn();

            },
            success: function (data) {

                if (data.caminho) {
                    window.location.href = data.caminho;
                }

                if (data.error) {

                    setInterval(function () {
                        $('.load').fadeOut();
                    }, 2000);

//                    form.find('input[type!=submit], select, textarea').val('');

                    $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                    $('.trigger-box-suspenso').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                    $('.trigger-box-suspenso').fadeIn(400);

                    setInterval(function () {
                        $('.trigger-box-suspenso').fadeOut();
                    }, 3000);

                }

                if (data.logado) {
                    $('.j_entrar_cadastrar').fadeOut();
                    $('.j_quantidade').fadeIn();
                }


            }

        });

        return false;
    });


    $('body').on('click', '.ajax_close', function () {

        $('.j_processo_compra').fadeOut();
        $('.j_entrar').fadeOut();
        $('.j_cadastrar').fadeOut();
        $('.j_popup').fadeOut();
        $('.trigger-box').fadeOut();
    });


    $('.j_logout').click(function () {

        $.ajax({
            url: '../_cdn/ajax/ajax.php',
            data: {action: 'logoff'},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

                if (data.caminho) {
                    window.location.href = data.caminho;
                }

            }


        });

    });
    
    //    PARA FECHAR JANELA COM BOTAO ESC
    $(document).bind('keydown', function (e) {

        if (e.which == 27) {
            $('.j_popup').fadeOut();
            $('.j_entrar').fadeOut();
            $('.j_cadastrar').fadeOut();
        }
    });


});