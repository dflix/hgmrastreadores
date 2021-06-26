<div class="col-md-12"> 
    <?php 
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    unset($filtro['files']);
    unset($filtro['cadastra']);
    
    if($filtro):
        
   // echo $_GET['contrato'];
    
    $cad = new Update();
    $cad->ExeUpdate("proposta", $filtro, "WHERE id_proposta = :e", "e={$_GET['proposta']}");
    $cad->getResult();
    
    if($cad->getResult()):
      echo "<div class=\"alert alert-success\" role=\"alert\">cadastro atualizado com sucesso</div>";
      
        else:
        echo "<div class=\"alert alert-danger\" role=\"alert\">Erro ao atualizar</div>";
    
    endif;
    endif;
    
    $view = new Read();
    $view->ExeRead("proposta", "WHERE id_proposta = :s", "s={$_GET['proposta']}");
    $view->getResult();
    
    //var_dump($filtro);
    ?>

    <div class="page-header"> <h3>Inserir Contratos</h3> </div>
    <form name="form" action="" method="post"> 
        <div class="form-group"> 
            <label>Automação </label>
            <input type="text" class="form-control" value="<?= $view->getResult()[0]['automacao'] ?>" name="automacao" />
        </div>
        <div class="form-group"> 
            <label>Nome Contrato </label>
            <input type="text" class="form-control" value="<?= $view->getResult()[0]['nome_proposta'] ?>" name="nome_proposta" />
        </div>
        <div class="form-group">
            <textarea id="summernote" name="proposta"><?= $view->getResult()[0]['proposta'] ?> </textarea>
        </div>
        <div class="form-group">
            <input type="hidden" name="relacionado" value="<?= $_COOKIE['logprot_id_usuario'] ?>" />
            <input type="submit" name="cadastra" class="btn btn-primary" value="CADASTRAR" />
        </div>
    
    </form>
</div>