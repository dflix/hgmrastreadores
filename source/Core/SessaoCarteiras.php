<?php



namespace Source\Core;

class SessaoCarteiras {
    
    public function __construct() {
         if (!session_id()) {
            session_start();
        }
    }
    
    public function sessaoCarteira() 
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
//        if(empty($_SESSION['carteira'])){
//            $read = new \Source\Models\Read();
//            $read->ExeRead("app_carterias", "WHERE user_id = :id AND free = :f", "id={$_SESSION['user_id']}&f=1");
//            $read->getResult();
//            
//            $_SESSION['carteira'] = $read->getResult()[0]['id'];
//            $_SESSION['nome_carteira'] = $read->getResult()[0]['wallet'];
//            
//        }
        
        if(!empty($data['carteira'])){
            
            if($data['carteira'] == "geral"){
                $_SESSION['carteira'] = "geral";
                $_SESSION['nome_carteira'] = "Geral";
            }else{
            
           $_SESSION['carteira'] = $data['carteira'];
            $nome = new \Source\Models\Read();
            $nome->ExeRead("app_carterias", "WHERE id = :id", "id={$data['carteira']}");
            $nome->getResult();
            $_SESSION['nome_carteira'] = $nome->getResult()[0]['wallet'];
        
     // var_dump($data , $_SESSION);
            
             // return  $_SESSION['carteira'];
          
            
        }
        
}}}   

