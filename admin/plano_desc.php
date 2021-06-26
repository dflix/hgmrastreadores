<?php

require './../vendor/autoload.php';

echo $_POST["plano"];

$desc = new Source\Models\Read();
$desc->ExeRead("app_planos_user", "WHERE id = :a", "a={$_POST["plano"]}");
$desc->getResult();

foreach ($desc->getResult() as $value) {
    


?>

<option value="<?= $value["descricao"] ?>"> <?= $value["descricao"] ?> </option>

<?php } ?>