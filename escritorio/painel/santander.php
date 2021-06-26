
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



// var_dump($form);



endif;
?>
<div class="col-md-12">
<form name="fileForm" action="" class="form" method="post" enctype="multipart/form-data">
    <div class="col-md-6">
        <p> Buscar Arquivo TXT (Santander) </p>
        <input type="file" class="form-control" name="imagem"/>
    </div>
    <div class="col-md-6">
        <p> Inserir a data de pagamento</p>
        <input type="text" name="data" class="form-control" placeholder="30-12-1999" />
    </div>
<div class="col-md-12">
    <input type="submit" name="sendImage" value="enviar arquivo!" class="btn btn-primary"/>
</div>
</form>
</div>
<?php






if ($form && $form['sendImage']) {

    $arquivo = fopen("baixas/{$upload->getResult()}", "r");
    


//ler o conteudo do arquivo

    while (!feof($arquivo)) {
        
            $postdata =  $_POST['data'];

$trata = explode("-", $postdata);

$datapgto = $trata[2] . "-" . $trata[1] . "-" . $trata[0];

        $linha = fgets($arquivo, 1024);
        $linha . '<br />';
        echo $string_letras = $linha;

        $letra = eregi_replace("([^a-z])", "", $string_letras);
        $letraplaca = substr($letra, 1, 3);



        $texto = $string_letras;
        $numeros = preg_replace("/[^a0-z9]/", "", $texto);
        $numerosplaca = substr($numeros, 48, 4);
        $placa = $letraplaca . $numerosplaca;

        $texto = $string_letras;
        $numeros = preg_replace("/[^a0-z9]/", "", $texto);
        $vencimentoboleto = substr($numeros, 55, 8);

        $ano = substr($numeros, 59, 4);
        $mes = substr($numeros, 57, 2);
        $dia = substr($numeros, 55, 2);


        echo "Ano {$ano} - Mes {$mes} - dia {$dia}";

        $data = $ano . "-" . $mes . "-" . $dia;

        $venc = date("d-m-Y", strtotime($vencimentoboleto));

        echo "Vencimento do boleto { $data} </br>";

        $string_letras = $linha;
        $cliente = eregi_replace("([^a-z])", " ", $string_letras);

        echo "Nome do cliente = {$cliente}";

        $filtra = explode(" ", $cliente);

        // print_r($filtra);

        $limpo = array_filter($filtra);

        print_r($limpo);

        echo "Filtro do nome" . $nomebusca = $filtra['139'] . " " . $filtra['140'] . " " . $filtra['141'];

        $texto = $string_letras;
        $boleto = preg_replace("/[^a0-z9]/", "", $texto);
        $valorboleto = substr($boleto, 73, 5);

        $verifica = new Read();
        $verifica->ExeRead("boletosantander", "WHERE documento = :p AND MONTH(vencimento) = :r", "p={$placa}&r={$mes}");
        $verifica->getResult();
        if ($verifica->getResult()):

            echo "Registro encontrado </br>";

            $soma += $valorboleto;

            echo $boleto = $verifica->getResult()[0]['id_boleto'] . "</br>";
            $Dados = [
                "status" => 2,
                "pg" => $datapgto
            ];
           // print_r($Dados);

            $atualiza = new Update();
            $atualiza->ExeUpdate("boletosantander", $Dados, "WHERE id_boleto= :p", "p={$boleto}");
            $atualiza->getResult();
            if ($atualiza->getResult()):
                echo "<div class=\"alert alert-success\" role=\"alert\">Atualização <b>(baixa do boleto)</b> realizada com sucesso</div>";
               
            else:
                echo "<div class=\"alert alert-danger\" role=\"alert\"><b>Erro ao atualizar baixa </b>- cadastrar manual</div>";



            endif;



        else:
            
        $string_letras = $linha;
        $cliente = eregi_replace("([^a-z])", " ", $string_letras);

        echo "Nome do cliente = {$cliente} </br>";
        
                $filtra = explode(" ", $cliente);

       // print_r($filtra);
        
        // Remove os valores nulos
$array = array_filter($filtra);

// Recria as chaves do array
$array = array_values($array);

// Mostra os dados
print_r( $array );

 $nomecli = $array['2'] . " " . $array['3'] . " " . $array['4'];
 
 echo " Nome do Cliente ==== <b> {$nomecli} </b> </br>";
 

        
            
            
            echo "<p class=\"deletar\"><b>Erro ao atualizar baixa </b>- cadastrar manual - busca no banco por <b> {$nomecli} </b></p></br>";


        endif;



        echo "Placa = {$placa} </br>";

        echo "Valor do BOleto R$ " . number_format($valorboleto / 100, 2, ",", ".") . "</br>";



        echo "<hr>";
    }
}

echo "<h2>SOma é igual a = R$" . number_format($soma / 100, 2, ",", ".")."</h2>";
echo "</br>";
echo "O dia de pagamento é ";
?>




