<main class="content"> 
<div class="page-header">
    <h1> LEADS PROTEGE FÁCIL </h1>
</div>
    
    <div class="table-responsive">
       		<table class="table-responsive table-striped table-bordered table-hover table-condensed">
                    <thead class="dark" >
   				<tr>
   					<th>Data</th>
   					<th>Nome</th>
   					<th>Email</th>
   					<th>Origem</th>
   					<th>Head Line</th>
   					
   					
   				</tr>
   			</thead>
   			<tbody>
   				<tr>
                                    
                                     <?php 
      $atual = filter_input(INPUT_GET, 'atual' ,FILTER_VALIDATE_INT );
      $pager = new Pager('index.php?p=lead&atual=', 'Primeira', 'Ultima', '1');
      $pager->ExePager($atual, 20);
      
      $exibe = new Read();
     $exibe->ExeRead("lead", "ORDER BY id DESC LIMIT :limit OFFSET :offset" , "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
      $exibe->getResult();
      
      foreach ($exibe->getResult() as $value) {
    

    ?>
    
    <td> <?php $data= $value['data'];
    $exibedata = date('d/m/Y H:i:s',strtotime($data));   echo $exibedata;
    ?>  </td>
    <td><?php echo $value['nome'];?> </td>
    <td><?php echo $value['email'];?> </td>
    <td><?php echo $value['origem'];?> </td>
    <td><?php echo $value['assunto'];
    
    
    
    
    ?> </td>

    
   				</tr>
                                  <?php } ?>
   				
   			</tbody>
   		</table>
    </div>
    
    
    <hr>
    

    
          <?php 
      $pager->ExePaginator("lead");
      
      echo $pager->getPaginator();
      ?>
   
    
</main>