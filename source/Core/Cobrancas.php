<?php


namespace Source\Core;


class Cobrancas {
    private $filtro;
    
    public function __construct() {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $this->filtro = $filtro;
    }
    
    public function Upload() {
        
        if(!empty($this->filtro["ENVIAR_COBRANCA"])){
            
             $Image = $_FILES["image"];

                $upload = new \Source\Support\Upload("./uploads/");
                $upload->file($Image);
               echo $upload->getResult();
                
                if($upload->getResult()){
                    echo "Upload com sucesso";
                }
                
                $Dados = [
                    
                    "pdf_boleto" => $upload->getResult()
                    
                ];
                
                $atualiza = new \Source\Models\Update();
                $atualiza->ExeUpdate("app_faturas", $Dados , "WHERE id = :a", "a={$this->filtro["fatura_id"]}");
                $atualiza->getResult();
                if($atualiza->getResult()){
                  echo "<div class='alert alert-success'> Arquivo enviado com Sucesso </div>";  
                }else{
                  echo "<div class='alert alert-danger'> Erro ao enviar Arquivo </div>";    
                }
                

            
           // var_dump($this->filtro , $_FILES , $Dados );
        }
        
    }
}
