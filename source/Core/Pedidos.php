<?php

namespace Source\Core;

use Source\Core\Agenda;

class Pedidos {

    private $filtro;

    public function __construct() {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        $this->filtro = $filtro;
    }

    public function pedido() {

        $verifica = new \Source\Models\Read();
        $verifica->ExeRead("app_pedidos", "ORDER BY id DESC ");
        $verifica->getResult();


        if ($verifica->getResult()) {
            $id = $verifica->getResult()[0]["pedido_id"];
        } else {
            $id = 0;
        }

        $_SESSION["pedido_id"] = $id + 1;
        $_SESSION["cliente_id"] = $_GET["id"];

//            $frete = str_replace(".", "", $_SESSION["frete"]);
//            $frete = str_replace(",", "", $_SESSION["frete"]);

        $cad = [
            "user_id" => $_SESSION["user_id"],
            "cliente_id" => intval($_SESSION["cliente_id"]),
            "pedido_id" => intval($_SESSION["pedido_id"]),
            "valor" => $_SESSION["totalPedido"],
            "status" => intval("1"),
            "data" => date("Y-m-d H:i:s")
        ];

        $cadastra = new \Source\Models\Create();
        $cadastra->ExeCreate("app_pedidos", $cad);
        $cadastra->getResult();


        if ($cadastra->getResult()) {
            echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
               <h5>Pedido Iniciado</h5>  </div>";
            $_SESSION["etapa"] = "1";
            //$this->veiculos();
            echo "
<meta http-equiv=\"refresh\" content=\"0; URL='./?p=pedido_veiculos'\"/>";
            // header("location:./pedido/veiculos");
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">
               <h5>Erro ao iniciar pedido</h5>  </div>";
        }
//        }
        //var_dump($_SESSION, $this->filtro);
    }

    public function veiculos() {

        if (!empty($this->filtro["veiculo"])) {
            //$_SESSION["etapa"] = $_SESSION["etapa"] + 1;

            $marca = explode("|", $this->filtro["marca1"]);
            $marca = $marca[0];

            $modelo = explode("|", $this->filtro["modelo1"]);
            $modelo = $modelo["3"];

            $ano = explode("|", $this->filtro["ano1"]);
            $ano = $ano["4"];

            $Dados = [
                "user_id" => intval($_SESSION["user_id"]),
                "cliente_id" => $_SESSION["cliente_id"],
                "pedido_id" => $_SESSION["pedido_id"],
                "tipo" => $this->filtro['veiculo'],
                "marca" => $marca,
                "modelo" => $modelo,
                "ano" => $ano,
                "valor" => $this->filtro["valor"],
                "fipe" => $this->filtro["fipe"],
                "cor" => $this->filtro["cor"],
                "placa" => $this->filtro["placa"],
                "chassi" => $this->filtro["chassi"],
                "renavam" => $this->filtro["renavam"],
                "plano" => $this->filtro["plano"],
                "plano_desc" => $this->filtro["plano_desc"],
                "plano_valor" => $this->filtro["plano_valor"],
                "adesao" => $this->filtro["adesao"],
                "forma_pagamento_adesao" => $this->filtro["forma_pagamento_adesao"],
                "vendedor" => $this->filtro["vendedor"],
                "equipamento_empresa" => $this->filtro["equipamento_empresa"],
                "equipamento" => $this->filtro["equipamento"],
                "chip" => $this->filtro["chip"],
                "login" => $this->filtro["login"],
                "senha" => $this->filtro["senha"],
                "central" => $this->filtro["central"],
                "instalacao" => $this->filtro["instalacao"],
                "status" => $this->filtro["status"],
                "id_contrato" => $this->filtro["id_contrato"],
                "observacoes" => $this->filtro["observacao"],
                "data" => date("Y-m-d")
            ];

            $horafinal = intval($this->filtro["start_horas"]) + 1;

            $start = $this->filtro["start_dia"] . " " . trim($this->filtro["start_horas"]) . ":" . trim($this->filtro["start_minutos"]) . ":00";
            $end = $this->filtro["start_dia"] . " " . trim($horafinal) . ":" . trim($this->filtro["start_minutos"]) . ":00";

            $DadosEvento = [
                "user_id" => intval($_SESSION["user_id"]),
                "pedido_id" => $_SESSION["pedido_id"],
                "title" => "instalação {$this->filtro["placa"]}",
                "start" => $start,
                "end" => $end,
                "placa" => $this->filtro["placa"],
                "tipo" => $this->filtro["tipo"],
                "cep" => $this->filtro["cep"],
                "logradouro" => $this->filtro["logradouro"],
                "numero" => $this->filtro["numero"],
                "complemento" => $this->filtro["complemento"],
                "bairro" => $this->filtro["bairro"],
                "cidade" => $this->filtro["cidade"],
                "uf" => $this->filtro["uf"]        
            ];
                
                $cadevento = new \Source\Models\Create();
                $cadevento->ExeCreate("eventos", $DadosEvento);
                $cadevento->getResult();
                if($cadevento->getResult()){
                    echo "<div class='alert alert-success'> Evento cadastrado com Sucesso </div>";
                }

           // var_dump($DadosEvento, $this->filtro);

            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_veiculos", $Dados);
            $cad->getResult();
            if($cad->getResult()){
                 echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
               <h5>Veiculo Cadastrado com Sucesso</h5>  </div>";
               echo "
                <meta http-equiv=\"refresh\" content=\"5; URL='./?p=cliente'\"/>";
            }else{
                  echo "<div class=\"alert alert-danger col-md-12\" role=\"alert\">
               <h5>Erro ao cadastrar</h5>  </div>";
            }
        }

//        if(!empty($this->filtro["pular"])){
//            $_SESSION["etapa"] = $_SESSION["etapa"] + 1;
//          
//        }
    }
    
