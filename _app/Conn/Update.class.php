<?php

/**
 * Update.class [ TIPO ]
 * Classe responsável por atualizações genéricas no banco de dados!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Update extends Conn {

    private $Tabela;
    private $Dados;
    private $Termos;
    private $Places;
    private $Result;

    /**
     * Query preparada da PDO 
     * @var PDOStatement */
    private $Update;

    /** @var PDO */
    private $Conn;

    
    public function ExeUpdate($Tabela, array $Dados, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
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
        return $this->Update->rowCount();
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
        $this->Update = $this->Conn->prepare($this->Update);
    }

    /**
     * <b>getSyntax():</b> MANIPULA A SINTAXE DA QUERY A SER PASSADA
     */
    private function getSyntax() {
        foreach ($this->Dados as $key => $value) :
            $Places[] = $key. ' = :' . $key;
        endforeach;
        
        $Places = implode(', ', $Places);
        $this->Update = "UPDATE {$this->Tabela} SET {$Places} {$this->Termos}";
        
        //var_dump($Places);
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
            $this->Update->execute(array_merge($this->Dados, $this->Places));
            $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
        
    }

}
