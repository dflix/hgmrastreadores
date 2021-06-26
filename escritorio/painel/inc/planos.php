<?php 
//require('../../_app/Config.inc.php');
?>
<main> 

    <h1> Planos HGM RASTREADORES </h1>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($form && $form['sendpost']):
        unset($form['sendpost']);


        $inserir = new Create();
        $inserir->exeCreate("planos", $form);
        $inserir->getResult();

        if ($inserir->getResult()):
            echo "Cadastro realizado com sucesso";
        else:
            echo "ERRO ao cadastrar";
        endif;

    endif;
    
            if ($form && $form['sendpostatualiza']):
                
            unset($form['sendpostatualiza']);
    $atu = new Update();
    $atu->ExeUpdate("planos", $form, "WHERE id_plano = :p", "p={$_GET['atu']}");
    $atu->getResult();
    
    if($atu->getResult()):
        echo "<div class=\"alert alert-success\" role=\"alert\">Atualizado com sucesso</div>";
    else:
        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao atualizar</div>";
        endif;
    
    endif;

    //var_dump($form);
    ?>

    <?php
    if (isset($_GET['atu'])) {

        $imprimi = new Read();
        $imprimi->ExeRead("planos", "WHERE id_plano = :p", "p={$_GET['atu']}");
        $imprimi->getResult();

        ?>

        <form action="" method="post"  class="form"> 
            <div class="form-group"> 
                <p>Categoria </p>
                <select name="id_categ" class="form-control"> 
                    <option value="<?php echo $imprimi->getResult()[0]['id_categ']; ?>"> <?php echo $imprimi->getResult()[0]['id_categ']; ?> </option>
                    <?php
                    $categ = new Read();
                    $categ->ExeRead("planoscateg", "ORDER BY id_categ DESC");
                    $categ->getResult();
                    foreach ($categ->getResult() as $valor) {

                    ?>
                    <option value="<?= $valor['id_categ'] ?>"> <?= $valor['categoria'] ?> </option>
                    
                    <?php } ?>
                </select>
            </div>
            
            
            <div class="form-group">
            
                <p>Plano </p>
                <input type="text" class="form-control" name="plano" value="<?php echo $imprimi->getResult()[0]['plano']; ?>" />
            
            </div>
            <div class="form-group">
            
                <p>Descrição </p>
                <input type="text" class="form-control" name="descricao" value="<?php echo $imprimi->getResult()[0]['descricao']; ?>" />
           
            </div>
            <div class="form-group">
            
                <p>Valor :</p>
                <input type="text" class="form-control" name="valor" value="<?php echo $imprimi->getResult()[0]['valor']; ?>" />
            </div>
            <div class="form-group">
            
                <p>Ativo :</p>
                <select name="ativo" class="form-control"> 
                
                    <option value="<?php echo $imprimi->getResult()[0]['valor']; ?>"> <?php echo $imprimi->getResult()[0]['ativo']; ?> </option>
                    <option value="1"> Ativo </option>
                    <option value="0"> Inativo </option>
                </select>
            </div>
                <input type="hidden" name="id_plano"  value="<?php echo $imprimi->getResult()[0]['id_plano']; ?>" />
            </label>
            <label> 

                <input type="submit" class="btn btn-primary" value="ATUALIZAR" name="sendpostatualiza" />
            </label>

        </form>



    <?php }else { ?>

        <form action="" method="post" enctype="multipart/form-data" class="form"> 
            <div class="form-group"> 
                <p>Categoria </p>
                <select name="id_categ" class="form-control"> 
<!--                    <option value="<?php //echo $imprimi->getResult()[0]['id_categ']; ?>"> <?php //echo $imprimi->getResult()[0]['id_categ']; ?> </option>-->
                    <?php
                    $categ = new Read();
                    $categ->ExeRead("planoscateg");
                    $categ->getResult();
                    foreach ($categ->getResult() as $valor) {

                    ?>
                    <option value="<?= $valor['id_categ'] ?>"> <?= $valor['categoria'] ?> </option>
                    
                    <?php } ?>
                </select>
            </div>
            
            
           <div class="form-group"> 
                <p>Plano </p>
                <input type="text" name="plano" class="form-control" />
            </div>
            <div class="form-group"> 
                <p>Descrição </p>
                <input type="text" name="descricao"class="form-control" />
            </div>
            <div class="form-group"> 
                <p>Valor :</p>
                <input type="text" name="valor"class="form-control" placeholder="Inserir separador decimal . (ponto) ao inves de virgula ex+ 19.90" />
            </div>
            
            <div class="form-group">
                                <select name="ativo" class="form-control"> 
                
                    
                    <option value="1"> Ativo </option>
                    <option value="0"> Inativo </option>
                </select>
            </div>
            
            <label> 

                <input type="submit" value="CADASTRAR" class="btn btn-primary" name="sendpost" />
            </label>

        </form>
    <?php } ?>

    <h2> Planos Cadastrados </h2>
    
    <table class="table-bordered table-condensed table-responsive"> 
        
        <thead> 
            <tr> 
                <th>Categoria </th>
                <th>Plano </th>
                <th>Descrição </th>
                <th>Valor </th>
                <th>Ativo </th>
                <th>Atualizar </th>
                <th>Deletar </th>
            </tr>
        </thead>
        
        <tbody>

    <?php
    $deleta = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);
    if ($deleta):

        $deletar = new Delete();
        $deletar->ExeDelete("planos", "WHERE id_plano = :p", "p={$deleta}");
        $deletar->getResult();
        if ($deletar->getResult()):
            echo "<div class=\"alert alert-success\" role=\"alert\">Registro removido com sucesso</div>";
        else:
            echo "<div class=\"alert alert-danger\" role=\"alert\">Registro removido com sucesso</div>";
        endif;

    endif;

    $exibe = new Read();
    $exibe->ExeRead("planos", "ORDER BY id_categ ASC");
    $exibe->getResult();

    foreach ($exibe->getResult() as $value) {
        
        $categ = $value['id_categ'];
        
        if($categ == "1"):
            $pcateg = "Moto";
        endif;
        if($categ == "2"):
            $pcateg = "Carro";
        endif;
        if($categ == "3"):
            $pcateg = "Utilitário";
        endif;
        if($categ == "4"):
            $pcateg = "Caminhão";
        endif;
        if($categ == "8"):
            $pcateg = "Comodato";
        endif;
        if($categ == "0"):
            $pcateg = "Sem categoria";
        endif;
        
        if($value['ativo'] == "1"):
            
            $ativo = "<div class=\"alert alert-success\" role=\"alert\">ATIVO</div>";
            
            else:
            $ativo = "<div class=\"alert alert-danger\" role=\"alert\">INATIVO</div>";
            
        endif;

        echo "    
        <tr> 
            <td> {$pcateg}</td>
            <td><b>Plano: </b> {$value['plano']}</td>
            <td><b>descrição: </b> {$value['descricao']}</td>
            <td><b>Valor: </b>{$value['valor']} </td>
            <td>{$ativo} </td>
           
            <td><a href=\"index.php?p=planos&atu={$value['id_plano']}\"> clique aqui</a> </td>
            <td><a href=\"index.php?p=planos&del={$value['id_plano']}\"> <span class='glyphicon glyphicon-remove'> </span></a> </td>
        </tr>
   
    ";
    }
    ?>
        </tbody>
</table>

</main>
</br> </br></br> </br>