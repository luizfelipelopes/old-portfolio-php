<?php

/**
 * Delete.class [ TIPO ]
 * Classe responsável por excluões genéricas no banco de dados!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Delete extends Conn {

    private $Tabela;
    private $Termos;
    private $Places;
    private $Result;

    /**
     * Query preparada da PDO 
     * @var PDOStatement */
    private $Delete;

    /** @var PDO */
    private $Conn;

    public function ExeDelete($Tabela, $Termos, $ParseString) {


        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Places);
        $this->getSyntax();
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
        return $this->Delete->rowCount();
    }

    /**
     * <b>setPlaces():</b> INSERÇÃO DE NOVOS VALORES PARA VARIÁVEIS DA CONSULTA
     * (STORED PROCEDURES)
     * @param STRING $ParseString = VALORES DA VARIÁVEIS DA CONSULTA
     */
    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
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
        $this->Delete = $this->Conn->prepare($this->Delete);
    }

    /**
     * <b>getSyntax():</b> MANIPULA A SINTAXE DA QUERY A SER PASSADA
     */
    private function getSyntax() {
        $this->Delete = "DELETE FROM {$this->Tabela} {$this->Termos}";
    }

    /**
     * <b>Execute():</b> EXECUTA TODO O PROCEDIMENTO EM PDO
     * REALIZA A EXECUÇÃO
     * EXECUTA A CONSULTA (Passa os valores do Array de DADOS e PLACES, 
     * para mergir os dois como um Array e executar os BindValues)
     * O $this-> Result RECEBE TRUE 
     * CASO CONTRÁRIO, $this->Result RECEBE NULL, E UMA MENSAGEM DE ERRO É EXIBIDA
     */
    private function Execute() {
        $this->Connect();
        
        try {
            $this->Delete->execute($this->Places);
            $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao Deletar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
