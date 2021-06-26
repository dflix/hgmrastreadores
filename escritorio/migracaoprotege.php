<?php

require('./_app/Config.inc.php');

$captura = new Read();
$captura->ExeRead("prevenda", "WHERE verifica = :a ORDER BY id_venda DESC" , "a=1");
$captura->getResult();

if($captura->getResult()):

$Dados = [
    "verifica" => 2
];

$update = new Update();
$update->ExeUpdate("prevenda", $Dados, "WHERE codigo = :a", "a={$captura->getResult()[0]['codigo']}");
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

<form name="formulario" method="post" action="migracaoprotege2.php"> 
    <!--<input type="hidden" name="id_venda" value="<?php // $captura->getResult()[0]['id_venda'] ?>" />-->
    <input type="hidden" name="codigo" value="<?= $captura->getResult()[0]['codigo'] ?>" />
    <input type="hidden" name="usuario" value="<?= $captura->getResult()[0]['usuario'] ?>" />
    <input type="hidden" name="senha" value="<?= $captura->getResult()[0]['senha'] ?>" />
    <input type="hidden" name="ip" value="<?= $captura->getResult()[0]['ip'] ?>" />
    <input type="hidden" name="cliente" value="<?= $captura->getResult()[0]['cliente'] ?>" />
    <input type="hidden" name="data_nasc" value="<?= $captura->getResult()[0]['data_nasc'] ?>" />
    <input type="hidden" name="cpf" value="<?= $captura->getResult()[0]['cpf'] ?>" />
    <input type="hidden" name="rg" value="<?= $captura->getResult()[0]['rg'] ?>" />
    <input type="hidden" name="telres" value="<?= $captura->getResult()[0]['telres'] ?>" />
    <input type="hidden" name="telcel" value="<?= $captura->getResult()[0]['telcel'] ?>" />
    <input type="hidden" name="email" value="<?= $captura->getResult()[0]['email'] ?>" />
    <input type="hidden" name="endereco" value="<?= $captura->getResult()[0]['endereco'] ?>" />
    <input type="hidden" name="numero" value="<?= $captura->getResult()[0]['numero'] ?>" />
    <input type="hidden" name="complemento" value="<?= $captura->getResult()[0]['comlemento'] ?>" />
    <input type="hidden" name="cep" value="<?= $captura->getResult()[0]['cep'] ?>" />
    <input type="hidden" name="bairro" value="<?= $captura->getResult()[0]['bairro'] ?>" />
    <input type="hidden" name="cidade" value="<?= $captura->getResult()[0]['cidade'] ?>" />
    <input type="hidden" name="uf" value="<?= $captura->getResult()[0]['uf'] ?>" />
    <input type="hidden" name="veiculo" value="<?= $captura->getResult()[0]['veiculo'] ?>" />
    <input type="hidden" name="marca" value="<?= $captura->getResult()[0]['marca'] ?>" />
    <input type="hidden" name="modelo" value="<?= $captura->getResult()[0]['modelo'] ?>" />
    <input type="hidden" name="ano" value="<?= $captura->getResult()[0]['ano'] ?>" />
    <input type="hidden" name="cor" value="<?= $captura->getResult()[0]['cor'] ?>" />
    <input type="hidden" name="placa" value="<?= $captura->getResult()[0]['placa'] ?>" />
    <input type="hidden" name="chassi" value="<?= $captura->getResult()[0]['chassi'] ?>" />
    <input type="hidden" name="renavam" value="<?= $captura->getResult()[0]['renavam'] ?>" />
    <input type="hidden" name="fipe" value="<?= $captura->getResult()[0]['fipe'] ?>" />
    <input type="hidden" name="valor" value="<?= $captura->getResult()[0]['valor'] ?>" />
    <input type="hidden" name="marca_t" value="<?= $captura->getResult()[0]['marca_t'] ?>" />
    <input type="hidden" name="modelo_t" value="<?= $captura->getResult()[0]['modelo_t'] ?>" />
    <input type="hidden" name="ano_t" value="<?= $captura->getResult()[0]['ano_t'] ?>" />
    <input type="hidden" name="cor_t" value="<?= $captura->getResult()[0]['cor_t'] ?>" />
    <input type="hidden" name="placa_t" value="<?= $captura->getResult()[0]['placa_t'] ?>" />
    <input type="hidden" name="chassi_t" value="<?= $captura->getResult()[0]['chassi_t'] ?>" />
    <input type="hidden" name="renavam_t" value="<?= $captura->getResult()[0]['renavam_t'] ?>" />
    <input type="hidden" name="fipe_t" value="<?= $captura->getResult()[0]['fipe_t'] ?>" />
    <input type="hidden" name="valor_t" value="<?= $captura->getResult()[0]['valor_t'] ?>" />
    <input type="hidden" name="taxa" value="<?= $captura->getResult()[0]['taxa'] ?>" />
    <input type="hidden" name="pagto_taxa" value="<?= $captura->getResult()[0]['pagto_taxa'] ?>" />
    <input type="hidden" name="datatransf" value="<?= $captura->getResult()[0]['datatransf'] ?>" />
    <input type="hidden" name="entradatransf" value="<?= $captura->getResult()[0]['entradatransf'] ?>" />
    <input type="hidden" name="data" value="<?= $captura->getResult()[0]['data'] ?>" />
    <input type="hidden" name="status" value="<?= $captura->getResult()[0]['status'] ?>" />
    <input type="hidden" name="adesao" value="<?= $captura->getResult()[0]['adesao'] ?>" />
    <input type="hidden" name="pgto_adesao" value="<?= $captura->getResult()[0]['pgto_adesao'] ?>" />
    <input type="hidden" name="formapgto_adesao" value="<?= $captura->getResult()[0]['formapgto_adesao'] ?>" />
    <input type="hidden" name="plano" value="<?= $captura->getResult()[0]['plano'] ?>" />
    <input type="hidden" name="tipo_plano" value="<?= $captura->getResult()[0]['tipo_plano'] ?>" />
    <input type="hidden" name="plano_desc" value="<?= $captura->getResult()[0]['plano_desc'] ?>" />
    <input type="hidden" name="id_plano" value="<?= $captura->getResult()[0]['id_plano'] ?>" />
    <input type="hidden" name="rt" value="<?= $captura->getResult()[0]['rt'] ?>" />
    <input type="hidden" name="assistencia" value="<?= $captura->getResult()[0]['assistencia'] ?>" />
    <input type="hidden" name="vendedor" value="<?= $captura->getResult()[0]['vendedor'] ?>" />
    <input type="hidden" name="relacionado" value="<?= $captura->getResult()[0]['relacionado'] ?>" />
    <input type="hidden" name="vencimento" value="<?= $captura->getResult()[0]['vencimento'] ?>" />
    <input type="hidden" name="instalador" value="<?= $captura->getResult()[0]['instalador'] ?>" />
    <input type="hidden" name="data_instalacao" value="<?= $captura->getResult()[0]['data_instalacao'] ?>" />
    <input type="hidden" name="local_instalacao" value="<?= $captura->getResult()[0]['local_instalacao'] ?>" />
    <input type="hidden" name="bloqueio" value="<?= $captura->getResult()[0]['bloqueio'] ?>" />
    <input type="hidden" name="operador" value="<?= $captura->getResult()[0]['operador'] ?>" />
    <input type="hidden" name="diapgto" value="<?= $captura->getResult()[0]['diapgto'] ?>" />
    <input type="hidden" name="ativo" value="<?= $captura->getResult()[0]['ativo'] ?>" />
    <input type="hidden" name="verifica" value="<?= $captura->getResult()[0]['verifica'] ?>" />
    <input type="hidden" name="entrada" value="<?= $captura->getResult()[0]['entrada'] ?>" />


    
           <input type="submit" value="enviar" />
           
</form>

<?PHP 
if($captura->getResult()):
?>

<script type="text/javascript">
document.formulario.submit()
</script>

<?PHP endif; ?>
