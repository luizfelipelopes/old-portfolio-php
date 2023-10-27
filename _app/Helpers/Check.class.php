<?php

/**
 * Check.class [ TIPO ]
 * Classe responsável por manipulr e validaar dados do sistema
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Check {

    private static $Data;
    private static $Format;

    /**
     * <b>Email():</b> Trata da validação de email  
     * @param STRING $Email = Email é passado por parâmetro
     * @return boolean = Retorna se um email é válido (TRUE) ou não(FALSE)
     */
    public static function Email($Email) {
        self::$Data = (string) $Email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$Format, self::$Data)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * <b>Name():</b> Trata qualquer nome para retirer acentos, espaços e caracteres especiais
     * @param STRING $Name = Passa um nome de arquivo como parâmetro
     * @return STRING = Retorna o nome tratado para ser utilizado por qualquer sistema
     */
    public static function Name($Name) {
        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';


        self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data)); // Retira scripts de código e espaços
        self::$Data = str_replace([':', ' ?', '?', ' !', '!', '.', '"', "'"], '', self::$Data); // Substitui acentos por traço
        self::$Data = str_replace(' ', '-', self::$Data); // Substitui espao em branco por traço
        self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data); // Substitui mais de um espaço em branco por traço

        return strtolower(utf8_encode(self::$Data)); // REtorn tudo em minúscula no formato UTF-8
    }

    /**
     * Retira os arrays com chaves numéricas vindas do plugin jQuery form
     * @param type $Post
     */
    public static function limparSubmit($Post) {

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        return $meuArray;
    }

    /**
     * <b>Data():</b> Trata data e horário passada por parâmetro
     * @param STRING $Data = Uma data e hora tratada é retornada. 
     * Se nenhuma data foi passada, a hora do sistema é inserida
     */
    public static function Data($Data) {
        self::$Format = explode(' ', $Data); // Separa data da hora
        self::$Data = explode('/', self::$Format[0]); // Separa a data em dia, mes e ano
        // Senão tiver hora
        if (empty(self::$Format[1])):
            self::$Format[1] = date('H:i:s'); // Hora d sistema é inserida
        endif;

        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0] . ' ' . self::$Format[1];
        return self::$Data; // A data formata é impressa
    }

    /**
     * <b>Words():</b>Mostra conteudo de mensagem com limitação de palavras
     * Caso a string tenha mais palavras que o limite, se exitir uma frase do $Pointer(ex: 'Continuar lendo..') é exibida no final
     * Ex: Manipular texto prévio de posts
     * 
     * @param STRING $String = Texto a ser trabalhado
     * @param INT $Limite = Número de plavras que serão permitidas na String
     * @param type $Pointer = Frase com exibida no final (Ex: Continaur Lendo)
     * @return STRING = Retorna o texto que tratado 
     */
    public static function Words($String, $Limite, $Pointer = null) {

        self::$Data = strip_tags(trim($String));
        self::$Format = (int) $Limite;

        $ArrWords = explode(' ', self::$Data);
        $NumWords = count($ArrWords);
        //array_slice = substr()
        $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));


        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer);
        $Result = (self::$Format < $NumWords ? $NewWords . $Pointer : self::$Data);
        return $Result;

        //     var_dump($ArrWords, $NumWords, $NewWords);
    }

    public static function countWords($string) {
        self::$Data = strip_tags(trim($string));

        $ArrWords = explode(' ', self::$Data);
        $NumWords = count($ArrWords);

        return $NumWords;
    }

    /**
     * <b>CatByName():</b> Seleciona uma categoria por nome
     * 
     * @param STRING $CategoryName = Nome da Categoria a ser procurado na BD
     * @return type = Retorna o resultado com o nome da categoria pesquisada,
     * caso não haja nenhuma categoria, uma mensagem avisando que não foi encontrado é exibida
     */
    public static function CatByName($CategoryName) {
        $read = new Read;
        $read->ExeRead('ws_categories', "WHERE category_name = :name", "name={$CategoryName}");
        if ($read->getRowCount()):
            return $read->getResult()[0]['category_id'];
        else:
            echo "A categoria {$CategoryName} não foi encontrada!";
            die;
        endif;
    }

    /**
     * <b>UserOnline():</b> Deleta um usuário e indica quantos estaõ online após a exclusão
     * @return INT = Retorna o número de usuários online após a exclusão 
     */
    public static function UserOnline() {
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new Delete();
        $deleteUserOnline->ExeDelete('ws_siteviews_online', "WHERE online_endview < :now", "now={$now}");

        $readUserOnline = new Read();
        $readUserOnline->ExeRead('ws_siteviews_online');
        return $readUserOnline->getRowCount();
    }

    /**
     * <b>Image():</b> Trata uma imagem a ser exibida
     * @param STRING $ImageUrl = Endereço da imagem a ser tratada
     * @param STRING $ImageDesc = Descrição da Imagem
     * @param INT $imageW = Seta um largura para a imgem 
     * @param INT $ImageH = Seta uma altura para a Imagem
     * @return boolean = Retorna a imagem em uma tag html IMG, caso o arquivo não exista, é retornado false
     */
    public static function Image($ImageUrl, $ImageDesc, $imageW = null, $ImageH = null) {

        self::$Data = $ImageUrl;


        if (file_exists(self::$Data) && !is_dir(self::$Data)):
            $patch = HOME;
            $imagem = self::$Data;
            return "<img src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$imageW}&h={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\" />";
        else:
            return false;
        endif;
    }

    /**
     * CORRIGE VALORES MONETÁRIOS
     */
    public static function toFloat($num) {

        $pontoPos = strrpos($num, '.');
        $virgulaPos = strrpos($num, ',');
        $sep = (($pontoPos > $virgulaPos) && $pontoPos) ? $pontoPos :
                ((($virgulaPos > $pontoPos) && $virgulaPos) ? $virgulaPos : false);

        if (!$sep):
            return floatval(preg_replace("/[^0-9]/", "", $num));
        endif;

        return floatval(preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
                preg_replace("/[^0-9]/", "", substr($num, $sep + 1, strlen($num)))
        );
    }

    /**
     * <b>verificarData:</b> Verifia se a data é maior que o dia de hoje. Caso seja retorna false.
     * @param type $data
     * @return boolean
     */
    public static function verificarData($data) {

        if ($data > date('Y-m-d')):
            return false;
        endif;

        return true;
    }

    /**
     * <b>verificarHora:</b> Verifica se a hora é uma hora válida. Caso seja, retorna true.
     * @param type $hora
     * @return boolean
     */
    public static function verificarHora($hora) {

        if (substr($hora, 0, 1) > '2'):
            return false;
        elseif (substr($hora, 3, 1) > '5'):
            return false;
        endif;

        return true;
    }

    /**
     * <b>verificarTelefone:</b> Verifica se o telefone possui mais de x caracteres. Caso seja, retorna true.
     * @param type $tel
     * @return boolean
     */
    public static function verificarTelefone($tel, $dig) {

        if (strlen($tel) > $dig):
            return false;
        endif;

        return true;
    }

    /**
     * <b>validarCnpj:</b> Valida um CNPJ dado.
     * Números para verificar o 1º dígito verificador: 5,4,3,2,9,8,7,6,5,4,3,2
     * Números para verificar o 2º dígito verificador: 6,5,4,3,2,9,8,7,6,5,4,3,2
     * <b>Lógica</b>: 
     * multiplica digitos com os números acima e 
     * soma o resultado de cada multiplicação
     * recupera o resto da soma por 11
     * Se for menor que zero, o digito verificador é zero, senão subtrai o resto por 11 
     * @param string $cnpj
     * @return boolean
     */
    public static function validarCnpj($cnpj) {

        // RETIRA CARACTERES E DEIXA APENAS NUMEROS NO CNPJ
        $j = 0;
        for ($i = 0; $i < (strlen($cnpj)); $i++):
            if (is_numeric($cnpj[$i])):

                $num[$j] = $cnpj[$i];
                $j++;

            endif;
        endfor;

//        SE O NÚMERO DE DIGITOS FOR MENOR QUE 14 O CNPJ É INVÁLIDO
        if (count($num) != 14):
            return false;
        endif;

//        SE TODOS OS 12 PRIMEIROS DIGITOS FOREM ZERO O CNPJ É INVÁLIDO
        if ($num[0] == 0 && $num[1] == 0 && $num[2] == 0 && $num[3] == 0 && $num[4] == 0 && $num[5] == 0 && $num[6] == 0 && $num[7] == 0 && $num[8] == 0 && $num[9] == 0 && $num[10] == 0 && $num[11] == 0):

            return false;

        endif;

        $multiplica = array();
//        VERIFICAR 1º DIGITO VERIFICADOR
        $j = 5;
        for ($i = 0; $i < 4; $i++):

            $multiplica[$i] = $num[$i] * $j;
            $j--;

        endfor;

        $j = 9;
        for ($i = 4; $i < 12; $i++):

            $multiplica[$i] = $num[$i] * $j;
            $j--;

        endfor;

        $soma = 0;
        for ($i = 0; $i < 12; $i++):

            $soma += $multiplica[$i];

        endfor;

        $ver1 = 0;
        if (($soma % 11) < 2):
            $ver1 = 0;
        else:
            $ver1 = 11 - ($soma % 11);
        endif;


        if ($num[12] != $ver1):
            return false;
        endif;


        //VERIFICAR 2º DIGITO VERIFICADOR
//        $num = null;
        $multiplica = array();
        $j = 6;
        for ($i = 0; $i < 5; $i++):

            $multiplica[$i] = $num[$i] * $j;
            $j--;

        endfor;

        $j = 9;
        for ($i = 5; $i < 13; $i++):

            $multiplica[$i] = $num[$i] * $j;
            $j--;

        endfor;

        $soma = 0;
        for ($i = 0; $i < 13; $i++):

            $soma += $multiplica[$i];

        endfor;

        $ver2 = 0;
        if (($soma % 11) < 2):
            $ver2 = 0;
        else:
            $ver2 = 11 - ($soma % 11);
        endif;


        if ($num[13] != $ver2):

            return false;

        endif;

        return true;
    }

    /**
     * <b>validarCpf:</b> valida o CPF dado
     * Números para verificar o 1º dígito verificador: 10 a 2
     * Números para verificar o 2º dígito verificador: 11 a 2
     * <b>Lógica</b>: 
     * multiplica digitos com os números acima e 
     * soma o resultado de cada multiplicação
     * recupera o resto da (soma * 1º digito dos numeros p/ verificar) por 11
     * Se digito verificador for diferente do resto será CPF inválido, caso contrário é válido
     * @param string $cpf
     * @return boolean
     */
    public static function validarCpf($cpf) {

        // RETIRA CARACTERES E DEIXA APENAS NUMEROS NO CPF
        $j = 0;
        for ($i = 0; $i < (strlen($cpf)); $i++):
            if (is_numeric($cpf[$i])):

                $num[$j] = $cpf[$i];
                $j++;

            endif;
        endfor;

//        SE O NÚMERO DE DIGITOS FOR MENOR QUE 11 O CPF É INVÁLIDO
        if (count($num) != 11):
            return false;
        endif;

//        SE TODOS OS 11 DIGITOS FOREM ZERO O CNPJ É INVÁLIDO
        if ($num[0] == $num[1] && $num[0] == $num[2] && $num[0] == $num[3] && $num[0] == $num[4] && $num[0] == $num[5] && $num[0] == $num[6] && $num[0] == $num[7] && $num[0] == $num[8] && $num[0] == $num[9] && $num[0] == $num[10]):

            return false;

        endif;

        $multiplica = array();

//        VALIDANDO 1º DIGITO
        $j = 10;
        for ($i = 0; $i < 9; $i++):
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        endfor;

        $soma = 0;
        for ($i = 0; $i < 9; $i++):
            $soma += $multiplica[$i];
        endfor;

        $resto = ($soma * 10) % 11;

        if ($num[9] != $resto):
            return false;
        endif;


//        VALIDANDO 2º DIGITO
        $j = 11;
        for ($i = 0; $i < 10; $i++):
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        endfor;

        $soma = 0;
        for ($i = 0; $i < 10; $i++):
            $soma += $multiplica[$i];
        endfor;

        $resto = ($soma * 10) % 11;

        if ($num[10] != $resto):
            return false;
        endif;


        return true;
    }

}
