<?php


namespace Source\Core;


class Documentos {
    private $filtro;
    
    public function __construct() {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $this->filtro = $filtro;
    }
    
    public function Upload() {
        
        if(!empty($this->filtro["ENVIAR_ARQUIVO"])){
            
             $Image = $_FILES["image"];

                $upload = new \Source\Support\Upload("./uploads/");
                $upload->Image($Image);
                $upload->getResult();
                
                $Dados = [
                    "cliente_id" => $this->filtro["cliente_id"],
                    "arquivo" => $upload->getResult(),
                    "data" => date("Y-m-d")
                ];
                
                $cad = new \Source\Models\Create();
                $cad->ExeCreate("app_documento", $Dados);
                $cad->getResult();
                if($cad->getResult()){
                  echo "<div class='alert alert-success'> Arquivo enviado com Sucesso </div>";  
                }else{
                  echo "<div class='alert alert-danger'> Erro ao enviar Arquivo </div>";    
                }
            
            //var_dump($this->filtro , $_FILES , $Dados);
        }
        
    }
}
