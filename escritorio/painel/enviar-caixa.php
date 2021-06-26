<?php

error_reporting(0);

?>



<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php 
        require('../_app/Config.inc.php');
        
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($form && $form['sendImage']):

            $upload = new UploadArquivo('baixas/');
            $imagem = $_FILES['imagem'];
            //var_dump($imagem);

            $upload->Image($imagem);
            if (!$upload->getResult()):
                WSErro("Erro ao enviar imagem:<br><small> {$upload->getError()} </small>", WS_ERROR);
            else:
                WSErro("Arquivo enviado com sucesso:<br><smal> {$upload->getResult()}</smal>", WS_ACCEPT);
                $ficheiro =  $upload->getResult();
                
            endif;

            echo "<hr>";
            
            
            
            //var_dump($upload);



        endif;
        ?>
<form name="fileForm" action="" method="post" enctype="multipart/form-data">
            <label>
                <input type="file" name="imagem"/>
            </label>

            <input type="submit" name="sendImage" value="enviar arquivo!"/>
        </form>
        
        <?php
        
   $executa = filter_input_array(INPUT_POST , FILTER_DEFAULT);
  
      if($executa):
          
                  // Abre o Arquvio no Modo r (para leitura)
        $arquivo = fopen( "baixas/$upload->getResult()" , 'r');

// Lê o conteúdo do arquivo 
        while (!feof($arquivo)) {
//Mostra uma linha do arquivo

            $linha = fgets($arquivo, 1024);
            $linha . '<br />';
            $string_letras = $linha;


            /**
             * Esse codigo abaixo consegui capturar as letras da placa
             */
            $letra = eregi_replace("([^a-z])", "", $string_letras);

            $letraplaca = substr($letra, 1, 3);


            /**
             * Esse codigo abaxo vou tentar capturar os numeros da placa
             */
            $texto = $string_letras;
            $numeros = preg_replace("/[^a0-z9]/", "", $texto);
            $numerosplaca = substr($numeros, 57, 4);


            /**
             * Esse codigo recupera valor do boeto
             */
            $texto = $string_letras;
            $boleto = preg_replace("/[^a0-z9]/", "", $texto);
            $valorboleto = substr($boleto, 82, 5);

            //echo $numeroplaca;
            //echo $texto;
            /**
             * COdigo abaixo conseguimos extrair e tratar a plaa do caminhão
             */
            $placa = $letraplaca . $numerosplaca;

            "Placa do Veiculo =" . $placa;




// 
// echo "<hr>";
// 
            $letra2 = eregi_replace("([^a-z])", "", $string_letras);

            $nomecli = substr($letra2, 7, 30);
// 
            $valorboleto;



            $verifica = new Read();
            $verifica->ExeRead("prevendaacasp", "WHERE placa1 = :p ", "p={$placa}");
            $verifica->getResult();
            if ($verifica->getResult()):


                $verifica->getResult()[0]['associado'];

                $associado = $verifica->getResult()[0]['associado'];

                $placa = $verifica->getResult()[0]['placa1'];

                $data = date("Y-m-d");

                $Dados = [
                    "placa" => $placa,
                    "nome" => $associado,
                    "valor" => $valorboleto,
                    "data" => $data
                ];

                print_r($Dados);
                
                $soma += $valorboleto;

//                $cad = new Create;
//                $cad->ExeCreate('baixacaixa', $Dados);
//                $cad->getResult();
//                
//                
//              $valorformata =  number_format($valorboleto/100,2,",",".");
//
//                if ($cad->getResult()):
//                    echo "Placa = <b> {$placa} </b> </br> "
//                    . "cliente = <b>{$associado} </b> </br>"
//                    . "Boleto = <b>{$valorformata} </b> </br>"
//                    . "cadastrado pagamento com sucesso no banco de dados";
//
//                endif;

            //var_dump($cad);

            endif;
            echo "<hr>";
        }
          
          
          
          
          
      else:
          echo "Envie o Arquivo para leitura";
      endif; 
  
      echo "SOMA É IGUAL A R$" .number_format($soma/100,2,",",".");

        ?>
        
    </body>
</html>
