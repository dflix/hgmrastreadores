<?php


namespace Source\Core;


class Logotipo {
    
    private $filtro;
    
    public function __construct() {
      
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
    }
    
    public function Logo() {
        
         if (!empty($_FILES["image"])) {
                $Image = $_FILES["image"];
                
                var_dump($_FILES);

                $upload = new \Source\Support\Upload("./uploads/");
                $upload->Image($Image);
                $upload->getResult();
                if( $upload->getResult()){
                   
                    $Dados = [
                        "logo" => $upload->getResult(),
                        "title" => CONF_SITE_NAME
                    ];
                    
                    $up = new \Source\Models\Update();
                    $up->ExeUpdate("app_logo", $Dados, "WHERE id = :a", "a=1");
                    if($up->getResult()){
                        echo "<div class='alert alert-success'> Upload com Sucesso</div>";    
                    }
                    
                
                }else{
                 echo "<div class='alert alert-danger'> Erro</div>";    
                }
                
         }
        
    }
}
