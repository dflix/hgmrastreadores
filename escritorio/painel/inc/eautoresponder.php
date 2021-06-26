<div class="col-md-12"> 
   
    <h3>Editar Auto Responder </h3>
    
     <table class="table table-condensed table-responsive"> 
        
        <thead> 
        <tr> 
        <td>Nome </td>
        <td>Auto Responder </td>
        <td>Editar </td>
        <td>Deletar </td>
        </tr>
        </thead>
        
        <tbody> 
                    <?php
        $resultado = new Read;
        $resultado->ExeRead('ws_propostas');
        $resultado->getResult();

        if (!empty($resultado->getResult())):

            foreach ($resultado->getResult() as $view) {
                extract($view);


        ?>

            
            <tr> 
                <td> <?=$view['nome_proposta'] ?></td>
                <td> <?=$view['proposta'] ?></td>
                <td> <a href="index.php?p=aautoresponder&id=<?=$view['id_proposta'] ?>"><i class="glyphicon glyphicon-pencil" style="font-size: 25px;"> </i></a></td>
                <td>  <i class="glyphicon glyphicon-remove" style="font-size: 25px; color: #F00;"> </i></td>
            </tr>
        
                
                <?php 
                 
            }

        endif;
                ?>

        </tbody>
    
    </table>
    
</div>
