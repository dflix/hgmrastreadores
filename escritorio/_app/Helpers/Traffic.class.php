<?php

/**
 * Classe responsavel por capturar trafego di ste
 *
 * @author usuario
 */
class Traffic {

    private $ip;
    private $local;
    private $data;
    private $navegador;
    private $system;
    private $dados;

    function __construct() {

        $this->ip = $this->ip;
        $this->local = $this->local;
        $this->data = $this->data;
        $this->navegador = $this->navegador;
        //$this->sessao = $_SESSION['useronline'];
        $this->system = $this->system;
        $this->dados = $this->dados;

        $this->Local();

        $this->CheckBrowser();
        $this->CheckSystem();
        $this->Cadastra();
    }

    public function Local() {
        $this->local = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
        $this->local = ($this->local ? $this->local : 'index');
        //$this->local = explode("/", $this->local);

        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->data = date('Y-m-d H:i:s');
    }

    private function CheckBrowser() {

        $this->navegador = $_SERVER['HTTP_USER_AGENT'];



        if (strpos($this->navegador, 'Chrome')):
            $this->navegador = 'Chrome';
        elseif (strpos($this->navegador, 'Firefox')):
            $this->navegador = 'Firefox';
        elseif (strpos($this->navegador, 'MSIE') || strpos($this->navegador, 'Trident/')):
            $this->navegador = 'IE';
        else:
            $this->navegador = 'Outros';
        endif;
    }

    private function CheckSystem() {
        $mobile = FALSE;
        $user_agents = array("iPhone", "iPad", "Android", "webOS", "BlackBerry", "iPod", "Symbian", "IsGeneric");

        foreach ($user_agents as $user_agent) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
                $mobile = TRUE;
                $modelo = $user_agent;
                break;
            }
        }

        if ($mobile) {
            $this->system = strtolower($modelo);
        } else {
            $this->system = "computador";
        }
    }

    private function Cadastra() {

        $this->dados = [
            "url => $this->local",
            "ip => $this->ip",
            "navegador => $this->navegador",
            "system => $this->system",
            "data => $this->data"
        ];

        $cad = new Create;
        $cad->ExeCreate('ws_traffic', $this->dados);
        $cad->getResult();
    }

}
