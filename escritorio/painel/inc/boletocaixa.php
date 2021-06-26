
<?php
//require('../_app/Config.inc.php');

$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if ($form && $form['send']):

    $i = 1;
    while ($i <= $_POST['parcelas']):

        //  echo "<b>{$i} </b> - ";

        $s = 15 * $i;

        $dia = $_POST['vencimento'];

        $Date = $_POST['emissao'];

        $explodir = explode("-", $Date);

        $DataBase = $explodir['0'] . $explodir['1'] . $dia;

        $vencimentos = date("Y-m-d", strtotime($DataBase . " + {$i} month"));
        //  echo "</br>";
//
        //   echo "</br>";
        $valor = $_POST['valor'];
        $valor = str_replace(".", "", $valor); // Primeiro tira os pontos
        $valor = str_replace(",", "", $valor); // Depois tira a vírgula

        $Dados = [
            "documento" => $_POST['documento'],
            "parcela" => $i,
            "emissao" => $DataBase,
            "vencimento" => $vencimentos,
            "valor" => $valor,
            "status" => 1,
            "tipo" => $_POST['motivo']
        ];

        //print_r($Dados);

        $cadastra = new Create();
        $cadastra->ExeCreate("boletoscaixa", $Dados);
        $cadastra->getResult();

//        if ($cadastra->getResult()):
//            echo "<b>cobrança {$i} cadastrada com sucesso</b> </br>";
//        endif;


        $i ++;


    endwhile;



endif;
?>

<script language="javascript">
//-----------------------------------------------------
//Funcao: MascaraMoeda
//Sinopse: Mascara de preenchimento de moeda
//Parametro:
//   objTextBox : Objeto (TextBox)
//   SeparadorMilesimo : Caracter separador de milésimos
//   SeparadorDecimal : Caracter separador de decimais
//   e : Evento
//Retorno: Booleano
//Autor: Gabriel Fróes - www.codigofonte.com.br
//-----------------------------------------------------
    function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e) {
        var sep = 0;
        var key = '';
        var i = j = 0;
        var len = len2 = 0;
        var strCheck = '0123456789';
        var aux = aux2 = '';
        var whichCode = (window.Event) ? e.which : e.keyCode;
        if (whichCode == 13)
            return true;
        key = String.fromCharCode(whichCode); // Valor para o código da Chave
        if (strCheck.indexOf(key) == -1)
            return false; // Chave inválida
        len = objTextBox.value.length;
        for (i = 0; i < len; i++)
            if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal))
                break;
        aux = '';
        for (; i < len; i++)
            if (strCheck.indexOf(objTextBox.value.charAt(i)) != -1)
                aux += objTextBox.value.charAt(i);
        aux += key;
        len = aux.length;
        if (len == 0)
            objTextBox.value = '';
        if (len == 1)
            objTextBox.value = '0' + SeparadorDecimal + '0' + aux;
        if (len == 2)
            objTextBox.value = '0' + SeparadorDecimal + aux;
        if (len > 2) {
            aux2 = '';
            for (j = 0, i = len - 3; i >= 0; i--) {
                if (j == 3) {
                    aux2 += SeparadorMilesimo;
                    j = 0;
                }
                aux2 += aux.charAt(i);
                j++;
            }
            objTextBox.value = '';
            len2 = aux2.length;
            for (i = len2 - 1; i >= 0; i--)
                objTextBox.value += aux2.charAt(i);
            objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
        }
        return false;
    }
</script>

<section class="col-md-6">

    <h2> CADASTRAR COBRANÇAS </h2>

    <form action="" class="form" method="post"> 
        <div class="col-md-12"> 
            <p>Documento (placa o cliente) </p>
            <input type="text" name="documento" class="form-control" placeholder="placa do cliente" <?php
            if ($_GET['placa']):
                echo "value=\"{$_GET['placa']}\"";
            else:
                echo "value=\"\"";
            endif;
            ?> />
        </div>
        <div class="col-md-12"> 
            <p>Valor </p>
            <input type="text" name="valor" class="form-control" placeholder="valor do boleto" onKeyPress="return(MascaraMoeda(this, '.', ',', event))"

                   <?php
                   if ($_GET['placa']):
                       echo "value=\"{$_GET['plano']}\"";
                   else:
                       echo "value=\"\"";
                   endif;
                   ?>

                   />
        </div>
        <div class="col-md-12"> 
            <p>Quantidade de Parcelas </p>
            <input type="text" class="form-control" name="parcelas" />
        </div>
        <div class="col-md-12">
            <p>Emissão </p>
            <input type="text" class="form-control" name="emissao" value="<?= date("Y-m-d") ?>"  />
        </div>
        <div class="col-md-12">
            <p>Data Vencimento </p>
            <input type="text" class="form-control" name="vencimento" />
        </div>
        <div class="col-md-12"> 
            <p>Motivo Cobrança </p>
            <select name="motivo" class="form-control"> 
                <option value="1"> Monitoramento </option>
                <option value="2"> Adesão </option>
                <option value="3"> Rateio </option>

            </select>
        </div>
        <div class="col-md-12">
            <input type="submit" name="send" value="CADASTRAR"class="btn btn-primary" />
        </div>

    </form>

</section>



<section class="col-md-6"> 

    <h2> COBRANÇAS CADASTRADAS </h2>


    <table class="table table-responsive table-bordered table-condensed">
        <thead>
        <th> Documento</th>
        <th> Parcela</th>
        <th> Valor</th>
        <th> Vencimento</th>
        <th> Pago</th>
       <th> Tipo</th>
        <th> Status</th>
        <th>Editar</th>
        </thead>

        <tbody> 
    <?php
    $cadastradas = new Read();
    $cadastradas->ExeRead("boletoscaixa", "WHERE documento = :p ORDER BY parcela ASC", "p={$_GET['placa']}");
    $cadastradas->getResult();

    foreach ($cadastradas->getResult() as $value) {

        $vencimento = date("d/m/Y", strtotime($value['vencimento']));

        $tipo = $value['tipo'];

        if ($tipo == "1"):
            $tipo = "Monitoramento";
        endif;
        if ($tipo == "2"):
            $tipo = "Adesão";
        endif;
        if ($tipo == "3"):
            $tipo = "Outros";
        endif;

        $status = $value['status'];

        $valor = number_format($value['valor'] / 100, 2, ",", ".");


echo "<tr>";
        echo "<td> <span class=\"fontep\">{$value['documento']}</td>";
        echo "<td> -- {$value['parcela']}  </td>";
        echo "<td> R$ {$valor}</td>";
        echo "<td> {$vencimento}</td>";
        echo "<td> {$value['pg']}</td>";
        echo "<td> {$tipo}</td>";
        if ($status == "1"):
            echo "<td > <span class=\"vermelho\"> EM ABERTO </span> </td>";
        endif;
        if ($status == "2"):
            echo "<td > <span class=\"verde\"> Pago </span></td>";
        endif;

        echo "<td > Editar </td>";

    }
   echo "</tr>";
    ?>
        </tbody>

    </table>




</section>