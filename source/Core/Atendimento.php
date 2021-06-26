<?php


namespace Source\Core;


class Atendimento {
    
    private $filtro;
    
    public function __construct() {
       
       $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
       
       $this->filtro = $filtro;
        
    }
    
    public function Cadastra() {
        
        if(!empty($this->filtro["cadastrar"])){
            
            $Dados = [
                "user_id" => $this->filtro["user_id"],
                "cliente_id" => $this->filtro["cliente_id"],
                "ocorrencia" => $this->filtro["ocorrencia"],
                "data" => $this->filtro["date"]
            ];
            
            $cadastra = new \Source\Models\Create();
            $cadastra->ExeCreate("app_atendimento", $Dados);
            $cadastra->getResult();
            if($cadastra->getResult()){
             
                echo "<div class='alert alert-success'> Atendimento cadastrado com sucessso </div>";
                
            }else{
                
                 echo "<div class='alert alert-danger'> Erro ao cadastrar Atendimento </div>";
                
            }
            
           // var_dump($this->filtro , $Dados);
        }
        
    }
    
}
