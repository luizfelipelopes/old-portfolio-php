<?php

/**
 * Sitemap.class [ HELPER ]
 * Classe Responsável por Criar, Deletar, Atualizar o arquivo sitemap.xml e pingar nos mecanismos de busca
 * @copyright (c) 2018, Luiz Felipe C. Lopes 
 */
class Sitemap {

    private $Xml;
    private $UrlSet;
    private $Url;
    private $Loc;
    private $LastMod;
    private $ChangeFreq;
    private $Priority;
    private $Result;
    private $Error;

    // RAIZ DO SISTEMA
    const Path = ROOT_DOC . DIRECTORY_SEPARATOR;

    /**
     * GETTERS
     */
    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    /**
     * <b>ExeSitemap</b>: Gera Sitemap do Sistema. Caso exista, apenas é atualizado.
     * Também dado um ping nos moteres de busca para que percebam a nova atualização.
     * @param array $SitemapEstatic : Recebe as páginas estáticas do site
     * @param array $SitemapDynamic : Recebe as páginas dinâmicas do site
     */
    public function ExeSitemap(array $SitemapEstatic, array $SitemapDynamic = null) {

        if (in_array('', $SitemapEstatic)):
            $this->Error = ["Preencha todos os menus estáticos", WS_ERROR];
            $this->Result = false;
        else:

            $this->Xml = new DOMDocument('1.0', 'UTF-8');
            $xslt = $this->Xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="sitemap.xsl"');
            $this->Xml->appendChild($xslt);

            $this->UrlSet = $this->Xml->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
            $this->UrlSet = $this->Xml->appendChild($this->UrlSet);

            $this->CreateSitemapEstatic($SitemapEstatic);

            if (!empty($SitemapDynamic)):
                $this->CreateSitemapDynamic($SitemapDynamic);
            endif;

            $this->Xml->formatOutput = true;
            $StringValue = $this->Xml->saveXML();
            $this->Xml->save(self::Path . 'sitemap.xml');
            $this->Result = '<pre>' . $StringValue . '</pre>';

            $this->UpdateSitemapGz();

        endif;
    }

    /**
     * <b>InitSitemapGz</b>: cria arquivo sitemap.xml.gz para o google search console.
     */
    public function InitSitemapGz() {

        if (!file_exists(self::Path . 'sitemap.xml.gz')):

            $gzip = gzopen(self::Path . 'sitemap.xml.gz', 'w9');
            $gmap = file_get_contents(self::Path . 'sitemap.xml');
            gzwrite($gzip, $gmap);
            gzclose($gzip);

            $this->SitemapPing();

        endif;
    }

    /**
     * ********************************************************
     * ***************** PRIVATES METHODS **********************
     * ********************************************************
     */

    /**
     * <b>InitSitemapGz</b>: gera novo arquivo sitemap.xml.gz para o google search console.
     * Caso já exista, ele excluído e um novo é criado em seu lugar;
     */
    private function UpdateSitemapGz() {

        if (file_exists(self::Path . 'sitemap.xml.gz')):
            unlink(self::Path . 'sitemap.xml.gz');
        endif;

        $gzip = gzopen(self::Path . 'sitemap.xml.gz', 'w9');
        $gmap = file_get_contents(self::Path . 'sitemap.xml');
        gzwrite($gzip, $gmap);
        gzclose($gzip);

        $this->SitemapPing();
    }

    /**
     * <b>CreateSitemapEstatic</b>: Método responsável pela criação das páginas estáticas no sitemap.xml.
     * @param array $SitemapEstatic
     */
    private function CreateSitemapEstatic(array $SitemapEstatic) {

        foreach ($SitemapEstatic as $sitemap):

            $this->Url = $this->Xml->createElement('url');
            $this->Url = $this->UrlSet->appendChild($this->Url);

            $this->Loc = $this->Xml->createElement('loc', $sitemap['loc']);
            $this->Loc = $this->Url->appendChild($this->Loc);

            $this->LastMod = $this->Xml->createElement('lastmod', date(DATE_W3C, strtotime($sitemap['lastmod'])));
            $this->LastMod = $this->Url->appendChild($this->LastMod);

            $this->ChangeFreq = $this->Xml->createElement('changefreq', $sitemap['changefreq']);
            $this->ChangeFreq = $this->Url->appendChild($this->ChangeFreq);

            $this->Priority = $this->Xml->createElement('priority', $sitemap['priority']);
            $this->Priority = $this->Url->appendChild($this->Priority);

        endforeach;
    }

