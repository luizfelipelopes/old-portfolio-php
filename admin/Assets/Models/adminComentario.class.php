<?php

/**
 * adminComentario.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Comentários
 * @copyright (c) 2016, Luiz Felipe C. Lopes 
 */
class adminComentario {

    private $Comentario;
    private $Data;
    private $Error;
    private $Result;

    const Entity = COMENTARIOS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if (isset($this->Data['comentario_author']) && $this->Data['comentario_author'] == null || isset($this->Data['comentario_email']) && $this->Data['comentario_email'] == null || isset($this->Data['comentario_content']) && $this->Data['comentario_content'] == null):
            $this->Error = ["Por favor, preencha os campos Obrigatórios (Nome, email e mensagem)", "error"];
            $this->Result = false;

        else:

            $this->tratarDados();
            if (!empty($this->Data['comentario_author'])):
                $this->verificarNome();
            endif;
            $this->verificarImagem();
            $this->Create();

        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Comentario = (int) $Id;
        $this->Data = $Dados;

        if (isset($this->Data['comentario_author']) && $this->Data['comentario_author'] == null || isset($this->Data['comentario_email']) && $this->Data['comentario_email'] == null || isset($this->Data['comentario_content']) && $this->Data['comentario_content'] == null):
            $this->Error = ["Por favor, preencha os campos Obrigatórios (Nome, email e mensagem)", "error"];
            $this->Result = false;

        else:

            $this->tratarDados();
            if (!empty($this->Data['comentario_author'])):
                $this->verificarNome();
            endif;
            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Comentario = (int) $Id;
        $this->Delete();
    }
    
    public function ExeStatus($Id, array $Data) {
        $this->Comentario = (int) $Id;
        $this->Data = $Data;
        $this->Update();
    }

    private function tratarDados() {

        $Imagem = null;
        if (isset($this->Data['comentario_cover'])):
            $Imagem = $this->Data['comentario_cover'];
            unset($this->Data['comentario_cover']);
        endif;

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        if (isset($this->Data['comentario_author'])):
            $this->Data['comentario_name'] = Check::Name($this->Data['comentario_author']);
        endif;

        $this->Data['comentario_cover'] = $Imagem;

        if (!isset($this->Comentario)):
            $this->Data['comentario_date'] = date('Y-m-d H:i:s');
        endif;
    }

    private function verificarNome() {

        $where = (!empty($this->Comentario) ? "comentario_id != {$this->Comentario} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} comentario_author = :author", "author={$this->Data['comentario_author']}");
        if ($read->getResult()):
            $this->Data['comentario_name'] = $this->Data['comentario_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function verificarImagem() {

        if (isset($this->Data['comentario_cover']) && is_array($this->Data['comentario_cover'])):

            $upload = new Upload('../../../uploads');
            $upload->Image($this->Data['comentario_cover'], (!empty($this->Data['comentario_name']) ? $this->Data['comentario_name'] : 'usuario' . rand(0, 1000)), null, '/comentarios');

            if (!$upload->getResult()):
                $this->Data['comentario_cover'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['comentario_cover'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Comentário', "error"];
            $this->Result = false;
        else:
            $this->Error = [(MODERADOR == '1' ? 'Parabéns! Sua Avaliação foi enviada a moderação! ;)' : 'Comentário Enviado com Sucesso! ;)'), "success"];
            $this->Result = $create->getResult();
        endif;
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE comentario_id = :id", "id={$this->Comentario}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Comentário", "error"];
            $this->Result = false;
        else:
            $this->Error = ["Comentário Atualizado com Sucesso!", "success"];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE comentario_id = :id", "id={$this->Comentario}");
        if (($read->getResult() && !empty($read->getResult()[0]['comentario_cover']) && !isset($_SESSION['userlogin']) && !isset($_SESSION['clientelogin'])) || (!empty($read->getResult()[0]['comentario_cover']) && (!empty($_SESSION['userlogin']['user_foto']) && $_SESSION['userlogin']['user_foto'] != $read->getResult()[0]['comentario_cover'])) || (!empty($read->getResult()[0]['comentario_cover']) && !empty($_SESSION['clientelogin']['cliente_cover']) && $_SESSION['clientelogin']['cliente_cover'] != $read->getResult()[0]['comentario_cover'])):
            $capa = '../../../uploads' . $read->getResult()[0]['comentario_cover'];

            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE comentario_id = :id", "id={$this->Comentario}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Comentário", "error"];
            $this->Result = false;
        else:
            $this->Error = ["Comentário Excluído com Sucesso!", "success"];
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
