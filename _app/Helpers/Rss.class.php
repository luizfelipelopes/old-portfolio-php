<?php

/**
 * Rss.class [ HELPER ]
 * Classe Responsável por Criar, Deletar, Atualizar o arquivo rss.xml
 * @copyright (c) 2018, Luiz Felipe C. Lopes 
 */
class Rss {

    private $Xml;
    private $Rss;
    private $Channel;
    private $Title;
    private $Link;
    private $Description;
    private $Language;
    private $Item;
    private $TitleNo;
    private $LinkNo;
    private $PubDate;
    private $DescriptionNo;
    private $Enclosure;
    private $Id;
    private $ImageLink;
    private $Condition;
    private $Price;
    private $Availability;
    private $Brand;
    private $Gtin;
    private $Mpn;
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
     * <b>ExeRss</b>: Gera RSS do Sistema. Caso exista, apenas é atualizado.
     * @param array $RSSDynamic : Recebe os itens do site dinamicamente
     */
    public function ExeRss(array $RSSDynamic = null) {

        $this->Xml = new DOMDocument('1.0', 'UTF-8');
        $this->Rss = $this->Xml->createElementNS('http://www.w3.org/2005/Atom', 'rss');
        $this->Rss->setAttribute('version', '2.0');
        $this->Rss = $this->Xml->appendChild($this->Rss);

        $this->Channel = $this->Xml->createElement('channel');
        $this->Channel = $this->Rss->appendChild($this->Channel);

        $this->Title = $this->Xml->createElement('title', SITENAME);
        $this->Title = $this->Channel->appendChild($this->Title);

        $this->Link = $this->Xml->createElement('link', HOME);
        $this->Link = $this->Channel->appendChild($this->Link);

        $this->Description = $this->Xml->createElement('description', SITEDESC);
        $this->Description = $this->Channel->appendChild($this->Description);

        $this->Language = $this->Xml->createElement('language', 'pt-br');
        $this->Language = $this->Channel->appendChild($this->Language);

        $this->CreateRSSDynamic($RSSDynamic);

        $this->Xml->formatOutput = true;
        $StringValue = $this->Xml->saveXML();
        $this->Xml->save(self::Path . 'rss.xml');
        $this->Result = '<pre>' . $StringValue . '</pre>';
//        print_r($StringValue);
//        die;
//        endif;
    }

    /**
     * ********************************************************
     * ***************** PRIVATES METHODS **********************
     * ********************************************************
     */

    /**
     * <b>CreateRSSDynamic</b>: Método responsável pela criação das páginas dinâmicas no rss.xml.
     * @param array $RSSDynamic : podem conter os seguintes tipos de conteúdos [post, product]
     */
    private function CreateRSSDynamic(array $RSSDynamic) {

        if (in_array('post', $RSSDynamic)):
            $this->RSSDynamicPost();
        endif;

        if (in_array('product', $RSSDynamic)):
            $this->RSSDynamicProduct();
        endif;
    }

    /**
     * <b>RSSDynamicPost</b>: Método responsável pela criação dos posts do sistema no rss.xml
     */
    private function RSSDynamicPost() {

        $read = new Read;
        $read->ExeRead(POSTS, "WHERE post_status = 1 ORDER BY post_date DESC");
        if ($read->getResult()):

            foreach ($read->getResult() as $post):
                extract($post);

                $this->Item = $this->Xml->createElement('item');
                $this->Item = $this->Channel->appendChild($this->Item);

                $this->TitleNo = $this->Xml->createElement('title', $post_title);
                $this->TitleNo = $this->Item->appendChild($this->TitleNo);

                $this->LinkNo = $this->Xml->createElement('link', HOME . '/post/' . $post_name);
                $this->LinkNo = $this->Item->appendChild($this->LinkNo);

                $this->PubDate = $this->Xml->createElement('pubdate', date(DATE_W3C, strtotime((!empty($post_last_views) ? $post_last_views : $post_date))));
                $this->PubDate = $this->Item->appendChild($this->PubDate);

                $this->DescriptionNo = $this->Xml->createElement('description', $post_subtitle);
                $this->DescriptionNo = $this->Item->appendChild($this->DescriptionNo);

            endforeach;

        endif;
    }

    /**
     * <b>RSSDynamicProduct</b>: Método responsável pela criação dos produtos do sistema no rss.xml
     */
    private function RSSDynamicProduct() {

        $read = new Read;
        $read->ExeRead(PRODUTOS, "ORDER BY produto_data");
        if ($read->getResult()):

            foreach ($read->getResult() as $product):
                extract($product);

                $this->Item = $this->Xml->createElement('item');
                $this->Item = $this->Channel->appendChild($this->Item);

                $this->TitleNo = $this->Xml->createElement('title', $produto_title);
                $this->TitleNo = $this->Item->appendChild($this->TitleNo);

                $this->LinkNo = $this->Xml->createElement('link', HOME . '/produto/' . $produto_name);
                $this->LinkNo = $this->Item->appendChild($this->LinkNo);

                $this->PubDate = $this->Xml->createElement('pubdate', date(DATE_W3C, strtotime((!empty($produto_lastviews) ? $produto_lastviews : $produto_data))));
                $this->PubDate = $this->Item->appendChild($this->PubDate);

                $this->DescriptionNo = $this->Xml->createElement('description', str_replace('&nbsp;', '', $produto_descricao));
                $this->DescriptionNo = $this->Item->appendChild($this->DescriptionNo);

                $this->Enclosure = $this->Xml->createElement('enclosure', HOME . DIRECTORY_SEPARATOR . 'uploads' . $produto_image);
                $this->Enclosure = $this->Item->appendChild($this->Enclosure);

                $this->Id = $this->Xml->createElement('id', $produto_id);
                $this->Id = $this->Item->appendChild($this->Id);

                $this->ImageLink = $this->Xml->createElement('imagelink', HOME . DIRECTORY_SEPARATOR . 'uploads' . $produto_image);
                $this->ImageLink = $this->Item->appendChild($this->ImageLink);

                $this->Condition = $this->Xml->createElement('condition', 'new');
                $this->Condition = $this->Item->appendChild($this->Condition);

                $this->Price = $this->Xml->createElement('price', $produto_valor);
                $this->Price = $this->Item->appendChild($this->Price);

                $this->Availability = $this->Xml->createElement('availability', ($produto_disponivel == '1' ? 'in stock' : 'out of stock'));
                $this->Availability = $this->Item->appendChild($this->Availability);

                $this->Brand = $this->Xml->createElement('brand', (!empty($produto_brand) ? $produto_brand : NOME_EMPRESA));
                $this->Brand = $this->Item->appendChild($this->Brand);

                $this->Gtin = $this->Xml->createElement('gtin', '0');
                $this->Gtin = $this->Item->appendChild($this->Gtin);

                $this->Mpn = $this->Xml->createElement('mpn', 'mpn');
                $this->Mpn = $this->Item->appendChild($this->Mpn);

            endforeach;

        endif;
    }

}
