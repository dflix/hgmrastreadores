<?php

namespace Source\Core;

use Source\Core\SessaoCarteiras;

class SessionUser {
    
    public function __construct() {
        if (!session_id()) {
            session_start();
        }
       
    }
    
    public function start(int $data) {
        
        $read = new \Source\Models\Read();
        $read->ExeRead("usuarios", "WHERE id = :id", "id={$data}");
        $read->getResult();
        
        $_SESSION['user_id'] = $read->getResult()[0]['id'];
        $_SESSION['email_user'] = $read->getResult()[0]['email'];
        $_SESSION['nome'] = $read->getResult()[0]['first_name'];
        $_SESSION['nivel'] = $read->getResult()[0]['nivel'];
        $_SESSION['carteira'] = "Empresa";
        $_SESSION['nome_carteira'] = "Empresa";
        
        
        
    }
    
    
}
