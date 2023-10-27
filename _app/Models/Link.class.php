<?php

/**
 * Link.class [ MODEL ]
 * Classe responsável por organizar o SEO do sistema e realizar a navegação!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Link {

    private $File;
    private $Link;

    /** DATA */
    private $Local;
    private $Path;
    private $Tags;
    private $Data;

    /** @var Seo */
    private $Seo;

    public function __construct() {
        $this->Local = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
        $this->Local = ($this->Local ? $this->Local : 'index');
        $this->Local = explode('/', $this->Local);
        $this->File = (isset($this->Local[0]) ? ($this->Local[0] != 'post' 
                && $this->Local[0] != 'index' 
                && $this->Local[0] != 'sobre' 
                && $this->Local[0] != 'dicas' 
                && $this->Local[0] != 'receitas' 
                && $this->Local[0] != 'atendimento' 
                && $this->Local[0] != 'depoimentos' 
                && $this->Local[0] != 'contato' 
                && $this->Local[0] != 'venda-servico' 
                && $this->Local[0] != 'sessao-gratuita' 
                && $this->Local[0] != 'treinamentoreal' 
                && $this->Local[0] != 'posts' 
                && $this->Local[0] != 'videos' 
                && $this->Local[0] != 'pesquisa' 
                && $this->Local[0] != '404' 
                && $this->Local[0] != 'confirma' 
                && $this->Local[0] != 'obrigado'
                && $this->Local[0] != 'uma-palavra'
                && $this->Local[0] != 'curso'
                && $this->Local[0] != 'login'
                && $this->Local[0] != 'shop'
                && $this->Local[0] != 'checkout'
                && $this->Local[0] != 'promocao'
                && $this->Local[0] != 'QuemSomos'
                && $this->Local[0] != 'FaleConosco'
                && $this->Local[0] != 'tapetes'
                && $this->Local[0] != 'Detalhes'
                && $this->Local[0] != 'cadastrar' 
                && $this->Local[0] != ARQUIVO_INDEX ? 'encaminhador-content' : $this->Local[0]) : 'index');
        $this->Link = (isset($this->Local[1]) ? $this->Local[1] : null);
        $this->Id = strip_tags(trim(filter_input(INPUT_GET, 'produtoid', FILTER_DEFAULT)));
        $this->Seo = new Seo($this->File, $this->Link, $this->Local, $this->Id);
    }

    public function getId() {
        return $this->Id;
    }

    public function getLink() {
        return $this->Link;
    }

    public function getTags() {
        $this->Tags = $this->Seo->getTags();
        echo $this->Tags;
    }

    public function getData() {
        $this->Data = $this->Seo->getData();
        return $this->Data;
    }

    public function getLocal() {
        return $this->Local;
    }

    public function getFile() {
        return $this->File;
    }

    public function getPath() {
        $this->setPatch();
        return $this->Path;
    }

    //PRIVATES
    private function setPatch() {

        if (file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . '.php')):
            $this->Path = REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . '.php';
        elseif (file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . '.php')):
            $this->Path = REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . '.php';
        elseif (file_exists('_cdn' . DIRECTORY_SEPARATOR . INDEX)):
            if ($this->File != INDEX && !GATE):
                $this->Path = '_cdn' . DIRECTORY_SEPARATOR . 'app_campaign' . DIRECTORY_SEPARATOR . $this->File . '.php';
            else:
                $this->Path = '_cdn' . DIRECTORY_SEPARATOR . INDEX;
            endif;

        else:
            $this->Path = REQUIRE_PATH . DIRECTORY_SEPARATOR . '404.php';
        endif;
    }

}
