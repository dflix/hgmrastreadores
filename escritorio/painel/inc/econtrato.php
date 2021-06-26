<div class="col-md-12"> 

    <div class="page-header"> <h3>EDITAR CONTRATOS </h3></div>
    
  <div class="table-responsive">  <table class="table-responsive table-bordered table">
    
        <thead> 
            <tr> 
                <th> Nome Contrato </th>
                <th> Editar </th>
                <th> Excluir </th>

            </tr>
        </thead>
        
        <tbody> 
            <?php 
            $contratos = new Read();
            $contratos->ExeRead("contrato" );
            $contratos->getResult();
            
            foreach ($contratos->getResult() as $value) {
                
      
            ?>
            <tr> 
                <td> <?= $value['contrato'] ?></td>
                <td> <a href="index.php?p=acontrato&contrato=<?= $value['id_contrato'] ?>"><span class="glyphicon glyphicon-pencil" style="font-size: 1.5em; color: #0056b3;"> </span></a></td>
                <td>  <span class="glyphicon glyphicon-trash" style="font-size: 1.5em; color: #0056b3;"> </span></td>

            </tr>
        <?php  }   ?>
        </tbody>
    
      </table></div>

</div>
