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

<?php
$dia = $_GET['dia'];
if (empty($dia)):
    $dia = date("d");
endif;
$mes = $_GET['mes'];
if (empty($mes)):
    $mes = date("m");
endif;
$ano = $_GET['ano'];
if (empty($ano)):
    $ano = date("Y");
endif;

if (empty($_GET['ano'])):

    echo "<meta http-equiv=\"refresh\" content=1;url=\"index.php?p=fluxocaixa&ano={$ano}&mes={$mes}&dia={$dia}&view=resultados\"> ";
//header("location:index.php?p=fluxocaixa&ano={$ano}");
endif;
?>

<main class="content"> 
    <h3 class="page-header"> Fluxo Caixa </h3>
    <section class="row col-md-12"> 
        <form action="" class="form" method="GET">

            <div class="col-md-2"> 
                <label>DIA </label>
                <select name="dia" class="form-control">

                    <option value="<?= $dia ?>"><?= $dia ?></option>   
                    <option value="mes">00 busca por mes</option>   
                    <option value="01">01</option>   
                    <option value="02">02</option>   
                    <option value="03">03</option>   
                    <option value="04">04</option>   
                    <option value="05">05</option>   
                    <option value="06">06</option>   
                    <option value="07">07</option>   
                    <option value="08">08</option>   
                    <option value="09">09</option>   
                    <option value="10">10</option> 
                    <option value="11">11</option>   
                    <option value="12">12</option>   
                    <option value="13">13</option>   
                    <option value="14">14</option>   
                    <option value="15">15</option>   
                    <option value="16">16</option>   
                    <option value="17">17</option>   
                    <option value="18">18</option>   
                    <option value="19">19</option>   
                    <option value="20">20</option>                   
                    <option value="21">21</option>   
                    <option value="22">22</option>   
                    <option value="23">23</option>   
                    <option value="24">24</option>   
                    <option value="25">25</option>   
                    <option value="26">26</option>   
                    <option value="27">27</option>   
                    <option value="28">28</option>   
                    <option value="29">29</option>   
                    <option value="30">30</option>
                    <option value="31">31</option>  
                </select>

            </div>

            <div class="col-md-3">
                <label>MES </label>
                <select name="mes" class="form-control">
                    <option value="<?= $mes ?>">  <?= $mes ?></option>
                    <option value="<?= "01" ?>">  <?= "JAN" ?></option>
                    <option value="<?= "02" ?>">  <?= "FEV" ?></option>
                    <option value="<?= "03" ?>">  <?= "MAR" ?></option>
                    <option value="<?= "04" ?>">  <?= "ABR" ?></option>
                    <option value="<?= "05" ?>">  <?= "MAI" ?></option>
                    <option value="<?= "06" ?>">  <?= "JUN" ?></option>
                    <option value="<?= "07" ?>">  <?= "JUL" ?></option>
                    <option value="<?= "08" ?>">  <?= "AGO" ?></option>
                    <option value="<?= "09" ?>">  <?= "SET" ?></option>
                    <option value="<?= "10" ?>">  <?= "OUT" ?></option>
                    <option value="<?= "11" ?>">  <?= "NOV" ?></option>
                    <option value="<?= "12" ?>">  <?= "DEZ" ?></option>
                </select>
            </div>

            <div class="col-md-3"> 
                <label>ANO </label>
                <select name="ano" class="form-control"> 


                    <option value="<?= $ano ?>"> <?= $ano ?> </option>
                    <option value="2018"> 2018 </option>
                    <option value="2019"> 2019 </option>
                    <option value="2020"> 2020 </option>
                    <option value="2021"> 2021 </option>
                    <option value="2022"> 2022 </option>
                    <option value="2023"> 2023 </option>
                    <option value="2024"> 2024 </option>
                    <option value="2025"> 2025 </option>
                </select> </div>

            <div class="col-md-3"> 
                <label>BUSCAR <span class="glyphicon glyphicon-search"> </span></label></BR>
                <input type="hidden" name="view" class="form-control" value="<?= $_GET['view'] ?>" />
                <input type="submit" name="p" value="fluxocaixa" class="btn btn-primary" /></div>
            <div class="clear"> </div>
        </form>
    </section>

    <section class="col-md-12"> 
        </br>
        <p style="font-size: 1.2em; font-weight: bold; color: #006699;"> Movimento do <?php
            if ($dia == "mes"):
                echo "mês de ";
            else:
                echo "dia  " . $dia;
            endif;
            ?> <?php
            if ($_GET['mes'] == "01"):
                echo "Janeiro";
            endif;
            if ($_GET['mes'] == "02"):
                echo "Fevereiro";
            endif;
            if ($_GET['mes'] == "03"):
                echo "Março";
            endif;
            if ($_GET['mes'] == "04"):
                echo "Abril";
            endif;
            if ($_GET['mes'] == "05"):
                echo "Maio";
            endif;
            if ($_GET['mes'] == "06"):
                echo "Junho";
            endif;
            if ($_GET['mes'] == "07"):
                echo "Julho";
            endif;
            if ($_GET['mes'] == "08"):
                echo "Agosto";
            endif;
            if ($_GET['mes'] == "09"):
                echo "Setembro";
            endif;
            if ($_GET['mes'] == "10"):
                echo "Outubro";
            endif;
            if ($_GET['mes'] == "11"):
                echo "Novembro";
            endif;
            if ($_GET['mes'] == "12"):
                echo "Desembro";
            endif;
            ?> de <?= $_GET['ano'] ?> </p>


    </section>
    <section class="col-md-12"> 


        <!-- Criação das abas -->
        <!-- <ul class="nav nav-pills" role="tablist"> -->
        <ul class="nav nav-tabs" role="tablist">
            <li <?php
            if ($_GET['view'] == "protege"): echo "class=\"active\"";
            endif;
            ?>><a href="#protege" role="tab" data-toggle="tab">ENTRADA SANTANDER</a></li>
            <li <?php
            if ($_GET['view'] == "acasp"): echo "class=\"active\"";
            endif;
            ?>><a href="#acasp" role="tab" data-toggle="tab">ENTRADA CAIXA </a></li>
            <li <?php
            if ($_GET['view'] == "adesaoprotege"): echo "class=\"active\"";
            endif;
            ?>><a href="#adesaoprotege" role="tab" data-toggle="tab">ADESÃO PROTEGE </a></li>
            
            <li <?php
            if ($_GET['view'] == "adesaoacasp"): echo "class=\"active\"";
            endif;
            ?>><a href="#adesaoacasp" role="tab" data-toggle="tab">ADESÃO ASSOCIAÇÃO </a></li>
            
            
            <li <?php
            if ($_GET['view'] == "transferenciaprotege"): echo "class=\"active\"";
            endif;
            ?>><a href="#transferenciaprotege" role="tab" data-toggle="tab">TRANSFERÊNCIA PROTEGE </a></li>
            
            
            
            <li <?php
            if ($_GET['view'] == "transferenciaacasp"): echo "class=\"active\"";
            endif;
            ?>><a href="#transferenciaacasp" role="tab" data-toggle="tab">TRANSFERÊNCIA ACASP </a></li>
            
            <li <?php
            if ($_GET['view'] == "comissao"): echo "class=\"active\"";
            endif;
            ?>><a href="#comissao" role="tab" data-toggle="tab">COMISSÕES</a></li>
            <li <?php
            if ($_GET['view'] == "pagamento"): echo "class=\"active\"";
            endif;
            ?>><a href="#pagamento" role="tab" data-toggle="tab">PAGAMENTOS</a></li>
            <li <?php
            if ($_GET['view'] == "despezas"): echo "class=\"active\"";
            endif;
            ?>><a href="#despezas" role="tab" data-toggle="tab">DESPEZAS FIXAS</a></li>
            <li <?php
            if ($_GET['view'] == "resultados"): echo "class=\"active\"";
            endif;
            ?>><a href="#resultados" role="tab" data-toggle="tab">RESULTADOS</a></li>
        </ul>



        <!-- Conteúdo das abas -->
        <div class="tab-content">

            <!-- aba PROTEGE -->
            <div class="tab-pane" role="tabpanel" id="protege">






                <h3>ENTRADAS PROTEGE</h3>
                <?php
                if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $entradaprot = new Read();
                        $entradaprot->ExeRead("boletosantander", "WHERE  MONTH(pg) = :m AND YEAR(pg) = :a", "m={$_GET['mes']}&a={$_GET['ano']}");
                        $entradaprot->getResult();

                        echo "Busca o mes e ano";

                    else:

                        $entradaprot = new Read();
                        $entradaprot->ExeRead("boletosantander", "WHERE  MONTH(pg) = :m AND YEAR(pg) = :a AND DAY(pg) = :d", "m={$_GET['mes']}&a={$_GET['ano']}&d={$_GET['dia']}");
                        $entradaprot->getResult();

                        echo "Busca o dia , mes e ano";

                    endif;

                endif;
                ?>


                <section class="col-md-12"> 
                    <h3>Entradas Boletos Protege </h3>

                    <table class="table-responsive table-striped table-bordered table-hover table-condensed col-md-12">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Parcela</th>
                                <th>Vencimento</th>
                                <th>Pago em</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($entradaprot->getResult() as $value) {
                                ?>


                                <tr>
                                    <td>
                                        Documento </br> 
                                        <b><?= $value['documento'] ?></b></td>
                                    <td>Parcela </br> 
                                        <b><?= $value['parcela'] ?></b></td>
                                    <td>Vencimento </br> 
                                        <b><?= date("d/m/Y", strtotime($value['vencimento'])) ?></b></td>
                                    <td>Pago em</br> 
                                        <b><?= date("d/m/Y", strtotime($value['pg'])) ?></b></td>
                                    <td>Valor</br> 
                                        <b><?= number_format($value['valor'] / 100, 2, ",", "."); ?></b></td>

                                </tr>

                                <?php
                                $somaprotege += $value['valor'];
                                ?>


                            <?php } ?>


                        </tbody>
                    </table>
                    </br>






                    <div class="col-md-12"> 
                        <h3>Soma é de R$ <?php echo number_format($somaprotege / 100, 2, ",", "."); ?></h3>
                    </div>

                </section>




            </div>

            <!-- aba ACASP -->
            <div class="tab-pane" role="tabpanel" id="acasp">
                <h3>ENRADAS ASSOCIAÇÃO (CAIXA)</h3>
                <?php
                if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $entradaacasp = new Read();
                        $entradaacasp->ExeRead("boletoscaixa", "WHERE  MONTH(pg) = :m AND YEAR(pg) = :a", "m={$_GET['mes']}&a={$_GET['ano']}");
                        $entradaacasp->getResult();

                        echo "Busca o mes e ano";

                    else:

                        $entradaacasp = new Read();
                        $entradaacasp->ExeRead("boletoscaixa", "WHERE  MONTH(pg) = :m AND YEAR(pg) = :a AND DAY(pg) = :d", "m={$_GET['mes']}&a={$_GET['ano']}&d={$_GET['dia']}");
                        $entradaacasp->getResult();

                        echo "Busca o dia , mes e ano";

                    endif;

                endif;
                ?>


                <section class="col-md-12"> 
                    <h3>Entradas Boletos Associaçao (CAIXA) </h3>

                    <table class="table-responsive table-striped table-bordered table-hover table-condensed col-md-12">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Parcela</th>
                                <th>Vencimento</th>
                                <th>Pago em</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($entradaacasp->getResult() as $value) {
                                ?>


                                <tr>
                                    <td>
                                        Documento </br> 
                                        <b><?= $value['documento'] ?></b></td>
                                    <td>Parcela </br> 
                                        <b><?= $value['parcela'] ?></b></td>
                                    <td>Vencimento </br> 
                                        <b><?= date("d/m/Y", strtotime($value['vencimento'])) ?></b></td>
                                    <td>Pago em</br> 
                                        <b><?= date("d/m/Y", strtotime($value['pg'])) ?></b></td>
                                    <td>Valor</br> 
                                        <b><?= number_format($value['valor'] / 100, 2, ",", "."); ?></b></td>

                                </tr>

                                <?php
                                $somaacasp += $value['valor'];
                                ?>


                            <?php } ?>


                        </tbody>
                    </table>
                    </br>






                    <div class="col-md-12"> 
                        <h3>Soma é de R$ <?php echo number_format($somaacasp / 100, 2, ",", "."); ?></h3>
                    </div>

                </section>
            </div>
            <!-- aba ADESÃO E TRANSFERENCIAS -->
            <div class="tab-pane <?php
            if ($_GET['view'] == "adesao"): echo "active";
            endif;
            ?>" role="tabpanel" id="adesao">

                <?php
                $filtro = filter_input_array(INPUT_GET, FILTER_DEFAULT);

                if (isset($filtro['adesaoprotege'])):

                    //var_dump($filtro);
                    // esse array atualiza a tabela prevenda
                    $dadosatualiza = [
                        "id_venda" => $filtro['id_venda'],
                        "entrada" => 1
                    ];

                    $updateentrada = new Update();
                    $updateentrada->ExeUpdate("prevenda", $dadosatualiza, "WHERE id_venda = :p", "p={$filtro['id_venda']}");
                    $updateentrada->getResult();


                    //esse array da entrada na tabela caixa

                    $filtro['adesao'] = str_replace(".", "", $filtro['adesao']); // Primeiro tira os pontos
                    $filtro['adesao'] = str_replace(",", "", $filtro['adesao']); // Depois tira a vírgula

                    $cadastracaixa = [
                        "tipo" => 1,
                        "valor" => $filtro['adesao'],
                        "categoria" => $filtro['categoria'],
                        "data" => date("Y-m-d"),
                        "meios" => $filtro['meios'],
                        "obs" => $filtro['obs'],
                        "placa" => $filtro['placa']
                    ];

                    $icaixap = new Create();
                    $icaixap->ExeCreate("caixa", $cadastracaixa);
                    $icaixap->getResult();

                    if ($icaixap->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Entrada no caixa realizada com sucesso</div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao dar enrada no caixa</div>";
                    endif;

                    //esse array da entrada na tabela comissões

                    $filtro['comissao'] = str_replace(".", "", $filtro['comissao']); // Primeiro tira os pontos
                    $filtro['comissao'] = str_replace(",", "", $filtro['comissao']); // Depois tira a vírgula

                    $comissao = [
                        "vendedor" => $filtro['vendedor'],
                        "cliente" => $filtro['placa'],
                        "valor" => $filtro['comissao'],
                        "data" => date("Y-m-d")
                    ];

                    $icomp = new Create();
                    $icomp->ExeCreate("comissao", $comissao);
                    $icomp->getResult();

                    if ($icomp->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Comissão cadastrada com sucesso</div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao cadastrar comissão </div>";
                    endif;

//                    print_r($dadosatualiza);
//                    print_r($cadastracaixa);
//                    print_r($comissao);


                endif;
                ?>
                <!-- INCIO BLOCO  -->
                <h3>ADESÃO PROTEGE</h3>
                <?php
                if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $adesaoprot = new Read();
                        $adesaoprot->ExeRead("prevenda", "WHERE entrada = :e AND YEAR(data) = :a AND MONTH(data) = :m ORDER BY data DESC", "e=0&a={$_GET['ano']}&m={$_GET['mes']}");
                        $adesaoprot->getResult();

                    //echo "Busca o mes e ano";

                    else:

                        $adesaoprot = new Read();
                        $adesaoprot->ExeRead("prevenda", "WHERE entrada = :e AND YEAR(data) = :a AND MONTH(data) = :m AND DAY(data) = :d ORDER BY data DESC", "e=0&a={$_GET['ano']}&m={$_GET['mes']}&d={$_GET['dia']}");
                        $adesaoprot->getResult();


                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
                ?>

                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Data Venda</th>
                            <th>Placa</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Valor Adesão / Trasf</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($adesaoprot->getResult() as $retorno) {
                            ?>
                            <tr>
                                <td><?= date("d/m/Y", strtotime($retorno['data'])) ?></td>
                                <td><?= $retorno['placa'] ?></td>
                                <td><?= $retorno['cliente'] ?></td>
                                <td><?php
                                    $puxavend = $retorno['vendedor'];
                                    $vend = new Read();
                                    $vend->ExeRead("usuario", "WHERE id_usuario = :p", "p={$puxavend}");
                                    $vend->getResult();

                                    echo $vend->getResult()[0]['nome'];
                                    ?></td>
                                <td><?php
                                    $puxaadesao = $retorno['adesao'];

                                    $valoradesao = $retorno['adesao'];

                                    $valoradesao = str_replace("R$", "", $valoradesao); // Primeiro tira os pontos
                                    $valoradesao = str_replace(" ", "", $valoradesao); // Primeiro tira os pontos
                                    $valoradesao = str_replace(".", "", $valoradesao); // Primeiro tira os pontos
                                    $valoradesao = str_replace(",", "", $valoradesao); // Depois tira a vírgula

                                    echo number_format($valoradesao / 100, 2, ",", ".");

                                    $somaadesaoprot += $valoradesao;
                                    ?></td>
                                <td>     <button type="button" class="btn btn-info" 
                                                 data-toggle="modal" data-target="#janelaap<?= $retorno['placa'] ?>">
                                        Dar Entrada
                                    </button></td>
                            </tr>


                            <!-- inicio modal Adesão Protege -->  
                        <div class="modal fade" id="janelaap<?= $retorno['placa'] ?>">

                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- cabecalho -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                        <h4 class="modal-title"></h4>
                                    </div>

                                    <!-- corpo -->
                                    <div class="modal-body">

                                        <h2> ENTRADA DE ADESÃO PROTEGE PLACA <?= $retorno['placa'] ?> </h2>

                                        <form class="form" name="adesaoprotege" method="get"> 
                                            <div class="group-form">
                                                <label> Cliente </label>
                                                <input type="text" name="cliente" class="form-control" value="<?= $retorno['cliente'] ?>" />
                                            </div>
                                            <div class="group-form">
                                                <label> Placa </label>
                                                <input type="text" name="placa" class="form-control" value="<?= $retorno['placa'] ?>" />
                                            </div>
                                            <div class="group-form">
                                                <label> Valor </label>
                                                <input type="text" name="adesao" class="form-control" value="<?= $retorno['adesao'] ?>" />
                                            </div>
                                            <div class="group-form form-inline">
                                                <label> Tipo de Entrada</label>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="1"> Dinheiro
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="2"> Cheque
                                                    </label>
                                                </div>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="3"> Maquina / Cartão
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="4"> PAGSEGURO
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="5">Boleto
                                                    </label>
                                                </div>

                                            </div>

                                            <div class="form-group"> 
                                                <label> Observações </label>
                                                <textarea class="form-control" name="obs"> </textarea>   
                                            </div>

                                            <hr>
                                            <h3> Lançar Comissao</h3>

                                            <div class="form-group"> 
                                                <label> Vendedor - <?php echo $vend->getResult()[0]['nome']; ?> </label>
                                                <input type="hidden" name="vendedor"  value="<?= $retorno['vendedor'] ?>" />
                                                <input type="hidden" name="p"  value="<?= $_GET['p'] ?>" />
                                                <input type="hidden" name="view"  value="<?= $_GET['view'] ?>" />
                                                <input type="hidden" name="ano"  value="<?= $_GET['ano'] ?>" />
                                                <input type="hidden" name="mes"  value="<?= $_GET['mes'] ?>" />
                                                <input type="hidden" name="dia"  value="<?= $_GET['dia'] ?>" />
                                                <input type="hidden" name="id_venda"  value="<?= $retorno['id_venda'] ?>" />
                                            </div>
                                            <div class="form-group"> 
                                                <label>Categoria </label>
                                                <select name="categoria" class="form-control"> 
                                                    <?php
                                                    $puxacateg = new Read();
                                                    $puxacateg->ExeRead("categmov", "WHERE tipo = :c ORDER BY categoria ASC", "c=1");
                                                    $puxacateg->getResult();
                                                    foreach ($puxacateg->getResult() as $value) {
                                                        ?>
                                                        <option value="<?= $value['id_categ'] ?>"> <?= $value['categoria'] ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group"> 
                                                <label> Comissão </label>
                                                <input type="text" name="comissao" class="form-control" onKeyPress="return(MascaraMoeda(this, '.', ',', event))"  />
                                            </div>


                                            <div class="group-form">

                                                <input type="submit" name="adesaoprotege" class="btn btn-primary"  />
                                            </div>

                                        </form>
                                    </div>

                                    <!-- rodape -->
                                    <div class="modal-footer">



                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- fim modal Adesão Proege -->                       



                    <?php } ?>
                    <tr> 
                        <td class="success"> A Receber R$ <?php echo number_format($somaadesaoprot / 100, 2, ",", "."); ?> </td>
                    </tr>

                    </tbody>
                </table>

                <!-- FIM DO BLOCO -->
                <!-- INCIO BLOCO  -->



                <h3>TRANSFERÊNCIAS PROTEGE</h3>
                <?php
                $filtrotp = filter_input_array(INPUT_GET, FILTER_DEFAULT);

                if (isset($filtrotp['transferenciaprotege'])):

                    $filtrotp['adesao'] = str_replace(".", "", $filtrotp['adesao']);
                    $filtrotp['adesao'] = str_replace(",", "", $filtrotp['adesao']);

                    //esse array é para atualizar entrada  transferencia

                    $statustransf = [
                        "id_venda" => $filtrotp['id_venda'],
                        "entradatransf" => 1
                    ];

                    $uptransp = new Update();
                    $uptransp->ExeUpdate("prevenda", $statustransf, "WHERE id_venda = :p", "p={$filtrotp['id_venda']}");
                    $uptransp->getResult();

                    if ($uptransp->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Transferencia atualizada com sucesso</div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO na atualização </div>";
                    endif;

                    //esse array é para dar entrada no banco caixa

                    $entradatransf = [
                        "tipo" => 1,
                        "valor" => $filtrotp['adesao'],
                        "categoria" => $filtrotp['categoria'],
                        "data" => date("Y-m-d"),
                        "meios" => $filtrotp['meios'],
                        "obs" => $filtrotp['obs'],
                        "placa" => $filtrotp['placa']
                    ];

                    $ientradatransf = new Create();
                    $ientradatransf->ExeCreate("caixa", $entradatransf);
                    $ientradatransf->getResult();

                    if ($ientradatransf->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Entrada no caixa com sucesso</div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO na entrada do caixa</div>";

                    endif;

//                    print_r($statustransf);
//                    print_r($entradatransf);
//
//
//                    var_dump($filtrotp);


                endif;
                ?>
                <?php
                if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $transfprot = new Read();
                        $transfprot->ExeRead("prevenda", "WHERE entrada = :e AND YEAR(datatransf) = :a AND MONTH(datatransf) = :m AND entradatransf = :g ORDER BY datatransf DESC", "e=0&a={$_GET['ano']}&m={$_GET['mes']}&g=0");
                        $transfprot->getResult();

                    //echo "Busca o mes e ano";

                    else:

                        $transfprot = new Read();
                        $transfprot->ExeRead("prevenda", "WHERE entrada = :e AND YEAR(datatransf) = :a AND MONTH(datatransf) = :m AND DAY(datatransf) = :d AND entradatransf = :g ORDER BY datatransf DESC", "e=0&a={$_GET['ano']}&m={$_GET['mes']}&d={$_GET['dia']}&g=0");
                        $transfprot->getResult();


                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
                ?>

                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Data Venda</th>
                            <th>Placa</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Valor Adesão / Trasf</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($transfprot->getResult() as $retornotp) {
                            ?>
                            <tr>
                                <td><?= date("d/m/Y", strtotime($retornotp['datatransf'])) ?></td>
                                <td><?= $retornotp['placa'] ?></td>
                                <td><?= $retornotp['cliente'] ?></td>
                                <td><?php
                                    $puxavend = $retornotp['vendedor'];
                                    $vend = new Read();
                                    $vend->ExeRead("usuario", "WHERE id_usuario = :p", "p={$puxavend}");
                                    $vend->getResult();

                                    echo $vend->getResult()[0]['nome'];
                                    ?></td>
                                <td><?php
                                    $valortransfp = $retornotp['adesao'];

                                    $valortransfp = str_replace("R$", "", $valortransfp); // Primeiro tira os pontos
                                    $valortransfp = str_replace(" ", "", $valortransfp); // Primeiro tira os pontos
                                    $valortransfp = str_replace(".", "", $valortransfp); // Primeiro tira os pontos
                                    $valortransfp = str_replace(",", "", $valortransfp); // Depois tira a vírgula

                                    echo number_format($valortransfp / 100, 2, ",", ".");

                                    $somatransfprot += $valortransfp;
                                    ?></td>
                                <td>      <button type="button" class="btn btn-info" 
                                                  data-toggle="modal" data-target="#janelatp<?= $retornotp['placa'] ?>">
                                        Dar Entrada
                                    </button></td>
                            </tr>

                            <!-- inicio modal Transferencia Proege -->  
                        <div class="modal fade" id="janelatp<?= $retornotp['placa'] ?>">

                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- cabecalho -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                        <h4 class="modal-title"></h4>
                                    </div>

                                    <!-- corpo -->
                                    <div class="modal-body">

                                        <h2> ENTRADA DE TRANSFERÊNCIAPROTEGE PLACA <?= $retornotp['placa'] ?> </h2>

                                        <form class="form" name="adesaoprotege" method="get"> 
                                            <div class="group-form">
                                                <label> Cliente </label>
                                                <input type="text" name="cliente" class="form-control" value="<?= $retornotp['cliente'] ?>" />
                                            </div>
                                            <div class="group-form">
                                                <label> Valor </label>
                                                <input type="text" name="adesao" class="form-control" value="<?= $retornotp['adesao'] ?>" />
                                            </div>
                                            <div class="group-form">
                                                <label> Placa </label>
                                                <input type="text" name="placa" class="form-control" value="<?= $retornotp['placa'] ?>" />
                                            </div>

                                            <div class="group-form form-inline">
                                                <label> Tipo de Entrada</label>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="1"> Dinheiro
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="2"> Cheque
                                                    </label>
                                                </div>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="3"> Maquina / Cartão
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="4"> PAGSEGURO
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="5">Boleto
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="form-group"> 
                                                <label> Observações </label>
                                                <textarea class="form-control" name="obs"> </textarea>
                                            </div>

                                            <div class="form-group"> 
                                                <label>Categoria </label>
                                                <select name="categoria" class="form-control"> 
                                                    <?php
                                                    $puxacateg = new Read();
                                                    $puxacateg->ExeRead("categmov", "WHERE tipo = :c ORDER BY categoria ASC", "c=1");
                                                    $puxacateg->getResult();
                                                    foreach ($puxacateg->getResult() as $value) {
                                                        ?>
                                                        <option value="<?= $value['id_categ'] ?>"> <?= $value['categoria'] ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group"> 

                                                <input type="hidden" name="vendedor"  value="<?= $retornotp['vendedor'] ?>" />
                                                <input type="hidden" name="p"  value="<?= $_GET['p'] ?>" />
                                                <input type="hidden" name="view"  value="<?= $_GET['view'] ?>" />
                                                <input type="hidden" name="ano"  value="<?= $_GET['ano'] ?>" />
                                                <input type="hidden" name="mes"  value="<?= $_GET['mes'] ?>" />
                                                <input type="hidden" name="dia"  value="<?= $_GET['dia'] ?>" />
                                                <input type="hidden" name="id_venda"  value="<?= $retornotp['id_venda'] ?>" />
                                            </div>



                                            <div class="group-form">

                                                <input type="submit" name="transferenciaprotege" class="btn btn-primary"  />
                                            </div>

                                        </form>
                                    </div>

                                    <!-- rodape -->
                                    <div class="modal-footer">



                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- fim modal Adesão Transferencia Protege --> 






                    <?php } ?>
                    <tr class="success">
                        <td>A receber R$ <?= number_format($somatransfprot / 100, 2, ",", ".") ?> </td>
                    </tr>
                    </tbody>
                </table>

                <!-- FIM DO BLOCO -->



                <!-- INICIO BLOCO  -->
                <h3>ADESÃO  ASSOCIAÇÃO</h3>

                <?php
                $filtroaa = filter_input_array(INPUT_GET, FILTER_DEFAULT);

                if (isset($filtroaa['entradaacasp'])):

                    // esse array atualiza a tabela prevenda
                    $dadosatualiza = [
                        "id_venda" => $filtroaa['id_venda'],
                        "entrada" => 1
                    ];

                    $updateentrada = new Update();
                    $updateentrada->ExeUpdate("prevendaacasp", $dadosatualiza, "WHERE id_venda = :p", "p={$filtroaa['id_venda']}");
                    $updateentrada->getResult();


                    //esse array da entrada na tabela caixa

                    $filtroaa['adesao'] = str_replace(".", "", $filtroaa['adesao']); // Primeiro tira os pontos
                    $filtroaa['adesao'] = str_replace(",", "", $filtroaa['adesao']); // Depois tira a vírgula

                    $cadastracaixa = [
                        "tipo" => 1,
                        "valor" => $filtroaa['adesao'],
                        "categoria" => $filtroaa['categoria'],
                        "data" => date("Y-m-d"),
                        "meios" => $filtroaa['meios'],
                        "obs" => $filtroaa['obs'],
                        "placa" => $filtroaa['placa']
                    ];

                    $icaixap = new Create();
                    $icaixap->ExeCreate("caixa", $cadastracaixa);
                    $icaixap->getResult();

                    if ($icaixap->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Entrada no caixa realizada com sucesso</div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao dar enrada no caixa</div>";
                    endif;

                    //esse array da entrada na tabela comissões

                    $filtroaa['comissao'] = str_replace(".", "", $filtroaa['comissao']); // Primeiro tira os pontos
                    $filtroaa['comissao'] = str_replace(",", "", $filtroaa['comissao']); // Depois tira a vírgula

                    $comissao = [
                        "vendedor" => $filtroaa['vendedor'],
                        "cliente" => $filtroaa['placa'],
                        "valor" => $filtroaa['comissao'],
                        "data" => date("Y-m-d")
                    ];

                    $icomp = new Create();
                    $icomp->ExeCreate("comissao", $comissao);
                    $icomp->getResult();

                    if ($icomp->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Comissão cadastrada com sucesso</div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao cadastrar comissão </div>";
                    endif;

//                    print_r($dadosatualiza);
//                    print_r($cadastracaixa);
//                    print_r($comissao);
//var_dump($filtroaa);
                endif;
                ?>   


                <?php
                if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $adesaoacasp = new Read();
                        $adesaoacasp->ExeRead("prevendaacasp", "WHERE entrada = :e AND YEAR(data) = :a AND MONTH(data) = :m AND entrada = :r ORDER BY data DESC", "e=0&a={$_GET['ano']}&m={$_GET['mes']}&r=0");
                        $adesaoacasp->getResult();

                    //echo "Busca o mes e ano";

                    else:

                        $adesaoacasp = new Read();
                        $adesaoacasp->ExeRead("prevendaacasp", "WHERE entrada = :e AND YEAR(data) = :a AND MONTH(data) = :m AND DAY(data) = :d AND entrada = :r ORDER BY data DESC", "e=0&a={$_GET['ano']}&m={$_GET['mes']}&d={$_GET['dia']}&r=0");
                        $adesaoacasp->getResult();


                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
                ?>

                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Data Venda</th>
                            <th>Placa</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Valor Adesão / Trasf</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($adesaoacasp->getResult() as $retornoaa) {
                            ?>
                            <tr>
                                <td><?= date("d/m/Y", strtotime($retornoaa['data'])) ?></td>
                                <td><?= $retornoaa['placa1'] ?></td>
                                <td><?= $retornoaa['associado'] ?></td>
                                <td><?php
                                    $puxavend = $retornoaa['vendedor'];
                                    $vend = new Read();
                                    $vend->ExeRead("usuario", "WHERE id_usuario = :p", "p={$puxavend}");
                                    $vend->getResult();

                                    echo $vend->getResult()[0]['nome'];
                                    ?></td>
                                <td><?php
                                    $valoradesaoacasp = $retornoaa['adesao'];

                                    $valoradesaoacasp = str_replace("R$", "", $valoradesaoacasp); // Primeiro tira os pontos
                                    $valoradesaoacasp = str_replace(" ", "", $valoradesaoacasp); // Primeiro tira os pontos
                                    $valoradesaoacasp = str_replace(".", "", $valoradesaoacasp); // Primeiro tira os pontos
                                    $valoradesaoacasp = str_replace(",", "", $valoradesaoacasp); // Depois tira a vírgula

                                    echo number_format($valoradesaoacasp / 100, 2, ",", ".");

                                    $somaadesaoacasp += $valoradesaoacasp;
                                    ?></td>
                                <td>

                                    <button type="button" class="btn btn-info" 
                                            data-toggle="modal" data-target="#janelaaa<?= $retornoaa['placa1'] ?>">
                                        Dar Entrada
                                    </button>

                                </td>
                            </tr>
                            <tr> </tr>




                            <!-- inicio modal ENTRADA ACASP -->  
                        <div class="modal fade" id="janelaaa<?= $retornoaa['placa1'] ?>">

                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- cabecalho -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                        <h4 class="modal-title"></h4>
                                    </div>

                                    <!-- corpo -->
                                    <div class="modal-body">

                                        <h2> ENTRADA DE ADESÃO ASSOCIAÇÃO PLACA <?= $retornoaa['placa1'] ?> </h2>

                                        <form class="form" name="adesaoprotege" method="get"> 
                                            <div class="group-form">
                                                <label> Cliente </label>
                                                <input type="text" name="cliente" class="form-control" value="<?= $retornoaa['associado'] ?>" />
                                            </div>
                                            <div class="group-form">
                                                <label> Valor </label>
                                                <input type="text" name="adesao" class="form-control" value="<?= $retornoaa['adesao'] ?>" />
                                            </div>
                                            <div class="group-form">
                                                <label> Placa </label>
                                                <input type="text" name="placa" class="form-control" value="<?= $retornoaa['placa1'] ?>" />
                                            </div>

                                            <div class="group-form form-inline">
                                                <label> Tipo de Entrada</label>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="1"> Dinheiro
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="2"> Cheque
                                                    </label>
                                                </div>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="3"> Maquina / Cartão
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="4"> PAGSEGURO
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="5">Boleto
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="form-group"> 
                                                <label> Observações </label>
                                                <textarea class="form-control" name="obs"> </textarea>
                                            </div>

                                            <div class="page-header"> 
                                                <h3> CADASTRAR COMISSÃO </h3>
                                            </div>

                                            <div class="form-group"> 
                                                <label> Vendedor <?= $vend->getResult()[0]['nome'] ?> </label>
                                            </div>
                                            <div class="form-group"> 
                                                <label> Valor da Comissão </label>
                                                <input type="text" class="form-control" name="comissao" onKeyPress="return(MascaraMoeda(this, '.', ',', event))" />
                                            </div>

                                            <div class="form-group"> 
                                                <label>Categoria </label>
                                                <select name="categoria" class="form-control"> 
                                                    <?php
                                                    $puxacateg = new Read();
                                                    $puxacateg->ExeRead("categmov", "WHERE tipo = :c ORDER BY categoria ASC", "c=1");
                                                    $puxacateg->getResult();
                                                    foreach ($puxacateg->getResult() as $value) {
                                                        ?>
                                                        <option value="<?= $value['id_categ'] ?>"> <?= $value['categoria'] ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group"> 

                                                <input type="hidden" name="vendedor"  value="<?= $retornoaa['vendedor'] ?>" />
                                                <input type="hidden" name="p"  value="<?= $_GET['p'] ?>" />
                                                <input type="hidden" name="view"  value="<?= $_GET['view'] ?>" />
                                                <input type="hidden" name="ano"  value="<?= $_GET['ano'] ?>" />
                                                <input type="hidden" name="mes"  value="<?= $_GET['mes'] ?>" />
                                                <input type="hidden" name="dia"  value="<?= $_GET['dia'] ?>" />
                                                <input type="hidden" name="id_venda"  value="<?= $retornoaa['id_venda'] ?>" />
                                            </div>



                                            <div class="group-form">

                                                <input type="submit" name="entradaacasp" class="btn btn-primary"  />
                                            </div>

                                        </form>
                                    </div>

                                    <!-- rodape -->
                                    <div class="modal-footer">



                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- fim modal Adesão Transferencia Protege --> 






                    <?php } ?>
                    <tr class="success"> 
                        <td>A receber R$ <?= number_format($somaadesaoacasp / 100, 2, ",", ".") ?> </td>
                    </tr>

                    </tbody>
                </table>
                <!-- FIM DO BLOCO -->



                <!-- INICIO BLOCO  -->
                <h3> TRANSFERÊNCIA  ASSOCIAÇÃO</h3>

                <?php
                $filtrota = filter_input_array(INPUT_GET, FILTER_DEFAULT);

                if (isset($filtrota['transferenciaacasp'])):

                    //esse array atualiza a exibição dos registros
                    $ata = [
                        "id_venda" => $filtrota['id_venda'],
                        "entrada_transf" => 1
                    ];
//    echo "ARRAY para atulizar o view </br>";
//    print_r($ata);

                    $upviewta = new Update();
                    $upviewta->ExeUpdate("prevendaacasp", $ata, "WHERE id_venda = :o", "o={$filtrota['id_venda']}");
                    $upviewta->getResult();

                    if ($upviewta->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Atualização Transferencia com sucesso </div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO naAtualização Transferencia </div>";
                    endif;

                    //esse array é para cadastra no caixa
                    $valortransfac = $filtrota['adesao'];

                    $valortransfac = str_replace("R$", "", $valortransfac); // Primeiro tira os pontos
                    $valortransfac = str_replace(" ", "", $valortransfac); // Primeiro tira os pontos
                    $valortransfac = str_replace(".", "", $valortransfac); // Primeiro tira os pontos
                    $valortransfac = str_replace(",", "", $valortransfac); // Depois tira a vírgula


                    $cta = [
                        "tipo" => 1,
                        "valor" => $valortransfac,
                        "categoria" => $filtrota['categoria'],
                        "data" => date("Y-m-d"),
                        "meios" => $filtrota['meios'],
                        "obs" => $filtrota['obs'],
                        "placa" => $filtrota['placa']
                    ];

                    $caixa = new Create();
                    $caixa->ExeCreate("caixa", $cta);
                    $caixa->getResult();

                    if ($caixa->getResult()):

                        echo "<div class=\"alert alert-success\" role=\"alert\"> Entrada no caixa realizada com sucesso   </div>";

                    else:

                        echo "<div class=\"alert alert-danger\" role=\"alert\"> ERRO na entrada da transferencia</div>";

                    endif;

// echo "</br>ARRAY para dar entrada no caixa </br>";
//var_dump($filtrota);
                endif;
                ?>


                <?php
                if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $tarnsfacasp = new Read();
                        $tarnsfacasp->ExeRead("prevendaacasp", "WHERE entrada = :e AND YEAR(data_transf) = :a AND MONTH(data_transf) = :m AND entrada_transf = :f ORDER BY data_transf DESC", "e=0&a={$_GET['ano']}&m={$_GET['mes']}&f=0");
                        $tarnsfacasp->getResult();

                    //echo "Busca o mes e ano";

                    else:

                        $tarnsfacasp = new Read();
                        $tarnsfacasp->ExeRead("prevendaacasp", "WHERE entrada = :e AND YEAR(data_transf) = :a AND MONTH(data_transf) = :m AND DAY(data_transf) = :d AND entrada_transf = :f ORDER BY data_transf DESC", "e=0&a={$_GET['ano']}&m={$_GET['mes']}&d={$_GET['dia']}&f=0");
                        $tarnsfacasp->getResult();


                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
                ?>

                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Data Venda</th>
                            <th>Placa</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Valor Adesão / Trasf</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tarnsfacasp->getResult() as $retornota) {
                            ?>
                            <tr>
                                <td><?= date("d/m/Y", strtotime($retornota['data_transf'])) ?></td>
                                <td><?= $retornota['placa1'] ?></td>
                                <td><?= $retornota['associado'] ?></td>
                                <td><?php
                                    $puxavend = $retornota['vendedor'];
                                    $vend = new Read();
                                    $vend->ExeRead("usuario", "WHERE id_usuario = :p", "p={$puxavend}");
                                    $vend->getResult();

                                    echo $vend->getResult()[0]['nome'];
                                    ?></td>
                                <td><?php
                                    $valortransfa = $retornota['valor_transf'];

                                    $valortransfa = str_replace("R$", "", $valortransfa); // Primeiro tira os pontos
                                    $valortransfa = str_replace(" ", "", $valortransfa); // Primeiro tira os pontos
                                    $valortransfa = str_replace(".", "", $valortransfa); // Primeiro tira os pontos
                                    $valortransfa = str_replace(",", "", $valortransfa); // Depois tira a vírgula

                                    echo number_format($valortransfa / 100, 2, ",", ".");

                                    $somatransfacasp += $valortransfa;
                                    ?></td>
                                <td>

                                    <button type="button" class="btn btn-info" 
                                            data-toggle="modal" data-target="#janelata<?= $retornota['placa1'] ?>">
                                        Dar Entrada
                                    </button>

                                </td>
                            </tr>



                            <!-- inicio modal Transferencia Proege -->  
                        <div class="modal fade" id="janelata<?= $retornota['placa1'] ?>">

                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- cabecalho -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                        <h4 class="modal-title"></h4>
                                    </div>

                                    <!-- corpo -->
                                    <div class="modal-body">

                                        <h2> ENTRADA DE TRANSFERÊNCIA PLACA <?= $retornota['placa1'] ?> </h2>

                                        <form class="form" name="adesaoprotege" method="get"> 
                                            <div class="group-form">
                                                <label> Cliente </label>
                                                <input type="text" name="cliente" class="form-control" value="<?= $retornota['associado'] ?>" />
                                            </div>
                                            <div class="group-form">
                                                <label> Valor </label>
                                                <input type="text" name="adesao" class="form-control" value="<?= $retornota['valor_transf'] ?>" />
                                            </div>
                                            <div class="group-form">
                                                <label> Placa </label>
                                                <input type="text" name="placa" class="form-control" value="<?= $retornota['placa1'] ?>" />
                                            </div>

                                            <div class="group-form form-inline">
                                                <label> Tipo de Entrada</label>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="1"> Dinheiro
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="2"> Cheque
                                                    </label>
                                                </div>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="3"> Maquina / Cartão
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="4"> PAGSEGURO
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="meios" class="form-control" value="5">Boleto
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="form-group"> 
                                                <label> Observações </label>
                                                <textarea class="form-control" name="obs"> </textarea>
                                            </div>

                                            <div class="form-group"> 
                                                <label>Categoria </label>
                                                <select name="categoria" class="form-control"> 
                                                    <?php
                                                    $puxacateg = new Read();
                                                    $puxacateg->ExeRead("categmov", "WHERE tipo = :c ORDER BY categoria ASC", "c=1");
                                                    $puxacateg->getResult();
                                                    foreach ($puxacateg->getResult() as $value) {
                                                        ?>
                                                        <option value="<?= $value['id_categ'] ?>"> <?= $value['categoria'] ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group"> 

                                                <input type="hidden" name="vendedor"  value="<?= $retornota['vendedor'] ?>" />
                                                <input type="hidden" name="p"  value="<?= $_GET['p'] ?>" />
                                                <input type="hidden" name="view"  value="<?= $_GET['view'] ?>" />
                                                <input type="hidden" name="ano"  value="<?= $_GET['ano'] ?>" />
                                                <input type="hidden" name="mes"  value="<?= $_GET['mes'] ?>" />
                                                <input type="hidden" name="dia"  value="<?= $_GET['dia'] ?>" />
                                                <input type="hidden" name="id_venda"  value="<?= $retornota['id_venda'] ?>" />
                                            </div>



                                            <div class="group-form">

                                                <input type="submit" name="transferenciaacasp" class="btn btn-primary"  />
                                            </div>

                                        </form>
                                    </div>

                                    <!-- rodape -->
                                    <div class="modal-footer">



                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- fim modal Adesão Transferencia Protege --> 



                    <?php } ?>
                    <tr class="success">
                        <td>A receber R$ <?= number_format($somatransfacasp / 100, 2, ",", ".") ?> </td>
                    </tr>
                    </tbody>
                </table>
                <!-- FIM DO BLOCO -->

                <div class="page-header"> 
                    <?php
                    $areceber = $somatransfacasp + $somaadesaoacasp + $somatransfprot + $somaadesaoprot;
                    ?>
                    <h2> A Receber R$ <?php echo number_format($areceber / 100, 2, ",", "."); ?> </h2>
                </div>


            </div>


            <!-- aba comissão -->
            <div class="tab-pane <?php
            if ($_GET['view'] == "comissao"):
                echo "active";
            endif;
            ?>" role="tabpanel" id="comissao">

                <div class="page-header"> 
                    <form method="get" class="form-inline" name="sendcomissao"> 
                        <label>FILTRA POR VENDEDOR </label>
                        <select name="qvend" class="form-control"> 
                            <option value="0">Selecionar Todos </option>
                            <?php
                            $exibevend = new Read();
                            $exibevend->ExeRead("usuario", "WHERE nivel = :n ORDER BY nome ASC", "n=2");
                            $exibevend->getResult();

                            foreach ($exibevend->getResult() as $valuevend) {
                                ?>
                                <option value="<?= $valuevend['id_usuario'] ?>"> <?= $valuevend['nome'] ?> </option>

                            <?php } ?>
                        </select>


                        <input type="submit" name="sendsearch" value="buscar" class="btn btn-primary"/>

                        <input type="hidden" name="view" value="comissao" />
                        <input type="hidden" name="p" value="fluxocaixa" />
                        <input type="hidden" name="ano" value="<?= $_GET['ano'] ?>" />
                        <input type="hidden" name="mes" value="<?= $_GET['mes'] ?>" />
                        <input type="hidden" name="dia" value="<?= $_GET['dia'] ?>" />
                    </form>
                </div>

                <h3>COMISSÕES A PAGAR</h3>
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Vendedor</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['status'])):

                            $filtrostatus = filter_input_array(INPUT_GET, FILTER_DEFAULT);
                            //esse array modifica status de não pago paa pago 
                            $alterastatus = [
                                "id" => $filtrostatus['id'],
                                "status" => $filtrostatus['status']
                            ];
                            print_r($alterastatus);

                            //esse array faz inclusão no banco caixa como saida de pagamento comissão

                            $pagacomissao = [
                            ];

                            var_dump($filtrostatus);

                        endif;


                        if(empty($_GET['qvend'] || $GET['qvend'] == "0")):


                        $viewcomissao = new Read();
                        $viewcomissao->ExeRead("comissao", "WHERE YEAR(data) = :d AND MONTH(data) = :m AND status = :s ORDER BY vendedor ASC", "d={$_GET['ano']}&m={$_GET['mes']}&s=0");
                        $viewcomissao->getResult();

                        else:

                        $viewcomissao = new Read();
                        $viewcomissao->ExeRead("comissao", "WHERE YEAR(data) = :d AND MONTH(data) = :m AND status = :s AND vendedor = :v ORDER BY vendedor ASC", "d={$_GET['ano']}&m={$_GET['mes']}&s=0&v={$_GET['qvend']}");
                        $viewcomissao->getResult();

                        endif;

                        foreach ($viewcomissao->getResult() as $valuecom) {
                            ?>
                            <?php
                            $total += $valuecom['valor'];
                            ?>
                            <tr>
                                <td><?php
                                    $puxave = $valuecom['vendedor'];

                                    $vend = new Read();
                                    $vend->ExeRead("usuario", "WHERE id_usuario = :p", "p={$puxave}");
                                    $vend->getResult();

                                    echo $vend->getResult()[0]['nome'];
                                    ?></td>
                                <td><?= $valuecom['cliente'] ?></td>
                                <td><?= number_format($valuecom['valor'] / 100, 2, ",", "."); ?></td>
                                <td><?= date("d/m/Y", strtotime($valuecom['data'])) ?></td>
                                <td><?php
                                    $status = $valuecom['status'];

                                    if ($status == "0"):
                                        echo "<p class=\"vermelho\">A Pagar </p>";
                                    endif;
                                    if ($status == "1"):
                                        echo "<p class=\"verde\">Pago </p>";
                                    endif;
                                    ?></td>
                                <td>     

                                    <button type="button" class="btn btn-info" 
                                            data-toggle="modal" data-target="#<?= $valuecom['id_comissao'] ?>">
                                        EFETUAR PAGAMENTO
                                    </button></td>
                            </tr>



                            <!-- Janela -->
                        <div class="modal fade" id="<?= $valuecom['id_comissao'] ?>">

                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- cabecalho -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                        <h4 class="modal-title">EFETUAR PAGAMENTO {<?= $valuecom['id_comissao'] ?>}</h4>
                                    </div>

                                    <!-- corpo -->
                                    <div class="modal-body">

                                        <h4 class="modal-title">Comissão numero  {<?= $valuecom['id_comissao'] ?>}</h4>

                                        <div class="col-md-4"> 
                                            <label>PLACA </label>
                                            <?= $valuecom['cliente'] ?>
                                        </div>


                                        <div class="col-md-4"> 
                                            <label>VALOR COMISSÃO </label>
                                            <?= number_format($valuecom['valor'] / 100, 2, ",", "."); ?>
                                        </div>

                                        <div class="col-md-4"> 
                                            <label>VENDEDOR </label>
                                            <?= $vend->getResult()[0]['nome'] ?>
                                        </div>
                                        <div class="col-md-12"> 
                                            <form method="get" name="formupcom" action="" class="form"> 
                                                <div class="form-group">
                                                    <select name="status" class="form-control"> 
                                                        <option value="<?= $valuecom['status'] ?>"> <?= $valuecom['status'] ?> </option>
                                                        <option value="0"> Á Pagar (0) </option>
                                                        <option value="1"> Pago (1) </option>
                                                    </select>
                                                </div>
                                                <div class="form-group"> 
                                                    <label>CATEGORIA </label>
                                                    <select name="categoria">
                                                        <?php
                                                        $viewcateg = new Read();
                                                        $viewcateg->ExeRead("categmov", "WHERE tipo = :t", "t=2");
                                                        $viewcateg->getResult();

                                                        foreach ($viewcateg->getResult() as $value) {
                                                            ?>
                                                            <option value="<?= $value['id_categ'] ?>"><?= $value['categoria'] ?> </option>

                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <input type="submit" name="sendupcom" value="alterar status" class="btn btn-primary" />
                                                <input type="hidden" name="dia" value="<?= $_GET['dia'] ?>" />
                                                <input type="hidden" name="mes" value="<?= $_GET['mes'] ?>" />
                                                <input type="hidden" name="ano" value="<?= $_GET['ano'] ?>" />
                                                <input type="hidden" name="view" value="comissao" />
                                                <input type="hidden" name="p" value="fluxocaixa" />
                                                <input type="hidden" name="id" value="<?= $valuecom['id_comissao'] ?>" />
                                                <input type="hidden" name="placa" value="<?= $valuecom['cliente'] ?>" />
                                                <input type="hidden" name="valor" value="<?= $valuecom['valor'] ?>" />
                                            </form>
                                        </div>



                                    </div>

                                    <!-- rodape -->
                                    <div class="modal-footer">

                                        RODAPE

                                    </div>

                                </div>
                            </div>

                        </div>


                    <?php } ?>
                    </tr>
                    </tbody>
                </table>
                <div class="page-header"> 
                    <h3> Total a pagar R$ <?= number_format($total / 100, 2, ",", "."); ?></h3>
                </div>

            </div>


            <!-- aba PAGAMENTO -->
            <div class="tab-pane <?php
            if ($_GET['view'] == "pagamento"):
                echo "active";
            endif;
            ?>" role="tabpanel" id="pagamento">
                <div class="page-header"><h3>PAGAMENTOS</h3></div>

                <?php
                $filtropagamento = filter_input_array(INPUT_GET, FILTER_DEFAULT);

                if (isset($filtropagamento['sendpagamento'])):



                    $filtropagamento['valor'] = str_replace("R$", "", $filtropagamento['valor']); // Primeiro tira os pontos
                    $filtropagamento['valor'] = str_replace(" ", "", $filtropagamento['valor']); // Primeiro tira os pontos
                    $filtropagamento['valor'] = str_replace(".", "", $filtropagamento['valor']); // Primeiro tira os pontos
                    $filtropagamento['valor'] = str_replace(",", "", $filtropagamento['valor']); // Depois tira a vírgula
                    $val = $filtropagamento['valor'];
                    $datapg = $filtropagamento['ano'] . "-" . $filtropagamento['mes'] . "-" . $filtropagamento['dia'];
                    $saidacad = [
                        "tipo" => "2",
                        "valor" => $val,
                        "categoria" => $filtropagamento['categoria'],
                        "obs" => $filtropagamento['obs'],
                        "data" => $datapg
                    ];

                    $cadsaida = new Create();
                    $cadsaida->exeCreate("caixa", $saidacad);
                    $cadsaida->getResult();

                    if ($cadsaida->getResult()):

                        echo "<div class=\"alert alert-success\" role=\"alert\"><b>Saida</b> cadastrada com sucesso</div>";

                    else:

                        echo "<div class=\"alert alert-danger\" role=\"alert\"><b>ERRO</b> ao cadastrar saida</div>";
                    endif;

//            print_r($saidacad);
//            var_dump($filtropagamento);

                endif;
                ?>


                <form name="sendpagamento" method="get" action="" class="form"> 

                    <div class="form-group"> 
                        <label> CATEGORIA</label>
                        <select name="categoria" class="form-control"> 
                            <?php
                            $ler = new Read();
                            $ler->ExeRead("categmov", "WHERE tipo = :t", "t=2");
                            $ler->getResult();
                            foreach ($ler->getResult() as $value) {
                                ?>
                                <option value="<?= $value['id_categ'] ?>"> <?= $value['categoria'] ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group"> 
                        <label> VALOR</label>
                        <input type="text" name="valor" class="form-control" onKeyPress="return(MascaraMoeda(this, '.', ',', event))" />
                    </div>
                    <div class="form-group"> 
                        <label> OBSERVAÇÕES</label>
                        <textarea name="obs" class="form-control"></textarea> 
                    </div>
                    <input type="submit" name="sendpagamento" value="INSERIR PAGAMENTOS" class="btn btn-danger" />
                    <input type="hidden" name="ano" value="<?= $_GET['ano'] ?>" />
                    <input type="hidden" name="mes" value="<?= $_GET['mes'] ?>" />
                    <input type="hidden" name="dia" value="<?= $_GET['dia'] ?>" />
                    <input type="hidden" name="view" value="pagamento" />
                    <input type="hidden" name="p" value="fluxocaixa" />
                </form>
                <hr>

                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>DATA</th>
                            <th>Categoria</th>
                            <th>Valor</th>
                            <th>Arquivos</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($_GET['dia'] == "mes"):

                            $pag = new Read();
                            $pag->ExeRead("caixa", "WHERE tipo = :t AND MONTH(data) = :m AND YEAR(data) = :a", "t=2&m={$_GET['mes']}&a={$_GET['ano']}");
                            $pag->getResult();

                        else:

                            $pag = new Read();
                            $pag->ExeRead("caixa", "WHERE tipo = :t AND DAY(data) = :d AND MONTH(data) = :m AND YEAR(data) = :a", "t=2&m={$_GET['mes']}&a={$_GET['ano']}&d={$_GET['dia']}");
                            $pag->getResult();
                        endif;
                        ?>

                        <?php
                        foreach ($pag->getResult() as $valuepg) {
                            ?>
                            <tr>
                                <td><?= date("d/m/Y", strtotime($valuepg['data'])) ?></td>
                                <td><?php
                                    $refcateg = $valuepg['categoria'];
                                    $cat = new Read();
                                    $cat->ExeRead("categmov", "WHERE id_categ = :c", "c={$refcateg}");
                                    $cat->getResult();

                                    echo $cat->getResult()[0]['categoria'];
                                    ?></td>
                                <td><?= number_format($valuepg['valor'] / 100, 2, ",", ".") ?></td>
                                <td>     

                                    <button type="button" class="btn btn-info" 
                                            data-toggle="modal" data-target="#janelaupload<?php echo $valuepg['id_entrada']; ?>">
                                        <span class="glyphicon glyphicon-paperclip"> </span>
                                    </button>

                                    <button type="button" class="btn btn-success" 
                                            data-toggle="modal" data-target="#janelaupdate<?php echo $valuepg['id_entrada']; ?>">
                                        <span class="glyphicon glyphicon-pencil">  </span>
                                    </button>

                                    <button type="button" class="btn btn-danger" 
                                            data-toggle="modal" data-target="#janeladel<?php echo $valuepg['id_entrada']; ?>">
                                        <span class="glyphicon glyphicon-trash"> </span>
                                    </button>


                                </td>

                            </tr>

                            <!-- Janela modal Upload arquivo (comprovante de pagamentos) -->
                        <div class="modal fade" id="janelaupload<?php echo $valuepg['id_entrada']; ?>">

                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- cabecalho -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                        <h4 class="modal-title">ENVIAR ARQUIVOS Entrada <?php echo $valuepg['id_entrada']; ?></h4>
                                    </div>

                                    <!-- corpo -->
                                    <div class="modal-body">

                                        <H3> FAZER UPLOAD DOS ARQUIVOS</h3>

                                        <?php
//require('../_app/Config.inc.php');

                                        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                                        if ($form && $form['sendImage']):

                                            $upload = new UploadArquivo('../uploads/');
                                            $imagem = $_FILES['imagem'];
                                            //var_dump($imagem);

                                            $upload->Image($imagem);
                                            if (!$upload->getResult()):
                                                WSErro("Erro ao enviar imagem:<br><small> {$upload->getError()} </small>", WS_ERROR);
                                            else:
                                                // WSErro("Arquivo enviado com sucesso:<br><smal> {$upload->getResult()}</smal>", WS_ACCEPT);
                                                $ficheiro = $upload->getResult();
                                                $docarray = [
                                                    "ref" => $form['ref'],
                                                    "doc" => $ficheiro,
                                                    "data" => date("Y-m-d")
                                                ];
                                                //print_r($docarray);
                                                $caddoc = new Create();
                                                $caddoc->ExeCreate("documentos", $docarray);
                                                $caddoc->getResult();
                                                if ($caddoc->getResult()):

                                                    echo "<div class=\"alert alert-success\" role=\"alert\">Arquivo enviado com sucesso {$upload->getResult()}</div>";

                                                else:

                                                    echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao enviar arquivo {$upload->getError()}</div>";

                                                endif;

                                            endif;

                                            // var_dump($form);

                                            echo "<hr>";



// var_dump($form);



                                        endif;
                                        ?>
                                        <div class="col-md-12">
                                            <form name="fileForm" action="" class="form" method="post" enctype="multipart/form-data">
                                                <div class="col-md-6">
                                                    <p> COMPROVANTE </p>
                                                    <input type="file" class="form-control" name="imagem"/>
                                                    <input type="hidden" name="ref" value="<?php echo $valuepg['id_entrada']; ?>" />
                                                </div>

                                                <div class="col-md-12">
                                                    <input type="submit" name="sendImage" value="enviar arquivo!" class="btn btn-primary"/>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-md-12"> 

                                            <?php
                                            $printdoc = new Read();
                                            $printdoc->ExeRead("documentos", "WHERE ref = :r", "r={$valuepg['id_entrada']}");
                                            $printdoc->getResult();
                                            foreach ($printdoc->getResult() as $valuepd) {
                                                ?>

                                                <div class="com-md-3">

                                                    <img src="../uploads/<?= $valuepd['doc'] ?>" class="img-thumbnail col-md-3" />

                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>

                                    <!-- rodape -->
                                    <div class="modal-footer">

                                        Rodapé

                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- Janela modal Ataulizar Movimnto () -->
                        <div class="modal fade" id="janelaupdate<?php echo $valuepg['id_entrada']; ?>">

                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- cabecalho -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                        <h4 class="modal-title">ATUALIZAR MOVIMENTO</h4>
                                    </div>

                                    <!-- corpo -->
                                    <div class="modal-body">

                                        <form name="sendpagamento" method="get" action="" class="form"> 

                                            <div class="form-group"> 
                                                <label> CATEGORIA</label>
                                                <?php
                                                $filtroatu = filter_input_array(INPUT_GET, FILTER_DEFAULT);

                                                if (isset($filtroatu['sendatualizasaida'])):
                                                    $filtroatu['valor'] = str_replace("R$", "", $filtroatu['valor']); // Primeiro tira os pontos
                                                    $filtroatu['valor'] = str_replace(" ", "", $filtroatu['valor']); // Primeiro tira os pontos
                                                    $filtroatu['valor'] = str_replace(".", "", $filtroatu['valor']); // Primeiro tira os pontos
                                                    $filtroatu['valor'] = str_replace(",", "", $filtroatu['valor']); //
                                                    //var_dump($filtroatu) ;

                                                    $atuarray = [
                                                        "categoria" => $filtroatu['categoria'],
                                                        "obs" => $filtroatu['obs'],
                                                        "valor" => $filtroatu['valor']
                                                    ];

                                                    $atucx = new Update();
                                                    $atucx->ExeUpdate("caixa", $atuarray, "WHERE id_entrada = :e", "e={$filtroatu['id_entrada']}");
                                                    $atucx->getResult();


                                                    if ($atucx->getResult()):
                                                        echo "<div class=\"alert alert-success\" role=\"alert\">Atualizado com sucesso</div>";

                                                    else:
                                                        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao atualizar</div>";
                                                    endif;


                                                endif;
                                                ?>
                                                <select name="categoria" class="form-control"> 
                                                    <option value="<?php echo $valuepg['categoria']; ?>"> <?php echo $valuepg['categoria']; ?> </option>
                                                    <?php
                                                    $ler = new Read();
                                                    $ler->ExeRead("categmov", "WHERE tipo = :t", "t=2");
                                                    $ler->getResult();
                                                    foreach ($ler->getResult() as $value) {
                                                        ?>
                                                        <option value="<?= $value['id_categ'] ?>"> <?= $value['categoria'] ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group"> 
                                                <label> VALOR</label>
                                                <input type="text" name="valor" class="form-control" value="<?php echo $valuepg['valor']; ?>"  onKeyPress="return(MascaraMoeda(this, '.', ',', event))" />
                                            </div>
                                            <div class="form-group"> 
                                                <label> OBSERVAÇÕES</label>
                                                <textarea name="obs" class="form-control"><?php echo $valuepg['obs']; ?></textarea> 
                                            </div>
                                            <input type="submit" name="sendatualizasaida" value="ATUALIZAR PAGAMENTOS" class="btn btn-info" />
                                            <input type="hidden" name="ano" value="<?= $_GET['ano'] ?>" />
                                            <input type="hidden" name="mes" value="<?= $_GET['mes'] ?>" />
                                            <input type="hidden" name="dia" value="<?= $_GET['dia'] ?>" />
                                            <input type="hidden" name="view" value="pagamento" />
                                            <input type="hidden" name="p" value="fluxocaixa" />
                                            <input type="hidden" name="id_entrada" value="<?php echo $valuepg['id_entrada']; ?>" />
                                        </form>

                                    </div>

                                    <!-- rodape -->
                                    <div class="modal-footer">
                                        Rodape

                                    </div>

                                </div>
                            </div>

                        </div>




                        <!-- Janela modal Deletar movimento (comprovante de pagamentos) -->
                        <div class="modal fade" id="janeladel<?php echo $valuepg['id_entrada']; ?>">

                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- cabecalho -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>

                                    </div>

                                    <!-- corpo -->
                                    <div class="modal-body">

                                        <H3>TEM CERTEZA QUE CDESEJA REMOVER ESSE REGISTRO </H3>

                                    </div>

                                    <!-- rodape -->
                                    <div class="modal-footer">



                                    </div>

                                </div>
                            </div>

                        </div>
                    <?php } ?>
                    </tbody>
                </table>

            </div>

            <!-- aba DESPEZAS -->
            <div class="tab-pane <?php
            if ($_GET['view'] == "despezas"):
                echo "active";
            endif;
            ?>" role="tabpanel" id="despezas">

                <?php
                $filtrodespesa = filter_input_array(INPUT_GET, FILTER_DEFAULT);

                if ($filtrodespesa['nome']):



                    $filtrodespesa['valor'] = str_replace("R$", "", $filtrodespesa['valor']); // Primeiro tira os pontos
                    $filtrodespesa['valor'] = str_replace(" ", "", $filtrodespesa['valor']); // Primeiro tira os pontos
                    $filtrodespesa['valor'] = str_replace(".", "", $filtrodespesa['valor']); // Primeiro tira os pontos
                    $filtrodespesa['valor'] = str_replace(",", "", $filtrodespesa['valor']); // Depois tira a vírgula

                    $valordespesa = $filtrodespesa['valor'];

                    $arraydespesa = [
                        "categoria" => $filtrodespesa['categoria'],
                        "valor" => $filtrodespesa['valor'],
                        "nome" => $filtrodespesa['nome'],
                        "obs" => $filtrodespesa['obs'],
                        "diavenc" => $filtrodespesa['diavenc'],
                    ];

                    $inserir = new Create();
                    $inserir->ExeCreate("despesasfixas", $arraydespesa);
                    $inserir->getResult();

                    if ($inserir->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Despesa cadastrada com sucesso</div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao cadastrar despesa </div>";

                    endif;
                endif;

                //var_dump($filtrodespesa);
                ?>
                <div class="page-header"><h3>DESPESAS FIXAS CADASTRADAS</h3></div>

                <form name="formdespesas" method="get" action="" class="form"> 
                    <div class="form-group"> 
                        <select name="categoria" class="form-control"> 

                            <?php
                            $ler = new Read();
                            $ler->ExeRead("categmov", "WHERE tipo = :t", "t=2");
                            $ler->getResult();
                            foreach ($ler->getResult() as $value) {
                                ?>
                                <option value="<?= $value['id_categ'] ?>"> <?= $value['categoria'] ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group"> 
                        <label>Nome da Despesa </label>
                        <input type="text" name="nome" class="form-control" />
                    </div>

                    <div class="form-group"> 
                        <label>Observações </label>
                        <textarea name="obs" class="form-control"> </textarea>
                    </div>

                    <div class="form-group"> 
                        <label>Valor do Pagamento</label>
                        <input type="text" name="valor" class="form-control" onKeyPress="return(MascaraMoeda(this, '.', ',', event))"  />
                    </div>
                    <div class="form-group"> 
                        <label>Dia de vencimento</label>
                        <input type="text" name="diavenc" class="form-control"  />
                    </div>
                    <div class="form-group"> 

                        <input type="submit" name="p" class="btn btn-primary" value="fluxocaixa" />
                        <input type="hidden" name="dia"  value="<?= $_GET['dia'] ?>" />
                        <input type="hidden" name="mes"  value="<?= $_GET['mes'] ?>" />
                        <input type="hidden" name="ano"  value="<?= $_GET['ano'] ?>" />
                        <input type="hidden" name="view"  value="despezas" />
                    </div>

                </form>

                <hr>

                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Despesa Fixa</th>
                            <th>Valor</th>
                            <th>Dia Vencimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $desp = new Read();
                        $desp->ExeRead("despesasfixas", "ORDER BY diavenc ASC");
                        $desp->getResult();

                        foreach ($desp->getResult() as $valuedesp) {
                            ?>
                            <tr>
                                <td><?= $valuedesp['nome'] ?></td>
                                <td><?= number_format($valuedesp['valor'] / 100, 2, ",", ".") ?></td>
                                <td><?= $valuedesp['diavenc'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>


            <!-- aba RESULTADO -->
            <div class="tab-pane <?php
                        if ($_GET['view'] == "resultados"):
                            echo "active";
                        endif;
                        ?>" role="tabpanel" id="resultados">
                <h3>Resultados</h3>
                <table class="table-responsive table-striped table-bordered table-hover table-condensed col-md-12">
                    <thead>
                        <tr>
                            <th class="success">Entrada Santander</th>
                            <th class="success">Entrada Caixa</th>
                            <th class="success">Adesão Protege</th>
                            <th class="success" >Adesão Associaçao</th>
                            <th class="success">Transferência Protege</th>
                            <th class="success">Transferencia Associaçao</th>
                            <th class="danger">Saidas</th>
                            <th class="info">Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo "R$" . number_format($somaprotege / 100, 2, ".", ","); ?></td>
                            <td><?php echo "R$" . number_format($somaacasp / 100, 2, ".", ","); ?></td>
                            <td>Entradas adesão Protege categ(4)</td>
                            <td class="success">Entradas adesão Associação (6)</td>
                            <td class="success">Entradas Transferencias Protege (5)</td>
                            <td class="success">Entradas Transferencias Associação (5)</td>
                            <td class="danger">{Saidas}</td>
                            <td class="info">{Resutado}</td>

                        </tr>

                    </tbody>
                </table>
            </div>
            
            <div class="page-header">
                <h3>Total de Entradas </h3>
            </div>

        </div>



    </section>




</main>
