

<div class="container-fluid"> 

    <h3 class="border-bottom"> Orçamentos </h3>

    <div class="row"> 

        <div class="col-md-12" style="margin-top: 10px;"> 
            <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Enviar Orçamentos</div>
        </div>
<!--        <div class="col-md-3"style="margin-top: 10px;">  
            <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Criar Orçamentos E-mail </div>
        </div>
        <div class="col-md-3"style="margin-top: 10px;">  
            <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Criar Orçamentos Whatsapp </div>
        </div>
        <div class="col-md-3"style="margin-top: 10px;">  
            <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Galeria de Imagens </div>
        </div>-->



        <div class="col-md-6"> 
            </br>
            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Enviar por E-mail</a>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Enviar por Whatsapp</button>
                <!--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle both elements</button>-->
            </p>
            <div class="row">

                <?php
                $orcamento = new \Source\Core\Orcamento();
                $orcamento->enviarEmail();
                $orcamento->whatsapp();
                ?>

                <div class="col-md-12">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body">
                            <!--Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.-->
                            <form action="" method="post"> 
                                <div class="col-md-12"> 

                                    <input type="text" placeholder="Nome do Cliente" name="nome" class="form-control" />
                                </div>
                                <div class="col-md-12"> 
                                    </br>
                                    <input type="text" placeholder="Assunto do E-mail" name="assunto" class="form-control" />
                                </div>
                                <div class="col-md-12"> 
                                    </br>
                                    <input type="text" placeholder="E-mail do Cliente" name="destinatario" class="form-control" />
                                </div>
                                <div class="col-md-12"> 
                                    </br>
                                    <input type="text" placeholder="E-mail de Resposta" name="remetente" class="form-control" />
                                </div>

                                <div class="col-md-12"> 
                                    <label> Corpo do E-mail</label>

                                    <textarea id="summernote" class="form-control" name="mensagem"></textarea>
                                </div>
                                <div class="col-md-12"> 
                                    <input type="hidden" name="modo" value="email" />
                                    <input type="submit" name="submit" value="enviar" class="btn btn-success" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <div class="card card-body col-md-12">
                            <!--Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.-->
                            <p> Enviar Mensagem Whatsapp </p>
                            <p> %0A (Quebra de linha) </p>
                            <p>*negrito* (com asteriscos) vira negrito.</p>
                            <p>_itálico_ (com underscore) vira itálico.</p>
                            <p>~tachado~ (com til) vira tachado.</p>
                            <p>_*negrito e itálico*_ vira <b>BOM DIA</b> <i>GRUPO.</i></p>
                            
                            <form action="" method="post" > 
                                <div class="col-md-12">
                                    </br>
                                    <input type="text" placeholder="Nome do Cliente" class="form-control" name="nome"/>
                                </div>
                                <div class="col-md-12">
                                    </br>
                                    <input type="text" placeholder="Telefone" class="form-control" value="055"  name="telefone"/>
                                </div>
                                <div class="col-md-12">
                                    <label> Mensagem </label>
                                    <textarea class="form-control" name="mensagem"> </textarea>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="modo" value="whatsapp" />
                                    <input type="submit" value="ENVAIR" class="btn btn-success" />
                                </div>
                            </form>
                                
                            </qp>
                        </div>
                    </div>
                </div>
            </div>



        </div>



        <div class="col-md-6"> 
            <h3 class="border-bottom">Orçamentos Enviados </h3>
            <table class="table table-responsive table-condensed table-striped"> 
                <thead class="bg-dark" style="color:#fff;"> 
                    <tr>
                        <th>Data </th>
                        <th>Cliente </th>
                        <th>Telefone </th>
                        <th>MODO </th>

                    </tr>
                </thead>
                <tbody> 

                    <?php
                    $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                    $pager = new Source\Support\Pager("./orcamento&atual=", "Primeiro", "Ultimo", "1");
                    $pager->ExePager($atual, 10);

                    $read = new \Source\Models\Read();
                    $read->ExeRead("app_orcamento", "WHERE user_id = :id ORDER BY date DESC LIMIT :limit OFFSET :offset",
                            "id={$_SESSION["user_id"]}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $read->getResult();

                    foreach ($read->getResult() as $orcamento) {
                        ?>

                        <tr> 
                            <td> <?= date("m/d/Y "."</br>"."H:i:s" , strtotime($orcamento["date"]))  ?></td>
                            <td> <?= $orcamento["nome"] ?></td>
                            <td> <?= $orcamento["telefone"] ?></td>
                            <td> 
                                <?php 
                                if($orcamento["modo"] == "whatsapp"){
                                ?>
<!--                                <p class="btn btn-success"> Whatsapp Web </p>
                                <p class="btn btn-info"> Whatsapp App </p>-->
                                <a href="https://web.whatsapp.com/send?phone=<?= $orcamento['telefone'] ?>&text=<?= $orcamento['mensagem'] ?>" target="_blank"> <bottom class="btn btn-success"> WHATSAPP WEB </bottom> </a>
                                <hr>
                                <a href="https://api.whatsapp.com/send?phone=<?= $orcamento['telefone'] ?>&text=<?= $orcamento['mensagem'] ?>" target="_blank"> <bottom class="btn btn-info"> WHATSAPP APP </bottom> </a>

                                <?php }else{ ?>
                                <?= $orcamento["email"] ?> </br>
                                <i class="fas fa-paper-plane" style="font-size: 1.5em;color:green;"></i> <span style="font-size: 0.8em;">enviado com sucesso</span>
                            </td>
                                <?php } ?>
                           
                        </tr>
                    <?php } ?>



                </tbody>
            </table>
                    <?php
                    $pager->ExePaginator("app_orcamento");
                    echo $pager->getPaginator();
                    ?>
        </div>




    </div>


</div>

