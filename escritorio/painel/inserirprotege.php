
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1> Inserir Dados Protege</h1>
        <?php
        require ('../_app/Config.inc.php');
        
        $puxa = $_POST["id"];
        

        
        $dadosacasp = new Read();
        $dadosacasp->ExeRead("prevendaacasp","WHERE placa1 = :p","p={$puxa}");
        $dadosacasp->getResult();
        
       echo $valor = $dadosacasp->getResult()[0]['valor1'];
       
                   if($valor < 99999.00):
        echo  $plano = 65.00;
            $tipo = "1 Rastreador";
            $descricao = "Monitoramento 1 RT R$65.00";
            $idplano = 40;
            endif;
            if($valor > 99999.00):
             echo   $plano = 130.00;
            $tipo = "2 Rastreador";
            $descricao = "Monitoramento 2 RT R$130.00";
            $idplano = 41;
           
            endif;
            
       
      
        

               $Dados = [
                   "cliente" => $dadosacasp->getResult()[0]['associado'],
                   "data_nasc" => $dadosacasp->getResult()[0]['data_nasc'],
                   "cpf" => $dadosacasp->getResult()[0]['cpf'],
                   "rg" => $dadosacasp->getResult()[0]['rg'],
                   "telres" => $dadosacasp->getResult()[0]['telres'],
                   "telcel" => $dadosacasp->getResult()[0]['telcel'],
                   "email" => $dadosacasp->getResult()[0]['email'],
                   "endereco" => $dadosacasp->getResult()[0]['logradouro'],
                   "numero" => $dadosacasp->getResult()[0]['numero'],
                   "complemento" => $dadosacasp->getResult()[0]['complemento'],
                   "bairro" => $dadosacasp->getResult()[0]['bairro'],
                   "cidade" => $dadosacasp->getResult()[0]['localidade'],
                   "uf" => $dadosacasp->getResult()[0]['uf'],
                   "cep" => $dadosacasp->getResult()[0]['cep'],
                   "modelo" => $dadosacasp->getResult()[0]['marca_modelo1'],
                   "ano" => $dadosacasp->getResult()[0]['ano1'],
                   "cor" => $dadosacasp->getResult()[0]['cor1'],
                   "placa" => $dadosacasp->getResult()[0]['placa1'],
                   "chassi" => $dadosacasp->getResult()[0]['chassi1'],
                   "renavam" => $dadosacasp->getResult()[0]['renavam1'],
                   "data" => $dadosacasp->getResult()[0]['data'],
                   "vendedor" => $dadosacasp->getResult()[0]['vendedor'],
                   "tipo_plano" => $tipo,
                   "plano_desc" => $descricao,
                   "plano" => number_format($plano, 2, ".", ","),
                   "id_plano" => $idplano,
                   "diapgto" => 30,
                   "status" => 3,
                   "codigo" => $_POST['codigo']
                   
  
                ];
               
                print_r($Dados);
                
                $cadastra = new Create();
                $cadastra->ExeCreate("prevenda", $Dados);
                $cadastra->getResult();
                
                if($cadastra->getResult()):
                    echo "Cadastro Realizado com Sucesso";
                else:
                    echo "Erro ao cadastrar";
                endif;
        
        
       // echo "". $dadosacasp->getResult()[0]['associado'] . "</br>"
        
        
        
        ?>
    </body>
</html>
