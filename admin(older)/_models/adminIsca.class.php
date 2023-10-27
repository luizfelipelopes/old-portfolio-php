<?php

/**
 * adminIsca.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Iscas
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminIsca {

    private $Isca;
    private $Data;
    private $Error;
    private $Result;

    const Entity = ISCAS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;


//        $url = $this->Data['isca_url'];
//        unset($this->Data['isca_url']);

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
//            $this->Data['isca_url'] = $url;

            $this->tratarDados();
            $this->verificarNome();
            $this->verificarImagem();
            $this->verificarArquivo();

            $this->Create();

        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Isca = (int) $Id;
        $this->Data = $Dados;

        if (!empty($this->Data['isca_url'])):
            $url = $this->Data['isca_url'];
            unset($this->Data['isca_url']);
        endif;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
            if (!empty($this->Data['isca_url'])):
                $this->Data['isca_url'] = $url;
            endif;
            $this->tratarDados();
            if (!empty($this->Data['isca_title'])):
                $this->verificarNome();
            endif;

            if (!empty($this->Data['isca_cover'])):
                $this->verificarImagemUpload();
            endif;

            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Isca = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

        if (!empty($this->Data['isca_cover'])):
            $Imagem = $this->Data['isca_cover'];
            unset($this->Data['isca_cover']);
        endif;
        
        if (!empty($this->Data['isca_file'])):
            $Arquivo = $this->Data['isca_file'];
            unset($this->Data['isca_file']);
        endif;

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        if (!empty($this->Data['isca_title'])):
            $this->Data['isca_name'] = Check::Name($this->Data['isca_title']);
        endif;

        if (!empty($Imagem)):
            $this->Data['isca_cover'] = $Imagem;
        endif;
        
        if (!empty($Arquivo)):
            $this->Data['isca_file'] = $Arquivo;
        endif;

//        if (!isset($this->Data['isca_status'])):
//            $this->Data['isca_status'] = '0';
//        endif;

        $Data = str_replace('/', '-', substr($this->Data['isca_date'], 0, 10));
        $Hora = date('H:i:s', strtotime(substr($this->Data['isca_date'], 10, 8)));
        $this->Data['isca_date'] = date('Y-m-d H:i:s', strtotime($Data . ' ' . $Hora));
    }

    private function verificarNome() {

        $where = (!empty($this->Isca) ? "isca_id != {$this->Isca} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} isca_title = :title", "title={$this->Data['isca_title']}");
        if ($read->getResult()):
            $this->Data['isca_name'] = $this->Data['isca_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function verificarImagem() {

        if (!empty($this->Data['isca_cover']) && is_array($this->Data['isca_cover'])):

            $upload = new Upload('../../uploads');
            $upload->Image($this->Data['isca_cover'], $this->Data['isca_name'], null, '/iscas/imagens');

            if (!$upload->getResult()):
                $this->Data['isca_cover'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['isca_cover'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data['isca_cover'] && is_array($this->Data['isca_cover'])):

            $readCapa = new Read;
            $readCapa->ExeRead(ISCAS, "WHERE isca_id = :id", "id={$this->Isca}");
            if ($readCapa->getResult()):

                $capa = '../../uploads' . $readCapa->getResult()[0]['isca_cover'];

                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $upload = new Upload("../../uploads");
                $upload->Image($this->Data['isca_cover'], $this->Data['isca_name'], null, "/iscas/imagens");
                if (!$upload->getResult()):
                    unset($this->Data['isca_cover']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['isca_cover'] = $upload->getResult();
                    $this->Result = true;
                endif;



            endif;

        else:
            $this->Result = true;
        endif;
    }

    private function verificarArquivo() {

        if (!empty($this->Data['isca_file']) && is_array($this->Data['isca_file'])):

            $this->Titulo = (strpos($this->Data["isca_name"], '.pdf') ? substr($this->Data["isca_name"], 0, strpos($this->Data["isca_name"], '.pdf')) : (strpos($this->Data["isca_name"], '.xls') ? substr($this->Data["isca_name"], 0, strpos($this->Data["isca_name"], '.xls')) : (strpos($this->Data["isca_name"], '.xlsx') ? substr($this->Data["isca_name"], 0, strpos($this->Data["isca_name"], '.xlsx')) : substr($this->Data["isca_name"], 0, strpos($this->Data["isca_name"], '.docx')))));

            $upload = new Upload('../../uploads');
            $upload->File($this->Data["isca_file"], null, '/iscas/arquivos');

            if (!$upload->getResult()):
                $this->Data['isca_file'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['isca_file'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarArquivoUpload() {

        if (!empty($this->Data['isca_file']) && is_array($this->Data['isca_file'])) {

            $this->Titulo = (strpos($this->Data["isca_name"], '.pdf') ? substr($this->Data["isca_name"], 0, strpos($this->Data["isca_name"], '.pdf')) : (strpos($this->Data["isca_name"], '.xls') ? substr($this->Data["isca_name"], 0, strpos($this->Data["isca_name"], '.xls')) : (strpos($this->Data["isca_name"], '.xlsx') ? substr($this->Data["isca_name"], 0, strpos($this->Data["isca_name"], '.xlsx')) : substr($this->Data["isca_name"], 0, strpos($this->Data["isca_name"], '.docx')))));

            $readIsca = new Read;
            $readIsca->ExeRead(self::Entity, "WHERE isca_id = :id", "id={$this->Isca}");
            if ($readIsca->getResult()):

                $material = '../../uploads' . $readIsca->getResult()[0]['isca_name'];

                if (file_exists($material) && !is_dir($material)):
                    unlink($material);
                endif;

                $upload = new Upload("../../uploads");
                $upload->File($this->Data['isca_file'], $this->Data['isca_name'], '/iscas/arquivos');
                if (!$upload->getResult()):
                    unset($this->Data['isca_file']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['isca_file'] = $upload->getResult();
                    $this->Result = true;
                endif;



            endif;
        }
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Isca', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Isca cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE isca_id = :id", "id={$this->Isca}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Isca", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Isca Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE isca_id = :id", "id={$this->Isca}");
        if ($read->getResult()):
            $capa = '../../uploads' . $read->getResult()[0]['isca_cover'];

            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE isca_id = :id", "id={$this->Isca}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Isca", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Isca Excluído com Sucesso!", WS_ACCEPT];
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
