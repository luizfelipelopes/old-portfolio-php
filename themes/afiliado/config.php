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
define("BASE", "http://formulanegocioonlinefunciona.info"); //https://www.seusite.com.br/campanha
// define("GATE", true);
// define("INDEX", "pages/home_prevenda.php");
// define("CONFIRM", "pages/confirma_text.php");
// define("THANKYOU", "pages/obrigado_text.php");
// define("GOOGLE_FONT", "Exo:100,300,400,500,700");
// define("PRODUTO", "");
define("HOTLINK", "https://go.hotmart.com/B6177684W?ap=efd3");

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
$SEO = array(
    "title" => "Treinamento Fórmula Negócio Online | Saiba Como Ganhar Dinheiro Na Internet!",
    "description" => "Saiba Como Ganhar Dinheiro Na Internet Sem Sair De Casa! Conheça o Treinamento Fórmula Negócio Online!",
    "copyright" => "Como Mudar de Vida, Todos os Direitos Reservados! | CNPJ: 10.548.698/0001-38 | cursos@upinside.com.br",
    "site_name" => "Treinamento Fórmula Negócio Online Funciona",
    "g_author" => "103958419096641225872",
    "g_page" => "107305124528362639842",
    "fb_author" => "robsonvleite",
    "fb_page" => "upinside",
    "yt_channel" => "upinsidebr",
    "twitter" => "robsonvleite"
);

/*
 * LEGAL Config:
 * Configurações de links para páginas de termos de uso, aviso legal e políticas de privacidade!
 */
$LEGAL = [
    "termos" => "https://www.upinside.com.br/termos.php",
    "politicas" => "https://www.upinside.com.br/politicas.php",
    "aviso" => "https://www.upinside.com.br/aviso.php"
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

//mc_host = sacandobaixo
//mc_form = 5586d4ff3d

//ac_host = flowstate2
//ac_form = 1

//aw_host = awlist4805398
//aw_form = 48635667

$OPTIIN = [
    "headline" => "Cadastre-se para <b>CONHECER O TREINAMENTO</b> Fórmula Negócio Online!",
    "tag_copy" => "Cadastre-se e descubra o melhor e mais completo curso de e-mail marketing com ActiveCampaign do mercado!",
    "ac_host" => "awlist4805398",
    "ac_form" => "48635667",
    "ac_button" => "BAIXAR E-BOOK AGORA!",
    "ac_register" => "QUERO CONHECER O TREINAMENTO!",
    "ac_button_color" => "yellow", // green, blue, yellow, red
    "ac_inputs" => [
        "<input type='text' class='name' placeholder='Nome:' name='fullname' required />",
        "<input type='email' class='email' placeholder='E-mail:' name='email' required />"
    ],
    "yt_video" => [
        "captura" => "XzTllkpVyIc",
        "confirma" => "XzTllkpVyIc",
        "obrigado" => "XzTllkpVyIc"
    ],
    "require_form" => "formaw"
    
];

/*
 * SECTIONS Config:
 * Configurações dos títulos de sessões na página de captura!
 */
$SECTIONS = [
    "O que <b class='color_{$OPTIIN['ac_button_color']}'>esperar do livro?</b>",
    "Conheça o <b class='color_{$OPTIIN['ac_button_color']}'>autor do livro!</b>",
    "O que os alunos <b class='color_{$OPTIIN['ac_button_color']}'>falam da UpInside?</b>"
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
    "title" => "O link do treinamento foi enviado por e-mail!",
    "headline" => "Acesse seu e-mail para confirmar o interesse e conhecer o Treinamento Fórmula Negócio Online!",
    "subject" => "[CONFIRMAÇÃO] Clique aqui e conheça o Treinamento Fórmula Negócio Online!"
];

/*
 * THANKS Config:
 * Configurações da página de obrigado por se cadastrar!
 */
$THANKS = [
    "title" => "Obrigado por confirmar sua inscrição!",
    "content" => "A partir de agora sempre que tivermos uma novidade avisamos por e-mail!",
    "cta" => "CONHEÇA O TREINAMENTO AGORA!",
    "cta_link" => HOTLINK
];
