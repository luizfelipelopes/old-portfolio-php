<?php
if (!empty($_SESSION['clientelogin'])):
    $SessionUser = array_map('mb_strtolower', $_SESSION['clientelogin']);

    $SessionUser['cliente_name'] = substr($SessionUser['cliente_name'], 0, strpos($SessionUser['cliente_name'], " "));
    $SessionUser['cliente_lastname'] = substr($SessionUser['cliente_lastname'], strpos($SessionUser['cliente_lastname'], " "));
    $SessionUser['cliente_phone'] = '55' . str_replace(["(", ")"], "", $SessionUser['cliente_ddd']) . str_replace(["(", ")", "-", ".", " "], "", $SessionUser['cliente_telefone']);
    $SessionUser['cliente_cep'] = str_replace(["-", ".", " "], "", $SessionUser['cliente_cep']);


    $readCity = new Read;
    $readCity->ExeRead(CIDADES, "WHERE cidade_id = :id", "id={$SessionUser['cliente_cidade']}");
    if ($readCity->getResult()):
        $SessionAddr['cliente_cidade'] = strtolower($readCity->getResult()[0]['cidade_nome']);
        $SessionAddr['cliente_uf'] = strtolower($readCity->getResult()[0]['cidade_uf']);
    endif;

//    var_dump($SessionUser, $SessionAddr);        

endif;

if (!empty($_SESSION['carrinho'])):

    $SessionCart = array();
    $i = 0;

    foreach ($_SESSION['carrinho'] as $Key => $Value):
        $id = 'product_' . $Key;
        $SessionCart += [$i => $id];
        $i++;
    endforeach;

endif;
?>

<script>

    FB_PIXEL = '737016459816766';
    FS_USER = <?= (!empty($SessionUser) ? json_encode($SessionUser) : '"null"'); ?>;
    FS_ADDR = <?= (!empty($SessionAddr) ? json_encode($SessionAddr) : '"null"'); ?>;
    FS_LINK = window.location.href;
//    console.log(FS_CART);

    !function (f, b, e, v, n, t, s) {
        if (f.fbq)
            return;
        n = f.fbq = function () {
            n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq)
            f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window,
            document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');


    // FS_TRACK       
    if (FS_USER == 'null') {
        fbq('init', FB_PIXEL); // Insert your pixel ID here.
    } else {
        fbq('init', FB_PIXEL, {
            em: FS_USER.cliente_email, //Email
            fn: FS_USER.cliente_name, // Nome 
            ln: FS_USER.cliente_lastname, // Sobrenome
            ph: FS_USER.cliente_phone, // Telefone
//            ge: 'm', // Gênero
//            db: '19900801', // Data de Nascimento (yyyymmdd)
            ct: FS_ADDR.cliente_cidade, // Cidade
            st: FS_ADDR.cliente_uf, // UF
            zp: FS_USER.cliente_cep // CEP
        });
    }

    // FS EVENTS
    fbq('track', 'PageView');

    if (FS_LINK.match('tapetes/')) {
        fbq('track', 'ViewContent', {
            content_name: '<?= (!empty($category_title) ? $category_title : null); ?>',
            referrer: document.referrer,
            userAgent: navigator.userAgent,
            language: navigator.language
        });
    }


    if (FS_LINK.match('Detalhes/')) {
        fbq('track', 'ViewContent', {
            content_name: '<?= (!empty($produto_title) ? $produto_title : null); ?>',
            value: '<?= (!empty($produto_desconto) && $produto_desconto > 0 ? $produto_valor_descontado : (!empty($produto_valor) ? $produto_valor : null)); ?>',
            currency: 'BRL',
            content_type: 'product',
            content_ids: '<?= (!empty($produto_id) ? "product_" . $produto_id : null); ?>',
            referrer: document.referrer,
            userAgent: navigator.userAgent,
            language: navigator.language
        });
    }

    if (FS_LINK.match('Carrinho')) {
        fbq('track', 'AddToCart', {
            value: '<?= (!empty($ValorTotalBruto) ? $ValorTotalBruto : null); ?>',
            currency: 'BRL',
            content_type: 'product',
            content_ids: '<?= (!empty($_SESSION['carrinho']) ? json_encode($SessionCart) : null); ?>',
            referrer: document.referrer,
            userAgent: navigator.userAgent,
            language: navigator.language
        });
    }
    

    if (FS_LINK.match('endereco/')) {
        fbq('track', 'InitiateCheckout', {
            referrer: document.referrer,
            language: navigator.language
        });
    }
    
    if (FS_LINK.match('pagamento/')) {
        fbq('track', 'AddPaymentInfo', {
            referrer: document.referrer,
            language: navigator.language
        });
    }

    if (FS_LINK.match('pedido/obrigado')) {
        fbq('track', 'Purchase', {
            value: '<?= (!empty($ValorTotalBruto) ? $ValorTotalBruto + CUSTO_FRETE : null); ?>',
            currency: 'BRL',
            content_type: 'product',
            content_ids: '<?= (!empty($_SESSION['carrinho']) ? json_encode($SessionCart) : null); ?>',
            referrer: document.referrer,
            userAgent: navigator.userAgent,
            language: navigator.language
        });
    }

    if (FS_LINK.match('pesquisa/')) {

        fbq('track', 'Search', {
            search_string: '<?= (!empty($search) ? $search : null); ?>',
            referrer: document.referrer,
            userAgent: navigator.userAgent,
            language: navigator.language
        });

    }

    if (FS_LINK.match('&cadastro=true') && document.referrer.match('/Entrar')) {

        fbq('track', 'CompleteRegistration', {
            content_name: 'fs_client_register',
            status: 'active',
            referrer: document.referrer,
            userAgent: navigator.userAgent,
            language: navigator.language
        });

    }


</script>

<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=737016459816766&ev=PageView&noscript=1"/></noscript>

