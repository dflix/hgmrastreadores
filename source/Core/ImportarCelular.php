<?php



namespace Source\Core;


class ImportarCelular {
    
    private $filtro;
    
    public function __construct() {
        
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->filtro = $filtro;
        
    }
    
    public function cadastra() {
        
        if($this->filtro){
            
          // $arquivo = $_FILES["arquivo"];
           
         $arquivo_tmp =  $_FILES["arquivo"]["tmp_name"];
         
         //ler aqrquivo em um array
         
        $dados = file($arquivo_tmp);
        
        foreach ($dados as $valor) {
            
           // var_dump($dados);
            $trata = explode(",", $valor);
            
            $trata[1] = str_replace(' ', '', $trata[1]);
            $trata[1] = str_replace('(', '', $trata[1]);
            $trata[1] = str_replace(')', '', $trata[1]);
            $trata[1] = str_replace('-', '', $trata[1]);
            
            $Dados = [
                "nome" => $trata[0],
                "telefone" => $trata[1],
                "vendedor" => NULL,
                "data" => NULL,
                "enviado" => "0",
                "obs" => NULL
            ];
//            
          // var_dump($Dados);
            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_marketing", $Dados);
            $cad->getResult();
            if($cad->getResult()){
                echo "cadastrado com sucesso";
            }else{
                echo "erro ao cadastrar";
            }
            
      //    echo $valor = trim($valor) . "</br>";
        }
            
         //  var_dump($this->filtro , $dados );
        }
        
    }
    
}
