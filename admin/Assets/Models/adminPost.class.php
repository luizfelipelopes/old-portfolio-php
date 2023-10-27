<?php

/**
 * adminPost.class [ ADMIN ]
 * Classe Responsável pela Gestão das Posts
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminPost {

    private $Post;
    private $Data;
    private $Error;
    private $Result;

    const Entity = POSTS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", 'alert'];
            $this->Result = false;

        else:

            $this->capturarCatParent();
            $this->tratarDados();
            $this->verificarNome();
            $this->verificarImagem();

            if ($this->getResult()):
                $this->Create();
            endif;
        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Post = (int) $Id;
        $this->Data = $Dados;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", 'alert'];
            $this->Result = false;

        else:
            $this->capturarCatParent();
            $this->tratarDados();
            $this->verificarNome();
            $this->verificarImagemUpload();

            if ($this->Result):
                $this->Update();
            endif;

        endif;
    }

    public function ExeDelete($Id) {
        $this->Post = (int) $Id;
        $this->Delete();
    }

    public function ExeStatus($Id, $Dados) {
        $this->Post = (int) $Id;
        $this->Data = $Dados;
        $this->Update();
    }

    public function ExeDeleteThumbs() {

        if ($this->readThumbsContent()):

            $path = ROOT_DOC . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . 'content';
//            $path = substr(__DIR__, 0, strpos(__DIR__, '\admin')) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . 'content';
//            var_dump($path);
            $Uploads = Check::listarDiretorio($path);
            $ImgsContent = $this->readThumbsContent();

            $i = 0;
            $excluido = 0;

            foreach ($Uploads as $upload):

                $i = 0;

                foreach ($ImgsContent as $content):
                    if ($content == $upload):
                        $i++;
                    endif;
                endforeach;

                if ($i == 0):
                    $foto = $path . substr($upload, strpos($upload, '\\'));
                    if (!is_dir($foto) && file_exists($foto)):
                        unlink($foto);
                        $excluido++;
                    endif;
                endif;

            endforeach;

            if ($excluido > 0):
                $this->Result = true;
                $this->Error = ["Varredura de Exclusão de Imagens Executadas com Sucesso !", 'success'];
            else:
                $this->Result = false;
                $this->Error = ["Não há imagens a serem deletadas !", 'info'];
            endif;

        endif;
    }

    private function tratarDados() {

        $Content = $this->Data['post_content'];
        $Imagem = $this->Data['post_cover'];

        unset($this->Data['post_cover'], $this->Data['post_content']);

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        $this->Data['post_name'] = (!empty($this->Data['post_name']) && $this->verificarUrlDinamica() ? Check::Name($this->Data['post_name']) : (!empty($this->Data['post_name']) ? $this->Data['post_name'] : Check::Name($this->Data['post_title'])));
        $this->Data['post_content'] = $Content;
        $this->Data['post_cover'] = $Imagem;
        $this->Data['post_video'] = (!empty($this->Data['post_video']) ? $this->Data['post_video'] : null);
        $this->Data['post_subtitle'] = (!empty($this->Data['post_subtitle']) ? $this->Data['post_subtitle'] : null);

        if (empty($this->Data['post_status'])):
            $this->Data['post_status'] = '0';
        endif;

//        var_dump($this->Data['post_date']);

        $Data = str_replace('/', '-', substr($this->Data['post_date'], 0, 10));
        $Hora = date('H:i:s', strtotime(substr($this->Data['post_date'], 10, 8)));
        $this->Data['post_date'] = date('Y-m-d H:i:s', strtotime($Data . ' ' . $Hora));
//        var_dump($this->Data['post_date']);
    }

    private function verificarUrlDinamica() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE post_id = :id", "id={$this->Post}");

        if ($read->getResult()):
            if ($read->getResult()[0]['post_name'] != $this->Data['post_name']):
                return true;
            endif;
        endif;

        return false;
    }

    private function readThumbsContent() {

        $readContent = new Read;
        $readContent->FullRead("SELECT post_content FROM " . self::Entity);
        
        $ImgsContent = array();

        if ($readContent->getResult()):

            foreach ($readContent->getResult() as $imagem):

                extract($imagem);

                $Count = substr_count($post_content, '<img');

                if (strpos($post_content, '<img') !== false):

                    $offset = 0;

                    for ($i = 0; $i < $Count; $i++):

                        $Posicao = strpos($post_content, 'src=', $offset);
                        $offset = strpos($post_content, 'src=', $Posicao) + 2;
                        $Fim = strpos($post_content, 'g"', $offset);
                        $ImgsContent[] = str_replace('/', '\\', substr(substr($post_content, $Posicao + 5, ($Fim - $Posicao) - 4), strpos(substr($post_content, $Posicao + 5, ($Fim - $Posicao) - 4), 'content')));

                    endfor;

                endif;

            endforeach;

//            var_dump($ImgsContent);

            return $ImgsContent;


        endif;
    }

    private function capturarCatParent() {

        $read = new Read;
        $read->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$this->Data['post_category']}");

        if (!$read->getResult()):
            $this->Data['post_cat_parent'] = null;
            $this->Error = ["Nenhuma categoria encontrada", 'info'];
            $this->Result = false;
        else:
            $this->Data['post_cat_parent'] = $read->getResult()[0]['category_parent'];
            $this->Result = true;
        endif;
    }

    private function verificarNome() {

        $where = (!empty($this->Post) ? "post_id != {$this->Post} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} post_title = :title", "title={$this->Data['post_title']}");
        if ($read->getResult()):
            $this->Data['post_name'] = $this->Data['post_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function verificarImagem() {

        if ($this->Data['post_cover'] && is_array($this->Data['post_cover'])):

            $upload = new Upload('../../../uploads');
            $upload->Image($this->Data['post_cover'], $this->Data['post_name'], 300000, '/posts');

            if (!$upload->getResult()):
                $this->Data['post_cover'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['post_cover'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data['post_cover'] && is_array($this->Data['post_cover'])) {

            $readCapa = new Read;
            $readCapa->ExeRead(self::Entity, "WHERE post_id = :id", "id={$this->Post}");
            if ($readCapa->getResult()):

                $capa = '../../../uploads' . $readCapa->getResult()[0]['post_cover'];

                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $upload = new Upload("../../../uploads");
                $upload->Image($this->Data['post_cover'], $this->Data['post_name'], 300000, "/posts");
                if (!$upload->getResult()):
                    unset($this->Data['post_cover']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['post_cover'] = $upload->getResult();
                    $this->Result = true;
                endif;



            endif;
        }
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Post', 'error'];
            $this->Result = false;
        else:
            $this->Error = ['Post cadastrado com Sucesso!', 'success'];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE post_id = :id", "id={$this->Post}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Post", 'error'];
            $this->Result = false;
        else:
            $this->Error = ["Post Atualizado com Sucesso!", 'success'];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE post_id = :id", "id={$this->Post}");
        if ($read->getResult()):
            $capa = '../../../uploads' . $read->getResult()[0]['post_cover'];
            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE post_id = :id", "id={$this->Post}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Post", 'error'];
            $this->Result = false;
        else:
            $this->Error = ["Post Excluído com Sucesso!", 'success'];
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
