<div class="col-md-12"> 

    <div class="page-header"> <h3>EDITAR CONTRATOS </h3></div>
    
  <div class="table-responsive">  <table class="table-responsive table-bordered table">
    
        <thead> 
            <tr> 
                <th>Nome Proposta </th>
                <th>Proposta </th>
                <th>Editar </th>
                <th>Excluir </th>

            </tr>
        </thead>
        
        <tbody> 
            <?php 
            $contratos = new Read();
            $contratos->ExeRead("propostas", "WHERE relacionado = :r", "r={$_SESSION['id_usuario']}");
            $contratos->getResult();
            
            foreach ($contratos->getResult() as $value) {
                
      
            ?>
            <tr> 
                <td> <?= $value['nome_proposta'] ?></td>
                <td> <?= $value['proposta'] ?></td>
                <td> <a href="painel.php?p=aproposta&proposta=<?= $value['id_proposta'] ?>"><span class="glyphicon glyphicon-pencil" style="font-size: 1.5em; color: #0056b3;"> </span></a></td>
                <td>  <span class="glyphicon glyphicon-trash" style="font-size: 1.5em; color: #0056b3;"> </span></td>

            </tr>
        <?php  }   ?>
        </tbody>
    
      </table></div>

</div>
