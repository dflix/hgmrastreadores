
        <h1>  </h1>
        <?php
        
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        var_dump($filtro);
        
        ?>

        <hr>
        
        <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal<?php echo $filtro[0]['codigo']; ?>" > TODOS<br>
      DADOS</button> </td>
      
      
    								<div class="modal fade" id="myModal{$value['codigo']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title text-center" id="myModalLabel">DADOS DO CLIENTE</h4>
											</div>
											<div class="modal-body">
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

<form method="POST" action="index.php?p=sqlatendimento"  >

<label> 
<p>Histórico Atendimento </p>
<textarea type="text" name="historico"> </textarea>
</label>
</br>
<label> 
<p> Atendente </p>
<select name="atendente"> 
<option value="CELY">CELY </option>
<option value="MERCIA"> MERCIA</option>
<option value="PATRICIA"> PATRICIA</option>
<option value="DIANA">DIANA </option>
<option value="IEDA">IEDA </option>
</select>
<input type="hidden" value="{$value['codigo']}" name="codigo" />
</label>
</br>

<input type="submit"  value="Cadastrar" name="SendAtendimento" /> 

    </form>
                                                                                                        
											</div>
		
										</div>
									</div>
								</div>
      
      
      
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

