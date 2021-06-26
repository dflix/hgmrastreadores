<?php

/**
 *  Session.class.php[HELPER]
 * Classe responcavel pelas estatisticas e atualizações de tráfego do sistema
 * @copyright (c) year, Marcio Leite Up
 */
class Session {

    private $Date;
    private $Cache;
    private $Traffic;
    private $Browser;

    //Verifica e executa todos os metodos da classe
    function __construct($Cache = null) {
        session_start();
        $this->CheckSession($Cache);
    }

    private function CheckSession($Cache = null) {
        $this->Date = date('Y-m-d');
        $this->Cache = ( (int) $Cache ? $Cache : 20);

        if (empty($_SESSION['useronline'])):
            $this->setTraffic();
            $this->setSession();
            $this->CheckBrowser();
            $this->setUsuario();
            $this->BrowserUpdate();
        else:
            
            $this->setSession();

            $this->TrafficUpdate();
            $this->sessionUpdate();
            $this->CheckBrowser();
            $this->BrowserUpdate();
            $this->usuarioUpdate();


        endif;

        $this->Date = null;
    }

    //Inicia a sessão odo usuario
    public function setSession() {
        $_SESSION['useronline'] = [
            "online_session" => session_id(),
            "online_startview" => date('Y-m-d H:i:s'),
            "online_endview" => date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes")),
            "online_ip" => filter_input(INPUT_SERVER, $_SERVER["REMOTE_ADDR"], FILTER_VALIDATE_IP),
            "online_url" => filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT),
            "online_agent" => filter_input(INPUT_SERVER, "HTTP_USER_AGENT", FILTER_DEFAULT)
        ];
    }

    //Atualiza sessão do usuário
    private function sessionUpdate() {
        $_SESSION['useronline']['online_endview'] = date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes"));
        $_SESSION['useronline']['online_url'] = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
    }

    //Verifica e insere o trafego na tabela

    private function setTraffic() {
        $this->getTraffic();
        if (!$this->Traffic):
            $ArrSiteViews = ['siteviews_date' => $this->Date, 'siteviews_users' => 1, 'siteviews_views' => 1, 'siteviews_pages' => 1];
            $createSiteViews = new Create;
            $createSiteViews->ExeCreate('ws_siteviews', $ArrSiteViews);
        else:
            if (!$this->getCookie()):
                $ArrSiteViews = [ 'siteviews_users' => $this->Traffic['siteviews_users'] + 1, 'siteviews_views' => $this->Traffic['siteviews_views'] + 1, 'siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
            else:
                $ArrSiteViews = [ 'siteviews_views' => $this->Traffic['siteviews_views'] + 1, 'siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
            endif;

            $updateSiteViews = new Update;
            $updateSiteViews->ExeUpdate('ws_siteviews', $ArrSiteViews, "WHERE siteviews_date = :date", "date={$this->Date}");


        endif;
    }

    //Verifica e atualiza osp ageviews
    private function TrafficUpdate() {
        $this->getTraffic();
        $ArrSiteViews = [ 'siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
        $updatePageViews = new Update;
        $updatePageViews->ExeUpdate('ws_siteviews', $ArrSiteViews, "WHERE siteviews_date = :date", "date={$this->Date}");

        $this->Traffic = null;
    }

    //Obtem dados da Tabela [HELPER TRAFFIC]
    private function getTraffic() {

        $readSiteViewes = new Read;
        $readSiteViewes->ExeRead('ws_siteviews', "WHERE siteviews_date = :date", "date={$this->Date}");
        if ($readSiteViewes->getRowCount()):
            $this->Traffic = $readSiteViewes->getResult()[0];

        endif;
    }

    //verifica , cria e atualiza o cookie do usuário [ HELPER TRAFFIC ]

    private function getCookie() {

        $Cookie = filter_input(INPUT_COOKIE, 'user_online', FILTER_DEFAULT);
        setcookie("user_online", base64_encode("Protege Facil"), time() + 86400);
        if (!$Cookie):
            return false;
        else:
            return true;
        endif;
    }

    /**
     * ********************************************
     * *********** NAVEGADORES DE ACESSO **********
     * ********************************************
     */
    //Identifica navegador do usuario
    private function CheckBrowser() {
        $this->Browser = $_SESSION['useronline']['online_agent'];
        if (strpos($this->Browser, 'Chrome')):
            $this->Browser = 'Chrome';
        elseif (strpos($this->Browser, 'Firefox')):
            $this->Browser = 'Firefox';
        elseif (strpos($this->Browser, 'MSIE') || strpos($this->Browser, 'Trident/')):
            $this->Browser = 'IE';
        else:
            $this->Browser = 'Outros';
        endif;
    }

    //Atualiza tabela com dados de navegadores
    private function BrowserUpdate() {
        $readAgent = new Read;
        $readAgent->ExeRead('ws_siteviews_agent', "WHERE agent_name = :agent", "agent={$this->Browser}");

        if (!$readAgent->getRowCount()):
            $ArrAgent = ['agent_name' => $this->Browser, 'agent_views' => 1];
            $createAgent = new Create;
            $createAgent->ExeCreate('ws_siteviews_agent', $ArrAgent);
        else:
            $ArrAgent = ['agent_views' => $readAgent->getResult()[0]['agent_views'] + 1];
            $updateAgent = new Update;
            $updateAgent->ExeUpdate('ws_siteviews_agent', $ArrAgent, "WHERE agent_name = :name", "name={$this->Browser}");

        endif;
    }

    /**
     * ********************************************
     * *********** NAVEGADORES DE ACESSO **********
     * ********************************************
     */
    //Cadastra usuário online na tabela

    private function setUsuario() {
        $sesOnline = $_SESSION['useronline'];
        $sesOnline['agent_name'] = $this->Browser;

        $userCreate = new Create;
        $userCreate->ExeCreate('ws_siteviews_online', $sesOnline);
    }

    //Atualiza navegação do usuário online
    private function usuarioUpdate() {
        $ArrOnline = [
            'online_endview' => $_SESSION['useronline']['online_endview'],
            'online_url' => $_SESSION['useronline']['online_url']
        ];

        $userUpdate = new Update;
        $userUpdate->ExeUpdate('ws_siteviews_online', $ArrOnline, "WHERE online_session = :ses", "ses={$_SESSION['useronline']['online_session']}");

        if (!$userUpdate->getRowCount()):
            $readSes = new Read;
            $readSes->ExeRead('ws_siteviews_online', "WHERE online_session = :onses", "onses={$_SESSION['useronline']['online_session']}");
            if(!$readSes->getRowCount()):
                $this->setUsuario();
            endif;
        endif;

      
    }

}
