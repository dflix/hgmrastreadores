<div class="col-md-12"> 

    <div class="page-header"> <h3>EDITAR CONTRATOS </h3></div>
    
    <?php 
    if(isset($_GET['del'])):
    $del = new Delete();
    $del->ExeDelete("proposta", "WHERE id_proposta = :p", "p={$_GET['del']}");
    $del->getResult();
    
    if($del->getResult()):
        echo "<div class='alert alert-success'>Proposta Deletada com Sucesso </div>";
    endif;
    
    endif;
    ?>
    
  <div class="table-responsive">  <table class="table-responsive table-bordered table">
    
        <thead> 
            <tr> 
                <th>Nome Proposta </th>
                <th>Proposta </th>
                <th>Automação </th>
                <th>Editar </th>
                <th>Excluir </th>

            </tr>
        </thead>
        
        <tbody> 
            <?php 
            $contratos = new Read();
            $contratos->ExeRead("proposta", "ORDER BY id_proposta DESC");
            $contratos->getResult();
            
            foreach ($contratos->getResult() as $value) {
                
      
            ?>
            <tr> 
                <td> <?= $value['nome_proposta'] ?></td>
                <td> <?= $value['proposta'] ?></td>
                <td> <?= $value['automacao'] ?></td>
                <td> <a href="index.php?p=aproposta&proposta=<?= $value['id_proposta'] ?>"><span class="glyphicon glyphicon-pencil" style="font-size: 1.5em; color: #0056b3;"> </span></a></td>
                <td> <a href="index.php?p=eproposta&del=<?= $value['id_proposta'] ?>"> <span class="glyphicon glyphicon-trash" style="font-size: 1.5em; color: #0056b3;"> </span> </a></td>

            </tr>
        <?php  }   ?>
        </tbody>
    
      </table></div>

</div>
