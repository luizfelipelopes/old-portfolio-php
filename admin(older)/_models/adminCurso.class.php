<?php

/**
 * adminCurso.class [ ADMIN ]
 * Classe Responsável pela Gestão das Cursos
 * @copyright (c) 2016, Luiz Felipe C. Lopes 
 */
class adminCurso {

    private $Curso;
    private $Data;
    private $Error;
    private $Result;

    const Entity = CURSOS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:

//            $this->capturarCatParent();
            $this->tratarDados();
            $this->verificarNome();
            $this->verificarImagem();

            if ($this->getResult()):
                $this->Create();
            endif;
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
            $this->verificarImagemUpload();

            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Curso = (int) $Id;
        $this->Delete();
    }

    public function ExeStatus($Id, $Status) {

        $this->Curso = (int) $Id;
        $this->Data = $Status;

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE curso_id = :id", "id={$this->Curso}");
        if (!$read->getResult()):
            $this->Error = ["Índice inválido! Favor tente novamente", WS_ALERT];
            $this->Result = false;

        else:
            $update = new Update();
            $update->ExeUpdate(self::Entity, $this->Data, "WHERE curso_id = :id", "id={$this->Curso}");
            if (!$update->getResult()):
                $this->Error = ["Não foi possível atualizar o status do curso <b> {$read->getResult()[0]['curso_title']}</b> ! Favor tente novamente", WS_ALERT];
                $this->Result = false;
            else:
                $this->Error = ["Status do curso <b> {$read->getResult()[0]['curso_title']}</b> atualizado com sucesso !", WS_ACCEPT];
                $this->Result = true;
            endif;


        endif;
    }

    private function tratarDados() {

//        $Content = $this->Data['curso_subtitle'];
        $Imagem = $this->Data['curso_cover'];

        unset($this->Data['curso_cover']);

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        $this->Data['curso_name'] = Check::Name($this->Data['curso_title']);
//        $this->Data['curso_content'] = $Content;
        $this->Data['curso_cover'] = $Imagem;

        if (!isset($this->Data['curso_status'])):
            $this->Data['curso_status'] = '0';
            $this->Data['curso_date'] = date('Y-m-d H:i:s', strtotime($this->Data['curso_date']));
        else:
            $this->Data['curso_date'] = $this->Data['curso_date'] . ' ' . date('H:i:s');
        endif;


        $this->Data['curso_valor'] = Check::toFloat($this->Data['curso_valor']);
    }

    private function verificarNome() {

        $where = (!empty($this->Curso) ? "curso_id != {$this->Curso} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} curso_title = :title", "title={$this->Data['curso_title']}");
        if ($read->getResult()):
            $this->Data['curso_name'] = $this->Data['curso_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function verificarImagem() {

        if ($this->Data['curso_cover'] && is_array($this->Data['curso_cover'])):

            $upload = new Upload('../../uploads');
            $upload->Image($this->Data['curso_cover'], $this->Data['curso_name'], null, '/cursos');

            if (!$upload->getResult()):
                $this->Data['curso_cover'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['curso_cover'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data['curso_cover'] && is_array($this->Data['curso_cover'])) {

            $readCapa = new Read;
            $readCapa->ExeRead(self::Entity, "WHERE curso_id = :id", "id={$this->Curso}");
            if ($readCapa->getResult()):

                $capa = '../../uploads' . $readCapa->getResult()[0]['curso_cover'];

                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $upload = new Upload("../../uploads");
                $upload->Image($this->Data['curso_cover'], $this->Data['curso_name'], null, "/cursos");
                if (!$upload->getResult()):
                    unset($this->Data['curso_cover']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['curso_cover'] = $upload->getResult();
                    $this->Result = true;
                endif;



            endif;
        }
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Curso', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Curso cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE curso_id = :id", "id={$this->Curso}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Curso", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Curso Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE curso_id = :id", "id={$this->Curso}");
        if ($read->getResult()):
            $capa = '../../uploads' . $read->getResult()[0]['curso_cover'];

            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE curso_id = :id", "id={$this->Curso}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Curso", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Curso Excluído com Sucesso!", WS_ACCEPT];
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
