<?php

/**
 * adminCategoria.class [ ADMIN ]
 * Classe Responsável pela Gestão das Categorias
 * @copyright (c) 2017, Luiz Felipe C. Lopes  - Flowstate
 */
class adminCategoria {

    private $Categoria;
    private $Data;
    private $Error;
    private $Result;

    const Entity = CATEGORIAS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if ($this->Data['category_title'] == '' || $this->Data['category_content'] == ''):
            $this->Error = ["Por favor, preencha todos os dados", "alert"];
            $this->Result = false;

        else:

            $this->tratarDados();
            $this->verificarNome();
            $this->Create();
        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Categoria = (int) $Id;
        $this->Data = $Dados;

        if ($this->Data['category_title'] == '' || $this->Data['category_content'] == ''):
            $this->Error = ["Por favor, preencha todos os dados", "alert"];
            $this->Result = false;
        else:
            $this->tratarDados();
            if (!empty($this->Data['category_name'])):
                $this->verificarNome();
            endif;
            $this->Update();
        endif;
    }

    public function ExeDelete($Id) {
        $this->Categoria = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

        $Content = null;

        if (!empty($this->Data['category_content'])):
            $Content = $this->Data['category_content'];
            unset($this->Data['category_content']);
        endif;

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        if (!empty($this->Data['category_title'])):
            $this->Data['category_name'] = Check::Name($this->Data['category_title']);
        endif;

        if (!empty($Content)):
            $this->Data['category_content'] = $Content;
        endif;

        if (!isset($this->Categoria)):
            $this->Data['category_date'] = date('Y-m-d H:i:s');
        endif;
    }

    private function verificarNome() {

        $where = (!empty($this->Categoria) ? "category_id != {$this->Categoria} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} category_title = :title", "title={$this->Data['category_title']}");
        if ($read->getResult()):
            $this->Data['category_name'] = $this->Data['category_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Categoria', "error"];
            $this->Result = false;
        else:
            $this->Error = ['Categoria ou Seção cadastrado com Sucesso!', "success"];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE category_id = :id", "id={$this->Categoria}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Categoria ou Seção", "error"];
            $this->Result = false;
        else:
            $this->Error = ["Categoria ou Seção Atualizada com Sucesso!", "success"];
            $this->Result = true;
        endif;
    }

    /**
     * <b>PostChangeCategory</b>: Migra os posts de uma categoria para a categoria padrão do sistema
     * @param type $Category
     */
    private function PostChangeCategory($Category) {

        $readPost = new Read;
        $updatePost = new Update;

        $Data = [
            'post_cat_parent' => BuscaRapida::buscarCategoriaName('secao-padrao')['category_id'],
            'post_category' => BuscaRapida::buscarCategoriaName('secao-padrao')['category_id'],
        ];

        $readPost->FullRead('SELECT post_id FROM ' . POSTS . " WHERE " .(empty(BuscaRapida::buscarCategoria($this->Categoria)['category_parent']) ? 'post_cat_parent' : 'post_category'). " = :category", "category={$Category}");

        if ($readPost->getResult()):

            foreach ($readPost->getResult() as $post):
                extract($post);
                $updatePost->ExeUpdate(POSTS, $Data, "WHERE post_id = :id", "id={$post_id}");
//                var_dump($updatePost->getResult());

            endforeach;

        endif;
    }

    /**
     * <b>DeleteCategory</b>: Deleta as categorias de uma determinada seção
     * @param type $Category
     */
    private function DeleteCategory($Category) {

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE category_id = :id", "id={$Category}");
    }

    private function Delete() {

        $delete = new Delete;

        // Verifica se categoria é uma seção
        if (empty(BuscaRapida::buscarCategoria($this->Categoria)['category_parent'])):

            $readCategories = new Read;

            // Verifica se há categorias pertencentes a seção a ser excluída
            $readCategories->FullRead('SELECT category_id FROM ' . self::Entity . " WHERE category_parent IS NOT NULL AND category_parent = :id", "id={$this->Categoria}");
            if ($readCategories->getResult()):

                foreach ($readCategories->getResult() as $category):
                    extract($category);

                    // Categoria pertencente a seção é excluída.
                    $this->DeleteCategory($category_id);

                endforeach;
            endif;

        endif;

        // Caso haja posts desta seção a ser excluida, eles serão migrados para uma categoria default do sistema
        $this->PostChangeCategory(BuscaRapida::buscarCategoria($this->Categoria)['category_id']);

        // Deleta a seção de fato    
        $delete->ExeDelete(self::Entity, "WHERE category_id = :id", "id={$this->Categoria}");

        // Mensagens de erro
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Categoria ou Seção", "error"];
            $this->Result = false;
        else:
            $this->Error = ["Categoria ou Seção Excluída com Sucesso!", "success"];
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
