<?php

/**
 * Read.class [ TIPO ]
 * Classe responsável por leituras genéricas no banco de dados!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Read extends Conn {

    private $Select;
    private $Places;
    private $Result;

    /**
     * Query preparada da PDO 
     * @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    
    public function ExeRead($Tabela, $Termos = null, $ParseString = null) {
        if(!empty($ParseString)):
        parse_str($ParseString, $this->Places);
        endif;
        
        $this->Select = "SELECT * FROM {$Tabela} {$Termos}";
        $this->Execute();
        
    }

    /**
     * <b>getResult:</b> Retorna false ou o todo os registros lidos da tabela
     * @return $this->Result
     */
    public function getResult() {
        return $this->Result;
    }
    
    /**
     * <b>getResult:</b> Retorna o número de registros na tabela
     * @return rowCount()
     */
    public function getRowCount() {
        return $this->Read->rowCount();
    }
    
    /**
     * <b>FullRead:</b> OCORRE A CRIAÇÃO LIVRE DE UMA QUERY, ONDE PODERÁ SER CRIADO UMA CONSULTA,
     * COM MAIS DE DUAS TABELAS (JOINS, ETC)
     * @param STRING $Query = CONSULTA SQL A SER PASSADA
     * @param STRING $ParseString = VALORES DA VARIÁVEIS DA CONSULTA
     */
    public function FullRead($Query, $ParseString = null) {
        
        $this->Select = (string) $Query;
        
        if(!empty($ParseString)):
        parse_str($ParseString, $this->Places);
        endif;
        
        $this->Execute();
    }
    
    /**
     * <b>setPlaces():</b> INSERÇÃO DE NOVOS VALORES PARA VARIÁVEIS DA CONSULTA
     * (STORED PROCEDURES)
     * @param STRING $ParseString = VALORES DA VARIÁVEIS DA CONSULTA
     */
    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->Execute();
    }
    

    /**
     * ********************************************c    
     * ************ PRIVATE METHODS ***************
     * ********************************************
     * VÂO DAR SUPORTE NA EXECUÇÂO
     */

    /**
     * PEGA A CONEXÃO E PREPARA O STATMENT e SETA O MODO DE CAPTURA DOS REGISTROS
     */
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($this->Select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
    }

    /**
     * <b>getSyntax():</b> MANIPULA A SINTAXE DA QUERY A SER PASSADA E 
     * SETA OS BINDVALUES
     */
    private function getSyntax() {
        
        // SE EXISTIR PLACES
        if($this->Places):
            //VERIFICA EM TDS OS PLACES SE ELES POSSUM 'LIMIT' OU 'OFFSET'
            // CASO TENHAM OS VALORES DE LIMIT E/OU OFFSET SÃO OBRIGATORIAMENTE PASSADOS COMO INTEIRO
            // O BINDVALUE TBM É EXECUTADO NESSE LAÇO, SE O VALOR É UM LIMIT OU OFFSET (POIS PRECISAM SER 
            // UTILIZADOS DE FORMAS DIFERENTES)
            foreach ($this->Places as $Vinculo => $Valor) {
                if($Vinculo == 'limit' || $Vinculo == 'offset'):
                    $Valor = (int) $Valor;
                endif;
                $this->Read->bindValue(":{$Vinculo}", $Valor, (is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        endif;
    }

    /**
     * <b>Execute():</b> EXECUTA TODO O PROCEDIMENTO EM PDO
     * REALIZA A EXECUÇÃO
     * MANIPULA A SINTAXE
     * EXECUTA A CONSULTA
     * SE A CONSULTA FOI REALIZADA COM SUCESSO, O RESULTADO DA CONSULTA É PASSADO PARA 
     * O $this-> Result 
     * CASO CONTRÁRIO, $this->Result RECEBE NULL, E UMA MENSAGEM DE ERRO É EXIBIDA
     */
    private function Execute() {
        $this->Connect();
        try {
            $this->getSyntax();
            $this->Read->execute();
            $this->Result = $this->Read->fetchAll();
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
