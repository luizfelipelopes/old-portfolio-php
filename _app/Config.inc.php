<?php

//CONFIGURAÇÕES DO BANCO #################################### 

if ($_SERVER['SERVER_NAME'] == 'localhost'):
    define('HOST', 'db');
    define('USER', 'root');
    define('PASS', 'root');
    define('DBSA', 'flowstate');

else:
    define('HOST', '#####');
    define('USER', '#####');
    define('PASS', '#####');
    define('DBSA', '#####');
endif;


//TABELAS DO BANCO
define('CATEGORIAS', 'flowstate_categories');
define('COMENTARIOS', 'flowstate_comentarios');
define('FOTOS', 'flowstate_fotos');
define('VIDEOS', 'flowstate_videos');
define('PAGINAS', 'flowstate_paginas');
define('DESTAQUES', 'flowstate_destaques');
define('ANUNCIOS', 'flowstate_anuncios');
define('POSTS', 'flowstate_posts');
define('PRODUTOS', 'flowstate_produtos');
define('ESPECIFICACOES', 'flowstate_especificacoes');
define('GALERIA', 'flowstate_produtos_gallery');
define('CUPONS', 'flowstate_cupons');
define('SITEVIEWS', 'flowstate_siteviews');
define('SITEVIEWS_AGENT', 'flowstate_siteviews_agent');
define('SITEVIEWS_ONLINE', 'flowstate_siteviews_online');
define('USUARIOS', 'flowstate_users');
define('VENDAS', 'flowstate_vendas');
define('CLIENTES', 'flowstate_clientes');
define('AULAS_ANDAMENTOS', 'flowstate_aulas_andamentos');
define('AULAS', 'flowstate_aulas');
define('MODULOS', 'flowstate_modulos');
define('CURSOS', 'flowstate_cursos');
define('MATERIAIS', 'flowstate_materiais');
define('NOTAS', 'flowstate_notas');
define('PROGRESSOS', 'flowstate_progressos');
define('SEGMENTOS', 'flowstate_segments');
define('CIDADES', 'app_cidades');
define('ESTADOS', 'app_estados');
define('CONFIGURACOES', 'flowstate_configuracoes');
define('EMAILS', 'flowstate_emails');
define('LEADS', 'flowstate_leads');
define('ISCAS', 'flowstate_iscas');
define('DEPOIMENTOS', 'flowstate_depoimentos');
define('INGRESSOS', 'flowstate_ingressos');

$servername = HOST;
$username = USER;
$password = PASS;
$dbname = DBSA;

// var_dump($servername);
// var_dump($username);
// var_dump($password);
// var_dump($dbname);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM " . CONFIGURACOES . " WHERE config_id ='1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        extract($row);
    }
} else {
//    echo "0 results";
}
$conn->close();

$getUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setUrl = (empty($getUrl) ? 'index' : $getUrl);
$Url = explode('/', $setUrl);


//DEFINE O NOME DO SOFTWARE
define('SOFTWARE', 'Flow State');

//DEFINE SERVIDOR DE EMAIL ####################################
define('MAILNOME', (!empty($MAIL_NAME) ? $MAIL_NAME : 'Flowstate'));
define('MAILUSER', (!empty($MAIL_USER) ? $MAIL_USER : 'contato@gabadi.com.br'));
define('MAILPASS', (!empty($MAIL_PASS) ? $MAIL_PASS : 'l?xQ56.5JabC'));
define('MAILPORT', (!empty($MAIL_PORT) ? $MAIL_PORT : '465'));
define('MAILHOST', (!empty($MAIL_HOST) ? $MAIL_HOST : 'mail.gabadi.com.br'));
define('MAILENCRYPT', (!empty($MAIL_ENCRYPT) ? $MAIL_ENCRYPT : 'ssl'));

//DEFINE A BASE DO SITE ####################################

if ($_SERVER['SERVER_NAME'] == 'localhost'):
    define('HOME', 'http://localhost:4500');
    define('HOME_ADMIN', 'http://localhost:4500');
else:
    define('HOME', 'https://site-name.com');
    define('HOME_ADMIN', (!empty($SITE_URL) ? $SITE_URL : 'https://site-name.com'));
endif;

//TEMAS POR SESSÃO
$Theme = filter_input(INPUT_GET, 'theme', FILTER_DEFAULT);
if (!PHP_SESSION_ACTIVE):
    session_start();
endif;
$_SESSION['theme'] = (!empty($Theme) ? $Theme : (!empty($_SESSION['theme']) && empty($Theme) ? $_SESSION['theme'] : null));

