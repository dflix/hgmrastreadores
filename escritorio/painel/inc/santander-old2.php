
<?php
//require('../_app/Config.inc.php');

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
        $ficheiro = $upload->getResult();

    endif;

    echo "<hr>";



// var_dump($upload);



endif;
?>
<form name="fileForm" action="" method="post" enctype="multipart/form-data">
    <label>
        <input type="file" name="imagem"/>
    </label>
    <label> 
        <p> Inserir a data </p>
        <input type="text" name="data" placeholder="2018-10-30" />
    </label>

    <input type="submit" name="sendImage" value="enviar arquivo!" class="botao"/>
</form>

<?php

if ($form && $form['sendImage']){

$arquivo = fopen("baixas/{$upload->getResult()}", "r");

//ler o conteudo do arquivo

while (!feof($arquivo)) {

    $linha = fgets($arquivo, 1024);
    $linha . '<br />';
   echo  $string_letras = $linha;

echo "</br>";

    $letra = eregi_replace("([^a-z])", "", $string_letras);
    $letraplaca = substr($letra, 1, 3);



    $texto = $string_letras;
    $numeros = preg_replace("/[^a0-z9]/", "", $texto);
    $numerosplaca = substr($numeros, 48, 4);



    $placa = $letraplaca . $numerosplaca;

    $letra2 = eregi_replace("([^a-z])", "", $string_letras);

    $nomecli = substr($letra2, 4, 35);



    $texto = $string_letras;
    $boleto = preg_replace("/[^a0-z9]/", "", $texto);
    $valorboleto = substr($boleto, 73, 5);

    echo "VAlor do BOleto R$ " . number_format($valorboleto / 100, 2, ",", ".");


    if ($nomecli):
        echo "</br> <b>Tem cliente aqui faz verificação na placa</b>";

        $verifica = new Read();
        $verifica->ExeRead("prevenda", "WHERE placa = :p", "p={$placa}");
        $verifica->getResult();
        if ($verifica->getResult()):
            echo $verifica->getResult()[0]['placa'];
            echo "Verificado fazer o registro";

            $data = date("Y-m-d", strtotime($_POST['data']));

            $Dados = [
                "placa" => $verifica->getResult()[0]['placa'],
                "nome" => $verifica->getResult()[0]['cliente'],
                "valor" => $valorboleto,
                "data" => $data
            ];
            
            if($Dados):
                print_r($Dados);
            endif;

            $soma += $valorboleto;
            
            $cad = new Create();
            $cad->ExeCreate("baixasantander", $Dados);
            $cad->getResult();
            
//            if($cad->getResult()):
//                
//
//            echo "Placa = <b> {$Dados['placa']} </b> </br> "
//            . "cliente = <b>{$Dados['nome']} </b> </br>"
//            . "Boleto = <b>{$Dados['valor']} </b> </br>"
//            . "<p style=\"color:#093\"><b>cadastrado pagamento com sucesso no banco de dados</b></p>";
//                
//            endif;

//            print_r($Dados);

        else:

            echo "Várias placas fazer cadastro manual";
        
        

        endif;

    else:
        echo "</br> <b>Dados corrompidos , pica o pé . DELETE </b>";
    endif;




    echo "<hr>";
}


echo "SOMA É IGUAL A R$" .number_format($soma/100,2,",",".");
echo "</br>";


//$Mov=[
//    "data" => $data, 
//    "entrada" => $soma 
//];
//
//
//$inmov = new Create();
//$inmov->exeCreate("movsantander", $Mov);
//$inmov->getResult();
//if($inmov->getResult()):
//    echo "<b>cadastrado movimento com sucesso</b>";
//endif;

}

