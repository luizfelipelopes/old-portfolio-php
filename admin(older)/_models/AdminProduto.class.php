<?php

require 'AdminEspecificacoes.class.php';

/**
 * AdminProduto.class [ MODEL ADMIN ]
 * Classe responsável por manipular e tratar os dados do produto 
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class AdminProduto {

    private $Produto;
    private $Data;
    private $Especificacoes;
    private $Result;
    private $Error;

    const Entity = PRODUTOS;

    public function __construct() {
        $this->Especificacoes = new AdminEspecificacoes();
    }

    public function ExeCreate(array $Data) {

        $this->Data = $Data;
        
        if (in_array('', $this->Data)):
            $this->Error = ["Preenche todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->tratarDados();
            $this->verificarNome();
            $this->verificarImagem();
//            var_dump($this->Data);

        endif;

        if ($this->Result):
            $this->Create();
        endif;
    }

    public function ExeUpdate($Id, array $Data) {

        $this->Produto = (int) $Id;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Preenche todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->Result = true;
            $this->tratarDados();
            $this->verificarNome();
            $this->verificarImagemUpload();

            if ($this->Result):
                $this->Update();
            endif;


        endif;
    }

    public function ExeStatus($Id, $Status) {

        $this->Produto = (int) $Id;
        $this->Data = $Status;

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE produto_id = :id", "id={$this->Produto}");
        if (!$read->getResult()):
            $this->Error = ["Índice inválido! Favor tente novamente", WS_ALERT];
            $this->Result = false;

        else:
            $update = new Update();
            $update->ExeUpdate(self::Entity, $this->Data, "WHERE produto_id = :id", "id={$this->Produto}");
            if (!$update->getResult()):
                $this->Error = ["Não foi possível atualizar o status do produto <b> {$read->getResult()[0]['produto_title']}</b> ! Favor tente novamente", WS_ALERT];
                $this->Result = false;
            else:
                $this->Error = ["Status do produto <b> {$read->getResult()[0]['produto_title']}</b> atualizado com sucesso !", WS_ACCEPT];
                $this->Result = true;
            endif;


        endif;
    }

    public function ExeEstoque($Id, $Estoque) {

        $this->Produto = (int) $Id;
        $this->Data = $Estoque;

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE produto_id = :id", "id={$this->Produto}");
        if (!$read->getResult()):
            $this->Error = ["Índice inválido! Favor tente novamente", WS_ALERT];
            $this->Result = false;

        else:
            $update = new Update();
            $update->ExeUpdate(self::Entity, $this->Data, "WHERE produto_id = :id", "id={$this->Produto}");
            if (!$update->getResult()):
                $this->Error = ["Não foi possível atualizar a dsponibilidade do produto <b> {$read->getResult()[0]['produto_title']}</b> ! Favor tente novamente", WS_ALERT];
                $this->Result = false;
            else:
                $this->Error = ["Disponibilidade do produto <b> {$read->getResult()[0]['produto_title']}</b> atualizado com sucesso !", WS_ACCEPT];
                $this->Result = true;
            endif;


        endif;
    }

    public function ExeDelete($Id) {
        $this->Produto = (int) $Id;

        // ELIMINAR FOTOS DA GALERIA NA PASTA DE UPLOADS
        $read = new Read();
        $read->ExeRead(GALERIA, "WHERE produto_id = :id", "id={$this->Produto}");
        if ($read->getResult()):

            foreach ($read->getResult() as $galeria):

                $NameImg = '../uploads/' . $galeria['gallery_image'];

                // SE ARQUIVO EXISTE E NAO FOR UM DIRETÓRIO
                if (file_exists($NameImg) && !is_dir($NameImg)):
                    unlink($NameImg);
                endif;
            endforeach;
        endif;

        // ELIMINAR FOTO DE CAPA NA PASTA DE UPLOADS
        $read->ExeRead(self::Entity, "WHERE produto_id = :id", "id={$this->Produto}");
        if ($read->getResult()):

            $Name = '../uploads' . $read->getResult()[0]['produto_image'];

            // SE ARQUIVO EXISTE E NAO FOR UM DIRETÓRIO
            if (file_exists($Name) && !is_dir($Name)):
                unlink($Name);
            endif;


        endif;


        $delete = new Delete();
        // DELETA GALERIA DO BANCO
        $delete->ExeDelete(GALERIA, "WHERE produto_id = :id", "id={$this->Produto}");

        //DELETA O PRODUTO DO BANCO
        $delete->ExeDelete(self::Entity, "WHERE produto_id = :id", "id={$this->Produto}");

        if (!$delete->getResult()):
            $this->Error = ["Não foi possível deletar produto <b> {$delete->getResult()[0]['produto_title']}</b> ! Favor tente novamente", WS_ALERT];
            $this->Result = false;
        else:

            $this->Especificacoes->ExeDelete($this->Produto);
            if (!$this->Especificacoes->getResult()):
                $this->Error = ["Não foi possível deletar produto <b> {$delete->getResult()[0]['produto_title']}</b> ! Favor tente novamente", WS_ALERT];
                $this->Result = false;
            else:
                $this->Error = ["Produto deletado com sucesso!", WS_ACCEPT];
                $this->Result = true;
            endif;
        endif;
    }

    public function ExeDesconto($Valor, $Desconto) {

        $Desc = Check::toFloat($Desconto);
        
        $descontoDecimal = $Desc / 100;

        $Valor = Check::toFloat($Valor);
        
        return $Valor - ($Valor * $descontoDecimal);
        
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    public function getEspecificacoes() {
        return $this->Especificacoes->getData();
    }

    private function verificarImagem() {

        if ($this->Data['produto_image']):

            $upload = new Upload('../../uploads');
            $upload->Image($this->Data['produto_image'], $this->Data['produto_name'], null, '/produtos');

            if (!$upload->getResult()):

                $this->Data['produto_image'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;

            else:
                $this->Data['produto_image'] = $upload->getResult();
                $this->Result = true;
            endif;
        endif;
    }

    private function verificarImagemUpload() {

        if (is_array($this->Data['produto_image'])):

            $readCapa = new Read;
            $readCapa->ExeRead(self::Entity, "WHERE produto_id = :id", "id={$this->Produto}");

//            var_dump($readCapa->getResult());

            $capa = '../../uploads' . $readCapa->getResult()[0]['produto_image'];
            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;

            $uploadCapa = new Upload("../../uploads");
            $uploadCapa->Image($this->Data['produto_image'], $this->Data['produto_name'], null, '/produtos');

//            var_dump($uploadCapa->getResult());

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['produto_image'] = $uploadCapa->getResult();
                $this->Result = true;
            else:
                unset($this->Data['produto_image']);
                $this->Error = [$uploadCapa->getError()[0], $uploadCapa->getError()[1]];
                $this->Result = false;
            endif;


        endif;
    }

    public function gbSend($Id, array $Images) {

        $this->Produto = (int) $Id;
        $this->Data = $Images;

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE produto_id = :id", "id={$this->Produto}");

        if (!$read->getResult()):

            $this->Error = ["Não foi possível salval galeria! Este índice não existe!", WS_ALERT];
            $this->Result = false;
        else:

            $NameImage = $read->getResult()[0]['produto_name'];

            $gbFiles = array();
            $gbCount = count($this->Data['tmp_name']);
            $gbKeys = array_keys($this->Data);


            for ($gb = 0; $gb < $gbCount; $gb++):
                foreach ($gbKeys as $Keys):
                    $gbFiles[$gb][$Keys] = $this->Data[$Keys][$gb];
                endforeach;
            endfor;

            $gbSend = new Upload('../../uploads');

            $i = 0;
            $u = 0;


            foreach ($gbFiles as $gbUpload):

                $i++;
                $NameImg = $NameImage . '-gb-' . $this->Produto . '-' . substr(md5(time() + $i), 0, 5);

                $gbSend->Image($gbUpload, $NameImg, null, '/produtos');

                if ($gbSend->getResult()):

                    $gbCreate = new Create();

                    $Dados = ['produto_id' => $this->Produto, 'gallery_image' => $gbSend->getResult(), 'gallery_date' => date('Y-m-d H:i:s')];

                    $gbCreate->ExeCreate(GALERIA, $Dados);
                    if (!$gbCreate->getResult()):
                        $this->Error = ["Erro ao salvar galeria! Por favor tente novamente", WS_ALERT];
                        $this->Result = false;
                    else:
                        $this->Result = true;
                        $u++;
                    endif;

                    if ($u > 1):
                        $this->Error = ["{$u} imagens foram atualizadas com sucesso!", WS_ACCEPT];
                    endif;


                endif;

            endforeach;
        endif;
    }

    public function gbRemove($Id) {

        $read = new Read;
        $read->ExeRead(GALERIA, "WHERE gallery_id = :id", "id={$Id}");

        if ($read->getResult()):
            $Image = '../uploads/' . $read->getResult()[0]['gallery_image'];

            if (file_exists($Image) && !is_dir($Image)):
                unlink($Image);
            endif;


            $delete = new Delete();
            $delete->ExeDelete(GALERIA, "WHERE gallery_id = :id", "id={$Id}");

            if ($delete->getResult()):
                $this->Error = ["Imagem deletada com sucesso", WS_ACCEPT];
                $this->Result = true;
            endif;

        endif;
    }

    private function tratarDados() {

        $Content = $this->Data['produto_descricao'];
        $Cover = $this->Data['produto_image'];
//        $Data = $this->Data['produto_data'];
        unset($this->Data['produto_descricao'], $this->Data['produto_image']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['produto_name'] = Check::Name($this->Data['produto_title']);
        
        
        if(!empty($this->Data['produto_desconto'])):
            $this->Data['produto_valor_descontado'] = $this->ExeDesconto($this->Data['produto_valor'], $this->Data['produto_desconto']);
            $this->Data['produto_desconto'] = Check::toFloat($this->Data['produto_desconto']/100);
            else:
            $this->Data['produto_valor_descontado'] = 0;    
            $this->Data['produto_desconto'] = 0;    
        endif;
        
        $this->Data['produto_valor'] = Check::toFloat($this->Data['produto_valor']);
        
        if(empty($this->Produto)):
            $this->Data['produto_data'] = date('Y-m-d', strtotime($this->Data['produto_data'])) . ' ' . date('H:i:s');
        endif;

        $this->Data['produto_type'] = 'produto';
        $this->Data['produto_descricao'] = $Content;
        $this->Data['produto_image'] = $Cover;
        $this->Data['produto_author'] = $_SESSION['userlogin']['user_id'];
        
        if(empty($this->Data['produto_status'])):
            $this->Data['produto_status'] = '0';
        endif;


        $this->getCatParent();


        $espec = ['especificacao_ref' => $this->Data['especificacao_ref'],
            'especificacao_modelo' => $this->Data['especificacao_modelo'],
            'especificacao_cor' => $this->Data['especificacao_cor'],
            'especificacao_dimensoes' => $this->Data['especificacao_dimensoes'],
            'especificacao_fab_inicial' => $this->Data['especificacao_fab_inicial'],
            'especificacao_fab_final' => $this->Data['especificacao_fab_final'],
            'especificacao_artesas' => $this->Data['especificacao_artesas'],
            'especificacao_tonalidade' => $this->Data['especificacao_tonalidade']
        ];


        $this->Especificacoes->setData($espec);

        unset($this->Data['especificacao_ref'], $this->Data['especificacao_modelo'], $this->Data['especificacao_cor'], $this->Data['especificacao_dimensoes'], $this->Data['especificacao_fab_inicial'], $this->Data['especificacao_fab_final'], $this->Data['especificacao_artesas'], $this->Data['especificacao_tonalidade']);
    }

    private function getCatParent() {

        $readCat = new Read();
        $readCat->ExeRead(CATEGORIAS, "WHERE category_parent IS NOT NULL AND category_id = :id", "id={$this->Data['produto_categoria']}");
        if ($readCat->getResult()):
            $this->Data['produto_cat_parent'] = $readCat->getResult()[0]['category_parent'];
        endif;
    }

    private function verificarNome() {

        $Where = ($this->Produto ? "produto_id != {$this->Produto} AND " : '');


        $readNome = new Read();
        $readNome->ExeRead(self::Entity, "WHERE {$Where} produto_title = :produtotitle", "produtotitle={$this->Data['produto_title']}");
        if ($readNome->getResult()):

            $this->Data['produto_name'] = $this->Data['produto_name'] . '-' . ($readNome->getRowCount() + 1);

        endif;
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar! POr favor tente novamente", WS_ALERT];
            $this->Result = false;
        else:


            $this->Result = $create->getResult();
            $this->Especificacoes->ExeCreate($this->Result);
            if (!$this->Especificacoes->getResult()):
                $this->Result = false;
                $this->Error = [$this->Especificacoes->getError()[0], $this->Especificacoes->getError()[1]];
            else:
                $this->Error = ["Produto Cadastrado com Sucesso!", WS_ACCEPT];
//                $this->Result = true;
            endif;
        endif;
    }

    private function Update() {

        $update = new Update();
        if ($this->Data['produto_image'] == 'null'):
            unset($this->Data['produto_image']);
        endif;

        $update->ExeUpdate(self::Entity, $this->Data, "WHERE produto_id = :id", "id={$this->Produto}");
        if (!$update->getResult()):
            $this->Error = ["Erro atualizar o produto {$this->Data['produto_title']}. Tente Novamente!", WS_ALERT];
            $this->Result = false;
        else:

            $readEspecificacoes = new Read();
            $readEspecificacoes->ExeRead(ESPECIFICACOES, "WHERE produto_id = :produtoid", "produtoid={$this->Produto}");

            if (!$readEspecificacoes->getResult()):
                $this->Especificacoes->ExeCreate($this->Produto);
                if (!$this->Especificacoes->getResult()):
                    $this->Error = ["Erro atualizar o produto {$this->Data['produto_title']}. Tente Novamente!", WS_ALERT];
                    $this->Result = false;
                else:
                    $this->Error = ["O produto <b>{$this->Data['produto_title']}</b> foi atualizado com sucesso!", WS_ACCEPT];
                    $this->Result = true;
                endif;

            else:

                $this->Especificacoes->ExeUpdate($this->Produto);
                if (!$this->Especificacoes->getResult()):
                    $this->Error = ["Erro atualizar o produto {$this->Data['produto_title']}. Tente Novamente!", WS_ALERT];
                    $this->Result = false;
                else:
                    $this->Error = ["O produto <b>{$this->Data['produto_title']}</b> foi atualizado com sucesso!", WS_ACCEPT];
                    $this->Result = true;
                endif;

            endif;


        endif;
    }

}
