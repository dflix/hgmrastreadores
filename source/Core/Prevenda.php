<?php


namespace Source\Core;

class Prevenda {
   
    private $filtro;
    
    public function __construct() {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $this->filtro = $filtro;
        
    }
    
    public function Cadastro() {
        
        if($this->filtro){
            
            $DadosInstalacao = [
                "user_id" => $_SESSION["user_id"],
                "title" => $this->filtro["title"] . " " . $this->filtro["placa"] ,
                "color" => $this->filtro["color"],
                "start" => $this->filtro["start_dia"] . " " .  trim($this->filtro["start_horas"]) . ":" . $this->filtro["start_minutos"],
                "end" => $this->filtro["start_dia"] . " " .  trim($this->filtro["start_horas"]) . ":" . $this->filtro["start_minutos"],
                "placa" => $this->filtro["placa"]
            ];
            
            $marca = explode("|", $this->filtro["marca1"]);
            $modelo = explode("|", $this->filtro["modelo1"]);
            $ano = explode("|", $this->filtro["ano1"]);
            
            $caixapostal = $this->filtro["cep"];
            
            $Dados = [
                "contrato" => $this->filtro["contrato"],
                "nome" => $this->filtro["nome"],
                "cpf_cnpj" => $this->filtro["cpf_cnpj"],
                "rg_ie" => $this->filtro["rg_ie"],
                "email" => $this->filtro["email"],
                "telefone" => $this->filtro["telefone"],
                "celular" => $this->filtro["celular"],
                "caixa_postal" => $caixapostal,
                "logradouro" => $this->filtro["logradouro"],
                "numero" => $this->filtro["numero"],
                "complemento" => $this->filtro["complemento"],
                "bairro" => $this->filtro["bairro"],
                "cidade" => $this->filtro["cidade"],
                "uf" => $this->filtro["uf"],
                "veiculo" => $this->filtro["veiculo"],
                "marca" => $marca[0],
                "modelo" => $modelo[3],
                "ano" => $ano[4],
                "cor" => $this->filtro["cor"],
                "placa" => $this->filtro["placa"],
                "renavam" => $this->filtro["renavam"],
                "chassi" => $this->filtro["chassi"],
                "fipe" => $this->filtro["fipe"],
                "valor" => $this->filtro["valor"],
                "plano" => $this->filtro["plano"],
                "descricao_plano" => $this->filtro["plano_desc"],
                "mensalidade" => $this->filtro["plano_valor"],
                "assistencia" => $this->filtro["assistencia"],
                "adesao" => $this->filtro["adesao"],
                "forma_pagamento_adesao" => $this->filtro["forma_pagamento_adesao"],
                "vendedor" => $this->filtro["vendedor"],
                "equipamento_empresa" => $this->filtro["equipamento_empresa"],
                "equipamento" => $this->filtro["equipamento"],
                "chip" => $this->filtro["chip"],
                "login" => $this->filtro["login"],
                "senha" => $this->filtro["senha"],
                "status" => $this->filtro["status"],
                "observacao" => $this->filtro["observacao"],
                "central" => $this->filtro["central"],
                "instalacao" => $this->filtro["instalacao"],
                "id_contrato" => $this->filtro["id_contrato"]
                
            ];
            
            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_prevenda", $Dados);
            $cad->getResult();
            if( $cad->getResult()){
              echo "<div class='alert alert-success'> Prevenda cadastrada com sucesso </div>"; 
              
              $agenda = new \Source\Models\Create();
              $agenda->ExeCreate("eventos", $DadosInstalacao);
              $agenda->getResult();
              if($agenda->getResult()){
                 echo "Sucesso"; 
              }else{
                  echo "Deu merda";
              }
              
            }else{
               echo "<div class='alert alert-danger'> Erro ao Cadastrear venda </div>";   
            }
            
         
        }
        
    }
    
    public function Update() {
        
        if($this->filtro){
            
            $DadosInstalacao = [
                "user_id" => $_SESSION["user_id"],
                "title" => $this->filtro["title"] . " " . $this->filtro["placa"] ,
                "color" => $this->filtro["color"],
                "start" => $this->filtro["start_dia"] . " " .  trim($this->filtro["start_horas"]) . ":" . $this->filtro["start_minutos"],
                "end" => $this->filtro["start_dia"] . " " .  trim($this->filtro["start_horas"]) . ":" . $this->filtro["start_minutos"],
                "placa" => $this->filtro["placa"]
            ];
            
            $marca = explode("|", $this->filtro["marca1"]);
            $modelo = explode("|", $this->filtro["modelo1"]);
            $ano = explode("|", $this->filtro["ano1"]);
            
            $caixapostal = $this->filtro["cep"];
            
            $Dados = [
                "contrato" => $this->filtro["contrato"],
                "nome" => $this->filtro["nome"],
                "cpf_cnpj" => $this->filtro["cpf_cnpj"],
                "rg_ie" => $this->filtro["rg_ie"],
                "email" => $this->filtro["email"],
                "telefone" => $this->filtro["telefone"],
                "celular" => $this->filtro["celular"],
                "caixa_postal" => $caixapostal,
                "logradouro" => $this->filtro["logradouro"],
                "numero" => $this->filtro["numero"],
                "complemento" => $this->filtro["complemento"],
                "bairro" => $this->filtro["bairro"],
                "cidade" => $this->filtro["cidade"],
                "uf" => $this->filtro["uf"],
                "veiculo" => $this->filtro["veiculo"],
                "marca" => $marca[0],
                 "modelo" => $modelo[3],
                "ano" => $ano[4],
                "cor" => $this->filtro["cor"],
                "placa" => $this->filtro["placa"],
                "renavam" => $this->filtro["renavam"],
                "chassi" => $this->filtro["chassi"],
                "fipe" => $this->filtro["fipe"],
                "valor" => $this->filtro["valor"],
                "plano" => $this->filtro["plano"],
                "descricao_plano" => $this->filtro["plano_desc"],
                "mensalidade" => $this->filtro["plano_valor"],
                "assistencia" => $this->filtro["assistencia"],
                "adesao" => $this->filtro["adesao"],
                "forma_pagamento_adesao" => $this->filtro["forma_pagamento_adesao"],
                "vendedor" => $this->filtro["vendedor"],
                "equipamento_empresa" => $this->filtro["equipamento_empresa"],
                "equipamento" => $this->filtro["equipamento"],
                "chip" => $this->filtro["chip"],
                "login" => $this->filtro["login"],
                "senha" => $this->filtro["senha"],
                "status" => $this->filtro["status"],
                "observacao" => $this->filtro["observacao"],
                "central" => $this->filtro["central"],
                "instalacao" => $this->filtro["instalacao"],
                "id_contrato" => $this->filtro["id_contrato"]
                
            ];
            
            $update = new \Source\Models\Update();
            $update->ExeUpdate("app_prevenda", $Dados, "WHERE id = :a", "a={$this->filtro["id"]}");
            $update->getResult();
            

            if($update->getResult()){
              echo "<div class='alert alert-success'> Prevenda atualizada com sucesso </div>"; 
              
              
              
//              $agenda = new \Source\Models\Create();
//              $agenda->ExeCreate("eventos", $DadosInstalacao);
//              $agenda->getResult();
//              if($agenda->getResult()){
//                 echo "Sucesso"; 
//              }else{
//                  echo "Deu merda";
//              }
              
            }else{
               echo "<div class='alert alert-danger'> Erro ao Atualizar venda </div>";   
            }
            
         
        }
        
    }
}