    public function veiculosEdit() {
        
        if($this->filtro["id"]){
            
             $marca = explode("|", $this->filtro["marca1"]);
            $marca = $marca[0];

            $modelo = explode("|", $this->filtro["modelo1"]);
            $modelo = $modelo["3"];

            $ano = explode("|", $this->filtro["ano1"]);
            $ano = $ano["4"];

            
            $Dados = [
                "user_id" => intval($_SESSION["user_id"]),
                "cliente_id" => $_SESSION["cliente_id"],
                "pedido_id" => $_SESSION["pedido_id"],
                "tipo" => $this->filtro['veiculo'],
                "marca" => $marca,
                "modelo" => $modelo,
                "ano" => $ano,
                "valor" => $this->filtro["valor"],
                "fipe" => $this->filtro["fipe"],
                "cor" => $this->filtro["cor"],
                "placa" => $this->filtro["placa"],
                "chassi" => $this->filtro["chassi"],
                "renavam" => $this->filtro["renavam"],
                "plano" => $this->filtro["plano"],
                "plano_desc" => $this->filtro["plano_desc"],
                "plano_valor" => $this->filtro["plano_valor"],
                "adesao" => $this->filtro["adesao"],
                "forma_pagamento_adesao" => $this->filtro["forma_pagamento_adesao"],
                "vendedor" => $this->filtro["vendedor"],
                "equipamento_empresa" => $this->filtro["equipamento_empresa"],
                "equipamento" => $this->filtro["equipamento"],
                "chip" => $this->filtro["chip"],
                "login" => $this->filtro["login"],
                "senha" => $this->filtro["senha"],
                "central" => $this->filtro["central"],
                "instalacao" => $this->filtro["instalacao"],
                "status" => $this->filtro["status"],
                "id_contrato" => $this->filtro["id_contrato"],
                "observacoes" => $this->filtro["observacao"],
                
            ];
            
            $up = new \Source\Models\Update();
            $up->ExeUpdate("app_veiculos", $Dados, "WHERE pedido_id = :a", "a={$_GET["edit"]}");
            $up->getResult();
            if($up->getResult()){
                echo "<div class='alert alert-success'> Atualizado com Sucesso </div>";
            }else{
               echo "<div class='alert alert-danger'> ERRO </div>"; 
            }
            
            $horafinal = intval($this->filtro["start_horas"]) + 1;

            $start = $this->filtro["start_dia"] . " " . trim($this->filtro["start_horas"]) . ":" . trim($this->filtro["start_minutos"]) . ":00";
            $end = $this->filtro["start_dia"] . " " . trim($horafinal) . ":" . trim($this->filtro["start_minutos"]) . ":00";

            $DadosEvento = [
                "user_id" => intval($_SESSION["user_id"]),
                "pedido_id" => $_SESSION["pedido_id"],
                "title" => "instalação {$this->filtro["placa"]}",
                "start" => $start,
                "end" => $end,
                "placa" => $this->filtro["placa"],
                "tipo" => $this->filtro["tipo"],
                "cep" => $this->filtro["cep"],
                "logradouro" => $this->filtro["logradouro"],
                "numero" => $this->filtro["numero"],
                "complemento" => $this->filtro["complemento"],
                "bairro" => $this->filtro["bairro"],
                "cidade" => $this->filtro["cidade"],
                "uf" => $this->filtro["uf"]        
            ];
                
                $evento = new \Source\Models\Update();
                $evento->ExeUpdate("eventos", $DadosEvento, "WHERE pedido_id = :a", "a={$_SESSION["pedido_id"]}");
                $evento->getResult();
                if($evento->getResult()){
                    echo "<div class='alert alert-success'> Atualizado Evento com SUcesso </div>";
                }else{
                    echo "<div class='alert alert-danger'> ERRO </div>";
                }

        
       // var_dump( $Dados , $DadosEvento);
        }
        
    }

