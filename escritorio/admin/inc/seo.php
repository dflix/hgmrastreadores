<form action="" method="post">
    <label>
        <p> Palavra Chave </p>
        <input type="text" name="palavrachave" />
    </label>
    <label> 
        <input type="submit"value="BUSCAR" />
    </label>

</form>
<?php


echo "O SEO da palavra chave <b style=\"color:red\">" . $_POST['palavrachave'] . "</b> resultados abaixo:";
echo "<hr>";

require('../_app/Conn/Read.class.php');
$read = new Read;
$read->ExeRead('ws_posts', "WHERE post_id = :p", "p={$_GET['idpost']}");
$read->getResult();

$titulo = $read->getResult()[0]['post_title'];
echo $titulo . " Possui ";
echo strlen($titulo);
echo " caracteres";


if (stripos($titulo, $_POST['palavrachave'])) {
    echo '<b style="color:green;">Palavra chave encontrada</b>';
} else {
    echo "<b style=\"color:red\"> Palavra chave não encontrada</b>";
}
echo "<hr>";


$description = $read->getResult()[0]['post_description'];
echo $description . " Possui ";
echo strlen($description);
echo " caracteres";

if (stripos($description, $_POST['palavrachave'])) {

    echo '<b style="color:green;">Palavra chave encontrada</b>';
} else {
    echo "<b style=\"color:red\"> Palavra chave não encontrada</b>";
}


echo "<hr>";


$conteudo = $read->getResult()[0]['post_content'];
echo $conteudo . " Possui ";
echo strlen($conteudo);
echo " caracteres";

if (stripos($conteudo, $_POST['palavrachave'])) {
    echo '<b style="color:green">Palavra chave encontrada</b>';
} else {
    echo "<b style=\"color:red\"> Palavra chave não encontrada</b>";
}

echo "</br>";
echo "O Conteudo da página possui <b style=\"color:green\">";
echo substr_count($conteudo, " ");
echo "</b> palavras, o ideal seria 400 à 600 palavras";



echo "<hr>";


$imagem = $read->getResult()[0]['post_cover'];
echo $imagem . " Possui ";
echo strlen($imagem);
echo " caracteres";

if (stripos($imagem, $_POST['palavrachave'])) {

    echo '<b style="color:green;">Palavra chave encontrada</b>';
} else {
    echo "<b style=\"color:red\"> Palavra chave não encontrada</b>";
}

echo "<hr>";

$url = $read->getResult()[0]['post_name'];
echo $url . " Possui ";
echo strlen($url);
echo " caracteres";

if (stripos($url, $_POST['palavrachave'])) {

    echo '<b style="color:green;">Palavra chave encontrada</b>';
} else {
    echo "<b style=\"color:red\"> Palavra chave não encontrada</b>";
}
echo "<hr>";

function procpalavras($frase, $palavras, $resultado = 0) {
    foreach ($palavras as $key => $value) {
        $pos = strpos($frase, $value);
        if ($pos !== false) {
            $resultado = 1;
            break;
        }
    }
    return $resultado;
}
?>




