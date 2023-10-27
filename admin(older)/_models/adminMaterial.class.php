<?php

/**
 * adminAula.class [ ADMIN ]
 * Classe Responsável pela Gestão das Aulas
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminMaterial {

    private $Material;
    private $Aula;
    private $Titulo;
    private $Data;
    private $Error;
    private $Result;

    const Entity = MATERIAIS;

    public function ExeCreate($Id, array $Data) {

        $this->Data = $Data;
        $this->Aula = (int) $Id;

//            $this->tratarDados();
//            $this->verificarNome();
        $this->verificarImagem();

        if ($this->Result):
            $this->Create();
        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Material = (int) $Id;
        $this->Data = $Dados;

        $this->verificarImagemUpload();

        if ($this->Result):
            $this->Update();
        endif;
    }

    public function ExeDelete($Id) {
        $this->Material = (int) $Id;
        $this->Delete();
    }

    private function verificarImagem() {

        if ($this->Data && is_array($this->Data)):

            $this->Titulo = (strpos($this->Data["name"], '.pdf') ? substr($this->Data["name"], 0, strpos($this->Data["name"], '.pdf')) : substr($this->Data["name"], 0, strpos($this->Data["name"], '.docx')));

            $upload = new Upload('../../uploads');
            $upload->File($this->Data, null, '/aulas');

            if (!$upload->getResult()):
                $this->Data = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data && is_array($this->Data)) {

            $this->Titulo = (strpos($this->Data["name"], '.pdf') ? substr($this->Data["name"], 0, strpos($this->Data["name"], '.pdf')) : substr($this->Data["name"], 0, strpos($this->Data["name"], '.docx')));

            $readMaterial = new Read;
            $readMaterial->ExeRead(self::Entity, "WHERE material_id = :id", "id={$this->Material}");
            if ($readMaterial->getResult()):

                $material = '../../uploads' . $readMaterial->getResult()[0]['material_name'];

                if (file_exists($material) && !is_dir($material)):
                    unlink($material);
                endif;

                $upload = new Upload("../../uploads");
                $upload->File($this->Data, $this->Data['name'], '/aulas');
                if (!$upload->getResult()):
                    unset($this->Data);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data = $upload->getResult();
                    $this->Result = true;
                endif;



            endif;
        }
    }

    private function Create() {

        $Arquivos = [
            "material_title" => $this->Titulo,
            "material_name" => $this->Data,
            "material_aula" => $this->Aula
        ];

        $create = new Create();
        $create->ExeCreate(self::Entity, $Arquivos);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Material', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Material cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $Arquivos = [
            "material_title" => $this->Titulo,
            "material_name" => $this->Data
        ];


        $update = new Update;
        $update->ExeUpdate(self::Entity, $Arquivos, "WHERE material_id = :id", "id={$this->Material}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Material", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Material Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE material_id = :id", "id={$this->Material}");
        if ($read->getResult()):
            $material = '../../uploads' . $read->getResult()[0]['material_name'];

            if (file_exists($material) && !is_dir($material)):
                unlink($material);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE material_id = :id", "id={$this->Material}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Material", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Material Excluído com Sucesso!", WS_ACCEPT];
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
