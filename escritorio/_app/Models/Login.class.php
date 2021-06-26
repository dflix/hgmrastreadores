<?php

/**
 * Login.class [ MODEL ]
 * Responável por autenticar, validar, e checar usuário do sistema de login!
 * 
 * @copyright (c) 2014, Marcio Leite mblvendas@hotmail.com
 */
class Login {

    private $Level;
    private $Email;
    private $Senha;
    private $Error;
    private $Result;

    /**
     * <b>Informar Level:</b> Informe o nível de acesso mínimo para a área a ser protegida.
     * @param INT $Level = Nível mínimo para acesso
     */
    function __construct($Level) {
        $this->Level = (int) $Level;
    }

    public function ExeLogin(array $UserData) {
        $this->Email = strip_tags(trim($UserData['user']));
        $this->Senha = strip_tags(trim($UserData['pass']));
        $this->setLogin();
    }

    public function getResult() {
        return $this->Result;
    }

    public function CheckLogin() {
        if (empty($_SESSION['userlogin']) || $_SESSION['userlogin']['user_level'] < $this->Level):
            unset($_SESSION['userlogin']);
            return false;
        else:
            return true;
        endif;
    }

    public function getError() {
        return $this->Error;
    }

    //PRIVATES

    public function setLogin() {
        if (!$this->Email || !$this->Senha || !Check::Email($this->Email)):
            $this->Error = ['Informe seu E-mail e senha para efetuar Login', WS_ALERT];
            $this->Result = false;
        elseif ($this->getUser()):
            $this->Error = ['Os dados informados não são compativeis', WS_ERROR];
            $this->Result = false;
        elseif ($this->Result < $this->Level):
            $this->Error = ["Os dados informados não são compativeis", WS_ERROR];
            $this->Result = false;
        else:
            $this->Execute();
        endif;
    }

    public function getUser() {
        $this->Senha = $this->Senha;
        $read = new Read;
        $read->ExeRead("ws_users", "WHERE user_email = :e AND user_password = :p", "e={$this->Email}&p={$this->Senha}");
        if ($read->getResult()):
            $this->Result = $read->getResult()[0];

        endif;
    }

    private function Execute() {
        if (!session_id()):
            session_start();
        endif;
        $_SESSION['userlogin'] = $this->Result;
        $this->Error = ["Ola {$this->Result['user_name']} ,seja bem vindo(a).Aguarde redirecionamento", WS_ACCEPT];
        $this->Result = true;
    }

}
