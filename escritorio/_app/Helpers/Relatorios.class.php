<?php

/**
 * Description of Trafego
 *
 * @author Disbiriflix
 */
class Relatorios {

    private $ip;
    private $data;


    function __construct() {
        
        $this->hoje();
        
        
       
      
    }

   public function hoje() {
       
       $agora = date("Y-m-d");
       
       $hoje = date("Y-m-d" , strtotime("-30 days" , strtotime($agora)));
       
       json_decode($hoje);
  
       
   }
   
  
}
