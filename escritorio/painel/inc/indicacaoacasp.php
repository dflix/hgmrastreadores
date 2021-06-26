<main> 
<div class="page-header">
    <h3> INDICAÇÕES ASSOCIAÇÃO SÃO PAULO </h3>
</div>
  
    
      		<table class="table table-striped table-bordered table-hover table-condensed">
   			<thead>
   				<tr>
    <th> Data </th>
    <th>Nome </th>
    <th>Email </th>
    <th>Veiculo </th>
    <th>Valor </th>
    <th>Celular </th>
    <th>Telefone </th>
    <th>Vendedor </th>
   				</tr>
   			</thead>
   			<tbody>

    
    <?php 
      $atual = filter_input(INPUT_GET, 'atual' ,FILTER_VALIDATE_INT );
      $pager = new Pager('index.php?p=indicacaoacasp&atual=', 'Primeira', 'Ultima', '1');
      $pager->ExePager($atual, 10);
      
                      if ($_COOKIE['logprot_nivel'] == "2"):
                    $exibe = new Read();
                    $exibe->ExeRead("orcamentoacasp", "WHERE vendedor = :p ORDER BY data DESC LIMIT :limit OFFSET :offset", "p={$_COOKIE['logprot_id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                else:

                    $exibe = new Read();
                    $exibe->ExeRead("orcamentoacasp", "ORDER BY data DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                endif;
      
//      $exibe = new Read();
//     $exibe->ExeRead("orcamentoacasp", "ORDER BY id DESC LIMIT :limit OFFSET :offset" , "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
//      $exibe->getResult();
      
      foreach ($exibe->getResult() as $value) {
    

    ?>
<tr>
    <td> <?php $data= $value['data'];
    $exibedata = date('d/m/Y H:i:s',strtotime($data));   echo $exibedata;
    ?>  </td>
    <td><span class="branquinho">.</span><?php echo $value['nome'];?> </td>
    <td><span class="branquinho">.</span><?php echo $value['email'];?> </td>
    <td><span class="branquinho">.</span><?php echo $value['veiculo'];?> </td>
    <td><span class="branquinho">.</span><?php echo $value['valor'];?> </td>
    <td><span class="branquinho">.</span><?php echo $value['celular'];?> </td>
    <td><span class="branquinho">.</span><?php echo $value['telefone'];?> </td>
    <td><span class="branquinho">.</span><?php 
    
    $vend = new Read();
    $vend->ExeRead("usuario","WHERE id_usuario= :p","p={$value['vendedor']}");
    $vend->getResult();
    
    if($vend->getResult()):
        
         echo "<p class=\"azul\">{$vend->getResult()[0]['nome']}</p>";
        
        else:
            
           echo "<p class=\"azul\"><b>Selecione Vendedor</b></p>";
        
    endif;
    
    echo "<p class=\"azul\">{$vend->getResult()[0]['nome']}</p>";
    
   
        
        ?>
        
        <?php 
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if($form && $form['indicacao']):
            unset($form['indicacao']);
            
        $indicar = new Update();
        $indicar->ExeUpdate("orcamentoacasp", $form, "WHERE id= :p", "p={$form['id']}");
        $indicar->getResult();
        
        if($indicar->getResult()):
            echo "Indicação enviada com sucesso para vendedor {$form['vendedor']}";
            echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=indicacaoacasp\">";
        endif;
        
        //var_dump($form);
        
            
        endif;
        ?>
        
        <form action="" method="post" class="form"> 
            
            <label> 
                <select name="vendedor" class="form-control"> 
                    <option value="#"> Selecione o vendedor </option>
                    <?php 
                    $loopvend = new Read();
                    $loopvend->ExeRead("usuario","WHERE nivel = :p","p=2");
                    $loopvend->getResult();
                    
                    foreach ($loopvend->getResult() as $valor) {
                      echo "<option value=\"{$valor['id_usuario']}\"> {$valor['nome']}</option>";  
                    }
                    
                    ?>
  
                </select>
            </label>
            <input type="hidden" name="id" value="<?php echo $value['id'];?>" />
            
            <input type="submit" value="enviar" name="indicacao" class="btn btn-success" />
        
        </form>
       

    
        
    </td>
</tr>
    
    <?php } ?>

                        </tbody></table>
    
          <?php 
      $pager->ExePaginator("orcamentoacasp");
      
      echo $pager->getPaginator();
      ?>
    
</main>
    