    /**
     * <b>CreateSitemapDynamic</b>: Método responsável pela criação das páginas dinâmicas no sitemap.xml.
     * @param array $SitemapDynamic : podem conter os seguintes tipos de conteúdos [post, product]
     */
    private function CreateSitemapDynamic($SitemapDynamic) {

        if (in_array('post', $SitemapDynamic)):
            $this->SitemapDynamicPost();
        endif;

        if (in_array('product', $SitemapDynamic)):
            $this->SitemapDynamicProduct();
        endif;
    }

    /**
     * <b>SitemapDynamicPost</b>: Método responsável pela criação dos posts do sistema no sitemap.xml
     */
    private function SitemapDynamicPost() {

        $read = new Read;
        $read->ExeRead(POSTS, "WHERE post_status = 1 ORDER BY post_date DESC");
        if ($read->getResult()):

            foreach ($read->getResult() as $post):
                extract($post);

                $this->Url = $this->Xml->createElement('url');
                $this->Url = $this->UrlSet->appendChild($this->Url);

                $this->Loc = $this->Xml->createElement('loc', HOME . '/post/' . $post_name);
                $this->Loc = $this->Url->appendChild($this->Loc);

                $this->LastMod = $this->Xml->createElement('lastmod', date(DATE_W3C, strtotime((!empty($post_last_views) ? $post_last_views : $post_date))));
                $this->LastMod = $this->Url->appendChild($this->LastMod);

                $this->ChangeFreq = $this->Xml->createElement('changefreq', 'daily');
                $this->ChangeFreq = $this->Url->appendChild($this->ChangeFreq);

                $this->Priority = $this->Xml->createElement('priority', '0.7');
                $this->Priority = $this->Url->appendChild($this->Priority);

            endforeach;

        endif;
    }

    /**
     * <b>SitemapDynamicProduct</b>: Método responsável pela criação dos produtos do sistema no sitemap.xml
     */
    private function SitemapDynamicProduct() {

        $read = new Read;
        $read->ExeRead(PRODUTOS, "WHERE produto_status = 1 ORDER BY produto_data");
        if ($read->getResult()):

            foreach ($read->getResult() as $product):
                extract($product);

                $this->Url = $this->Xml->createElement('url');
                $this->Url = $this->UrlSet->appendChild($this->Url);

                $this->Loc = $this->Xml->createElement('loc', HOME . '/product/' . $produto_name);
                $this->Loc = $this->Url->appendChild($this->Loc);

                $this->LastMod = $this->Xml->createElement('lastmod', date(DATE_W3C, strtotime((!empty($produto_lastviews) ? $produto_lastviews : $produto_data))));
                $this->LastMod = $this->Url->appendChild($this->LastMod);

                $this->ChangeFreq = $this->Xml->createElement('changefreq', 'daily');
                $this->ChangeFreq = $this->Url->appendChild($this->ChangeFreq);

                $this->Priority = $this->Xml->createElement('priority', '0.7');
                $this->Priority = $this->Url->appendChild($this->Priority);

            endforeach;

        endif;
    }

    /**
     * <b>SitemapPing</b>: Método responsável por realizar o ping do sitemap nas mecanismos de busca ao atualizar o site.
     */
    private function SitemapPing() {

        $SitemapPing = array();
        $SitemapPing['google'] = 'https://www.google.com/webmasters/tools/ping?sitemap=' . HOME . '/sitemap.xml';
        $SitemapPing['ping'] = 'https://www.bing.com/webmaster/ping.aspx?siteMap=' . HOME . '/sitemap.xml';

        foreach ($SitemapPing as $PingUrl):

            $ch = curl_init($PingUrl);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_exec($ch);
//            $debug = curl_getinfo($ch);
            curl_close($ch);
//            print_r($debug);
        endforeach;
    }

}
