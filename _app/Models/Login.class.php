<?php

/**
 * Login.class [ MODEL ]
 * Responsável por autenticar, validar, e checar usuário do sistema de login!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Login {

    private $Level;
    private $Email;
    private $Senha;
    private $Error;
    private $Result;

    function __construct($Level) {
        $this->Level = (int) $Level;
    }

    public function ExeLogin(array $UserData) {
        $this->Email = (string) strip_tags(trim($UserData['user_email']));
        $this->Senha = (string) strip_tags(trim($UserData['user_password']));
        $this->setLogin();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    public function CheckLogin() {
        if (empty($_SESSION['userlogin']) || $_SESSION['userlogin']['user_level'] < $this->Level):
            unset($_SESSION['useronline']); //Mata sessão
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
        elseif ($this->Result['user_level'] < $this->Level):
            $this->Error = ["Desculpe {$this->Result['user_name']}, você não tem permissão para acessar esta área!", WS_ERROR];
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
        $read->ExeRead(USUARIOS, "WHERE user_email = :e AND user_password = :p", "e={$this->Email}&p={$this->Senha}");
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

        $_SESSION['userlogin'] = $this->Result;
        $this->Error = ["Olá {$this->Result['user_name']}, seja bem vindo(a). Aguarde redirecionamento!", WS_ACCEPT];
        $this->Result = true;
    }

}