if (!empty($_SESSION['theme']) && $_SESSION['theme'] == 'blog'):
    define('THEME', 'blog');
    define('SITENAME', 'Nutricionista Low Carb');
    define('SITEDESC', 'Nutricionista Low Carb - Vivendo Com Qualidade');
    define('FONTS', '');
    define('URL_FACEBOOK_THEME', 'nutricionistalowcarb');
elseif (!empty($_SESSION['theme']) && $_SESSION['theme'] == 'ecommerce'):
    define('THEME', 'ecommerce');
    define('SITENAME', 'Cardi Tapetes');
    define('SITEDESC', 'Quer Comprar Tapetes Arraiolo e Smyrna de Qualidade? A Cooperativa Artesanal Regional de Diamantina possui os Melhores Tapetes de Acordo Com o Seu Gosto!');
    define('FONTS', '');
elseif (!empty($_SESSION['theme']) && $_SESSION['theme'] == 'ead'):
    define('THEME', 'ead');
    define('SITENAME', 'Cet-Rhema');
    define('SITEDESC', 'Cet-Rhema - Um Seminário a Serviço do Reino');
    define('FONTS', '');
elseif (!empty($_SESSION['theme']) && $_SESSION['theme'] == 'blog-saude'):
    define('THEME', 'blog-saude');
    define('SITENAME', 'Nilma Nayara Nutri e Coach');
    define('SITEDESC', 'Bem Vindo à Excelência em Emagrecimento Definitivo!');
    define('URL_FACEBOOK_THEME', 'nutricionistalowcarb');
    define('NOME_RESPONSAVEL_EMPRESA_THEME', 'Nilma Nayara Nutri e Coach');
    define('ENDERECO_EMPRESA_THEME', 'Praça Vicente de Paula Fonseca, 170 - Arraial dos Forros');
    define('CIDADE_EMPRESA_THEME', 'Diamantina - MG - Brasil');
    define('CEP_EMPRESA_THEME', '39100-000');
    define('TELEFONES_EMPRESA_THEME', '(38)98816-7371');
    define('EMAIL_EMPRESA_THEME', 'nilma.nayara@yahoo.com.br');
    define('FONTS', 'Coming+Soon|Goudy+Bookletter+1911|IBM+Plex+Serif:100,100i,300,300i,400,500');
elseif (!empty($_SESSION['theme']) && $_SESSION['theme'] == 'pizzaria'):
    define('THEME', 'pizzaria');
    define('SITENAME', '..Casa DiPizzas..');
    define('SITEDESC', 'Casa DiPizzas - A Melhor Pizza do Nordeste');
    define('FONTS', '');
elseif (!empty($_SESSION['theme']) && $_SESSION['theme'] == 'blog-cristao'):   
    define('THEME',  'blog-cristao');
    define('SITENAME', 'Gabadi Online');
    define('SITEDESC', 'A potência gospel de Diamantina!'); 
    define('FONTS', '');
elseif (!empty($_SESSION['theme']) && $_SESSION['theme'] == 'ingresso'):   
    define('THEME',  'ingresso');
    define('SITENAME', 'Conferência Avante Pelo Reino 2018');
    define('SITEDESC', 'Venha Celebrar Conosco, Para Juntos Seguirmos Avante Pelo Reino!'); 
    define('FONTS', '');
elseif (!empty($_SESSION['theme']) && $_SESSION['theme'] == 'afiliado'):   
    define('THEME',  'afiliado');
    define('SITENAME', 'Treinamento Fórmula Negócio Online | Saiba Como Ganhar Dinheiro Na Internet!');
    define('SITEDESC', 'Saiba Como Ganhar Dinheiro Na Internet Sem Sair De Casa! Conheça o Treinamento Fórmula Negócio Online!'); 
    define('FONTS', '');
elseif (!empty($_SESSION['theme']) && $_SESSION['theme'] == 'blog-baixo'):   
    define('THEME',  'blog-baixo');
    define('SITENAME', 'Sacando Baixo | Como Aprender a Tocar Contrabaixo');
    define('SITEDESC', 'Sacadas, Dicas Rápidas e Gratuitas de Como Aprender a Tocar Contrabaixo Para Você que, Seja Iniciante ou Não, Possa Evoluir Treinando Seu Contrabaixo de 4, 5 ou 6 Cordas'); 
    define('FONTS', '');        
else:
    $_SESSION['theme'] = null;
    define('THEME', $config_theme);
//DEFINE IDENTIDADE DO SITE ####################################
    define('SITENAME', $config_title);
    define('SITEDESC', $config_description);

endif;

define('INCLUDE_PATH', HOME . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . THEME);
define('INCLUDE_PATH_ADMIN', HOME_ADMIN . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . THEME);
define('REQUIRE_PATH', 'themes' . DIRECTORY_SEPARATOR . THEME);


