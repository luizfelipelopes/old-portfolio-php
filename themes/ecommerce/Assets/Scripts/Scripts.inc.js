$(function () {

    BASE = $("#j_base").attr('href');
    THEME = $("#j_theme").attr('href');
    CARRINHO = $("#j_carrinho").attr('href');

    Shadowbox.init();

    //Clique fake para impedir que o link com o shadowbox seja redirecionado
    $("body").on("click", ".j_galeria_shadowbox", function () {
        return false;
    });

//    DEBUG IMAGES
//$(".debug").each(function(){
//   
//    $(this).after("<p style='color:#fff; backgroud: #333;'>a</p>");
//    
//    
//});

    if (CARRINHO === '0') {
        console.log('carrinho desabilitado')
        $('.js_opt_cart').css('cssText', 'display:none;');
        
        //Header
        $('.header_search form').css('cssText', 'width: 70% !important; max-width:1000px !important;');
        $('.header_search input').css('cssText', 'width:82%;');
        $('.header_search button').css('cssText', 'max-width:40px !important;');
        $('.btn_comprar_destaque').css('cssText', 'top: 210px !important;')
        
        // Coprpo Produtos
        $('.info_produto').css('cssText', 'min-height: 150px !important;');
        $('.info_produto_desc').css('cssText', 'min-height: 10px !important;');
        $(".btn_add_cart").removeClass('j_loadcarrinho');
        $(".btn_comprar").css('cssText', 'height: 45px !important; min-width: 150px;');
        $(".btn_comprar").find(".txt_btn").css('cssText', 'line-height: 2 !important;');
        
    }


//    PIXEL FACEBOOK
    $("#j_pixel_checkout").click(function () {

        console.log('fui clicado');

        $.ajax({
            url: BASE + 'themes/' + THEME + '/ajax/ajax.php',
            data: {action: 'iniciarPixelCheckout'},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $(this).find(".load_carrinho").fadeIn();
            },
            success: function (data) {



                if (data.caminho) {

                    if (data.caminho.match('salvar')) {
                        fbq('track', 'InitiateCheckout', {
                            referrer: document.referrer,
                            language: navigator.language
                        });
                    }

                    window.location.href = data.caminho;
                }

            }
        });


        return false;
    });


    var quantidade_atual = '1';

    $('.j_loadcarrinho').click(function () {

        var valor = $(this).attr('valor-produto');
        var id = $(this).attr('id-produto');
        var idProduto = "#" + id;
        console.log(idProduto);

        $.ajax({
            url: BASE + 'themes/' + THEME + '/ajax/ajax.php',
            data: {action: 'adicionarCarrinho', valor_produto: valor, produto_id: id},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $(idProduto).find(".load_carrinho").fadeIn();
            },
            success: function (data) {
                $(idProduto).find(".load_carrinho").fadeOut();
                $('.j_subtotal').text(data.result);
                $('.mensagem_carrinho_ajax').fadeIn();

            }

        });
        return false;

    });


    $('.j_continuar').click(function () {

        $('.mensagem_carrinho_ajax').fadeOut();

    });


    var quantidade = 1;

    $('.quantidade').click(function () {
        quantidade = $(this).val();
//        console.log(quantidade);
        return false;

    });



    // ADICIONAR PRODUTO NO CARRINHO AJAX NA PÁGINA DE DETALHES
    $('.btn_confirmar').click(function () {
        var id_detalhes = $(this).attr('produto_id');
        var valor_detalhes = $(this).attr('produto_valor');

        $.ajax({
            url: BASE + 'themes/' + THEME + '/ajax/ajax.php',
            data: {action: 'capturardetalhes', detalhes_id: id_detalhes, detalhes_quantidade: quantidade, detalhes_valor: valor_detalhes},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.btn_confirmar').find(".load_carrinho").fadeIn();
            },
            success: function (data) {
                $('.btn_confirmar').find(".load_carrinho").fadeOut();
                $('.j_subtotal').text(data.result);
                $('.mensagem_carrinho_ajax').fadeIn();
            }


        });

        return false;
    });


    $('.j_excluir').click(function () {

        var id = $(this).attr('id');
        var id_linha = '#' + id;
        var subtotalid = "#subtotal" + id;
        var subtotal = $(this).parents('tr').children(subtotalid).attr('rel');
        var total_frete = $('#frete').html();
//        console.log(id);

        $.ajax({
            url: 'themes/' + THEME + '/ajax/ajax.php',
            data: {action: 'excluir', produto_id: id, produto_subtotal: subtotal, produto_quantidade: quantidade_atual, frete: total_frete},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

                $('.j_carrinho ' + id_linha).parents('tr').fadeOut();
                $('.j_subtotal').text(data.result);
                $('.j_total').text(data.result2);

                if (data.result === 'R$ 0,00') {

                    $('.j_carrinho').fadeOut();
                    $('.j_relacionados').fadeIn();

                } else {

//                    $(id_linha).parents('tr').fadeOut();
//                    $('.j_carrinho ' + id_linha).parents('tr').fadeOut();
//                    $('.j_total').text(data.result2);
//                    
                }


            }

        });

        quantidade_atual = '1';

        return false;
    });



    $('tbody #qtd').click(function () {
        quantidade_atual = $(this).val();
        var numItens = $(this).val();
        var id = $(this).attr('data_id');
        var preco = $(this).attr('data_preco');
        var total_frete = $("#frete").html();
        var subtotal = '#subtotal' + id;

        console.log(id);


        $.ajax({
            url: 'themes/' + THEME + '/ajax/ajax.php',
            data: {action: 'alterarquantidade', produto_id: id, produto_quantidade: numItens, produto_preco: preco, frete: total_frete},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

                $(subtotal).html(data.result);
                $('.j_subtotal').html(data.result2);

                if (data.result_bruto > Number(20000)) {

                    $(".total").find(".j_subtotal_desconto_20mil").parents('tr').fadeOut();
                    $(".j_bloco_desconto_20mil").html('<td class="titulo_total"> Desconto de 10% para compras acima de R$ 20 Mil</td><td class="preco_total j_subtotal_desconto_20mil" rel="' + data.descontado_bruto + '"><small class="valor_anterior m-top1"> De: <del>R$ ' + data.result2 + '</del></small><h1 class="valor_atual al-center"><span class="valor_atual_digitos">Por: ' + data.result_descontado_formatado + '</span></h1></td>');
                    $(".j_bloco_desconto_20mil").fadeIn();

                    if (data.result_somatorio) {
                        $('.j_total').html(data.result_somatorio_formatado_frete);
                        $('.j_valor_total_form').val(data.result_somatorio_formatado_frete);
                    } else {
                        $('.j_total').html(data.result_descontado_formatado_frete);
                        $('.j_valor_total_form').val(data.result_descontado_formatado_frete);
                    }

                } else {
                    $(".total").find(".j_subtotal_desconto_20mil").parents('tr').fadeOut();

                    if (data.result_cupom_bruto) {
                        $('.j_total').html(data.result_cupom_formatado_frete);
                        $('.j_valor_total_form').val(data.result_cupom_formatado_frete);
                    } else {
                        $('.j_total').html(data.result3);
                        $('.j_valor_total_form').val(data.result3);
                    }


                }


//                console.log(valorNormal);



            }


        });


        return false;
    });

    $('tbody #qtd').keyup(function () { // Corrigir o Erro quando a quantidade do ultimo produto e digitada e o primeiro é clicado 
        //                              e consertar preenchimento de carrinho
        quantidade_atual = $(this).val();
        var numItens = $(this).val();
        var id = $(this).attr('data_id');
        var preco = $(this).attr('data_preco');
        var total_frete = $("#frete").html();
        var subtotal = '#subtotal' + id;
        console.log(id);
        $.ajax({
            url: 'themes/' + THEME + '/ajax/ajax.php',
            data: {action: 'alterarquantidade', produto_id: id, produto_quantidade: numItens, produto_preco: preco, frete: total_frete},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

                $(subtotal).html(data.result);
                $('.j_subtotal').html(data.result2);


                if (data.result_bruto > Number(20000)) {
                    $(".total").find(".j_subtotal_desconto_20mil").parents('tr').fadeOut();
                    $(".j_bloco_desconto_20mil").html('<td class="titulo_total"> Desconto de 10% para compras acima de R$ 20 Mil</td><td class="preco_total j_subtotal_desconto_20mil" rel="' + data.descontado_bruto + '"><small class="valor_anterior m-top1"> De: <del>R$ ' + data.result2 + '</del></small><h1 class="valor_atual al-center"><span class="valor_atual_digitos">Por: ' + data.result_descontado_formatado + '</span></h1></td>');
                    $(".j_bloco_desconto_20mil").fadeIn();
                    $('.j_total').html(data.result_descontado_formatado_frete);
                } else {
                    $(".total").find(".j_subtotal_desconto_20mil").parents('tr').fadeOut();
                    $('.j_total').html(data.result3);
                }



            }


        });


        return false;
    });


    var path = null;

    $('form[id != search]').submit(function () {

        console.log("Submetendo");
        console.log(BASE);

        var form = $(this);
        var dados = $(this).serialize();
//        var path = null;

        $.ajax({
            url: BASE + 'themes/' + THEME + '/ajax/ajax.php',
            data: dados,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                form.find('.load').fadeIn(500);
            },
            success: function (data) {

                form.find('.load').fadeOut();

                $('.j_erro_padrao').fadeOut();

                if (data.caminho) {
                    window.location.href = data.caminho;
                }

                if (data.error) {

//                    form.find('input[type!=submit], select, textarea').val('');

                    $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                    $('.trigger-box-suspenso').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                    $('.trigger-box-suspenso').fadeIn(400);

                    setInterval(function () {
                        $('.trigger-box-suspenso').fadeOut();
                    }, 3000);

                }

                if (data.desconto_cupom) {
                    $(".j_total").html(data.desconto_cupom_formatado_frete);
                    $(".j_form_cupom").fadeOut();
                }

                if (!data.id) {
                    $('input[type=text], input[type=date], input[type=file], input[type=email], input[type=password], input[type=tel]').val('');
                    $('textarea').val('');
                    $('select').val('');
                    $('input[type=radio]').prop('checked', false);
                    $('input[type=checkbox]').prop('checked', false);
                }



            }

        });

        return false;
    });


    //    FECHA MENSAGENS DE ERRO (Ao clicar no X a direita da Mensagem)
    $('.trigger-box').on('click', '.ajax_close', function () {

        $('.trigger').fadeOut();

        return false;
    });


    //    PARA FECHAR JANELA COM BOTAO ESC
    $(document).bind('keydown', function (e) {

        if (e.which == 27) {
            $('.j_popup').fadeOut();
        }
    });

    //    MASCARA PARA CPF
    $("#cpf").mask("999.999.999-99", {autoclear: false});




//    $(".produto a").click(function(){
////       alert('clicou');
//       console.log($(this).attr('href'));
//       
//       return false;
//        
//    });


});