//$vermov = new Read();
//$vermov->ExeRead("movsantander", "WHERE data = :p", "p={$_POST['data']}");
//$vermov->getResult();
//
//if($vermov->getResult()[0]['data']){
//   
//    echo "<h1>Movimento do dia ja cadastrado</h1>";
//    
//}else{
//    
//
//
//
//// Abre o Arquvio no Modo r (para leitura)
//$arquivo = fopen("baixas/{$upload->getResult()}", 'r');
//
//// Lê o conteúdo do arquivo 
//while (!feof($arquivo)) {
////Mostra uma linha do arquivo
//
//    $linha = fgets($arquivo, 1024);
//    $linha . '<br />';
//    echo $string_letras = $linha;
//
//    echo "</br>";
//
//    echo "</br>";
//
//    $letra = eregi_replace("([^a-z])", "", $string_letras);
//
//    echo "Letra da placa = " . $letraplaca = substr($letra, 1, 3);
//
//    echo "</br>";
//
//    $texto = $string_letras;
//    $numeros = preg_replace("/[^a0-z9]/", "", $texto);
//    echo "Numero da placa = " . $numerosplaca = substr($numeros, 48, 4);
//
//    echo "</br>";
//
//    echo "Placa do Veículo = " . $placa = $letraplaca . $numerosplaca;
//
//    echo "</br>";
//
//    $letra2 = eregi_replace("([^a-z])", "", $string_letras);
//
//    $nomecli = substr($letra2, 4, 35);
//
//    echo "Nome do Cliente = " . $nomecli;
//
//    echo "</br>";
//
//    $texto = $string_letras;
//    $boleto = preg_replace("/[^a0-z9]/", "", $texto);
//    $valorboleto = substr($boleto, 73, 5);
//
//    echo "VAlor do BOleto R$ " . number_format($valorboleto / 100, 2, ",", ".");
//
//    $verifica = new Read();
//    $verifica->ExeRead("prevenda", "WHERE placa = :p ", "p={$placa}");
//    $verifica->getResult();
//    if ($verifica->getResult()[0]['placa']) {
//
//
//        $verifica->getResult()[0]['cliente'];
//
//        $associado = $verifica->getResult()[0]['cliente'];
//
//        $placa = $verifica->getResult()[0]['placa'];
//
//        $data = $_POST['data'];
//
//        $Dados = [
//            "placa" => $placa,
//            "nome" => $associado,
//            "valor" => $valorboleto,
//            "data" => $data
//        ];
//
//        print_r($Dados);
//        
//        $soma += $valorboleto;
//
//        $cad = new Create;
//        $cad->ExeCreate('baixasantander', $Dados);
//        $cad->getResult();
//
//
//        $valorformata = number_format($valorboleto / 100, 2, ",", ".");
//
//        if ($cad->getResult()):
//            echo "Placa = <b> {$placa} </b> </br> "
//            . "cliente = <b>{$associado} </b> </br>"
//            . "Boleto = <b>{$valorformata} </b> </br>"
//            . "<p style=\"color:#093\"><b>cadastrado pagamento com sucesso no banco de dados</b></p>";
//
//        endif;
//    }else{
//        
//        $associado = $verifica->getResult()[0]['cliente'];
//
//        $placa = $verifica->getResult()[0]['placa'];
//
//
//        
//        echo "<p style=\"color:#F00\"><b>cliente não cadastrado</b></p>";
//        echo "</br>";
//        echo "Cadastrar Cliente <a href=\"index.php?p=iprotege\" target=\"blank\">clique aqui </a> ";
//        echo "</br>";
//        echo "Inserir Pagamento Manual <a href=\"index.php?p=ipgtomanual&placa={$placa}&cliente={$nomecli}\" target=\"blank\">clique aqui</a> ";
//        
//        
//    }
//
//    echo "<hr>";
//}
//
//echo "SOMA É IGUAL A R$" .number_format($soma/100,2,",",".");
//echo "</br>";
//echo $_POST['data'];
//
//$Mov=[
//    "data" => $_POST['data'], 
//    "entrada" => $soma 
//];
//
//
//$inmov = new Create();
//$inmov->exeCreate("movsantander", $Mov);
//$inmov->getResult();
//if($inmov->getResult()):
//    echo "<b>cadastrado movimento com sucesso</b>";
//endif;
//}
?>




