
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
if ($form && $form['sendImage']) {

    $arquivo = fopen("baixas/{$upload->getResult()}", "r");

//ler o conteudo do arquivo

    while (!feof($arquivo)) {

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
                "status" => 2
            ];
           // print_r($Dados);

            $atualiza = new Update();
            $atualiza->ExeUpdate("boletosantander", $Dados, "WHERE id_boleto= :p", "p={$boleto}");
            $atualiza->getResult();
            if ($atualiza->getResult()):
                echo "<p class=\"cadastro\">Atualização <b>(baixa do boleto)</b> realizada com sucesso</p>";
            else:
                echo "<p class=\"deletar\"><b>Erro ao atualizar baixa </b>- cadastrar manual</p>";



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
 
// if(empty($nomecli)):
//     echo "<b>Nao tem registro não fazer SQL</b>";
//     else:
//     echo "<b>Registro encontrado realizar busca por placas</b>";
//     
//                 $multiplacas = new Read();
//            $multiplacas->ExeRead("prevenda", "WHERE  cliente LIKE '%' :link '%' ", "link={$nomecli}");
//            $multiplacas->getResult();
//
//            if ($multiplacas->getResult()):
//
//                echo "Quantidade de Placas <b>{$multiplacas->getRowCount()}</b> </br>";
//
//
//                foreach ($multiplacas->getResult() as $value) {
//
//                    echo "Ciente >> {$value['cliente']}  -- Placa >> {$value['placa']} </br>";
//                }
//
//            else:
//                echo "<p class=\"deletar\"><b> NADA  CONSTA </b></p>";
//            endif;
//     
//     
// endif;
        
            
            
            echo "<p class=\"deletar\"><b>Erro ao atualizar baixa </b>- cadastrar manual - busca no banco por <b> {$nomecli} </b></p></br>";


        endif;



        echo "Placa = {$placa} </br>";

        echo "Valor do BOleto R$ " . number_format($valorboleto / 100, 2, ",", ".") . "</br>";



        echo "<hr>";
    }
}

echo "<h2>SOma é igual a = R$ {$soma}</h2>";
?>




