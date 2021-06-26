<div class="row"> 
<div class="col-md-12">
    <h3>Categoria dos Planos </h3>
    
    <?php 

    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if($filtro):
    unset($filtro['acao']);
    unset($filtro['enviar']);
    
    $atualiza = new Update();
    $atualiza->ExeUpdate("planoscateg", $filtro, "WHERE id_categ = :a", "a={$filtro['id_categ']}");
    $atualiza->getResult();
    
    if($atualiza->getResult()):
        
        echo "<div class=\"alert alert-success\" role=\"alert\">Atualizado com sucesso</div>";
        
        else:
            
             echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao Atualizado</div>";
        
    endif;
        
        
        
    endif;

    
   // var_dump($filtro);
    
    
    ?>
</div>
    
    <div class="col-md-6"> 
        <h4>Cadastrar Categorias </h4>
        
        <?php 
        
        $ver = new Read();
        $ver->ExeRead("planoscateg", "WHERE id_categ = :a", "a={$_GET['id_categ']}");
        $ver->getResult();
        
        ?>
        
        <form action="" method="post"> 
        
            <div class="form-group"> 
                <label> Categoria</label>
                <input type="text" name="categoria" value="<?= $ver->getResult()[0]['categoria'] ?>" class="form-control" />
            </div>
            <div class="form-group">
               
                
                <input type="hidden"  name="acao" value="<?= $_GET['acao'] ?>" />
                <input type="hidden"  name="id_categ" value="<?= $_GET['id_categ'] ?>" />
               
                <input type="submit" class="btn btn-primary" name="enviar" />
            </div>
        
        </form>
    </div>
    
    <div class="col-md-6"> 
        <h4>Categorias Cadastradas </h4>
        
        <table class="table table-striped table-bordered table-hover table-condensed"> 
            <thead> 
                <tr> 
                    <th>Categoria </th>
                    <th>Editar </th>
                    <th>Deletar </th>
                </tr>
            </thead>
            
            <tbody> 
                <?php 
                $cat = new Read();
                $cat->ExeRead("planoscateg", "ORDER BY id_categ ASC");
                $cat->getResult();
                foreach ($cat->getResult() as $value) {
  
                ?>
                <tr> 
                    <td><?= $value['categoria'] ?> </td>
                    <td><a href="index.php?p=aplanoscateg&id_categ=<?= $value['id_categ'] ?>&acao=atualizar"><span class="glyphicon glyphicon-pencil"> </span></a> </td>
                    <td><a href="index.php?p=planoscateg&id_categ=<?= $value['id_categ'] ?>&acao=deletar"><span class="glyphicon glyphicon-remove"> </span></a> </td>
                
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>
    
