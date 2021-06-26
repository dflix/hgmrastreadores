<option value=""> Selecione o Plano </option> 
            <?php
//string json contendo os dados de um funcionário
 require('../_app/Config.inc.php');          


 $puxa = $_POST['tipo_plano'];

$tipo_plano = new Read();
$tipo_plano->ExeRead("planos", "WHERE id_categ = :a ", "a={$puxa}");
$tipo_plano->getResult();

foreach ($tipo_plano->getResult() as $tipoplano) {


        
            ?> 


<option value="<?= $tipoplano['plano'] ?>"> <?= $tipoplano['plano'] ?></option>

<?php } ?>