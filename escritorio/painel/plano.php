            <?php
//string json contendo os dados de um funcionário
 require('../_app/Config.inc.php');          


 echo $puxa = $_POST['plano'];

$tipo_plano = new Read();
$tipo_plano->ExeRead("planos", "WHERE plano = :a ", "a={$puxa}");
$tipo_plano->getResult();

foreach ($tipo_plano->getResult() as $plano) {


        
            ?> 


<option value="<?= $plano['valor']; ?>"> <?= $plano['valor']; ?></option>

<?php } ?>