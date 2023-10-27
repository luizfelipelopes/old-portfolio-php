<?php

/*
 * BASE CONFIG:
 * Configurações básicas de funcionamento!
 * BASE: Link de URL raiz da campanha!
 * GATE: Todo conteúdo dentro da pasta gates é protegido por padrão se GATE = TRUE!
 * INDEX: Modelo de página de captura (home_email.php, home_livro.php, home_video.php)
 * CONFIRM: Modelo de página de confirmação (confirma_text.php, confirma_video.php)
 * THANKYOU: Modelo de página de obrigado! (obrigado_text.php, obrigado_livro.php, obrigado_video.php)
 * GOOGLE_FONT: Fonte e Weight da fonte utilizada. Compatível apenas com Google Fonts
 * CURSO DE ACTIVECAMPAIGN UPINSIDE: https://www.upinside.com.br/curso/curso-activecampaign
 */
//define("BASE", "https://activecampaign.000webhostapp.com"); //https://www.seusite.com.br/campanha
define("GATE", true);
define("ARQUIVO_INDEX", "home_email");
define("INDEX", "app_campaign/" . ARQUIVO_INDEX . ".php");
define("CONFIRM", "app_campaign/confirma_video.php");
define("THANKYOU", "app_campaign/obrigado_text.php");
define("GOOGLE_FONT", "Exo:100,300,400,500,700");
define("PRODUTO", "");

//SITE: https://activecampaign.000webhostapp.com/
//HOST FTP : files.000webhost.com
//USER FTP: activecampaign
//SENHA FTP: LDO$tQyLy!Dv^P5VYyfY

/*
 * LEAD GATE:
 * $gatePages: Páginas adicionais que serão protegidas no Lead Gate
 * $HomePages: Indica as páginas iniciais permitidas para teste A/B/C ex: BASE/email, BASE/livro
 */
$gatePages = ["confirma", "obrigado"];
$HomePages = ['email', 'livro', 'video'];

/*
 * SEO, SEM and SMO Config:
 * Configurações de otimização do ActivePages.
 */
//"copyright" => "Luiz Felipe Lopes, Todos os Direitos Reservados! | CNPJ: 10.548.698/0001-38 | cursos@upinside.com.br",
$SEO = array(
    "title" => "Email Marketing Com ActiveCampaign | ActivePages",
    "description" => "Aprenda tudo que precisa para criar e gerenciar campanhas e automações de marketing digital e e-mail marketing!",
    "copyright" => "Luiz Felipe Lopes, Todos os Direitos Reservados! | lfelipelopesti@gmail.com",
    "site_name" => "Luiz Felipe Lopes",
    "g_author" => "103958419096641225872",
    "g_page" => "107305124528362639842",
    "fb_author" => "LuizFelipeCLopes",
    "fb_page" => "upinside",
    "yt_channel" => "upinsidebr",
    "twitter" => "robsonvleite"
);

/*
 * LEGAL Config:
 * Configurações de links para páginas de termos de uso, aviso legal e políticas de privacidade!
 */
$LEGAL = [
    "termos" => HOME . "/termos",
    "politicas" => HOME . "/politicas",
    "aviso" => HOME . "/aviso",
    "termos-completo" => HOME . "/termos-servico"
];
/*
 * TRACKING: FACEBOOK, GOOGLE 
 * facebook_pixel_id: Informe o ID do seu pixel do Facebook
 * google_adwords_id: Informe o ID do seu pixel de conversão do AdWords
 * google_adwords_label: Informe o label do pixel de conversão do AdWords
 * google_analytics: Informe o ID (UA) do seu pixel do Google Analytics
 */
$TRAKING = [
    "facebook_pixel_id" => "737016459816766",
    "google_adwords_id" => "853666240",
    "google_adwords_label" => "OeQiCIyPtnQQwNOHlwM",
    "google_analytics" => "UA-100818222-1"
];

/*
 * OPTIN Config:
 * Configurações do formulário, confirmação, obrigado de OPT-IN!
 * ac_button_color: TEMAS DO ACTIVE PAGES (yellow, green, blue, red, purple, pink)
 */

//ac_host = flowstate
//ac_form = 1

define('NAME_INPUT_AC', 'fullname');
define('EMAIL_INPUT_AC', 'email');
define('NAME_INPUT_MC', 'FNAME');
define('EMAIL_INPUT_MC', 'EMAIL');



