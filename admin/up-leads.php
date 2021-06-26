

<h2>arquivos <?= $_GET["p"]; ?> </h2>

<?php 
require '../vendor/autoload.php';

$read = new \Source\Models\Read();
$read->ExeRead("orcamento");
$read->getResult();



foreach ($read->getResult() as $value) {

?>

<p> Nome : <?=$value["nome"] ?>  Telefone: <?=$value["celular"] ?>   </p>

<?php } ?>

