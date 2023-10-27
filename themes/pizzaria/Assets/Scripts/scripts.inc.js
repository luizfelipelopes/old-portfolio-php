$(function () {

    HOME = $("#j_base").attr('href');
    THEME = '/themes/' + $("#j_theme").attr('href');
    PATH_AJAX = HOME + THEME + '/ajax/ajax.php'; 


    /**
     * *******************************************************************
     ******************** AÇÔES NO TOPO DO SITE***************************
     ** *******************************************************************
     */

//   CLICK CARRINHO
    $('.carrinho').on('click', '.js_ver_pedidos', function () {

        $('.lista_pedidos').toggle(function () {
            setTimeout(300);
        });

    });


//   EXIBIR MENU MOBILE OCULTO
    $('.menu').on('click', '.js_abrir_submenu', function () {

        $('.oculto_mobile').toggle(function () {
            setTimeout(300);
        });

    });

    //   EXIBIR MENU CARDÁPIO
    $('.bloco_cardapio_topo').on('click', '.js_menu', function () {

        if ($(this).hasClass('active')) {
            $(this).css("cssText", "background: rgba(90,11,9,0.5) !important").removeClass('active');
        } else {
            $(this).css("cssText", "background: rgba(90,11,9,0.8) !important").addClass('active');
        }

        $('.menu_principal').toggle(function () {
            setTimeout(300);
        });

    });

    //    SLIDE PAGE
    $('.js_slide_page a').click(function () {

        var goto = $($(this).attr('href')).position().top;
        console.log(goto);
        $('html, body').animate({scrollTop: goto}, 1000);
        return false;
    });

    //    BOTÂO TOPO

    $('.js_subir_topo').click(function () {

        $('html, body').animate({scrollTop: 0}, 1000);
        return false;
    });

//    EXIBIR / SUMIR BOTÂO TOPO (CARDÁPIO)
    $(window).scroll(function () {

        if ($(this).scrollTop() > $('.bloco_cardapio_topo').outerHeight()) {
            $('.js_subir_topo').fadeIn();
        } else {
            $('.js_subir_topo').fadeOut();
        }

    });


//   SLIDES

    var slideDestaque = '.slide_item';
    var slideSecundario = '.secundario_item';
//    setInterval(slideSecundarioGo, 3000);

    var action = setInterval(function () {
        slideGo(slideDestaque);
    }, 6000);

    var actionSecundario = setInterval(function () {
        slideGoSecundario(slideSecundario);
    }, 3000);

    $('.next').click(function () {
        clearInterval(actionSecundario);
        slideGoSecundario(slideSecundario);
    });

    $('.prev').click(function () {
        clearInterval(actionSecundario);
        slideBackSecundario(slideSecundario);
    });

    function slideGo(seletor) {

        if ($(seletor + '.first').next().size()) {
            $(seletor + '.first').fadeOut(400, function () {
                $(this).removeClass('first').next().animate({width: 'toggle'}, 350).addClass('first');
            });

        } else {

            $(seletor + '.first').fadeOut(400, function () {
                $(seletor).removeClass('first');
                $(seletor + ':eq(0)').animate({width: 'toggle'}, 350).addClass('first');
            });
        }
    }

    function slideGoSecundario(seletor) {

        if ($(seletor + '.first').next().size()) {
            $(seletor + '.first').hide('slide', {'direction': 'left'}, "slow", function () {
//                $(this).css("cssText", "left: -2000px !important;");
                $(this).removeClass('first').next().show('slide', {'direction': 'right'}, "slow").addClass('first').css("cssText", "left: 0px !important;");
//                console.log('Next. Indice: ' + $(seletor + '.first').index());
            });

        } else {
            $(seletor + '.first').hide('slide', {'direction': 'left'}, "slow", function () {
                $(seletor).removeClass('first');
                $(seletor + ':eq(0)').show('slide', {'direction': 'right'}, "slow").addClass('first');
//                console.log('Next. Indice: ' + $(seletor + '.first').index());
            });
        }
    }

    function slideBack(seletor) {

        if ($(seletor + '.first').index() === 0) {
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

    function slideBackSecundario(seletor) {

        if ($(seletor + '.first').index() === 0) {

            $(seletor + '.first').hide('slide', {'direction': 'right'}, 'slow', function () {
                $(this).removeClass('first');
                $(seletor + ':last-of-type').show('slide', {'direction': 'left'}, 'slow').addClass('first');
            });
        } else {

            $(seletor + '.first').hide('slide', {'direction': 'right'}, 'slow', function () {
                $(this).removeClass('first').prev().show('slide', {'direction': 'left'}, 'slow').addClass('first');
            });
        }
    }





    /**
     * *******************************************************************
     ************ AÇÔES DE FILTRO DE PIZZAS, BEBIDAS (shop.php) ***********
     ** *******************************************************************
     */

    // FILTRO POR CATEGORIA

    $(".barra_categorias").on('click', '.js_selecao_categoria', function () {

        var categoria = $(this).attr('attr-categoria');
        console.log(categoria);

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'filtrar_produtos', categoria: categoria},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {

                if (data.produtos) {
                    $('.js_produto_item').remove();
                    $('.js_produtos').html(data.produtos);
                    if (data.inteira) {
                        $(".js_hover_inteiro").fadeIn('fast');
                        $(".js_hover_metade").fadeOut('fast');
                    }

                } else {
                    $('.js_produto_item').remove();
                    $('.js_produtos').html('Opss! Nenhuma pizza foi encontrada nessa categoria. Confira as outras categorias =)');
                }

            }


        });

        return false;
    });


    // FILTRO POR TAMANHO

    $(".filtros").on('click', '.js_selecao_tamanho', function () {

        var tamanho = $(this).attr('attr-tamanho');
        console.log(tamanho);

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'filtrar_tamanho', tamanho: tamanho},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {

                if (tamanho === 'grande') {
                    $('.js_media').css('cssText', 'background: #fff !important; color: red !important;');
                    $('.js_grande').css('cssText', 'background: red !important; color: #fff !important;');
                } else if (tamanho === 'media') {
                    $('.js_grande').css('cssText', 'background: #fff !important; color: red !important;');
                    $('.js_media').css('cssText', 'background: red !important; color: #fff !important;');
                }

                $.each(data.produtos, function (key, value) {

                    $('.js_valores').find('#' + key).html('<span id="' + key + '" class="valor js_filtro_valor">R$ ' + value + '</span>');

                });

            }

        });

        return false;
    });


    // FILTRO POR ORDEM ALFABÉTICA OU POR PREÇO

    $(".filtros_direita").on('click', '.js_filtro_direita', function () {

        var tipo = $(this).attr('attr-tipo');
        console.log(tipo);

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'filtrar_ordem_preco', tipo: tipo},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {

                if (tipo === 'ordem_alfabetica') {
                    $('.js_ordem_preco').css('cssText', 'background: #fff !important; color: red !important;');
                    $('.js_ordem_alfabetica').css('cssText', 'background: red !important; color: #fff !important;');
                } else if (tipo === 'ordem_preco') {
                    $('.js_ordem_alfabetica').css('cssText', 'background: #fff !important; color: red !important;');
                    $('.js_ordem_preco').css('cssText', 'background: red !important; color: #fff !important;');
                }

                if (data.produtos) {
                    $('.js_produto_item').fadeOut('fast');
                    $('.js_produtos').html(data.produtos);
                    $(".js_hover_inteiro").fadeIn('fast');
                    $(".js_hover_metade").fadeOut('fast');

                } else {
                    $('.js_produto_item').fadeOut('fast');
                    $('.js_produtos').html('Opss! Nenhuma pizza foi encontrada. Em breve teremos mais sabores para você =)');
                }

            }


        });

        return false;


    });

    // FILTRO POR PESQUISA

    $(".filtro_busca").on('keyup', '.js_filtro_pesquisa', function () {

        var pesquisa = $(this).val();

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'filtrar_pesquisa', pesquisa: pesquisa},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {

                if (data.produtos) {
                    $('.js_produto_item').fadeOut('fast');
                    $('.js_produtos').html(data.produtos);
                    $(".js_hover_inteiro").fadeIn('fast');
                    $(".js_hover_metade").fadeOut('fast');

                } else {
                    $('.js_produto_item').fadeOut('fast');
                    $('.js_produtos').html('Opss! Nenhuma pizza foi encontrada com a pesquisa realizada. Confira outros sabores =)');
                }

            }
        });


    });




    /**
     * ********************************************************************
     ********** SELEÇÂO DE PIZZAS (INTEIRA, METADE) - shop.php ************
     ** *******************************************************************
     */

    // AÇÔES EXECUTADAS AO SELECIONAR PIZZA INTEIRA

    $(".opcao_pizza").on("click", ".js_inteira", function () {

        $(this).css("cssText", "background: red; color: #fff;");
        $(".js_metade").css("cssText", "background: #fff; color: red;");
        $(".js_mesa_metade").fadeOut(100);
        $(".js_add_metade").fadeOut(100);
        $(".lado_1").find('img').remove();
        $(".lado_2").find('img').remove();
        $(".cardapio_ingredientes").remove();
        $(".js_mesa_inteira").fadeIn(200);
        $(".js_add_inteiro").fadeIn(200);


        $(".js_selecao_sabor_metade").remove();

        $(".js_topo_metade").fadeOut();
        $(".js_topo_inteiro").fadeIn();

        $(".js_hover_metade").fadeOut();
        $(".js_hover_inteiro").fadeIn();


        $.post(PATH_AJAX, {action: "setar_secao_inteira"});


        return false;

    });

    // AÇÔES EXECUTADAS AO SELECIONAR PIZZA EM METADE

    $(".opcao_pizza").on("click", ".js_metade", function () {

        $(this).css("cssText", "background: red; color: #fff;");
        $(".js_inteira").css("cssText", "background: #fff; color: red;");
        $(".js_mesa_inteira").fadeOut(100);
        $(".js_add_inteiro").fadeOut(100);
        $(".lado_inteiro").find('img').remove();
        $(".cardapio_ingredientes").remove();
        $(".js_mesa_metade").fadeIn(200);
        $(".js_add_metade").fadeIn(200);

        $(".js_selecao_sabor_inteira").remove();

        $(".js_topo_inteiro").fadeOut();
        $(".js_topo_metade").fadeIn();

        $(".js_hover_inteiro").fadeOut();
        $(".js_hover_metade").fadeIn();


        $.post(PATH_AJAX, {action: "setar_secao_metade"});

        return false;

    });

    // ACOES EXECUTADAS AO ROLAR A PÁGINA

    $(window).scroll(function () {

        // EXIBIR OU OCULTAR SABORES NO TOPO QUE APARECE AO ROLAR A PÁGINA
        if ($(this).scrollTop() > $('.mesa_pizza').outerHeight()) {
            $('.sabores_topo').fadeIn();
        } else {
            $('.sabores_topo').fadeOut();
        }

        // EXIBIR OU OCULTAR MENU DO CARDÁPIO NO TOPO QUE APARECE AO ROLAR A PÁGINA (cardapio.php)
        if ($(this).scrollTop() > $('.bloco_cardapio_topo').outerHeight()) {
            $('.menu_principal').fadeOut();
            $('.menu_principal_topo').fadeIn();
        } else {
            $('.menu_principal_topo').fadeOut();
        }

    });

    //  AÇÔES EXECUTADAS AO CLICAR NO SABOR DE PIZZA (MODELO INTEIRA) 

    $(".js_produtos").on("click", ".js_hover_inteiro", function () {

        var id = $(this).attr('attr-id');
        var sabor = $(this).attr('attr-sabor');
        var valor = $(this).attr('attr-valor');
        var imagem = $(this).attr('attr-imagem');
        console.log(id);

        $(".js_sabor").append('<div class="sabor_selecionado radius js_selecao_sabor_inteira">' + sabor + '</div><div class="js_selecao_sabor_inteira sabor_close">x</div>');
        $(".lado_inteiro").append('<img class="img_inteira" src="' + imagem + '" title="' + sabor + '" alt="[' + sabor + ']">');
        $(".js_set_sabor").text(sabor);

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'escolher_sabor', id: id, sabor: sabor, valor: valor, imagem: imagem},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {

                $(".js_add_inteiro").find('.cardapio_ingredientes').remove();
                $(".js_add_inteiro .cta_pedido").append(data.cardapio);
                $(".js_valor").text(data.valor);
            }
        });


    });

    //  AÇÔES EXECUTADAS AO CLICAR NO SABOR DE PIZZA (MODELO METADE 1) 

    $(".js_produtos").on("click", ".metade_1", function () {

        var id = $(this).attr('id');
        var sabor = $(this).attr('attr-sabor');
        var valor1 = $(this).attr('attr-valor');
        var valor2 = $(".js_cardapio_sabor2").attr('attr-valor');
        var imagem = $(this).attr('attr-imagem');
//        console.log(valor1, valor2, imagem);

        $(".js_sabor1").append('<div class="sabor1_selecionado radius js_selecao_sabor_metade">' + sabor + '</div><div class="sabor1_close js_selecao_sabor_metade">x</div>');
        $(".js_lado1").append('<img class="img_metade1" src="' + imagem + '" title="' + sabor + '" alt="[' + sabor + ']">');
        $(".js_set_sabor1").text(sabor);

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'escolher_sabor1', id: id, sabor: sabor, valor1: valor1, valor2: valor2, imagem: imagem},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
                console.log('Sucesso');
                $(".add_sabor1").find('.cardapio_ingredientes').remove();
                $(".add_sabor1 .cta_pedido").append(data.cardapio);
                $(".js_valor").text(data.valor);
            }
        });

    });

    //  AÇÔES EXECUTADAS AO CLICAR NO SABOR DE PIZZA (MODELO METADE 2) 

    $(".js_produtos").on("click", ".metade_2", function () {

        var id = $(this).attr('id');
        var sabor = $(this).attr('attr-sabor');
        var valor1 = $(".js_cardapio_sabor1").attr('attr-valor');
        var valor2 = $(this).attr('attr-valor');
        var imagem = $(this).attr('attr-imagem');
        console.log(valor1, valor2, imagem);

        $(".js_sabor2").append('<div class="sabor2_selecionado radius js_selecao_sabor_metade">' + sabor + '</div><div class="sabor2_close js_selecao_sabor_metade">x</div>');
        $(".js_lado2").append('<img class="img_metade2" src="' + imagem + '" title="' + sabor + '" alt="[' + sabor + ']">');
        $(".js_set_sabor2").text(sabor);

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'escolher_sabor2', id: id, sabor: sabor, valor1: valor1, valor2: valor2, imagem: imagem},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
                $(".add_sabor2").find('.cardapio_ingredientes').remove();
                $(".add_sabor2 .cta_pedido").append(data.cardapio);
                $(".js_valor").text(data.valor);
            }
        });

    });

    //  AÇÔES EXECUTADAS AO ADICIONAR UM INGREDIENTE AO SABOR DE PIZZA ESCOLHIDO

    $(".cta_pedido").on("click", ".mais", function () {

        var quantidade = $(this).prevAll('.quantidade').text();
        var acrescimo = $(this).prevAll('.acrescimo').find('.valor_acrescimo').attr('attr-acrescimo');
        var acrescimo_id = $(this).prevAll('.acrescimo').find('.valor_acrescimo').attr('attr-id');
        var id_pizza = $(this).parents('.cardapio_itens').attr('id');
        var completo = false;
//        console.log(id_pizza, acrescimo_id, acrescimo);

        if (quantidade === '1') {
            quantidade++;
            completo = true;
            $(this).prevAll('.acrescimo').fadeIn('fast');
            $(this).prevAll('.quantidade').text(quantidade);
            $(this).css("cssText", "background: rgba(0,0,0, 0.3);");

            $.ajax({
                url: PATH_AJAX,
                data: {action: 'adicionar_ingredientes', id_pizza: id_pizza, acrescimo_id: acrescimo_id, acrescimo: acrescimo, quantidade: quantidade, completo: completo},
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {

                }, success: function (data) {
                    $('.js_valor').text(data.valor);
                }
            });

        } else {

        }


    });

    //  AÇÔES EXECUTADAS AO RETIRAR UM INGREDIENTE DO SABOR DE PIZZA ESCOLHIDO

    $(".cta_pedido").on("click", ".menos", function () {

        var quantidade = $(this).prevAll('.quantidade').text();
        var acrescimo = $(this).prevAll('.acrescimo').find('.valor_acrescimo').attr('attr-acrescimo');

        if (quantidade === '2') {
            quantidade--;
            $(this).prevAll('.acrescimo').fadeOut('fast');
            $(this).prevAll('.quantidade').text(quantidade);
            $(this).prevAll('.mais').css("cssText", "background: green;");

            $.ajax({
                url: PATH_AJAX,
                data: {action: 'retirar_ingredientes', acrescimo: acrescimo, quantidade: quantidade},
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {

                }, success: function (data) {
                    $('.js_valor').text(data.valor);
                }
            });


        }

    });



    /**
     * ******************************************************************************************
     ********* AÇÔES DE EXCLUSÂO E CANCELAMENTO DE PEDIDOS (INTEIRA, METADE) - shop.php *********
     ** *****************************************************************************************
     */

    // AÇÔES EXECUTADAS AO EXCLUIR SABOR DO TOPO (MODELO PIZZA INTEIRA)

    $(".sabores_topo").on("click", ".sabor_close", function () {

        $(".sabor_selecionado").fadeOut();
        $(".js_sabor").html('Adicione um sabor');
        $('.js_cardapio_sabor').remove();
        $('.img_inteira').remove();

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'retirar_valor'},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
                $('.js_valor').text(data.valor);
            }
        });


    });

    // AÇÔES EXECUTADAS AO EXCLUIR SABOR 1 DO TOPO (MODELO PIZZA METADE)

    $(".sabores_topo").on("click", ".sabor1_close", function () {

        var valor1 = $(".js_cardapio_sabor1").attr('attr-valor');
        var valor2 = $(".js_cardapio_sabor2").attr('attr-valor');
        console.log(valor1, valor2);

        $(".sabor1_selecionado").fadeOut();
        $(".js_sabor1").html('Adicione o primeiro sabor');
        $('.js_cardapio_sabor1').remove();
        $('.img_metade1').remove();

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'retirar_valor_metade1', valor1: valor1, valor2: valor2},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
                $('.js_valor').text(data.valor);
            }
        });
    });

    // AÇÔES EXECUTADAS AO EXCLUIR SABOR 2 DO TOPO (MODELO PIZZA METADE)

    $(".sabores_topo").on("click", ".sabor2_close", function () {

        var valor1 = $(".js_cardapio_sabor1").attr('attr-valor');
        var valor2 = $(".js_cardapio_sabor2").attr('attr-valor');


        $(".sabor2_selecionado").fadeOut();
        $(".js_sabor2").html('Adicione o segundo sabor');
        $('.js_cardapio_sabor2').remove();
        $('.img_metade2').remove();

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'retirar_valor_metade2', valor1: valor1, valor2: valor2},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
                $('.js_valor').text(data.valor);
            }
        });

    });

    // AÇÔES EXECUTADAS AO EXCLUIR CARDAPIO DE INGREDIENTES (MODELO PIZZA INTEIRA)

    $(".js_add_inteiro").on("click", ".titulo_ingredientes_close", function () {
        $(".sabor_selecionado").fadeOut();
        $(".js_sabor").html('Adicione um sabor');
        $(this).parent('.cardapio_ingredientes').remove();
        $('.img_inteira').remove();

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'retirar_valor'},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
                $('.js_valor').text(data.valor);
            }
        });

    });

    // AÇÔES EXECUTADAS AO EXCLUIR CARDAPIO DE INGREDIENTES DO SABOR 1 (MODELO PIZZA METADE)

    $(".add_sabor1").on("click", ".titulo_ingredientes_close", function () {

        var valor1 = $(".js_cardapio_sabor1").attr('attr-valor');
        var valor2 = $(".js_cardapio_sabor2").attr('attr-valor');

        $(".sabor1_selecionado").fadeOut();
        $(".js_sabor1").html('Adicione um sabor');
        $(this).parent('.cardapio_ingredientes').remove();
        $('.img_metade1').remove();

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'retirar_valor_metade1', valor1: valor1, valor2: valor2},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
                $('.js_valor').text(data.valor);
            }
        });


        return false;
    });

    // AÇÔES EXECUTADAS AO EXCLUIR CARDAPIO DE INGREDIENTES DO SABOR 2 (MODELO PIZZA METADE)

    $(".add_sabor2").on("click", ".titulo_ingredientes_close", function () {

        var valor1 = $(".js_cardapio_sabor1").attr('attr-valor');
        var valor2 = $(".js_cardapio_sabor2").attr('attr-valor');

        $(".sabor2_selecionado").fadeOut();
        $(".js_sabor2").html('Adicione um sabor');
        $(this).parent('.cardapio_ingredientes').remove();
        $('.img_metade2').remove();

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'retirar_valor_metade2', valor1: valor1, valor2: valor2},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
                $('.js_valor').text(data.valor);
            }
        });

    });

    // AÇÔES EXECUTADAS AO CANCELAR O PEDIDO

    $(".js_cancelar").click(function () {


        $.ajax({
            url: PATH_AJAX,
            data: {action: 'cancelar_item'},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
                $('.js_valor').text(data.valor);
                $(".sabor_selecionado").remove();
                $(".sabor1_selecionado").remove();
                $(".sabor2_selecionado").remove();
                $('.cardapio_ingredientes').remove();
                $('.img_inteira').remove();
                $('.img_metade1').remove();
                $('.img_metade2').remove();

            }
        });

        return false;
    });

    // AÇÔES EXECUTADAS AO AVANÇAR COM O PEDIDO

    $(".js_avancar").click(function () {

        var id_inteiro = $(".js_add_inteiro").find('.cardapio_ingredientes').attr('id');
        var sabor_inteiro = $(".js_add_inteiro").find('.cardapio_ingredientes').attr('attr-sabor');
        var valor_inteiro = $(".js_add_inteiro").find('.cardapio_ingredientes').attr('attr-valor');
        var imagem_inteira = $(".js_add_inteiro").find('.cardapio_ingredientes').attr('attr-imagem');
        console.log(id_inteiro, sabor_inteiro, valor_inteiro, imagem_inteira);

        var id_sabor1 = $(".add_sabor1").find('.cardapio_ingredientes').attr('id');
        var sabor1 = $(".add_sabor1").find('.cardapio_ingredientes').attr('attr-sabor');
        var valor1 = $(".add_sabor1").find('.cardapio_ingredientes').attr('attr-valor');
        var imagem1 = $(".add_sabor1").find('.cardapio_ingredientes').attr('attr-imagem');

        var id_sabor2 = $(".add_sabor2").find('.cardapio_ingredientes').attr('id');
        var sabor2 = $(".add_sabor2").find('.cardapio_ingredientes').attr('attr-sabor');
        var valor2 = $(".add_sabor2").find('.cardapio_ingredientes').attr('attr-valor');
        var imagem2 = $(".add_sabor2").find('.cardapio_ingredientes').attr('attr-imagem');

        console.log(id_inteiro, id_sabor1, id_sabor2);

        $.ajax({
            url: PATH_AJAX,
            data: {action: 'adicionar_carrinho', id_inteiro: id_inteiro, sabor_inteiro: sabor_inteiro, valor_inteiro: valor_inteiro, imagem_inteira: imagem_inteira, id_sabor1: id_sabor1, sabor1: sabor1, valor1: valor1, imagem1: imagem1, id_sabor2: id_sabor2, sabor2: sabor2, valor2: valor2, imagem2: imagem2},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            }, success: function (data) {
            }
        });

        return false;

    });


});