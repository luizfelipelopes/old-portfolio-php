<?php

/**
 * BuscaRapida.class [ HELPER ]
 * Classe responsável por executar buscas frequentes de uma tabela do BD associado a outra
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class BuscaRapida {

    private $Error;
    private $Result;
    private $read;

    public function __construct() {
        $this->read = new Read();
    }

    public static function buscarCidade($Id) {
        $read = new Read();
        $read->ExeRead("app_cidades", "WHERE cidade_id = :cidadeid", "cidadeid={$Id}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult();
        endif;
    }

    public static function buscarCategoria($Id) {
        $read = new Read();
        $read->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$Id}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult()[0];
        endif;
    }

    public static function buscarCategoriaName($Name) {
        $read = new Read();
        $read->ExeRead(CATEGORIAS, "WHERE category_name = :name", "name={$Name}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult()[0];
        endif;
    }

    public static function buscarUsuario($Id) {
        $read = new Read();
        $read->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$Id}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult()[0];
        endif;
    }

    public static function buscarLead($Email) {
        $read = new Read();
        $read->ExeRead(LEADS, "WHERE lead_email = :email", "email={$Email}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult()[0];
        endif;
    }

    public static function buscarPost($Id) {
        $read = new Read();
        $read->ExeRead(POSTS, "WHERE post_id = :id", "id={$Id}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult()[0];
        endif;
    }

    public static function buscarSetting($Name) {
        $read = new Read();
        $read->ExeRead(SETTINGS, "WHERE setting_name = :name", "name={$Name}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult()[0]['setting_value'];
        endif;
    }

    public static function buscarComment($Id) {
        $read = new Read();
        $read->ExeRead(COMENTARIOS, "WHERE comentario_id = :id", "id={$Id}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult()[0];
        endif;
    }

    public static function searchViews($day) {
        
        $readViewFix = new Read;
        $readViewFix->FullRead("SELECT siteviews_pages FROM " . SITEVIEWS . " WHERE siteviews_date = :date", "date={$day}");
        
        if(!$readViewFix->getResult()):
            return false;
        else:
            return $readViewFix->getResult()[0];
        endif;
        
    }

    public static function buscarIngresso($Id) {
        $read = new Read();
        $read->ExeRead(INGRESSOS, "WHERE ingresso_id = :id", "id={$Id}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult()[0];
        endif;
    }

    public static function buscarVenda($Registro) {
        $read = new Read();
        $read->ExeRead(VENDAS, "WHERE venda_registro = :registro", "registro={$Registro}");
        if (!$read->getResult()):
            return false;
        else:
            return $read->getResult()[0];
        endif;
    }

}