//MENUS
define('MENU_APP', '1');
define('SUBMENU', '1');
define('SUBSUBMENU', '1');


//SLIDES
define('SLIDES_APP', '1');
define('SLIDES_APP_ULTIMOS', '1');
define('SLIDES_APP_BANNERS', '1');
define('SLIDES_APP_VIDEOS', '0');
define('SLIDES_APP_ANUNCIANTES', '0');


//SIDEBAR
define('SIDEBAR_HOME_LEFT', '0');
define('SIDEBAR_HOME_RIGHT', '1');

//DEFINE DADOS DE IDENTIDADE DE MEO
define('AUTHOR_GOOGLE', $config_author_google);
define('PUBLISHER_GOOGLE', $config_publisher_google);
define('APP_ID_FACEBOOK', $config_app_id_facebook);
define('AUTHOR_FACEBOOK', $config_author_facebook);
define('PUBLISHER_FACEBOOK', $config_publisher_facebook);
define('PERFIL_TWITTER', $config_perfil_twitter);
define('LINK_DEVELOPER', (!empty($LINK_DEVELOPER) ? $LINK_DEVELOPER : 'https://www.linkedin.com/in/luizfelipelopes/'));
define('NAME_DEVELOPER', (!empty($NAME_DEVELOPER) ? $NAME_DEVELOPER : 'Luiz Felipe Lopes'));

define('DOMAIN', $config_domain);

//REDES SOCIAIS
define('REDES_SOCIAIS', '1');
define('REDE_SOCIAL_FB', '1');
define('URL_FACEBOOK', (!empty($URL_FACEBOOK) ? $URL_FACEBOOK : 'nutricionistalowcarb'));
define('REDE_SOCIAL_INSTA', '1');
define('URL_INSTAGRAM', (!empty($URL_INSTAGRAM) ? $URL_INSTAGRAM : 'nilmanayaranutri'));
define('REDE_SOCIAL_YT', '0');
define('URL_YOUTUBE', (!empty($URL_YOUTUBE) ? $URL_YOUTUBE : 'UCeIXThboLb7PWhhdxyKl3IA'));
define('REDE_SOCIAL_TW', '0');
define('URL_TWITTER', (!empty($URL_TWITTER) ? $URL_TWITTER : ''));
define('REDE_SOCIAL_LN', '0');
define('URL_LINKEDIN', (!empty($URL_LINKEDIN) ? $URL_LINKEDIN : 'luizfelipelopes'));


// TRACKING
define('GOOGLE_ANALYTICS_APP', '0');
define('GOOGLE_ANALYTICS_ID', (!empty($GOOGLE_ANALYTICS_ID) ? $GOOGLE_ANALYTICS_ID : 'UA-122807631-1'));
define('GOOGLE_ADSENSE_ID', (!empty($GOOGLE_ADSENSE_ID) ? $GOOGLE_ADSENSE_ID : "ca-pub-1957511375295893"));
define('GOOGLE_ADWORDS_APP', '0');
define('GOOGLE_ADWORDS_ID', (!empty($GOOGLE_ADWORDS_ID) ? $GOOGLE_ADWORDS_ID : 'AW-853666240'));
define('FACEBOOK_TRACKING', '0');
define('FACEBOOK_PIXEL_ID', (!empty($FACEBOOK_PIXEL_ID) ? $FACEBOOK_PIXEL_ID : '1082988118507407'));


//APPS FACEBOOK
define('FACEBOOK_APP', '1');
define('FACEBOOK_APP_GERAL_CURTIR', '1');
define('FACEBOOK_APP_SEGUIDORES', '1');
define('FACEBOOK_APP_SEGUIDORES_PERSONALIZADO_HOME', '0');
define('FACEBOOK_APP_TIMELINE_HOME', '0');
define('FACEBOOK_APP_TIMELINE_FOOTER', '1');

//APPS YOUTUBE
define('YOUTUBE_APP_HOME', '0');
define('YOUTUBE_APP_INSCRITOS', '1');

//APPS INSTAGRAM
define('INSTAGRAM_APP', '1');
define('INSTAGRAM_APP_TOKEN', '3067921974.960f1bf.931ea65f59354f18a73e35241c2bec44');
define('INSTAGRAM_APP_FOTOS_SIDEBAR_HOME', '0');
define('INSTAGRAM_APP_FOTOS_HORIZONTAL_HOME', '1');
define('INSTAGRAM_APP_FOTOS_SIDEBAR_FOOTER', '0');
define('INSTAGRAM_APP_FOTOS_HORIZONTAL_FOOTER', '0');

