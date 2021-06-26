<div class="col-md-12"> 
    <h3>INSERIR PROPOSTAS </h3>
     <?php
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if($form['sendpost']):
            unset($form['sendpost']);
            
        $cad = new Create();
        $cad->ExeCreate("ws_marketing", $form);
        $cad->getResult();
        
        if($cad->getResult()):
            echo "<div class=\"alert alert-success\" role=\"alert\"><B>PROPOSTA</B> cadastro realizado com sucesso</div>";
            else:
           echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO , error , <b>FUDEU</b></div>"; 
        endif;
            
        endif;
        
        if(isset($_GET['id'])):
            
        $del = new Delete();
        $del->ExeDelete("ws_marketing", "WHERE id_proposta = :a", "a={$_GET['id']}");
        $del->getResult();
        
        if($del->getResult()):
           
            echo "<div class=\"alert alert-success\" role=\"alert\"><B>PICOU O PÉ</B> com sucesso</div>";
            
            else:
          
                 echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO , error , <b>FUDEU DELETOU NÃO </b></div>"; 
        endif;
            
        endif;
        
        

     //  var_dump($form);
        ?>
    
    
    <form name="PostForm" action="" method="post" enctype="multipart/form-data" >

            <div class="form-group"> 
                <p class="fonteform"> NOME AUTO RESPONDER </p>
                <input type="text" name="nome_proposta" class="form-control" value="" />
            </div>
            <div class="form-group">  
            <p class="fonteform" > HTML DE RESPOSTA </p>
            <textarea name="proposta" class="form-control" id="summernote"> </textarea>
            </div>
            </br>
            <label> 
                <input type="submit" class="btn btn-primary" name="sendpost" value="cadastrar" />
            </label>
        </form>
    
</div>

<div class="col-md-12"> 
    <table class="table table-bordered table-condensed table-responsive"> 
        
        <thead> 
            <tr> 
                <td>Nome </td>
                <td>Proposta </td>
                <td>Edita </td>
                <td>Deleta </td>
            </tr>
        </thead>
        
        <tbody> 
            <?php 
            $view = new Read();
            $view->ExeRead("ws_marketing", "ORDER BY id_proposta DESC");
            $view->getResult();
            foreach ($view->getResult() as $valor) {

            ?>
            <tr> 
                <td><?= $valor['nome_proposta'] ?> </td>
                <td><?= $valor['proposta'] ?>  </td>
                <td><a href="index.php?p=amailmarketing&id=<?= $valor['id_proposta'] ?>"><i class="glyphicon glyphicon-pencil" style="font-size: 25px;"> </i> </a></td>
                <td><a href="index.php?p=mailmarketing&id=<?= $valor['id_proposta'] ?>"><i class="glyphicon glyphicon-remove" style="font-size: 25px; color: #F00;"> </i> </a> </td>
            </tr>
            <?php } ?>
        </tbody>
    
    </table>
    
</div>
