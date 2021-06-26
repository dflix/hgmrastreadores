<?php


/**
 *  Sessao.class.php[TIPO]
 * Classe responsavel por capturar trafego e visitas nas paginas
 * @copyright (c) year, Marcio Leite Up
 */
class Sessao {
   private $Date;
   private $Browser;
   private $Usuario;
   private $Cache;
   
   function __construct($Cache = null) {
       session_start();
   }

   public function CheckSession($Cache = null) {
       $this->date = date("Y-m-d H:i:s");
       
       echo $this->setSession();
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
    
}
