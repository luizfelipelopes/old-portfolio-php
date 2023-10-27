<?php

/**
 * LoginCliente.class [ MODEL ]
 * Responsável por autenticar, validar, e checar o cliente do site!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class LoginCliente {

    private $Level;
    private $Email;
    private $Senha;
    private $Error;
    private $Result;

    function __construct($Level) {
        $this->Level = (int) $Level;
    }

    public function ExeLogin(array $UserData) {
        $this->Email = (string) strip_tags(trim($UserData['cliente_email']));
        $this->Senha = (string) strip_tags(trim($UserData['cliente_senha']));
        $this->setLogin();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    public function CheckLogin() {
        if (isset($_SESSION['userlogin'])):
            return true;
        elseif (empty($_SESSION['clientelogin']) || (isset($_SESSION['clientelogin']['cliente_level']) && $_SESSION['clientelogin']['cliente_level'] < $this->Level)):
            unset($_SESSION['clientelogin']); //Mata sessão
            return false;
        else:
            return true;
        endif;
    }

    private function setLogin() {
        if (!$this->Email || !$this->Senha):
            $this->Error = ['Informe seu E-mail e senha para efetuar o login', WS_ALERT];
            $this->Result = false;
        elseif (!Check::Email($this->Email)):
            $this->Error = ['E-mail inválido! Favor colocar um e-mail válido!', WS_ALERT];
            $this->Result = false;
        elseif (!$this->getUser()):
            $this->Error = ['Os dados informados nao são compatíveis', WS_ALERT];
            $this->Result = false;
        else:
            $this->Execute();
        endif;
    }

    private function getUser() {

        //Aqui a senha é passada criptografada em md5
        $this->Senha = substr(md5($this->Senha), 0, 16);
//        echo $this->Senha;

        $read = new Read;
        $read->ExeRead(CLIENTES, "WHERE cliente_email = :e AND cliente_senha = :p", "e={$this->Email}&p={$this->Senha}");
        if ($read->getResult()):
            $this->Result = $read->getResult()[0];
            return true;
        else:
            return false;
        endif;
    }

    private function Execute() {
        if (!session_id()):
            session_start();
        endif;

        $_SESSION['clientelogin'] = $this->Result;
        $_SESSION['clientelogin']['venda_registro'] = Check::Name($_SESSION['clientelogin']['cliente_name']) . '-' . $_SESSION['clientelogin']['cliente_id'] . '-' . date('Y-m-d') . '-' . substr(md5(time() + 1), 0, 10);
        $this->Error = ["Olá {$this->Result['cliente_name']}, seja bem vindo(a). Aguarde redirecionamento!", WS_ACCEPT];
        $this->Result = true;
    }

}
