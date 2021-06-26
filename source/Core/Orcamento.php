<?php


namespace Source\Core;

class Orcamento {
    
    private $filtro;
    
    public function __construct() {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $this->filtro = $filtro;
    }
    
    public function enviarEmail() {
        
        if($this->filtro["modo"] == "email"){
            
            $marca = explode("|", $this->filtro["marca1"]);
            $modelo = explode("|", $this->filtro["modelo1"]);
            $ano = explode("|", $this->filtro["ano1"]);
            
            $mensagem = "<h1>HGM RASTREADORES</h1>"
                    . "<p><b>Olá {$this->filtro["nome"]}</b></p> "
                    . "<p> Recebemos com sucesso orçamento veiculo </p>"
                            . "<p> Veiculo Tipo {$this->filtro["veiculo"]} </p>"
                            . "<p>Marca {$marca[0]} </p>"
                            . "<p>Modelo {$modelo[3]} </p>"
                            . "<p>Ano {$ano[4]} </p>"
                            . "<p>Valor {$this->filtro["valor"]} </p>"
                            . "<p>FIPE {$this->filtro["fipe"]} </p>"
                            . "<p>Estamos realizando o orçamento , aguarde mais informações  </p>"
                                    . "<p>Ou Ligue (11)9 9534-7531 Whatsapp</p>";
            
           $view = new \Source\Models\View(__DIR__ . "/../../themes/views/email");
           $message = $view->render("mail", [
               "message" => $mensagem
               
           ]);
            
            $email = new \Source\Support\Email();
            $email->bootstrap(
                    "ORÇAMENTO HGM RASTREADORES", 
                    $message, 
                    $this->filtro["email"], 
                    $this->filtro["nome"])->send($this->filtro["email"]);
            

            
             $Dados = [
                   
                    "nome" => $this->filtro["nome"],
                    "email" => $this->filtro["email"],
                    "telefone" => $this->filtro["telefone"],
                    "veiculo" => $this->filtro["veiculo"],
                    "marca" => $marca[0],
                    "modelo" => $modelo[3],
                    "ano" => $ano[4],
                    "valor" => $this->filtro["valor"],
                    "fipe" => $this->filtro["fipe"],
                    "date" => date("Y-m-d H:i:s")
                ];
             
               // var_dump($Dados);
            
            if($email->send()){
                echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
                <h5>Orçamento Enviado com Sucesso </h5>  </div>";
                
                $Dados = [
                   
                    "nome" => $this->filtro["nome"],
                    "email" => $this->filtro["email"],
                    "telefone" => $this->filtro["telefone"],
                     "veiculo" => $this->filtro["veiculo"],
                    "marca" => $marca[0],
                    "modelo" => $modelo[3],
                    "ano" => $ano[4],
                    "valor" => $this->filtro["valor"],
                    "fipe" => $this->filtro["fipe"],
                    "data" => date("Y-m-d H:i:s")
                ];
                
                $cad = new \Source\Models\Create();
                $cad->ExeCreate("app_leads", $Dados);
                
            //  var_dump($Dados);
                
            }else{
                echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
                <h5>Erro ao enviar mensagem </h5>  </div>"; 
                
                  var_dump($Dados);
            }
 
           // var_dump($this->filtro);
        }
    }
    
    public function whatsapp() {
        
        if($this->filtro["modo"] == "whatsapp"){
            
            $Dados = [
                "nome" => $this->filtro["nome"],
                "user_id" => $_SESSION["user_id"],
                "telefone" => $this->filtro["telefone"],
                "mensagem" => $this->filtro["mensagem"],
                "modo" => "whatsapp",
                "date" => date("Y-m-d H:i:s")     
            ];
            
            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_orcamento", $Dados);
            $cad->getResult();
            
            if($cad->getResult()){
               echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
                <h5>Mensagem criada com sucesso .</h5>  </div>";  
            }else{
               echo "<div class=\"alert alert-danger col-md-12\" role=\"alert\">
                <h5>Erro ao criar mensagem .</h5>  </div>";    
            }
            
            
           // var_dump($this->filtro , $Dados);
        }
        
    }
    
    
    
}
