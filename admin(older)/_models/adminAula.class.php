<?php

/**
 * adminAula.class [ ADMIN ]
 * Classe Responsável pela Gestão das Aulas
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminAula {

    private $Aula;
    private $Data;
    private $Error;
    private $Result;

    const Entity = AULAS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if ($this->Data['aula_title'] == null || $this->Data['aula_descricao'] == null):
            $this->Error = ["Por favor, os campos Título e Descrição devem ser preenchidos!", WS_ALERT];
            $this->Result = false;

        else:

            $this->tratarDados();
            $this->verificarNome();
//            $this->verificarImagem();
            $this->Create();
        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Aula = (int) $Id;
        $this->Data = $Dados;

        if ($this->Data['aula_title'] == null || $this->Data['aula_descricao'] == null):
            $this->Error = ["Por favor, os campos Título e Material devem ser preenchidos!", WS_ALERT];
            $this->Result = false;

        else:
//            $this->capturarCatParent();
            $this->tratarDados();
            $this->verificarNome();
//            $this->verificarImagemUpload();

            if ($this->Result):

            endif;

            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Aula = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

//        $File = $this->Data['aula_material'];
//        unset($this->Data['aula_material']);
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        $this->Data['aula_name'] = Check::Name($this->Data['aula_title']);
//        $this->Data['aula_liberacao'] = date('Y-m-d H:i:s', strtotime($this->Data['aula_liberacao']));
        $this->Data['aula_date'] = date('Y-m-d H:i:s');
//        $this->Data['aula_material'] = $File;
    }

    private function verificarNome() {

        $where = (!empty($this->Curso) ? "aula_id != {$this->Curso} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} aula_title = :title", "title={$this->Data['aula_title']}");
        if ($read->getResult()):
            $this->Data['aula_name'] = $this->Data['aula_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function verificarImagem() {

        if ($this->Data['aula_material'] && is_array($this->Data['aula_material'])):

            $upload = new Upload('../../uploads');
//            $upload->Image($this->Data['aula_material'], $this->Data['aula_name'], null, '/aulas/material');
            $upload->File($this->Data['aula_material'], null, '/aulas');

            if (!$upload->getResult()):
                $this->Data['aula_material'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['aula_material'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data['aula_material'] && is_array($this->Data['aula_material'])) {

            $readMaterial = new Read;
            $readMaterial->ExeRead(self::Entity, "WHERE aula_id = :id", "id={$this->Aula}");
            if ($readMaterial->getResult()):

                $material = '../../uploads' . $readMaterial->getResult()[0]['aula_material'];

                if (file_exists($material) && !is_dir($material)):
                    unlink($material);
                endif;

                $upload = new Upload("../../uploads");
                $upload->File($this->Data['aula_material'], null, '/aulas');
                if (!$upload->getResult()):
                    unset($this->Data['aula_material']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['aula_material'] = $upload->getResult();
                    $this->Result = true;
                endif;



            endif;
        }
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Aula', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Aula cadastrada com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE aula_id = :id", "id={$this->Aula}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Aula", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Aula Atualizada com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE aula_id = :id", "id={$this->Aula}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Aula", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Aula Excluído com Sucesso!", WS_ACCEPT];
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
