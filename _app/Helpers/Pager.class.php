<?php

/**
 * Pager.class [ HELPER ]
 * Realização da gestão e paginação de resultados do sistema!
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Pager {

    /** DEFINE O PAGER */
    private $Page;
    private $Limit;
    private $Offset;

    /** RELIZA A LEITURA */
    private $Tabela;
    private $Termos;
    private $Places;

    /** DEFINE O PAGINATOR */
    private $Rows;
    private $Link;
    private $MaxLinks;
    private $First;
    private $Last;

    /** RENDERIZA O PAGINATOR */
    private $Paginator;

    public function __construct($Link, $First = null, $Last = null, $MaxLinks = null) {
        $this->Link = (string) $Link;
        $this->First = ((string) $First ? $First : 'Primeira');
        $this->Last = ((string) $Last ? $Last : 'Última');
        $this->MaxLinks = ((int) $MaxLinks ? $MaxLinks : 5);
    }

    public function ExePager($Page, $Limit) {
        $this->Page = ((int) $Page ? $Page : 1);
        $this->Limit = (int) $Limit;
        $this->Offset = ($this->Page * $this->Limit) - $this->Limit;
    }

    public function ReturnPage() {
        if ($this->Page > 1):
            $nPage = $this->Page - 1;
            header("Location: {$this->Link}{$nPage}");
        endif;
    }

    public function getPage() {
        return $this->Page;
    }

    public function getLimit() {
        return $this->Limit;
    }

    public function getOffset() {
        return $this->Offset;
    }

    public function ExePaginator($Tabela, $Termos = null, $parseString = null) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        $this->Places = (string) $parseString;
        $this->getSyntax();
    }

    public function ExeFullPaginator($Query, $parseString = null) {
        $this->Query = (string) $Query;
        $this->Places = (string) $parseString;
        $this->getSyntax();
    }

    public function getPaginator() {
        return $this->Paginator;
    }

    // PRIVATE

    /**
     * <b>getSyntax():</b>Realiza a sintaxe da paginação. 
     * Como eles serão exibidos
     */
    private function getSyntax() {
        $read = new Read;

        if (!empty($this->Query)):
            $read->FullRead($this->Query, $this->Places);
        else:
            $read->ExeRead($this->Tabela, $this->Termos, $this->Places);
        endif;

        $this->Rows = $read->getRowCount();

        if ($this->Rows > $this->Limit):
            $Paginas = ceil($this->Rows / $this->Limit);
            $MaxLinks = $this->MaxLinks;

            $this->Paginator = "<ul class=\"paginator\">";
            $this->Paginator .= "<li><a attr-page='1' title=\"{$this->First}\" href=\"{$this->Link}1\">{$this->First}</a></li> ";

            for ($iPag = $this->Page - $MaxLinks; $iPag <= $this->Page - 1; $iPag ++):
                if ($iPag >= 1):
                    $this->Paginator .= "<li><a attr-page='{$iPag}' title=\"Página {$iPag}\" href=\"{$this->Link}{$iPag}\">{$iPag}</a></li> ";
                endif;
            endfor;

            $this->Paginator .= "<li><span class=\"active\">{$this->Page}</span></li>";

            for ($dPag = $this->Page + 1; $dPag <= $this->Page + $MaxLinks; $dPag ++):
                if ($dPag <= $Paginas):
                    $this->Paginator .= "<li><a attr-page='{$dPag}' title=\"Página {$dPag}\" href=\"{$this->Link}{$dPag}\">{$dPag}</a></li> ";
                endif;
            endfor;


            $this->Paginator .= "<li><a attr-page='{$Paginas}' title=\"{$this->Last}\" href=\"{$this->Link}{$Paginas}\">{$this->Last}</a></li> ";
            $this->Paginator .= "</ul>";

        endif;
    }

}
