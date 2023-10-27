<?php

/**
 * Create.class [ TIPO ]
 * Classe responsável por cadastros genéricos no banco de dados!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Create extends Conn {

    private $Tabela;
    private $Dados;
    private $Result;

    /**
     * Query preparada da PDO 
     * @var PDOStatement */
    private $Create;

    /** @var PDO */
    private $Conn;

    /**
     * <b>ExeCreate:</b> Executa um cadastro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array atribuititvo com o nome da coluna e valor!
     * 
     * @param STRING $Tabela = INforme o nome da tabela do banco!
     * @param ARRAY $Dados = Informe um array atributivo. Ex:(Nome Da Coluna => Valor);
     */
    public function ExeCreate($Tabela, array $Dados) {
        // COM (STRING) SÓ VAI ACEITAR STRING
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->getSyntax();
        $this->Execute();
    }

    /**
     * <b>getResult:</b> Retorna false ou o último id inserido na tabela, caso a inserção 
     * foi executada com suesso!
     * 
     * @return type
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * ********************************************c    
     * ************ PRIVATE METHODS ***************
     * ********************************************
     * VÂO DAR SUPORTE NA EXECUÇÂO
     */

    /**
     * PEGA A CONEXÃO E PREPARA O STATMENT
     */
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }

    private function getSyntax() {
        //array_keys = PASSA O NOME DA COLUNA A QUAL CADA VALOR ESTÀ ASSOCIADO
        $Fields = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fields}) VALUES ({$Places})";
    }

    private function Execute() {
        $this->Connect();
        try {
            //SE FIELDS E PLACES TIVEREM O MESMO NOME, OS BINDS SÂO EXECUTADOS AUTOMATICAMENTE
            $this->Create->execute($this->Dados);
            //SE DER TD CERTO RECEBE O ULTIMO ID INSERIDO
            $this->Result = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            // SE DEU ERRADO, RESULT RECEBE NULL
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
