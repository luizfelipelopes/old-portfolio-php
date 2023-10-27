/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

    var path = 'ajax/ajax.php';
    TOTAL_CARRINHO = $('link[rel=total_carrinho]').attr('href');

    //    SUBMETE TODOS OS FORMS DO SISTEMA
    $('.js_content_form').on('submit', 'form', function () {

        var form = $(this);
        var classeTinyMCE = form.find('#j_post').attr('class');
        if (classeTinyMCE !== undefined) {
            tinyMCE.triggerSave(true, true);
        }
        var dados = $(this).serializeArray();
        console.log(dados);

        form.ajaxSubmit({
            url: path,
            data: dados,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.load').fadeIn(500);
            },
            success: function (data) {

                $('.load').fadeOut();

                if (data.caminho) {
                    window.location.href = data.caminho;
                }

                if (data.retornoBoleto) {
                    var strWindowFeatures = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
                    console.log(data.retornoBoleto);
                    window.open(data.retornoBoleto['paymentLink'][0], 'Boleto Pagseguro', strWindowFeatures);
                }

                /*
                 * =====================================
                 * ==========GATILHOS GERAIS============
                 * =====================================
                 */

                // EXIBE MENSAGEM APÓS O CADASTRO DO COMENTÁRIO
                if (data.error) {
                    $('.trigger-box-suspenso').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                    $('.trigger-box-suspenso').fadeIn(400);
                    setTimeout(function () {
                        $('.trigger-box-suspenso').fadeOut();
                    }, 3000);
                    form.find('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                }
//
//  
                // LIMPA TODOS OS CAMPOS DO FORMULÁRIO    
                if (!data.naolimpar) {

                    $(".j_previa").attr('src', '');
                    $('input[type=text], input[type=email], input[type=file]').val('');
//                    $('#calendar').val(HORA);
                    $('textarea').val('');
                    $('select').val('');
                    $('.j_limpa_capa').html('<img title="" src="" class="j_previa"/>');
                    $('.gallery_itens').html('');
                    $(".j_desconto").prop("disabled", true);
                    $(".j_valor_descontado").prop("disabled", true);
                    $('input[type=radio]').prop('checked', false);
                    $('input[type=checkbox]').prop('checked', false);

                    if (classeTinyMCE !== undefined) {
                        tinyMCE.activeEditor.setContent('');
                    }

                }

            }

        });
        return false;
    });

    // Inicia sessão de pagamento e hash ao focar no input de Cartão
    $('#bin').focus(function () {

        $.ajax({
            url: path,
            data: {action: 'iniciarPagamento'},
            type: 'post',
            dataType: 'json',
            timeout: '3000',
            success: function (data) {
                $('.retornoTeste').val(data.idSessao[0]);
                PagSeguroDirectPayment.setSessionId(data.idSessao);
                console.log(data.idSessao);

                var identificador = PagSeguroDirectPayment.getSenderHash();
                $('.hashPagSeguro').val(identificador)

            }

        });

    });

    // Pega bandeira e parcelamento do cartão de acordo com o número digitado
    bandeira = '';
    parcela = '';
    $('#bin').keyup(function () {

        var sessao = $('.retornoTeste').val();
        var bin = $(this).val();
        console.log(sessao, bin);

        PagSeguroDirectPayment.setSessionId(sessao);
        PagSeguroDirectPayment.getBrand({
            cardBin: bin,
            success: function (response) {

                bandeira = response['brand']['name'];
                console.log(bandeira);

                PagSeguroDirectPayment.getInstallments({
                    amount: TOTAL_CARRINHO,
                    maxInstallmentNoInterest: 2,
                    //brand: 'visa',

                    success: function (response) {
                        console.log(response['installments'][bandeira]);
                        parcela = response['installments'][bandeira];

                        $.post(path, {action: 'carregar_parcelas', parcela: parcela}, function (data) {

                            if (data.result) {
                                $('.js_parcelamento').prop('disabled', false);
                                $('.js_parcelamento').prop('required', true);
                                $('#parcelamento').html(data.result);
                            }

                        }, 'json');

                    },
                    error: function (response) {
                        console.log(response);
                        
                    }
                });

                if (bandeira === 'elo') {
                    $('.js_brand').css("cssText", "background: url(img/elo.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'visa') {
                    $('.js_brand').css("cssText", "background: url(img/visa.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'mastercard') {
                    $('.js_brand').css("cssText", "background: url(img/mastercard.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'hipercard') {
                    $('.js_brand').css("cssText", "background: url(img/hipercard.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'amex') {
                    $('.js_brand').css("cssText", "background: url(img/amex.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'aura') {
                    $('.js_brand').css("cssText", "background: url(img/aura.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'avista') {
                    $('.js_brand').css("cssText", "background: url(img/avista.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'bancodobrasil') {
                    $('.js_brand').css("cssText", "background: url(img/bancodobrasil.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'banrisul') {
                    $('.js_brand').css("cssText", "background: url(img/banrisul.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'bradesco') {
                    $('.js_brand').css("cssText", "background: url(img/bradesco.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'cabal') {
                    $('.js_brand').css("cssText", "background: url(img/cabal.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'diners') {
                    $('.js_brand').css("cssText", "background: url(img/diners.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'discover') {
                    $('.js_brand').css("cssText", "background: url(img/discover.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'hsbc') {
                    $('.js_brand').css("cssText", "background: url(img/hsbc.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else if (bandeira === 'itau') {
                    $('.js_brand').css("cssText", "background: url(img/itau.png) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                } else {
                    $('.js_brand').css("cssText", "background: url(img/bandeira-modelo.jpg) no-repeat; background-size: 100% 100% !important;");
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                }

            },
            error: function (response) {
                console.log(response);
                $('.js_parcelamento').prop('disabled', true);
                $('.js_brand').css("cssText", "background: url(img/bandeira-modelo.jpg) no-repeat; background-size: 100% 100% !important;");

                if (bin.length >= 6) {
                    $('#bin').css('cssText', 'border: 1px solid red;');
                    $('.js_erro_num_cartao').text('Bandeira inexistente! Confira o número do cartão!');
                } else {
                    $('#bin').css('cssText', 'border: 1px solid #ccc;');
                    $('.js_erro_num_cartao').text('');
                }



            }
        });

    });

    // Seta o valor que será pago no parcelamento no input hidden do valor de parcela
    $("body").on('change', '.js_parcelamento', function () {

        $("#valor_parcela").val(parcela[($(this).val() - 1)]['installmentAmount']);
        console.log(parcela[($(this).val() - 1)]['installmentAmount']);

    });

    // Gera token do cartão de crédito ao digitar os dígitos de segurança 
    $("#cvv").keyup(function () {  //criar token

        var sessao = $('.retornoTeste').val();

        numCartao = $("#bin").val();
        cvvCartao = $("#cvv").val();
        expiracaoMes = $("#pagamentoMes").val();
        expiracaoAno = $("#pagamentoAno").val();

        console.log(sessao, numCartao, cvvCartao, expiracaoMes, expiracaoAno);

        PagSeguroDirectPayment.setSessionId(sessao);
        PagSeguroDirectPayment.createCardToken({
            cardNumber: numCartao,
            cvv: cvvCartao,
            expirationMonth: expiracaoMes,
            expirationYear: expiracaoAno,

            success: function (response) {
                console.log(response);
                $(".tokenPagamentoCartao").val(response['card']['token']);

            },
            error: function (response) {
                console.log(response);
            }
        });

    });

    $("#meios").click(function () { //meios de pagamento disponíveis

        PagSeguroDirectPayment.getPaymentMethods({
            amount: 500,
            success: function (response) {
                console.log(response);
            },
            error: function (response) {
                console.log(response);
            }
        });

    });


    $('.js_bloco_abas_checkout').on('click', '.js_aba_cartao', function () {

        $('.js_form_cartao').fadeIn();
        $('.js_form_boleto').fadeOut();

    });
    
    $('.js_bloco_abas_checkout').on('click', '.js_aba_boleto', function () {

        $.ajax({
            url: path,
            data: {action: 'iniciarPagamento'},
            type: 'post',
            dataType: 'json',
            timeout: '3000',
            success: function (data) {
                $('.retornoTeste').val(data.idSessao[0]);
                PagSeguroDirectPayment.setSessionId(data.idSessao);
                console.log(data.idSessao);

                var identificador = PagSeguroDirectPayment.getSenderHash();
                $('.hashPagSeguro').val(identificador)

            }

        });

        $('.js_form_cartao').fadeOut();
        $('.js_form_boleto').fadeIn();

    });
    
    
    //    MASCARA PARA CPF
    $("#cpf").mask("000.000.000-00", {placeholder: '___.___.___-__'});

//    MASCARA PARA CARTÃO
    $('#bin').mask("0000000000000000");

 //    MASCARA PARA CARTÃO MÊS VALIDADE
    $('#pagamentoMes').mask("00");

    //    MASCARA PARA CARTÃO ANO VALIDADE
    $('#pagamentoAno').mask("0000");

    //    MASCARA PARA CARTÃO CVV
    $('#cvv').mask("000");

    //    MASCARA PARA DATA
    $('#calendario').mask("00/00/0000", {placeholder: '__/__/____'});

});