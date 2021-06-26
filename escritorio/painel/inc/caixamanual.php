


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

<section class="col-md-12">

    <h2> BUSCAR COBRANÇAS CAIXA</h2>
    
    <?php 
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    

    
   // var_dump($filtro);
    ?>

    <form action="" class="form" method="post"> 
        <div class="col-md-12"> 
            <p>Documento (placa o cliente) </p>
            <input type="text" name="q" class="form-control" placeholder="BUSCA " />
        </div>
        <div class="col-md-12 form-inline"> 

             <div class="radio">
                        <label>
                            <input type="radio" name="filtro" value="associado"> NOME
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="filtro" value="contrato"> CONTRATO
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="filtro" value="placa1"> PLACA
                        </label>
                    </div>
            
        </div>
        </br> </br>

        <div class="col-md-12">
            <input type="submit" name="send" value="CADASTRAR"class="btn btn-primary" />
        </div>

    </form>

</section>

<?php if(isset($filtro['q'])){ ?>

<section class="col-md-12 page-header"> 
    <h3>Sua busca por <?= $filtro['q'] ?> pelo filtro <?= $filtro['filtro'] ?> retornou os seguintes resultados</h3>
</section>

<?php } ?>

<?php 

            $exibe = new Read();
            $exibe->ExeRead("prevendaacasp", "WHERE {$filtro['filtro']} LIKE '%' :link '%'", "link={$filtro['q']}");
            $exibe->getResult();
            
            foreach ($exibe->getResult() as $valor) {
                


?>

<!-- aqui começa o loop das placas encontradas -->
<p> Placas encontrada <?= $valor['placa1'] ?> </p>


<?php 

?>


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
        <th>Delete</th>
        </thead>

        <tbody> 
            <?php
            $cadastradas = new Read();
            $cadastradas->ExeRead("boletoscaixa", "WHERE documento = :p ORDER BY parcela ASC", "p={$valor['placa1']}");
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

                //$datapg = explode("-", $value['pg']);
                $pg = $value['pg'];


                echo "<tr>";
                echo "<td> <span class=\"fontep\">{$value['documento']}</td>";
                echo "<td> -- {$value['parcela']}  </td>";
                echo "<td> R$ {$valor}</td>";
                echo "<td> {$vencimento}</td>";
                echo "<td> " . $pg . "</td>";
                echo "<td> {$tipo}</td>";
                if ($status == "1"):
                    echo "<td > <span class=\"vermelho\"> EM ABERTO </span> </td>";
                endif;
                if ($status == "2"):
                    echo "<td > <span class=\"verde\"> Pago </span></td>";
                endif;

                echo "<td >       <button type=\"button\" class=\"btn btn-info\" 
              data-toggle=\"modal\" data-target=\"#{$value['id_boleto']}\">
        EDITAR
      </button> </td>";

                echo "<td> <a href=\"index.php?p=cobrancasacasp&del={$value['id_boleto']}\" ><span class=\"glyphicon glyphicon-remove\" style=\"font-size:25px; color:red;\" > </a></td>"
                ?>

            <div class="modal fade" id="<?= $value['id_boleto'] ?>">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                         cabecalho 
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                            <h4 class="modal-title">COBRANÇA ID # <?= $value['id_boleto'] ?></h4>
                        </div>

                         corpo 
                        <div class="modal-body">

                            <h3> Corpo do Modal </h3>

                            <form action="" class="form" name="cobranca" method="get">

                                <div class="form-group"> 
                                    <p> ID Cobranca </p>
                                    <input type="text" class="form-control" name="id_boleto" value="<?= $value['id_boleto'] ?>" />
                                </div>
                                <div class="form-group"> 
                                    <p> DOCUMENTO </p>
                                    <input type="text" class="form-control" name="documento" value="<?= $value['documento'] ?>" />
                                </div>
                                <div class="form-group"> 
                                    <p> PARCELA</p>
                                    <input type="text" class="form-control" name="parcela" value="<?= $value['parcela'] ?>" />
                                </div>
                                <div class="form-group"> 
                                    <p> VALOR</p>
                                    <input type="text" class="form-control" name="valor" value="<?= $valor ?>" />
                                </div>
                                <div class="form-group"> 
                                    <p> VENCIMENTO </p>
                                    <input type="text" class="form-control" name="vencimento" value="<?= $vencimento ?>" />
                                </div>
                                <div class="form-group"> 
                                    <p> STATUS </p>
                                    <select name="status" class="form-control"> 

                                        <option value="<?= $value['parcela'] ?>"> <?php
                                            if ($value['parcela'] == 1):
                                                echo "EM ABERTO";
                                            endif;
                                            if ($value['parcela'] == 2):
                                                echo "PAGO";
                                            endif;

                                            $value['parcela']
                                            ?></option>
                                        <option value=""> Selecione uma opção</option>
                                        <option value="1"> EM ABERTO</option>
                                        <option value="2"> PAGO</option>
                                    </select>
                                </div>
                                <div class="form-group"> 
                                    <p> DATA PAGAMENTO </p>
                                    <input type="text" class="form-control" name="pg" placeholder="31/13/1999" />
                                </div>
                                <div class="form-group"> 

                                    <input type="hidden"  name="p" value="<?= $_GET['p'] ?>" />
                                    <input type="hidden"  name="placa1" value="<?= $valor['placa1'] ?>" />
                                    <input type="submit" class="btn btn-primary" name="atualiza" value="ATUALIZA" />
                                </div>


                            </form>

                        </div>

                         rodape 
                        <div class="modal-footer">

                            Rodape

                        </div>

                    </div>
                </div>

            </div>

            <?php
        }
        echo "</tr>";
        ?>
        </tbody>

    </table>




</section>

<!-- aqui tremina o loop das placas encontradas -->
<?php } ?>



