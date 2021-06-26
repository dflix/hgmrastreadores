		<link href="css/bootstrap.min.css" rel="stylesheet">
<style type="text/javascript"> 

var headertext = [];
var headers = document.querySelectorAll("thead");
var tablebody = document.querySelectorAll("tbody");

for (var i = 0; i < headers.length; i++) {
    headertext[i]=[];
    for (var j = 0, headrow; headrow = headers[i].rows[0].cells[j]; j++) {
      var current = headrow;
      headertext[i].push(current.textContent);
      }
} 

for (var h = 0, tbody; tbody = tablebody[h]; h++) {
    for (var i = 0, row; row = tbody.rows[i]; i++) {
      for (var j = 0, col; col = row.cells[j]; j++) {
        col.setAttribute("data-th", headertext[h][j]);
      } 
    }
}


</style>



<?php 

//require('../../_app/Config.inc.php');

    

?>

<?php 
if(isset($_GET['del'])):
    echo "<p class=\"deletar\">Tem certeza que deseja remover esse registro <a href=\"index.php?p=eprotege&delyes={$_GET['del']}\">clique aqui</a> </br>";
   echo " <b>Cliente</b>{$_GET['del']} </p>";
endif;
if(isset($_GET['delyes'])):
    $deletar = new Delete();
$deletar->ExeDelete("prevenda", "WHERE id_venda= :p", "p={$_GET['delyes']}");
$deletar->getResult();
if($deletar->getResult()):
    echo "<p class=\"deletar\"> Registro {$_GET['delyes']} removido com sucesso </p>";
endif;
endif;
?>

