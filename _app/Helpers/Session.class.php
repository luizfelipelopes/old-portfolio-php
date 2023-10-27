<?php

/**
 * Session.class [ HELPERS ]
 * Responsável pelas estatísticas, sessões e atualizações de tráfego do sistema!
 * 
 * @copyright (c) 2017, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Session {

    private $Date;
    private $Cache;
    private $Traffic;
    private $Browser;

    public function __construct($Cache = null) {
        if (!empty(getenv('HTTP_USER_AGENT')) && !preg_match('~(bot|crawl)~i', $_SERVER['HTTP_USER_AGENT']) && !substr(strpos(getenv('HTTP_USER_AGENT'), 'netcraft'), 0) && !preg_match('~(cpanel|client)~i', $_SERVER['HTTP_USER_AGENT'])):
            if (!session_id()):
                session_start();
            endif;
            $this->CheckSession($Cache);
        endif;
    }

    // Verifica e executa todos os métodos da classe!
    private function CheckSession($Cache) {
        $this->Date = date('Y-m-d');
        $this->Cache = ( (int) $Cache ? $Cache : 20 );

        if (empty($_SESSION['useronline'])):
            $this->setTraffic();
            $this->setSession();
            $this->CheckBrowser();
            $this->setUsuario();
            $this->BrowserUpdate();
        else:
            $this->TrafficUpdate();
            $this->sessionUpdate();
            $this->CheckBrowser();
            $this->UsuarioUpdate();
        endif;

        $this->Date = null;
    }

    /**
     * *************************************************************
     * *************** SESSÂO DO USUÀRIO ***************************
     * *************************************************************
     */
    //Inicia a sessao do usuario
    private function setSession() {

//        filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP)
//        filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT)
//        filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_DEFAULT)

        $_SESSION['useronline'] = [
            "online_session" => session_id(),
            "online_startview" => date('Y-m-d H:i:s'),
            "online_endview" => date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes")),
            "online_ip" => getenv("REMOTE_ADDR"),
            "online_url" => strip_tags(getenv('REQUEST_URI')),
            "online_agent" => getenv('HTTP_USER_AGENT')
        ];

        if (isset($_SESSION['clientelogin']['cliente_id'])):

            $_SESSION['useronline'] += [
                "online_cliente" => $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname']
            ];


        endif;
    }

    //Atualiza a sessão do usuário
    private function sessionUpdate() {
        $_SESSION['useronline']['online_endview'] = date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes"));
        $_SESSION['useronline']['online_url'] = strip_tags(getenv('REQUEST_URI'));

        if (isset($_SESSION['clientelogin']['cliente_id'])):

            $_SESSION['useronline'] += [
                "online_cliente" => $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname']
            ];


        endif;
    }

    /**
     * ******************************************************
     * ******************USUAÀRIOS< VISITA E ATUALIZAÇÔES
     * ******************************************************
     */
    //Verifica e insere o tráfego na tabela
    private function setTraffic() {
        $this->getTraffic();
        if (!$this->Traffic):
            $ArrSiteViews = ['siteviews_date' => $this->Date, 'siteviews_users' => 1, 'siteviews_views' => 1, 'siteviews_pages' => 1];
            $createSiteViews = new Create();
            $createSiteViews->ExeCreate(SITEVIEWS, $ArrSiteViews);
        else:
            if (!$this->getCookie()):
                $ArrSiteViews = ['siteviews_users' => $this->Traffic['siteviews_users'] + 1, 'siteviews_views' => $this->Traffic['siteviews_views'] + 1, 'siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
            else:
                $ArrSiteViews = ['siteviews_views' => $this->Traffic['siteviews_views'] + 1, 'siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
            endif;

            $updateSIteViews = new Update;
            $updateSIteViews->ExeUpdate(SITEVIEWS, $ArrSiteViews, "WHERE siteviews_date = :date", "date={$this->Date}");

        endif;
    }

    //Verifica e atualiza os pageviews
    private function TrafficUpdate() {
        $this->getTraffic();
        $ArrSiteViews = ['siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
        $updatePageViews = new Update;
        $updatePageViews->ExeUpdate(SITEVIEWS, $ArrSiteViews, "WHERE siteviews_date = :date", "date={$this->Date}");

        $this->Traffic = null;
    }

    // Obtem dados da Tabela [HELPER TRAFFIC]
    //cetrhema_siteviews
    private function getTraffic() {
        $readSiteViews = new Read();
        $readSiteViews->ExeRead(SITEVIEWS, "WHERE siteviews_date = :date", "date={$this->Date}");
        if ($readSiteViews->getRowCount()):
            $this->Traffic = $readSiteViews->getResult()[0];
        endif;
    }

    //Verifica, cria e atualiza o cookie do usuáeio [ HELPER TRAFFIC ]
    private function getCookie() {
        $Cookie = filter_input(INPUT_COOKIE, 'useronline', FILTER_DEFAULT);
        setcookie("useronline", base64_encode("Upinside"), time() + 86400);
        if (!$Cookie):
            return false;
        else:
            return true;
        endif;
    }

    /**
     * ******************************************************
     * ************* NAVEGADORES DE ACESSO ******************
     * ******************************************************
     */
    //Identifica navegador do usuário

    private function CheckBrowser() {
        $this->Browser = $_SESSION['useronline']['online_agent'];
        if (strpos($this->Browser, 'Chrome') && !strpos($this->Browser, 'OPR/')):
            $this->Browser = 'Chrome';
        elseif (strpos($this->Browser, 'Firefox')):
            $this->Browser = 'Firefox';
        elseif (strpos($this->Browser, 'MSIE') || strpos($this->Browser, 'Trident/')):
            $this->Browser = 'IE';
        elseif (strpos($this->Browser, 'OPR/')):
            $this->Browser = 'Opera';
        else:
            $this->Browser = 'Outros';
        endif;
    }

    // Atualiza tabela com dados de navegadores
    private function BrowserUpdate() {
        $readAgent = new Read;
        $readAgent->ExeRead(SITEVIEWS_AGENT, "WHERE agent_name = :agent", "agent={$this->Browser}");
        if (!$readAgent->getResult()):
            $ArrAgent = ['agent_name' => $this->Browser, 'agent_views' => 1];
            $createAge = new Create;
            $createAge->ExeCreate(SITEVIEWS_AGENT, $ArrAgent);
        else:
            $ArrAgent = ['agent_views' => $readAgent->getResult()[0]['agent_views'] + 1];
            $updateAgent = new Update;
            $updateAgent->ExeUpdate(SITEVIEWS_AGENT, $ArrAgent, "WHERE agent_name = :name", "name={$this->Browser}");
        endif;
    }

    /**
     * ******************************************************
     * *************     USUÁRIOS ONLINE    *****************
     * ******************************************************
     */
    //Cadastra usuário online na tabela
    private function setUsuario() {
        $sesOnline = $_SESSION['useronline'];
        $sesOnline['agent_name'] = $this->Browser;
        $userCreate = new Create;
        $userCreate->ExeCreate(SITEVIEWS_ONLINE, $sesOnline);
    }

    //Atualiza navegação do usuário online
    private function UsuarioUpdate() {
        $ArrOnline = [
            'online_endview' => $_SESSION['useronline']['online_endview'],
            'online_url' => $_SESSION['useronline']['online_url']
        ];

        if (isset($_SESSION['clientelogin']['cliente_id'])):

            $ArrOnline += [
                "online_cliente" => $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname']
            ];


        endif;


        $userUpdate = new Update;
        $userUpdate->ExeUpdate(SITEVIEWS_ONLINE, $ArrOnline, "WHERE online_session = :ses", "ses={$_SESSION['useronline']['online_session']}");

        if (!$userUpdate->getRowCount()):
            $readSes = new Read;
            $readSes->ExeRead(SITEVIEWS_ONLINE, "WHERE online_session = :onses", "onses={$_SESSION['useronline']['online_session']}");

            if (!$readSes->getRowCount()):
                $this->setUsuario();
            endif;

        endif;
    }

}
