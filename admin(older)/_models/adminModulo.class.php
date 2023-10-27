<?php

/**
 * adminModulo.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Módulos
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminModulo {

    private $Modulo;
    private $Data;
    private $Error;
    private $Result;

    const Entity = MODULOS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:

            $this->tratarDados();
            $this->verificarNome();
            $this->Create();
        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Curso = (int) $Id;
        $this->Data = $Dados;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
//            $this->capturarCatParent();
            $this->tratarDados();
            $this->verificarNome();
//            $this->verificarImagemUpload();

            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Curso = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        $this->Data['modulo_name'] = Check::Name($this->Data['modulo_title']);
        $this->Data['modulo_liberacao'] = date('Y-m-d H:i:s', strtotime($this->Data['modulo_liberacao']));
        $this->Data['modulo_date'] = date('Y-m-d H:i:s');
    }

    private function verificarNome() {

        $where = (!empty($this->Curso) ? "modulo_id != {$this->Curso} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} modulo_title = :title", "title={$this->Data['modulo_title']}");
        if ($read->getResult()):
            $this->Data['modulo_name'] = $this->Data['modulo_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Módulo', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Módulo cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE modulo_id = :id", "id={$this->Curso}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Módulo", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Módulo Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE modulo_id = :id", "id={$this->Curso}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Módulo", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Módulo Excluído com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

}