    public function planos() {
        if ($this->filtro) {
            $Dados = [
                "user_id" => $_SESSION["user_id"],
                "cliente_id" => $_SESSION["cliente_id"],
                "pedido_id" => $_SESSION["pedido_id"],
                "plano" => $this->filtro["planos"]
            ];
            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_plano_pedido", $Dados);
            $cad->getResult();
            if ($cad->getResult()) {
                $_SESSION["etapa"] = $_SESSION["etapa"] + 1;
                echo "
<meta http-equiv=\"refresh\" content=\"0; URL='./?p=pedido_itens'\"/>";
                // header("location:./itens");
                //echo "cadatrado";  
            } else {
                null;
            }
            // var_dump($this->filtro , $_SESSION , $Dados);
        }
    }

    public function itens() {
        if (!empty($this->filtro["qtd"])) {

            $this->filtro["valor_unit"] = str_replace(".", "", $this->filtro["valor_unit"]);
            $this->filtro["valor_unit"] = str_replace(",", "", $this->filtro["valor_unit"]);

            $Dados = [
                "user_id" => $_SESSION["user_id"],
                "pedido_id" => $_SESSION["pedido_id"],
                "qtd" => $this->filtro["qtd"],
                "descricao" => $this->filtro["descricao"],
                "valor_unit" => $this->filtro["valor_unit"]
            ];

            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_itens", $Dados);
            $cad->getResult();
            if ($cad->getResult()) {
                echo "cadastrado";
            }
            // var_dump($this->filtro , $_SESSION , $Dados); 
        }

        if (!empty($this->filtro["pular"])) {
            $_SESSION["etapa"] = $_SESSION["etapa"] + 1;
            echo "
<meta http-equiv=\"refresh\" content=\"0; URL='./?p=pedido_detalhes'\"/>";
            // header("location:./detalhes"); 
        }

        // var_dump($this->filtro , $_SESSION , $Dados); 
    }

    public function detalhes() {
        if ($this->filtro) {
            $Dados = [
                "detalhes" => $this->filtro["detalhes"],
                "pedido_id" => $_SESSION["pedido_id"],
                "user_id" => $_SESSION["user_id"]
            ];
            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_pedidos_detalhes", $Dados);
            $cad->getResult();
            if ($cad->getResult()) {
                $_SESSION["etapa"] = $_SESSION["etapa"] + 1;
                echo "
<meta http-equiv=\"refresh\" content=\"0; URL='./?p=pedido_local'\"/>";
                // header("location:./local"); 
            } else {
                echo "erro";
            }
        }

        //var_dump($this->filtro , $Dados);
    }

    public function local() {
        if ($this->filtro) {
            $Dados = [
                "local" => $this->filtro["local"],
                "pedido_id" => $_SESSION["pedido_id"]
            ];
            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_local_data", $Dados);
            $cad->getResult();
            if ($cad->getResult()) {
                $_SESSION["etapa"] = $_SESSION["etapa"] + 1;
                // header("location:./agendar");  
                echo "
<meta http-equiv=\"refresh\" content=\"0; URL='./?p=pedido_agendar'\"/>";
            } else {
                null;
            }
        }
    }

    public function agendar() {
        if ($this->filtro) {

            $agenda = new Agenda();
            $agenda->cadastra();
            $_SESSION["etapa"] = $_SESSION["etapa"] + 1;
            echo "
<meta http-equiv=\"refresh\" content=\"0; URL='./?p=pedido_recibo'\"/>";
            // header("location:./recibo");  
            // var_dump($this->filtro , $_SESSION );    
        }
    }

    public function recibo() {
        if ($this->filtro) {

            $this->filtro["valor"] = str_replace(".", "", $this->filtro["valor"]);
            $this->filtro["valor"] = str_replace(",", "", $this->filtro["valor"]);

            $Dados = [
                "pedido_id" => $_SESSION["pedido_id"],
                "valor" => $this->filtro["valor"],
                "de" => $this->filtro["de"],
                "descricao" => $this->filtro["descricao"],
                "forma_pagamento" => $this->filtro["forma_pagamento"]
            ];

            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_recibo", $Dados);
            $cad->getResult();
            if ($cad->getResult()) {
                $_SESSION["etapa"] = $_SESSION["etapa"] + 1;
                echo "
<meta http-equiv=\"refresh\" content=\"0; URL='./?p=cliente'\"/>";
                //header("location:../cliente");  
            }
            var_dump($this->filtro, $_SESSION, $Dados);
        }
    }

}
