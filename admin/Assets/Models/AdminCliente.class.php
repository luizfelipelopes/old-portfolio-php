<?php

/**
 * AdminCliente [ MODEL SITE ]
 * Classe responsável por tratar e modelar os dados de cadastro do CLiente 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class AdminCliente {

    private $Cliente;
    private $Data;
    private $Error;
    private $Result;

    const Entity = CLIENTES;

    public function ExeCreate(array $Data) {


        $this->Data = $Data;

        if (in_array("", $this->Data)):
            $this->Error = ["Por favor, preencha todos os campos", WS_ALERT];
            $this->Result = false;

        elseif (!Check::Email($this->Data['cliente_email'])):

            $this->Error = ["Imail inválido! Por favor utilize um email válido.", WS_ALERT];
            $this->Result = false;

        elseif ($this->verificarEmailExistente()):
            $this->Error = ["Este email já existe! Favor utilizar outro email.", WS_ALERT];
            $this->Result = false;
        else:

            $this->tratarDados();
            $this->verificarImagem();
            $this->Create();

        endif;
    }

    public function ExeUpdate($Id, array $Data) {


        $this->Cliente = (int) $Id;
        $this->Data = $Data;

        if (in_array("", $this->Data)):
            $this->Error = ["Por favor, preencha todos os campos", WS_ALERT];
            $this->Result = false;

        elseif (isset($this->Data['cliente_email']) && !Check::Email($this->Data['cliente_email'])):

            $this->Error = ["Imail inválido! Por favor utilize um email válido.", WS_ALERT];
            $this->Result = false;

        elseif (isset($this->Data['cliente_email']) && $this->verificarEmailExistente()):
            $this->Error = ["Este email já existe! Favor utilizar outro email.", WS_ALERT];
            $this->Result = false;
        else:

            $this->tratarDados();
            $this->verificarImagemUpload();
            $this->Update();

        endif;
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

    // PRIVATES
    private function tratarDados() {

        $Cover = null;

        if (isset($this->Data['cliente_cover'])):
            $Cover = $this->Data['cliente_cover'];
            unset($this->Data['cliente_cover']);
        endif;

        if (isset($this->Data['cliente_declaracao'])):
            $Declaracao = $this->Data['cliente_declaracao'];
            unset($this->Data['cliente_declaracao']);
        endif;

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        if (!empty($this->Data['cliente_cpf'])):
            $this->Data['cliente_cpf'] = str_replace([".", "-", " "], "", $this->Data['cliente_cpf']);
        endif;
        if (!empty($this->Data['cliente_telefone'])):
            $this->Data['cliente_telefone'] = str_replace([".", "-", " ", "(", ")"], "", $this->Data['cliente_telefone']);
        endif;

        if (!empty($this->Data['cliente_rg'])):
            $this->Data['cliente_rg'] = str_replace([".", " ", "-"], "", $this->Data['cliente_rg']);
        endif;

        if (!empty($this->Data['cliente_cep'])):
            $this->Data['cliente_cep'] = str_replace([".", "-", " ", "(", ")"], "", $this->Data['cliente_cep']);
        endif;

        if (isset($Cover)):
            $this->Data['cliente_cover'] = $Cover;
        endif;

        if (isset($Declaracao)):
            $this->Data['cliente_declaracao'] = $Declaracao;
        endif;

        if (isset($this->Data['cliente_senha']) && !isset($this->Cliente)):
            $this->Data['cliente_senha'] = substr(md5($this->Data['cliente_senha']), 0, 16);
        elseif (isset($this->Data['cliente_senha']) && $this->Data['cliente_senha'] == 'null'):
            $this->Data['cliente_senha'] = null;
        elseif (!empty($this->Data['cliente_senha'])):
            if (BuscaRapida::buscarCliente($this->Cliente)['cliente_senha'] != substr(md5($this->Data['cliente_senha']), 0, 16)):
                $this->Data['cliente_senha'] = substr(md5($this->Data['cliente_senha']), 0, 16);
            endif;
        endif;

        if (!$this->Cliente):
            $this->Data['cliente_registro'] = date('Y-m-d H:i:s');
            $this->Data['cliente_level'] = '1';
        endif;
    }

    private function verificarEmailExistente() {

        $Where = ($this->Cliente ? "cliente_id != {$this->Cliente} AND " : '');

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE {$Where} cliente_email = :email", "email={$this->Data['cliente_email']}");
        if ($read->getResult()):
            return true;
        endif;
        return false;
    }

    private function verificarImagem() {

        if (isset($this->Data['cliente_cover']) && is_array($this->Data['cliente_cover'])):

            $upload = new Upload('../../uploads');
            $upload->Image($this->Data['cliente_cover'], Check::Name($this->Data['cliente_name']), null, '/usuarios');

            if (!$upload->getResult()):
                $this->Data['cliente_cover'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['cliente_cover'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if (isset($this->Data['cliente_cover']) && is_array($this->Data['cliente_cover'])) {

            $readCapa = new Read;
            $readCapa->ExeRead("cetrhema_clientes", "WHERE cliente_id = :id", "id={$this->Cliente}");
            if ($readCapa->getResult()):

                $capa = '../../uploads' . $readCapa->getResult()[0]['cliente_cover'];

                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $upload = new Upload("../../uploads");
                $upload->Image($this->Data['cliente_cover'], Check::Name($this->Data['cliente_name']), null, "/usuarios");
                if (!$upload->getResult()):
                    unset($this->Data['cliente_cover']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['cliente_cover'] = $upload->getResult();
                    $this->Result = true;
                endif;



            endif;
        }
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar. Por favor, tente novamente!", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["Cadastrado realizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update();
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE cliente_id = :id", "id={$this->Cliente}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao atualizar. Por favor, tente novamente!", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["Cadastrado atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}
