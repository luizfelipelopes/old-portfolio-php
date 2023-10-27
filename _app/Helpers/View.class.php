<?php

/**
 * View.class [ HELPER MVC ]
 * Responsável por carregar o template, povoar e exibir a view, povoar e incluir arquivos PHP no sistema
 * Arquitetura MVC
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class View {

    private $Data;
    private $Keys;
    private $Values;
    private $Template;

    public function Load($Template) {
        if ($Template == 'produto' || $Template == 'comentario' || $Template == 'resposta'):
            $this->Template = HOME . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . THEME . DIRECTORY_SEPARATOR . '_tpl' . DIRECTORY_SEPARATOR . (string) $Template;
//            var_dump($this->Template);
        else:
            $this->Template = HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . '_tpl' . DIRECTORY_SEPARATOR . (string) $Template;
//            var_dump($this->Template);
        endif;

        $this->Template = $this->getFileContent($this->Template . '.tpl.html');
        return $this->Template;
    }

    public function Show(array $Data, $View) {
        $this->setKeys($Data);
        $this->setValues();
        $this->ShowView($View);
    }

    public function Request($File, array $Data) {
        extract($Data);
        require ("{$File}.inc.php");
    }

    //PRIVATES


    private function getFileContent($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $contents = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            echo "\n ";
            $contents = '';
        } else {
            curl_close($ch);
        } if (!is_string($contents) || !strlen($contents)) {
            echo "Erro ao carregar Views(Https). Failed to get contents.";
            $contents = '';
        } return $contents;
    }

    private function setKeys($Data) {
        $this->Data = $Data;
        $this->Data['HOME'] = HOME;
        $this->Data['INCLUDE_PATH'] = INCLUDE_PATH;
        $this->Keys = explode("&", '#' . implode("#&#", array_keys($this->Data)) . '#');
        $this->Keys[] = '#HOME#';
        $this->Keys[] = '#INCLUDE_PATH#';
    }

    private function setValues() {
        $this->Values = array_values($this->Data);
    }

    private function ShowView($View) {
        $this->Template = $View;
        echo str_replace($this->Keys, $this->Values, $this->Template);
    }

    public function returnView(array $Data = null, $View) {
        if (!empty($Data)):
            $this->setKeys($Data);
            $this->setValues();
        endif;

        $this->Template = $View;
        return str_replace($this->Keys, $this->Values, $this->Template);
    }

}