//PUBLICIDADE
define('PUBLICIDADE', '1');
define('PUBLICIDADE_SIDEBAR_HOME', '0');
define('PUBLICIDADE_HORIZONTAL_HOME', '0');
define('PUBLICIDADE_AFILIADO_HOME', '0');


//CONFIGURACOES BLOG
define('URL_DINAMICA', '1');
define('VIDEOS_YT', '0');
define('RECADOS', '0');


//CONFIGURACOES ADMIN
define('ADMIN', 'admin');
define('COMENTARIOS_ADMIN', '1');
define('BLOG_ADMIN', '1');
define('ECOMMERCE_ADMIN', '0');
define('EAD_ADMIN', '0');
define('DEPOIMENTOS_ADMIN', '0');
define('VIDEOS_ADMIN', '1');
define('SLIDES_ADMIN', '1');
define('SLIDES_FOTOS_ADMIN', '1');
define('SLIDES_DESTAQUES_ADMIN', '0');
define('SLIDES_BANNERS_ADMIN', '0');
define('PAGINAS_ADMIN', '0');
define('ENVIO_EMAILS_ADMIN', '0');
define('OPTIN_ADMIN', '0');
define('VIEWS_ADMIN', '1');
define('CONFIG_ADMIN', '0');
define('NOTIFICATION_COMMENT_ADMIN', '0');
define('SALES_ADMIN', '0');

//EMAILS
define('EMAILS_ADMIN', '1');
define('LEADS_ADMIN', '1');
define('LEADS_AC', '0');
define('LEADS_MC', '1');
define('LEADS_HORIZONTAL_HOME', '1');
define('LEADS_SIDEBAR_HOME', '1');


//AUTOLOAD DE CLASSSES ####################################
// FUNÇÂO AUTOLOAD TENTA CARREGAR A CLASSE QUE FOI INSTANCIADA
// SÒ FAZ O REQUIRE DA CLASSE QUE SERÀ INSTANCIADA NO MOMENTO
// O NOME DA CLASSE  É PASSADO POR PARÂMETRO
// TODA VEZ QUE O NEW É EXECUTADO, O MÉTODO AUTOLOAD DE CONFIG.INC SERÁ EXECUTADO AUTOMATICAMENTE, 
// PASSANDO O OBJETO QUE INSTANCIOU A CLASSE POR PARAMETRO
function carregarClasses($Class) {

    // NOME DAS PASTAS QUE CONTEM AS CLASSES DO SISTEMA
    $cDir = ['Conn', 'Helpers', 'Models', 'Library/PHPMailer', 'Library/PagSeguroLibrary/config', 'Library/PagSeguroLibrary/resources', 'Library/PagSeguroLibrary', '../' . ADMIN . '/Assets/Models'];
    $iDir = null;

    //__DIR__:  É O DIRETÓRIO DESSE ARQUIVO
    foreach ($cDir as $dirName) :
        if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . "{$dirName}" . DIRECTORY_SEPARATOR . "{$Class}.class.php") && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . "{$Class}.class.php")):

            include_once (__DIR__ . DIRECTORY_SEPARATOR . "{$dirName}" . DIRECTORY_SEPARATOR . "{$Class}.class.php");
//            var_dump(__DIR__ . DIRECTORY_SEPARATOR . "{$dirName}" . DIRECTORY_SEPARATOR . "{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}

function get_nginx_headers($function_name = 'getallheaders') {

    $all_headers = array();

    if (function_exists($function_name)) {

        $all_headers = $function_name();
    } else {

        foreach ($_SERVER as $name => $value) {

            if (substr($name, 0, 5) == 'HTTP_') {

                $name = substr($name, 5);
                $name = str_replace('_', ' ', $name);
                $name = strtolower($name);
                $name = ucwords($name);
                $name = str_replace(' ', '-', $name);

                $all_headers[$name] = $value;
            } elseif ($function_name == 'apache_request_headers') {

                $all_headers[$name] = $value;
            }
        }
    }


    return $all_headers;
}

//TRATAMENTO DE ERROS ########################################################################
//CSS constantes :: Mensagens de Erro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

//WSERRo :: Exibe erros lançados :: Front (ERRO CAUSADO POR AÇÂO DO USUÀRIO)
function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : (($ErrNo == E_USER_WARNING) ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";
    if ($ErrDie):
        die;
    endif;
}

//PHPErro :: personaliza o gatilho PHP (ERRO DO PHP PARA DESENVOLVEDOR)
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : (($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo))));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na linha: {$ErrLine} :: </b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

// FAZ COM QUE OS ERROS DO SISTEMA SEJAM MANIPULADOS PELA CALSSE 'PHPErro'
set_error_handler('PHPErro');
