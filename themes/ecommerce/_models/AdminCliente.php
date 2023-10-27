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

    const Entity = "cardi_clientes";

    public function ExeCreate(array $Data) {


        $this->Data = $Data;

        if (in_array("", $this->Data)):
            $this->Error = ["Por favor, preencha todos os campos", WS_ALERT];
            $this->Result = false;

        elseif (!Check::validarCpf($this->Data['cliente_cpf'])):
            $this->Error = ["CPF inválido! Por favor utilize um CPF válido.", WS_ERROR];
            $this->Result = false;

        elseif (!Check::verificarTelefone($this->Data['cliente_telefone'], 9)):
            $this->Error = ["Formato de Telefone ou Celular Inválido. Verifique seu telefone!", WS_ERROR];
            $this->Result = false;

        elseif (!Check::Email($this->Data['cliente_email'])):

            $this->Error = ["Imail inválido! Por favor utilize um email válido.", WS_ALERT];
            $this->Result = false;

        elseif ($this->verificarEmailExistente()):
            $this->Error = ["Este email já existe! Favor utilizar outro email.", WS_ALERT];
            $this->Result = false;
        else:

            $this->tratarDados();
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

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['cliente_cpf'] = $this->montarCPF($this->Data['cliente_cpf']);
        $this->Data['cliente_senha'] = md5($this->Data['cliente_senha']);
        $this->Data['cliente_registro'] = date('Y-m-d H:i:s');
    }

    private function montarCPF($cpf) {
        return substr($cpf, 0, 3) . substr($cpf, 4, 3) . substr($cpf, 8, 3) . substr($cpf, 12, 2);
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

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar. Por favor, tente novamente!", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["Cadastrado realizado com sucesso. Agora você pode entrar e comprar!", WS_ACCEPT];
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
