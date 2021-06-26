<?php

require './../vendor/autoload.php';

echo $_POST["valorplan"];

$desc = new Source\Models\Read();
$desc->ExeRead("app_planos_user", "WHERE id = :a", "a={$_POST["valorplan"]}");
$desc->getResult();

foreach ($desc->getResult() as $value) {
    


?>

<option value="<?= $value["valor"] ?>"> <?= $value["valor"] ?> </option>

<?php  } ?>