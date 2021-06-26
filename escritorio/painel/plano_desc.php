            
<optin>Selecione </optin>
<?php
//string json contendo os dados de um funcionário
 require('../_app/Config.inc.php');          


 $puxa = $_POST['plano_desc'];

$plano_desc = new Read();
$plano_desc->ExeRead("planos", "WHERE plano = :a ", "a={$puxa}");
$plano_desc->getResult();

foreach ($plano_desc->getResult() as $plano) {


        
            ?> 


<option value="<?= $plano['descricao'] ?>"> <?= $plano['descricao'] ?></option>

<?php  } ?>