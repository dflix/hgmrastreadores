<?php

require('./_app/Config.inc.php');

$captura = new Read();
$captura->ExeRead("orcamentoacasp", "WHERE verifica = :a ORDER BY id DESC" , "a=1");
$captura->getResult();

if($captura->getResult()):

$Dados = [
    "verifica" => 2
];

$update = new Update();
$update->ExeUpdate("orcamentoacasp", $Dados, "WHERE id = :a", "a={$captura->getResult()[0]['id']}");
$update->getResult();

else:
    
  echo "<H1>ACABOU MOTHER FUCKER</H1> </BR>" ; 
  echo "<H2>SUCK MY DICK</H2>" ; 
  echo "<H3>CAN BE UNTIL MY BALLS</H3>" ; 
  echo "<H3>SON OF A BITCH</H3>" ; 
endif;

//echo $captura->getResult()[0]['cliente'];
//echo $captura->getResult()[0]['rg'];
//echo $captura->getResult()[0]['cpf'];

?>

<form name="formulario" method="post" action="migracao2.php"> 
    <input type="hidden" name="nome" value="<?= $captura->getResult()[0]['nome'] ?>" />
    <input type="hidden" name="email" value="<?= $captura->getResult()[0]['email'] ?>" />
    <input type="hidden" name="telefone" value="<?= $captura->getResult()[0]['telefone'] ?>" />
    <input type="hidden" name="celular" value="<?= $captura->getResult()[0]['celular'] ?>" />
    <input type="hidden" name="veiculo" value="<?= $captura->getResult()[0]['veiculo'] ?>" />
    <input type="hidden" name="valor" value="<?= $captura->getResult()[0]['valor'] ?>" />
    <input type="hidden" name="data" value="<?= $captura->getResult()[0]['data'] ?>" />
    <input type="hidden" name="status" value="<?= $captura->getResult()[0]['status'] ?>" />
    <input type="hidden" name="vendedor" value="<?= $captura->getResult()[0]['vendedor'] ?>" />
    <input type="hidden" name="obs" value="<?= $captura->getResult()[0]['obs'] ?>" />

    
           <input type="submit" value="enviar" />
           
</form>

<?PHP 
if($captura->getResult()):
?>

<script type="text/javascript">
document.formulario.submit()
</script>

<?PHP endif; ?>