$OPTIIN = [
    "headline" => "Faça a sua <b>CONSULTORIA GRATUITA</b> e aumente as chances de crescimento do seu negócio!",
    "tag_copy" => "Cadastre-se e descubra o melhor e mais completo curso de e-mail marketing com ActiveCampaign do mercado!",
    "ac_host" => "host",
    "ac_form" => "51aac5b170",
    "ac_button" => "BAIXAR E-BOOK AGORA!",
    "ac_register" => "CADASTRE-SE PARA GANHAR A CONSULTORIA!",
    "ac_button_color" => "yellow", // green, blue, yellow, red
    "ac_inputs" => [
        "<input style='margin-right:1% !important;' type='text' class='".(LEADS_AC == '0' && LEADS_MC == '0' ? 'form-field box box-medium' : 'name')."' placeholder='Nome:' name='" . (LEADS_AC == '1' ? NAME_INPUT_AC : (LEADS_MC == '1' ? NAME_INPUT_MC : '')) . "' required />",
        "<input type='email' class='".(LEADS_AC == '0' && LEADS_MC == '0' ? 'form-field box box-medium' : 'email')."' placeholder='E-mail:' name='" . (LEADS_AC == '1' ? EMAIL_INPUT_AC : (LEADS_MC == '1' ? EMAIL_INPUT_MC : '')) . "' required />",
        // "<input type='text' class='js_cel ".(LEADS_AC == '0' && LEADS_MC == '0' ? 'form-field box box-medium' : 'whatsapp')."' placeholder='WhatsApp: (xx)xxxxx-xxxx' name='lead_whatsapp' required />"
    ],
    "yt_video" => [
        "captura" => "XzTllkpVyIc",
        "confirma" => "XzTllkpVyIc",
        "obrigado" => "XzTllkpVyIc"
    ]
];

define('HIDDEN_INPUT_AC', '<input type="hidden" name="u" value="' . $OPTIIN['ac_form'] . '" /><input type="hidden" name="f" value="' . $OPTIIN['ac_form'] . '" /><input type="hidden" name="s" /><input type="hidden" name="c" value="0" /><input type="hidden" name="m" value="0" /><input type="hidden" name="act" value="sub" /><input type="hidden" name="v" value="2" />');
define('HIDDEN_INPUT_MC', '');
define('ACTION_AC', '//' . $OPTIIN['ac_host'] . '.activehosted.com/proc.php');
define('ACTION_MC', '//' . $OPTIIN['ac_host'] . '.us16.list-manage.com/subscribe/post?u=3f4df7cd5d3b67a4e1b3818bd&amp;id=' . $OPTIIN['ac_form']);
define('ID_AC', '_form_' . $OPTIIN['ac_form']);
define('ID_MC', $OPTIIN['ac_form']);


/*
 * SECTIONS Config:
 * Configurações dos títulos de sessões na página de captura!
 */
$SECTIONS = [
    "O que <b class='color_{$OPTIIN['ac_button_color']}'>esperar do livro?</b>",
    "Conheça o <b class='color_{$OPTIIN['ac_button_color']}'>autor do livro!</b>",
    "O que os alunos <b class='color_{$OPTIIN['ac_button_color']} '>falam da UpInside?</b>"
];

/*
 * DESCRIPTIONS Config:
 * Configurações do blogo de descrições da página de captura!
 */
$DESCRIPTION = [
    [
        "title" => "Mindeset Empreendedor:",
        "content" => "Falar de mindset em letras escritas as vezes é complicado, pois nestas palavras teríamos que ter expressão facial, contato de rosto e sentimento. O mindset de fato é o ÚNICO caminho viável para o sucesso!"
    ],
    [
        "title" => "O poder da Ferramenta:",
        "content" => "No mercado há centenas de ferramentas prontas para, inclusive ótimas ferramentas. Podemos citar WordPress, Joomla, etc. Neste livro vamos falar sobre criar ferramentas que atendem a necessidade do cliente!"
    ],
    [
        "title" => "Os Processos Mandam:",
        "content" => "Eu odeio vender. Realmente não gosto de dar a cara a tapa para oferecer produtos ou serviços pois tenho em minha mente a imagem de um vendedor batendo a porta. Não quero que vejam isso em mim. Vamos trabalhar isso aqui!"
    ],
    [
        "title" => "É Preciso Resultados:",
        "content" => "Sites são feitos para serem acessados. Públicos segmentados e tráfego qualificado. Busque eles! Você será pago e reconhecido pelos resultados que consegue gerar, o resto é apenas o caminho!"
    ]
];

/*
 * CONFIRM Config:
 * Configurações da página de confirmação de cadastro!
 */
$CONFIRM = [
    "title" => "Seu e-book foi enviado por e-mail!",
    "headline" => "Acesse seu e-mail para confirmar a inscrição e efetuar o download do e-book!",
    "subject" => "[CONFIRMAÇÃO] Baixe aqui seu e-book da receitare!"
];

/*
 * THANKS Config:
 * Configurações da página de obrigado por se cadastrar!
 */
$THANKS = [
    "title" => "Obrigado por confirmar sua inscrição!",
    "content" => "Você receberá um e-mail para agendar-mos nossa consultoria gratuita!",
    "cta" => "BAIXAR E-BOOK AGORA!",
    "cta_link" => "#"
];
