<main class="content"> 
<div class="page-header">
    <h1> LEADS PROTEGE FÁCIL </h1>
</div>
    
    
       		<table class="table-responsive table-striped table-bordered table-hover table-condensed">
   			<thead>
   				<tr>
   					<th>Data</th>
   					<th>Nome</th>
   					<th>Email</th>
   					<th>Veiculo</th>
   					<th>Valor</th>
   					<th>Celular</th>
   					<th>Telefone</th>
   					
   				</tr>
   			</thead>
   			<tbody>
   				<tr>
                                    
                                     <?php 
      $atual = filter_input(INPUT_GET, 'atual' ,FILTER_VALIDATE_INT );
      $pager = new Pager('index.php?p=leadprotege&atual=', 'Primeira', 'Ultima', '1');
      $pager->ExePager($atual, 20);
      
      $exibe = new Read();
     $exibe->ExeRead("orcamento", "WHERE vendedor= :p ORDER BY id_orca DESC LIMIT :limit OFFSET :offset" , "p={$_SESSION['id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
      $exibe->getResult();
      
      foreach ($exibe->getResult() as $value) {
    

    ?>
    
    <td> <?php $data= $value['data'];
    $exibedata = date('d/m/Y H:i:s',strtotime($data));   echo $exibedata;
    ?>  </td>
    <td><?php echo $value['nome'];?> </td>
    <td><?php echo $value['email'];?> </td>
    <td><?php echo $value['veiculo'];?> </td>
    <td><?php //echo $value['valor'];
    
    $vervalor = new Read();
    $vervalor->ExeRead("ws_propostas","WHERE id_proposta= :p","p={$value['valor']}");
    $vervalor->getResult();
    if(empty($vervalor->getResult()[0]['nome_proposta'])):
        echo $value['valor'];
    else:
        echo $vervalor->getResult()[0]['nome_proposta'];
        
    endif;
    
    
    ?> </td>
    <td><?php echo $value['celular'];?> </td>
    <td><?php echo $value['telefone'];?> </td>

        

<!--   					<td>{Data}</td>
   					<td>{Nome}</td>
   					<td>{Emai}</td>
   					<td>{Veiculo}</td>
   					<td>{VAlor}</td>
   					<td>{Celular}</td>
   					<td>{Telefone}</td>
   					<td>{Vendedor}</td>-->
    
   				</tr>
                                  <?php } ?>
   				
   			</tbody>
   		</table>
    
    
    <div class="clear"> </div><hr>
    

    
          <?php 
      $pager->ExePaginator("orcamento");
      
      echo $pager->getPaginator();
      ?>
   
    
</main>