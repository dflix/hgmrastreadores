

<header class="container backwhite"> 

    <h1>Minhas Cobranças </h1>
    
    <?php 
    
    $boleto = new Source\Core\Boletos();
    $boleto->boleto();
    
    ?>
    
   
    
    <table class="table table-border"> 
        <thead> 
            <tr> 
                <th>Data </th>
               
        
                <th>Valor </th>
           
                <th>Status </th>
               
            </tr>
        </thead>
        
        <tbody> 
            
        <?php 
        
        $fatura = new Source\Models\Read();
        $fatura->ExeRead("app_faturas", "WHERE cliente_id = :a", "a={$_SESSION["cliente_id"]}");
        $fatura->getResult();
        foreach ( $fatura->getResult() as $value) {

        ?>
   
        <tr> 
            <td> <?= date("d/m/Y", strtotime($value["vencimento_em"])) ?> </td>
           
            <td>R$  <?= number_format($value["valor"] / 100, 2 ,".", ",") ?>  </td>
            <td>ID # <?= $value["id"] ?> / <?php $value["status"];
                    if($value["status"] == "paid"){
                        echo "<div class='alert alert-success'> PAGO</div>";
                    }else{
                    ?> 
            
           
                <!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal<?= $value["id"] ?>">
  PAGAR
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $value["id"] ?>" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cobrança ID #<?= $value["id"] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
          <div class="container py-5">

  <!-- For demo purpose -->
  <div class="row mb-4">
    <div class="col-lg-8 mx-auto text-center">
        <h3> Cobranças Insat </h3>
    </div>
  </div>
  <!-- End -->


  <div class="row">
    <div class="col-lg-10 mx-auto">
      <div class="bg-white rounded-lg shadow-sm p-5">
        <!-- Credit card form tabs -->
        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
<!--          <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
                                <i class="fa fa-credit-card"></i>
                                Cartão de Crédito
                            </a>
          </li>-->
<!--          <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
                                <i class="fa fa-paypal"></i>
                                Paypal
                            </a>
          </li>-->
          <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-bank" class="nav-link rounded-pill">
                                <i class="fa fa-university"></i>
                                 Boleto
                             </a>
          </li>
        </ul>
        <!-- End -->


        <!-- Credit card form content -->
        <div class="tab-content">

          <!-- credit card info-->
          <div id="nav-tab-card" class="tab-pane fade show ">
            <p class="alert alert-success">Some text success or error</p>
            <form role="form">
              <div class="form-group">
                <label for="username">Full name (on the card)</label>
                <input type="text" name="username" placeholder="Jason Doe" required class="form-control">
              </div>
              <div class="form-group">
                <label for="cardNumber">Card number</label>
                <div class="input-group">
                  <input type="text" name="cardNumber" placeholder="Your card number" class="form-control" required>
                  <div class="input-group-append">
                    <span class="input-group-text text-muted">
                                                <i class="fa fa-cc-visa mx-1"></i>
                                                <i class="fa fa-cc-amex mx-1"></i>
                                                <i class="fa fa-cc-mastercard mx-1"></i>
                                            </span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label><span class="hidden-xs">Expiration</span></label>
                    <div class="input-group">
                      <input type="number" placeholder="MM" name="" class="form-control" required>
                      <input type="number" placeholder="YY" name="" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group mb-4">
                    <label data-toggle="tooltip" title="Three-digits code on the back of your card">CVV
                                                <i class="fa fa-question-circle"></i>
                                            </label>
                    <input type="text" required class="form-control">
                  </div>
                </div>



              </div>
              <button type="button" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Confirm  </button>
            </form>
          </div>
          <!-- End -->

          <!-- Paypal info -->
          <div id="nav-tab-paypal" class="tab-pane fade">
            <p>Paypal is easiest way to pay online</p>
            <p>
              <button type="button" class="btn btn-primary rounded-pill"><i class="fa fa-paypal mr-2"></i> Log into my Paypal</button>
            </p>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
          <!-- End -->

          <!-- bank transfer info -->
          <div id="nav-tab-bank" class="tab-pane fade show active">
            <h6>Boleto Bancario ID <?= $value["id"]; ?></h6>
            
            <?php 
            $verifica = new Source\Models\Read();
            $verifica->ExeRead("app_transacoes", "WHERE fatura_id = :a", "a={$value["id"]}");
            $verifica->getResult();
            if(!empty($verifica->getResult())){
                ?>
            
            
            <h3> Boleto Gerado </h3>
            
            <a href="<?= $verifica->getResult()[0]["boleto_url"] ?>" target="_blank"> <p class="btn btn-success"> Visualizar Boleto </p> </a>
            
            <p> Codigo de Barras  </p>
            
            <p> <?= $verifica->getResult()[0]["boleto_barcode"] ?> </p>
            <?php
                
            }else{
            ?>
            
            <form action="" method="post"> 
                <input type="hidden" name="fatura_id" value="<?= $value["id"] ?>" />
                <input type="hidden" name="valor" value="<?= $value["valor"] ?>" />
                <input type="hidden" name="cliente_id" value="<?= $value["cliente_id"] ?>" />
                <input type="hidden" name="payment_method" value="boleto" />
                <input type="hidden" name="descricao" value="<?= $value["descricao"] ?>" />
                <input type="hidden" name="parcela" value="<?= $value["js_parcelas"] ?>" />
                <input type="submit" class="btn btn-success" name="boleto" value="Gerar Boleto" />
            </form>
            
            <?php } ?>
           
          </div>
          <!-- End -->
        </div>
        <!-- End -->

      </div>
    </div>
  </div>
</div>
          
          
          
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                
                
                    <?php } ?>
            </td>
         
            
        </tr>  
        <?php } ?>
       
        </tbody>
    
    </table>
    
    
    
      </header>


<style> 
body {
  background: #f5f5f5;
}

.rounded-lg {
  border-radius: 1rem;
}

.nav-pills .nav-link {
  color: #555;
}

.nav-pills .nav-link.active {
  color: #fff;
}
</style>

<script> 
$(function() {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>