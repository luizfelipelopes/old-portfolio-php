<?php

/**
 * Seo.class [ MODEL ]
 * Classe de apoio para o modelo LINK. Pode ser utilizada para gerar SEO para as páginas do sistema!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Seo {

    private $File;
    private $Link;
    private $Data;
    private $Tags;
    private $Id;
    private $Local;


    /* DADOS POVOADOS */
    private $seoTags;
    private $seoData;

    public function __construct($File, $Link, $Local, $Id = null) {
        $this->File = $File ? strip_tags(trim($File)) : null;
        $this->Link = $Link ? strip_tags(trim($Link)) : null;
        $this->Id = (!empty($Id) ? $Id : null);
        $this->Local = $Local[0];
    }

    public function getTags() {
        $this->checkData();
        return $this->seoTags;
    }

    public function getData() {
        $this->CheckData();
        return $this->seoData;
    }

    public function getLocal() {
        return $this->getLocal();
    }

    //PRIVATES
    private function checkData() {
        if (!$this->seoData):
            $this->getSeo();
        endif;
    }

    private function getSeo() {
        $ReadSeo = new Read;

        switch ($this->File):

            /**
             * =================================================
             * ===============PADRÃO PARA SITE==================
             * =================================================
             */
            //SEO:: INDEX    
            case 'index':
                $this->Data = [SITENAME . (THEME == 'ecommerce' ? ' | A Sua Loja Virtual de Tapetes Arraiolos' : ''), SITEDESC, HOME, INCLUDE_PATH . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . '37.png'];
                break;


            //SEO::QUEM SOMOS
            case 'QuemSomos':

                $ReadSeo->ExeRead(PAGINAS, "WHERE pagina_name = :name", "name=quem-somos");
                if (!$ReadSeo->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    extract($ReadSeo->getResult()[0]);
                    $this->seoData = $ReadSeo->getResult()[0];
                    $this->Data = ["{$pagina_title} | " . SITENAME, SITEDESC, HOME . 'QuemSomos', INCLUDE_PATH . '/images/site.png'];
                endif;

                break;


            //SEO::PESQUISA    
            case 'pesquisa':

                $ReadSeo->ExeRead(PRODUTOS, "WHERE produto_status = 1 AND (produto_title LIKE '%' :link '%' OR produto_descricao LIKE '%' :link '%')", "link={$this->Link}");
                if (!$ReadSeo->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    $this->seoData['data'] = $ReadSeo->getResult();
                    $this->seoData['count'] = $ReadSeo->getRowCount();
                    $this->Data = ["Pesquisa por: {$this->Link}" . ' | ' . SITENAME, "Sua pesquisa por {$this->Link} retornou {$this->seoData['count']} resultados!", HOME . "/pesquisa/{$this->Link}", INCLUDE_PATH . '/images/site.png'];
                endif;
                break;


            //SEO :: ENTRAR
            case 'Entrar':
                $this->Data = ["Entrar | " . SITENAME, (THEME == 'ecommerce' ? "Cadastre-se e compre os melhores tapetes da região" : ''), HOME . 'Entrar', INCLUDE_PATH . '/images/site.png'];
                break;

            //SEO :: FALE CONOSCO
            case 'FaleConosco':
                $this->Data = ["Fale Conosco | " . SITENAME, "Dúvidas, críticas ou sugetões? Entre em contato conosco! Ficaremos gratos em atendê-los", HOME . 'FaleConosco', INCLUDE_PATH . '/images/site.png'];
                break;
            
            //SEO :: Obrigado
            case 'obrigado':
                $this->Data = ["Obrigado", "Obrigado por confirmar sua inscrição!", HOME . 'obrigado', INCLUDE_PATH . '/images/site.png'];
                break;

            /**
             * =================================================
             * =====================PIZZARIA=========================
             * =================================================
             */
            
            case 'shop':
                    $this->Data = [SITENAME . ' | Shop', SITEDESC, HOME . '/shop', INCLUDE_PATH . '/img/logo.png'];
                break;
            
            case 'checkout':
                $this->Data = [SITENAME . ' | Checkout', SITEDESC, HOME . '/checkout', INCLUDE_PATH . '/img/logo.png'];
            break;  
            
            case 'contato':
                $this->Data = [SITENAME . ' | Contato', SITEDESC, HOME . '/contato', INCLUDE_PATH . '/img/logo.png'];
            break;  

            /**
             * =================================================
             * =====================EAD=========================
             * =================================================
             */
            
            case 'uma-palavra':
                $this->Data = ["Uma Palavra | " . SITENAME, 'Agora, para atender a necessidade daqueles que não podem estudar com um programa preso ao horário, o Cet-Rhema lança seus cursos no sistema, EAD, dando ao aluno condição de fazer seu tempo de estudo, sem perda da qualidade de ensino.', HOME . '/uma-palavra', INCLUDE_PATH . '/img/logo.png'];
                break;
            
            
             case 'curso':

                $readCurso = new Read;
                $readCurso->FullRead("SELECT curso_title, curso_subtitle, curso_name, curso_cover FROM " . CURSOS . " WHERE curso_name = :name", "name={$this->Link}");

                if ($readCurso->getResult()):
                    extract($readCurso->getResult()[0]);
                    $this->seoData = $readCurso->getResult()[0];
                    $this->Data = [$curso_title . ' | ' . SITENAME, $curso_subtitle, HOME . "/curso/{$curso_name}", HOME . DIRECTORY_SEPARATOR . 'uploads' . $curso_cover];
                endif;


                break;

            //SEO :: LOGIN
            case 'login':
                $this->Data = [(THEME == 'ead' ? 'Área do Aluno' : 'Login') . " | " . SITENAME, "Login do Sistema", HOME . 'FaleConosco', INCLUDE_PATH . '/img/logo.png'];
                break;

            /**
             * =================================================
             * ==================ECOMMERCE======================
             * =================================================
             */
            //SEO :: DETALHES
            case 'Detalhes':

                $Id = (!empty($this->Id) ? "produto_id = {$this->Id} AND" : '');
                $Admin = (isset($_SESSION['userlogin']['user_level']) && $_SESSION['userlogin']['user_level'] == 3 ? true : false);
                $Check = ($Admin ? '' : 'produto_status = 1 AND');

                $ReadSeo->ExeRead(PRODUTOS, "WHERE {$Check} {$Id} produto_name = :link", "link={$this->Link}");
                if (!$ReadSeo->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    extract($ReadSeo->getResult()[0]);
                    $this->seoData = $ReadSeo->getResult()[0];
                    $this->Data = [$produto_title . ' | ' . SITENAME, $produto_descricao, HOME . "/produtos/{$produto_name}", HOME . "/uploads/{$produto_image}"];

                    //post:: conta views da empresa
                    $ArrUpdate = ['produto_views' => $produto_views + 1];
                    $Update = new Update();
                    $Update->ExeUpdate(PRODUTOS, $ArrUpdate, "WHERE produto_id = :produtoid", "produtoid={$produto_id}");

                endif;
                break;

            //SEO :: CARRINHO
            case 'Carrinho':
                $this->Data = ["Carrinho | " . SITENAME, SITEDESC, HOME . 'Carrinho', INCLUDE_PATH . '/images/site.png'];
                break;

            //SEO::TAPETES
            case 'tapetes':
                $Admin = (isset($_SESSION['userlogin']['user_level']) && $_SESSION['userlogin']['user_level'] == 3 ? true : false);
                $Check = ($Admin ? '' : 'produto_status = 1 AND');

                $ReadCat = new Read();
                $ReadCat->ExeRead(CATEGORIAS, "WHERE category_name = :link", "link={$this->Link}");
                if (!$ReadCat->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    extract($ReadCat->getResult()[0]);
                    $this->seoData = $ReadCat->getResult()[0];
                    $this->Data = [$category_title . ' | ' . SITENAME, $category_content, HOME . "/categories/{$category_name}", INCLUDE_PATH . '/images/site.png'];
                endif;

                break;


            /**
             * =================================================
             * ===================BLOG==========================
             * =================================================
             */
            //SEO::POSTS
            case 'encaminhador-content':

                $readPost = new Read;
                $readPost->FullRead("SELECT post_title, post_content, post_name, post_cover FROM " . POSTS . " WHERE post_name = :name", "name={$this->Local}");
                $readPage = new Read;
                $readPage->FullRead("SELECT pagina_title, pagina_content, pagina_name FROM " . PAGINAS . " WHERE pagina_name = :name", "name={$this->Local}");

                if ($readPost->getResult()):
                    extract($readPost->getResult()[0]);
                    $this->seoData = $readPost->getResult()[0];
                    $this->Data = [$post_title . ' | ' . SITENAME, $post_content, HOME . "/{$post_name}", HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover];
                elseif ($readPage->getResult()):
                    extract($readPage->getResult()[0]);
                    $this->seoData = $readPage->getResult()[0];
                    $this->Data = [$pagina_title . ' | ' . SITENAME, $pagina_content, HOME . "/{$pagina_name}", HOME . DIRECTORY_SEPARATOR . 'uploads' . $pagina_content];
                endif;

                break;

            //SEO::POSTS
            case 'posts':

                $ReadCat = new Read();
                $ReadCat->ExeRead(CATEGORIAS, "WHERE category_name = :link", "link={$this->Link}");
                if (!$ReadCat->getResult()):
                    $this->seoData = null;
                    $this->Data = ['Posts | ' . SITENAME, 'Confira Os Nossos Posts', HOME . "/posts", INCLUDE_PATH . '/images/site.png'];
                else:
                    extract($ReadCat->getResult()[0]);
                    $this->seoData = $ReadCat->getResult()[0];
                    $this->Data = [$category_title . ' | ' . SITENAME, $category_content, HOME . "/posts/{$category_name}", INCLUDE_PATH . '/images/site.png'];
                endif;

                break;

            default :
                $this->Data = [SITENAME . ' | 404 Oppsss, Nada encontrado!', SITEDESC, HOME . "/404", INCLUDE_PATH . '/images/site.png'];
        endswitch;

        if ($this->Data):
            $this->setTags();
        endif;
    }

    private function setTags() {
        $this->Tags['Title'] = $this->Data[0];
        $this->Tags['Content'] = Check::Words(html_entity_decode($this->Data[1]), 25);
        $this->Tags['Link'] = $this->Data[2];
        $this->Tags['Image'] = $this->Data[3];
        $this->Tags['pg_fb_author'] = AUTHOR_FACEBOOK;
        $this->Tags['pg_fb_publisher'] = PUBLISHER_FACEBOOK;
        $this->Tags['pg_fb_app'] = APP_ID_FACEBOOK;
        $this->Tags['pg_google_author'] = AUTHOR_GOOGLE;
        $this->Tags['pg_google_publisher'] = PUBLISHER_GOOGLE;
        $this->Tags['pg_twitter'] = PERFIL_TWITTER;
        $this->Tags['pg_domain'] = DOMAIN;



        $this->Tags = array_map('strip_tags', $this->Tags);
        $this->Tags = array_map('trim', $this->Tags);

        $this->Data = null;


        //NORMAL PAGE
        $this->seoTags = '<title>' . $this->Tags['Title'] . '</title> ' . "\n";
        $this->seoTags .= '<meta name="description" content="' . $this->Tags['Content'] . '"/>' . "\n";
        $this->seoTags .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
        if ($this->File == 'carrinho'):
            $this->seoTags .= '<meta name="robots" content="noindex, nofollow" />' . "\n";
        else:
            $this->seoTags .= '<meta name="robots" content="index, follow" />' . "\n";
        endif;
        $this->seoTags .= '<link rel="canonical" href="' . $this->Tags['Link'] . '">' . "\n";
        $this->seoTags .= "\n";

        //ITEM GROUP (GOOGLE)
        $this->seoTags .= '<meta itemprop="author" content="' . $this->Tags['pg_google_author'] . '" />' . "\n";
        $this->seoTags .= '<meta itemprop="publisher" content="' . $this->Tags['pg_google_publisher'] . '" />' . "\n";
        $this->seoTags .= '<meta itemprop="name" content="' . $this->Tags['Title'] . '" />' . "\n";
        $this->seoTags .= '<meta itemprop="description" content="' . $this->Tags['Content'] . '" />' . "\n";
        $this->seoTags .= '<meta itemprop="url" content="' . $this->Tags['Link'] . '" />' . "\n";
        $this->seoTags .= '<meta itemprop="image" content="' . $this->Tags['Image'] . '" />' . "\n";
        $this->seoTags .= "\n";

        //FACEBOOK
        $this->seoTags .= '<meta property="og:app_id" content="' . $this->Tags['pg_fb_app'] . '" />' . "\n";
        $this->seoTags .= '<meta property="article:author" content="https://www.facebook.com/' . $this->Tags['pg_fb_author'] . '" />' . "\n";
        $this->seoTags .= '<meta property="article:publisher" content="https://www.facebook.com/' . $this->Tags['pg_fb_publisher'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
        $this->seoTags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
        $this->seoTags .= '<meta property="og:title" content="' . $this->Tags['Title'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:description" content="' . $this->Tags['Content'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:image" content="' . $this->Tags['Image'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:url" content="' . $this->Tags['Link'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:type" content="article" />' . "\n";
        $this->seoTags .= "\n";


//        TWITTER
        $this->seoTags .= '<meta property="twitter:card" content="summary_large_image"/>' . "\n";
        $this->seoTags .= '<meta property="twitter:site" content="' . $this->Tags['pg_twitter'] . '"/>' . "\n";
        $this->seoTags .= '<meta property="twitter:domain" content="' . $this->Tags['pg_domain'] . '"/>' . "\n";
        $this->seoTags .= '<meta property="twitter:title" content="' . $this->Tags['Title'] . '"/>' . "\n";
        $this->seoTags .= '<meta property="twitter:description" content="' . $this->Tags['Content'] . '"/>' . "\n";
        $this->seoTags .= '<meta property="twitter:image:src" content="' . $this->Tags['Image'] . '"/>' . "\n";
        $this->seoTags .= '<meta property="twitter:url" content="' . $this->Tags['Link'] . '"/>' . "\n";


        $this->Tags = null;
    }

}
