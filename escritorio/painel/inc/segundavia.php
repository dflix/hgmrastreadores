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

    echo "<meta http-equiv=\"refresh\" content=1;url=\"index.php?p=segundavia&ano={$ano}&mes={$mes}&dia={$dia}\"> ";
//header("location:index.php?p=fluxocaixa&ano={$ano}");
endif;
?>
<main class="content"> 
    <h3 class="page-header"> 2º VIAS DE BOLETOS </h3>
    <section class="row col-md-12"> 
        <form action="index.php?p=segundavia" class="form" method="GET">

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

            <div class="col-md-2"> 
                <input type="hidden" name="view" class="form-control"  />
                <input type="submit" name="p" value="segundavia" class="btn btn-primary" /> </div>
            <div class="clear"> </div>
        </form>
    </section>

    <section class="col-md-12" > 
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

        <div class="page-header"> 2º Via de boleto</div>

    </section>

    <section class="col-md-6"> 

        <div class="page-header"> ATENDIMENTO ASSOCIACÃO


            <?php
            if (isset($_GET['atualizar'])):


                $filtro = filter_input_array(INPUT_GET, FILTER_DEFAULT);
                if ($filtro['atualizar'] == "associacao"):
                    unset($filtro['p']);
                    unset($filtro['ano']);
                    unset($filtro['mes']);
                    unset($filtro['dia']);
                    unset($filtro['atualizar']);
                    $atu = new Update();
                    $atu->ExeUpdate("atendimentoacasp", $filtro, "WHERE id = :s", "s={$filtro['id']}");
                    $atu->getResult();
                    if($atu->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Ticket <b> {$filtro['id']} </b> Atualizado com sucesso </div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">Ticket <b> {$filtro['id']} </b> Não atualizado </div>";
                    endif;


                   // var_dump($filtro);
                endif;
            endif;
            ?>


        </div>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Atendente</th>
                    <th>Mensagem</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>




                <?php
                if ($dia == "mes"):

                    $assoc = new Read();
                    $assoc->ExeRead("atendimentoacasp", "WHERE MONTH(data) = :m AND YEAR(data) = :a AND categoria = :c", "m={$mes}&a={$ano}&c={$_GET['p']}");
                    $assoc->getResult();

                else:

                    $assoc = new Read();
                    $assoc->ExeRead("atendimentoacasp", "WHERE DAY(data) = :d AND MONTH(data) = :m AND YEAR(data) = :a AND categoria = :c", "d={$dia}&m={$mes}&a={$ano}&c={$_GET['p']}");
                    $assoc->getResult();

                endif;
                ?>


                <?php
                if (empty($assoc->getResult())):
                    echo "<td class=\"danger\">nada consta</td>";
                else:
                    foreach ($assoc->getResult() as $value) {
                        ?>

                        <tr>



                            <td><?= date('d/m/Y H:i:s', strtotime($value['data'])) ?></td>
                            <td><?= $value['cliente'] ?></td>
                            <td><?= $value['atendente'] ?></td>
                            <td><?= $value['historia'] ?></td>
                            <?php
                            if ($value['status'] == 1):
                                $status1 = "ABERTO";
                                $class1 = "class=\"success\"";
                            else:
                                $status1 = "RESOLVIDO";
                                $class1 = "class=\"danger\"";

                            endif;
                            ?>
                            <td <?= $class1 ?>>


                                <button type="button" class="btn btn-<?= $class1 ?>" 
                                        data-toggle="modal" data-target="#<?= $value['id'] ?>">
        <?= $status1 ?>
                                </button>


                            </td>
                        </tr>




                        <!-- Janela -->
                    <div class="modal fade" id="<?= $value['id'] ?>">

                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- cabecalho -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                    <h4 class="modal-title">TICKET # <?= $value['id'] ?></h4>
                                </div>

                                <!-- corpo -->
                                <div class="modal-body">


                                    <form action="" name="" > 
                                        <div class="form-group">
                                            <p>CLIENTE  </p>
                                            <input type="text" name="cliente" value="<?= $value['cliente'] ?>" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <p>HISTÓRICO DE ATENDIMENTO </p>
                                            <textarea name="historia"  class="form-control"> <?= $value['historia'] ?> </textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>STATUS </p>
                                            <select name="status" class="form-control"> 
                                                <option value="<?= $value['status'] ?>"> <?= $value['status'] ?> </option>
                                                <option value="1"> ABERTO </option>
                                                <option value="2"> RESOLVIDO </option>
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type="hidden" name="p" value="<?= $_GET['p'] ?>" />
                                            <input type="hidden" name="ano" value="<?= $_GET['ano'] ?>" />
                                            <input type="hidden" name="mes" value="<?= $_GET['mes'] ?>" />
                                            <input type="hidden" name="dia" value="<?= $_GET['dia'] ?>" />
                                            <input type="hidden" name="id" value="<?= $value['id'] ?>" />
                                            <input type='submit' name="atualizar" class="btn btn-primary" value="associacao"/>
                                        </div>

                                    </form>
                                </div>

                                <!-- rodape -->
                                <div class="modal-footer">

                                    Rodape

                                </div>

                            </div>
                        </div>

                    </div>



                    <?php
                }
            endif;
            ?>




            </tbody>
        </table>


    </section>


    <HR>

    <section class="col-md-6"> 

        <div class="page-header"> ATENDIMENTO PROTEGE</div>
        
                    <?php
            if (isset($_GET['atualiza'])):


                $filtrop = filter_input_array(INPUT_GET, FILTER_DEFAULT);
                if ($filtrop['atualiza'] == "protege"):
                    unset($filtrop['p']);
                    unset($filtrop['ano']);
                    unset($filtrop['mes']);
                    unset($filtrop['dia']);
                    unset($filtrop['atualiza']);
                    $atu = new Update();
                    $atu->ExeUpdate("atendimentoprotege", $filtrop, "WHERE id = :s", "s={$filtrop['id']}");
                    $atu->getResult();
                    if($atu->getResult()):
                        echo "<div class=\"alert alert-success\" role=\"alert\">Ticket <b> {$filtrop['id']} </b> Atualizado com sucesso </div>";
                    else:
                        echo "<div class=\"alert alert-danger\" role=\"alert\">Ticket <b> {$filtrop['id']} </b> Não atualizado </div>";
                    endif;


                   // var_dump($filtrop);
                endif;
            endif;
            ?>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Atendente</th>
                    <th>Mensagem</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>




                <?php
                if ($dia == "mes"):

                    $prot = new Read();
                    $prot->ExeRead("atendimentoprotege", "WHERE MONTH(data) = :m AND YEAR(data) = :a AND categoria = :c", "m={$mes}&a={$ano}&c={$_GET['p']}");
                    $prot->getResult();

                else:

                    $prot = new Read();
                    $prot->ExeRead("atendimentoprotege", "WHERE DAY(data) = :d AND MONTH(data) = :m AND YEAR(data) = :a AND categoria = :c", "d={$dia}&m={$mes}&a={$ano}&c={$_GET['p']}");
                    $prot->getResult();

                endif;
                ?>


                <?php
                if (empty($prot->getResult())):
                    echo "<td class=\"danger\">nada consta</td>";
                else:
                    foreach ($prot->getResult() as $valueprot) {
                        ?>
                        <tr>
                            <td><?= date('d/m/Y H:i:s', strtotime($valueprot['data'])) ?></td>
                            <td><?= $valueprot['cliente'] ?></td>
                            <td><?= $valueprot['atendente'] ?></td>
                            <td><?= $valueprot['historia'] ?></td>
                            <?php
                            if ($valueprot['status'] == 1):
                                $status = "ABERTO";
                                $class = "class=\"success\"";
                            else:
                                $status = "RESOLVIDO";
                                $class = "class=\"danger\"";

                            endif;
                            ?>
                            <td <?= $class ?>>

                                <button type="button" class="btn btn-<?= $class ?>" 
                                        data-toggle="modal" data-target="#<?= $valueprot['id'] ?>">
        <?= $status ?>
                                </button>



                            </td>
                        </tr>


                    <div class="modal fade" id="<?= $valueprot['id'] ?>">

                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- cabecalho -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                    <h4 class="modal-title">TICKET # <?= $valueprot['id'] ?></h4>
                                </div>

                                <!-- corpo -->
                                <div class="modal-body">

                                                                       <form action="" name="" > 
                                        <div class="form-group">
                                            <p>CLIENTE  </p>
                                            <input type="text" name="cliente" value="<?= $valueprot['cliente'] ?>" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <p>HISTÓRICO DE ATENDIMENTO </p>
                                            <textarea name="historia"  class="form-control"> <?= $valueprot['historia'] ?> </textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>STATUS </p>
                                            <select name="status" class="form-control"> 
                                                <option value="<?= $value['status'] ?>"> <?= $valueprot['status'] ?> </option>
                                                <option value="1"> ABERTO </option>
                                                <option value="2"> RESOLVIDO </option>
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type="hidden" name="p" value="<?= $_GET['p'] ?>" />
                                            <input type="hidden" name="ano" value="<?= $_GET['ano'] ?>" />
                                            <input type="hidden" name="mes" value="<?= $_GET['mes'] ?>" />
                                            <input type="hidden" name="dia" value="<?= $_GET['dia'] ?>" />
                                            <input type="hidden" name="id" value="<?= $valueprot['id'] ?>" />
                                            <input type='submit' name="atualiza" class="btn btn-primary" value="protege"/>
                                        </div>

                                    </form>
                                </div>

                                <!-- rodape -->
                                <div class="modal-footer">

                                    Rodape

                                </div>

                            </div>
                        </div>

                    </div>



        <?php
    }
endif;
?>




            </tbody>
        </table>

    </section>





</main>