<section class="buscar"> 
    
    <h1> BUSCAR </h1>

    <form action="index.php?p=eprotege" name="buscar" method="POST" enctype="multipart-form/data"> 
        
        <label class="seletor"> 
            
            <input type="radio" name="filtro" value="cliente"/> Nome<br />
            <input type="radio" name="filtro" value="codigo"/> Contrato<br />
            <input type="radio" name="filtro" value="placa"/> Placa<br />
            
        </label>
        
        <label class="buscando"> 
            <input type="text" name="q" />
            <input type="submit" name="SendBuscar" value="BUSCAR" style="width: 10%; padding: 10px; border-radius:10px; background:#006699; color: #fff;" />
        </label>
        
        <div class="clear"> </div>
        
    
    </form>
    
    <?php 
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(isset($filtro)){
      echo "<p style=\"text-align: center; padding:20px;\">Sua busca por <b>{$filtro['q']}</b> pelo filtro de <b>{$filtro['filtro']}</b> retornou seguinte resultados >><a href=\"index.php?p=eprotege\"> LIMPAR BUSCA</a></p>";   
    
    
   

    ?>
    
</section>

<table width="100%" border="0">
    
    <thead>
  <tr align="left" bgcolor="#333333" style="color:#FFF;" >
    <td width="3%" height="42">DATA</td>
    <td width="5%">TODOS<br>
      DADOS</td>
    <td width="5%">CONTRATO</td>
    <td width="26%">CLIENTE</td>
    <td width="13%">VEICULO</td>
    <td width="9%">PLACA</td>
    <td width="7%">VENDEDOR</td>
    <td width="3%">STATUS</td>
    <td width="7%">TRANSF</td>
    <td width="8%">DOC</td>
    <td width="4%">EDIT</td>
    <td width="4%">DEL</td>
    
   
  </tr>
  <thead>
      
  <tbody>
      
      <?php 
      
      $atual = filter_input(INPUT_GET, 'atual' ,FILTER_VALIDATE_INT );
      $pager = new Pager('index.php?p=eprotege&atual=', 'Primeira', 'Ultima', '1');
      $pager->ExePager($atual, 10);
      
      $exibe = new Read();
      $exibe->ExeRead("prevenda", "WHERE {$filtro['filtro']} LIKE '%' :link '%'" , "link={$filtro['q']}");
      $exibe->getResult();
      
      foreach ($exibe->getResult() as $value) {
          
          $data = $value['data'];
          $dataatual = date("d/m/Y H:i:s" , strtotime($data));
          
          $puxavendedor = $value['vendedor'];
          $puxapag = $value['cliente'];
          $puxaat = $value['codigo'];
          
          $atendimento = new Read();
          $atendimento->ExeRead("atendimento", "WHERE cliente = :p ORDER BY id DESC", "p={$puxaat}");
          $atendimento->getResult();
          if(!empty($atendimento->getResult()[0]['data'])):
              $historia = $atendimento->getResult()[0]['historia'];
           $dataatendimento = date("d/m/Y", strtotime($atendimento->getResult()[0]['data']));   
          endif;
          

          $pagamento = new Read();
          $pagamento->ExeRead('pagos', "WHERE confcli = :p ORDER BY id DESC", "p={$puxapag}");
          $pagamento->getResult();
          if(isset($pagamento->getResult()[0]['data'])):
           $datapagamento = $pagamento->getResult()[0]['data'];   
          endif;
          
          
          $datapagamentofinal = date("d/m/Y", strtotime($datapagamento));
          
          
          $vendedor = new Read();
          $vendedor->ExeRead('usuario', "WHERE id_usuario = :p", "p={$puxavendedor}");
          $vendedor->getResult();
          if(isset($vendedor->getResult()[0]['nome'])):
              $vend = $vendedor->getResult()[0]['nome']; 
          else:
              $vend = "nada consta";
          endif;
          
          echo"      <tr style=\" font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#333;\">
           <td>{$dataatual}</td>
    <td><button type=\"button\" class=\"btn btn-xs btn-primary\" data-toggle=\"modal\" data-target=\"#myModal{$value['codigo']}\">TODOS<br>
      DADOS</button> </td>
    <td>{$value['codigo']}</td>
    <td>{$value['cliente']}</td>
    <td>{$value['modelo']}</td>
    <td>{$value['placa']}</td>
    <td>{$vend}</td>
    <td>{$value['status']}</td>
    <td>
  </br>
        <p> <a href=\"index.php?p=tprotege&id={$value['id_venda']}\">Transferência</a> </p>
        </br>
        <hr>
        </br>
        <p> <a href=\"transferencia.php?id={$value['id_venda']}\" target=\"blank\">Imprimir</a> </p>
         </br>
    
    </td>
    <td>
        </br>
        <p> <a href=\"adesao.php?id={$value['id_venda']}\" target=\"blank\">Adesão</a> </p>
        </br>
        <hr>
        </br>
        <p> <a href=\"vistoria.php?id={$value['id_venda']}\" target=\"blank\">Vistoria</a> </p>
         </br>
        <hr>
        </br>
        <p> <a href=\"contrato.php?id={$value['id_venda']}\" target=\"blank\">Contrato</a> </p>
    </td>
    <td><a href=\"index.php?p=aprotege&id={$value['id_venda']}\"><img src=\"img/editar.png\" /></a></td>
 <td><a href=\"index.php?p=eprotege&del={$value['id_venda']}\"><img src=\"img/deletar.png\" /></a></td>
  
          
          
      </tr>
      
    								<div class=\"modal fade\" id=\"myModal{$value['codigo']}\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
									<div class=\"modal-dialog\" role=\"document\">
										<div class=\"modal-content\">
											<div class=\"modal-header\">
												<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
												<h4 class=\"modal-title text-center\" id=\"myModalLabel\">DADOS DO CLIENTE</h4>
											</div>
											<div class=\"modal-body\">
                                                                                        <p><b>Adesão: </b> {$dataatual} </p>
                                                                                                <p><b>Contrato:</b>{$value['codigo']}  <b> Nome: </b> {$puxapag} </p>
                                                                                                <p><b>Placa: </b> {$value['placa']}  <b> Veiculo Modelo: </b> {$value['modelo']}  <b> Veiculo Marca:</b>{$value['marca']}</p>
                                                                                                <p><b>Cor:</b>{$value['cor']}  <b> Ano: </b> {$value['ano']}</p>
												<p><b>VENDEDOR: </b> {$vend}</p>
												<p><b>Plano: </b> {$value['plano_desc']}</p>
<hr>
<h3> ULTIMO PAGAMENTO </h3>
<p>Ultimo Pagamento em = <b>{$datapagamentofinal}</b> </p>
    
<hr>
<h3> HISTÓRICO DE ATENDIMENTO </h3>
<p>Ultimo Atendimeto em = <b>{$dataatendimento}</b> </p>
<p>{$historia} </p>
                     
<hr>
<h3> Inserir histórico de atendimento </h3>

<form method=\"POST\" action=\"index.php?p=sqlatendimento\"  >

<label> 
<p>Histórico Atendimento </p>
<textarea type=\"text\" name=\"historico\"> </textarea>
</label>
</br>
<label> 
<p> Atendente </p>
<select name=\"atendente\"> 
<option value=\"CELY\">CELY </option>
<option value=\"MERCIA\"> MERCIA</option>
<option value=\"PATRICIA\"> PATRICIA</option>
<option value=\"DIANA\">DIANA </option>
<option value=\"IEDA\">IEDA </option>
</select>
</label>
</br>

<input type=\"submit\"  value=\"Cadastrar\" name=\"SendAtendimento\" /> 

    </form>
                                                                                                        
											</div>
		
										</div>
									</div>
								</div>
    
    "
;
          
      }
      
      ?>

   
  </tbody>
    
</table>

      
      <?php 
      $pager->ExePaginator("prevenda");
      
      echo $pager->getPaginator();
      ?>




<?php }else{ ?>

<table width="100%" border="0">
    
    <thead>
  <tr align="left" bgcolor="#333333" style="color:#FFF;" >
    <td width="3%" height="42">DATA</td>
    <td width="5%">TODOS<br>
      DADOS</td>
    <td width="5%">CONTRATO</td>
    <td width="26%">CLIENTE</td>
    <td width="13%">VEICULO</td>
    <td width="9%">PLACA</td>
    <td width="7%">VENDEDOR</td>
    <td width="3%">STATUS</td>
    <td width="7%">TRANSF</td>
    <td width="8%">DOC</td>
    <td width="4%">EDIT</td>
    <td width="4%">DEL</td>
    
   
  </tr>
  <thead>
      
  <tbody>
      
      <?php 
      
      // ESSA PARTE É SEM FILTRO DE PERSQUISA O RESULTADOS NATURAISS
      
      $atual = filter_input(INPUT_GET, 'atual' ,FILTER_VALIDATE_INT );
      $pager = new Pager('index.php?p=eprotege&atual=', 'Primeira', 'Ultima', '1');
      $pager->ExePager($atual, 10);
      
      $exibe = new Read();
      $exibe->ExeRead("prevenda", "ORDER BY id_venda DESC LIMIT :limit OFFSET :offset" , "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
      $exibe->getResult();
      
      foreach ($exibe->getResult() as $value) {
          
          $status= $value['status'];
//          if($status = "1"):
//              $status = "<p class=\"aguardando\"> Em analise </p>";
//          endif;
//          if($status = "2"):
//              $status = "<p class=\"agendado\"> Agendado </p>";
//          endif;
//          if($status = "3"):
//              $status = "<p class=\"instalado\"> Instalado </p>";
//          endif;
//          if($status = "4"):
//              $status = "<p class=\"cancelado\"> Cancelado </p>";
//          endif;
          
          $data = $value['data'];
          $dataatual = date("d/m/Y H:i:s" , strtotime($data));
          
          $puxavendedor = $value['vendedor'];
          $puxapag = $value['cliente'];
          $puxaat = $value['codigo'];
          
          $atendimento = new Read();
          $atendimento->ExeRead("atendimento", "WHERE cliente = :p ORDER BY id DESC", "p={$puxaat}");
          $atendimento->getResult();
          if(empty($atendimento->getResult()[0]['data'])):
              $historia = "Não possui atendimeto registrado";
          $dataatendimento = "Nada consta";
              else:
              $historia = $atendimento->getResult()[0]['historia'];
           $dataatendimento = date("d/m/Y", strtotime($atendimento->getResult()[0]['data']));   
          endif;
          

          $pagamento = new Read();
          $pagamento->ExeRead('pagos', "WHERE confcli = :p ORDER BY id DESC", "p={$puxapag}");
          $pagamento->getResult();
          if(isset($pagamento->getResult()[0]['data'])):
           $datapagamento = $pagamento->getResult()[0]['data'];  
   
          endif;
          if(empty($pagamento->getResult()[0]['data'])):
              
              $datapagamentofinal = "Não consta pagamentos no sistema";
          else:
              
            $datapagamentofinal = date("d/m/Y", strtotime($datapagamento)); 
   
          endif;

          
          $vendedor = new Read();
          $vendedor->ExeRead('usuario', "WHERE id_usuario = :p", "p={$puxavendedor}");
          $vendedor->getResult();
          if(isset($vendedor->getResult()[0]['nome'])):
              $vend = $vendedor->getResult()[0]['nome']; 
          endif;
          
          echo"      <tr style=\" font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#333;\">
           <td>{$dataatual}</td>
    <td><button type=\"button\" class=\"btn btn-xs btn-primary\" data-toggle=\"modal\" data-target=\"#myModal{$value['codigo']}\">TODOS<br>
      DADOS</button> </td>
    <td>{$value['codigo']}</td>
    <td>{$value['cliente']}</td>
    <td>{$value['modelo']}</td>
    <td>{$value['placa']}</td>
    <td>{$vend}</td>
    <td>{$status}</td>
    <td>
     </br>
        <p> <a href=\"index.php?p=tprotege&id={$value['id_venda']}\">Transferência</a> </p>
        </br>
        <hr>
        </br>
        <p> <a href=\"transferencia.php?id={$value['id_venda']}\" target=\"blank\">Imprimir</a> </p>
         </br>
    
    </td>
    <td>
        </br>
        <p> <a href=\"adesao.php?id={$value['id_venda']}\" target=\"blank\">Adesão</a> </p>
        </br>
        <hr>
        </br>
        <p> <a href=\"vistoria.php?id={$value['id_venda']}\" target=\"blank\">Vistoria</a> </p>
         </br>
        <hr>
        </br>
        <p> <a href=\"contrato.php?id={$value['id_venda']}\" target=\"blank\">Contrato</a> </p>
    </td>
    <td><a href=\"index.php?p=aprotege&id={$value['id_venda']}\"><img src=\"img/editar.png\" /></a></td>
 <td><a href=\"index.php?p=eprotege&del={$value['id_venda']}\"><img src=\"img/deletar.png\" /></a></td>
  
          
          
      </tr>
      
    								<div class=\"modal fade\" id=\"myModal{$value['codigo']}\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
									<div class=\"modal-dialog\" role=\"document\">
										<div class=\"modal-content\">
											<div class=\"modal-header\">
												<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
												<h4 class=\"modal-title text-center\" id=\"myModalLabel\">DADOS DO CLIENTE</h4>
											</div>
											<div class=\"modal-body\">
                                                                                        <p><b>Adesão: </b> {$dataatual} </p>
                                                                                                <p><b>Contrato:</b>{$value['codigo']}  <b> Nome: </b> {$puxapag} </p>
                                                                                                <p><b>Placa: </b> {$value['placa']}  <b> Veiculo Modelo: </b> {$value['modelo']}  <b> Veiculo Marca:</b>{$value['marca']}</p>
                                                                                                <p><b>Cor:</b>{$value['cor']}  <b> Ano: </b> {$value['ano']}</p>
												<p><b>VENDEDOR: </b> {$vend}</p>
												<p><b>Plano: </b> {$value['plano_desc']}</p>
<hr>
<h3> ULTIMO PAGAMENTO </h3>
<p>Ultimo Pagamento em = <b>{$datapagamentofinal}</b> </p>
    
<hr>
<h3> HISTÓRICO DE ATENDIMENTO </h3>
<p>Ultimo Atendimeto em = <b>{$dataatendimento}</b> </p>
<p>{$historia} </p>
                     
<hr>
<h3> Inserir histórico de atendimento </h3>

<form method=\"POST\" action=\"index.php?p=sqlatendimento\"  >

<label> 
<p>Histórico Atendimento </p>
<textarea type=\"text\" name=\"historico\"> </textarea>
</label>
</br>
<label> 
<p> Atendente </p>
<select name=\"atendente\"> 
<option value=\"CELY\">CELY </option>
<option value=\"MERCIA\"> MERCIA</option>
<option value=\"PATRICIA\"> PATRICIA</option>
<option value=\"DIANA\">DIANA </option>
<option value=\"IEDA\">IEDA </option>
</select>
<input type=\"hidden\" value=\"{$value['codigo']}\" name=\"\" />
</label>
</br>

<input type=\"submit\"  value=\"Cadastrar\" name=\"SendAtendimento\" /> 

    </form>
                                                                                                        
											</div>
		
										</div>
									</div>
								</div>
    
    "
;
          
      }
      
      ?>
      
      
      
      


   
  </tbody>
    
</table>

      
      <?php 
      $pager->ExePaginator("prevenda");
      
      echo $pager->getPaginator();
      ?>
<?php } ?>


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$('#exampleModal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var recipient = button.data('whatever') // Extract info from data-* attributes
				var recipientnome = button.data('whatevernome')
				var recipientdetalhes = button.data('whateverdetalhes')
				// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
				// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
				var modal = $(this)
				modal.find('.modal-title').text('ID do Curso: ' + recipient)
				modal.find('#id_curso').val(recipient)
				modal.find('#recipient-name').val(recipientnome)
				modal.find('#detalhes-text').val(recipientdetalhes)
			})
		</script>