<?php

/**
 * AdminEspecificacoes [ MODEL ADMIN ]
 * Modela e trata os dados das especificacões dos produtos
 * @copyright (c) year, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class AdminEspecificacoes {

    private $Especificacao;
    private $Data;
    private $Error;
    private $Result;

    const Entity = ESPECIFICACOES;

    public function ExeCreate($IdProduto) {

        $this->Data['produto_id'] = (int) $IdProduto;

        if (in_array("", $this->Data)):
            $this->Error = ["Preenche todos os campos!", WS_ALERT];
            $this->Result = false;

        else:

            $this->tratarDados();
            $this->Create();

        endif;
    }

    public function ExeUpdate($IdProduto) {

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE produto_id = :produtoid", "produtoid={$IdProduto}");
        if ($read->getResult()):
            $this->Especificacao = (int) $read->getResult()[0]['especificacao_id'];
        endif;

        if (in_array("", $this->Data)):
            $this->Error = ["Preenche todos os campos!", WS_ALERT];
            $this->Result = false;

        else:
            $this->tratarDados();
            $this->Update($IdProduto);

        endif;
    }

    public function ExeDelete($IdProduto) {

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE produto_id = :produtoid", "produtoid={$IdProduto}");
        if ($read->getResult()):
            $this->Especificacao = (int) $read->getResult()[0]['especificacao_id'];
        endif;


        $this->Delete($IdProduto);
    }

    public function setData($Data) {
        $this->Data = $Data;
//        var_dump($this->Data);
    }

    public function getData() {
        return $this->Data;
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

    private function tratarDados() {

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['especificacao_modelo'] = strtoupper($this->Data['especificacao_modelo']);
        $this->Data['especificacao_fab_inicial'] = strtoupper($this->Data['especificacao_fab_inicial']);
        $this->Data['especificacao_fab_final'] = strtoupper($this->Data['especificacao_fab_final']);
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar! Por favor tente novamente", WS_ALERT];
            $this->Result = false;
        else:
            $this->Result = $create->getResult();
        endif;
    }

    private function Update($IdProduto) {

        $update = new Update();
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE produto_id = :produtoid AND especificacao_id = :especificacaoid", "produtoid={$IdProduto}&especificacaoid={$this->Especificacao}");
        if (!$update->getResult()):
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    private function Delete($IdProduto) {

        $delete = new Delete();
        $delete->ExeDelete(self::Entity, "WHERE produto_id = :produtoid AND especificacao_id = :especificacaoid", "produtoid={$IdProduto}&especificacaoid={$this->Especificacao}");
        if (!$delete->getResult()):
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

}
