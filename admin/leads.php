<div class="container-fluid"> 

    <h3> Leads </h3>
    
    <table class="table"> 
        <thead> 
            <tr> 
                <th>Data </th>
                <th>Cliente </th>
                <th>Email </th>
                <th>Telefone </th>
                <th>Orçamento Tipo </th>
                <th>Informações </th>
                <th>Excluir </th>
            </tr>
        </thead>
        <tbody> 
            <?php 
            $lead = new Source\Models\Read();
            $lead->ExeRead("app_leads", "ORDER BY id DESC");
            $lead->getResult();
            foreach ( $lead->getResult() as $value) {

            ?>
            <tr> 
                <td> <?= date("d/m/Y H:i:s",strtotime($value["data"])); ?> </td>
                <td>  <?= $value["nome"] ?> </td>
                <td>  <?= $value["email"] ?> </td>
                <td>  <?= $value["telefone"] ?> </td>
                <td>  <?= $value["tipo_orcamento"] ?> </td>
                <td>
                    
                    <?php 
                    if($value["tipo_orcamento"] == "seguro"){
                    ?>
                    
                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $value["id"] ?>">
  Informações
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $value["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title <?= $value["id"] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row"> 
          
              <div class="col-md-4"> 
                  <p><b>Veiculo</b></p>
                  <p> <?= $value["tipo"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Marca</b></p>
                  <p> <?= $value["marca"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Modelo</b></p>
                  <p> <?= $value["modelo"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Ano</b></p>
                  <p> <?= $value["ano"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>VAlor</b></p>
                  <p> <?= $value["valor"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>FIPE</b></p>
                  <p> <?= $value["fipe"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Uso do Veículo </b></p>
                  <p> <?= $value["uso_veiculo"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Combustivel </b></p>
                  <p> <?= $value["combustivel"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Cep de Pernoite </b></p>
                  <p> <?= $value["cep_pernoite"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b> O veículo é turbo, rebaixado, tunado ou possui outras modificações?  </b></p>
                  <p> <?= $value["modificacoes"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>O veículo é modificado com Kit Gás (GNV)? </b></p>
                  <p> <?= $value["kit_gas"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Qual a relação do Segurado com o Proprietário do veículo? </b></p>
                  <p> <?= $value["relacao_proprietario_segurado"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Relação entre o segurado e o terceiro ? </b></p>
                  <p> <?= $value["relacao_segurado_terceiro"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Tipo de pessoa do Segurado </b></p>
                  <p> <?= $value["segurado"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>CPF do Segurado </b></p>
                  <p> <?= $value["cpf_segurado"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Qual a utilização do veículo? </b></p>
                  <p> <?= $value["utilizacao_veiculo"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>O veículo possui adaptação para pessoa com deficiência (PCD)? </b></p>
                  <p> <?= $value["adaptacao_deficiente"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b> O veículo é blindado?</b></p>
                  <p> <?= $value["veiculo_blindado"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b> O Segurado é o condutor principal?</b></p>
                  <p> <?= $value["segurado_condutor_principal"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b> Tipo de Condutor ?</b></p>
                  <p> <?= $value["tipo_condutor"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b> Data de Nascimento</b></p>
                  <p> <?= $value["data_nascimento"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b> Estado Civil </b></p>
                  <p> <?= $value["estado_civil"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Sexo </b></p>
                  <p> <?= $value["sexo"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Possui garagem no local de pernoite do veículo (residência)? </b></p>
                  <p> <?= $value["garagem_pernoite_residencia"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Possui garagem no trabalho? </b></p>
                  <p> <?= $value["garagem_trabalho"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Possui garagem no local de estudo? </b></p>
                  <p> <?= $value["garagem_estudo"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Qual a quilometragem rodada por mês? </b></p>
                  <p> <?= $value["quilometragem_rodada_mes"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Qual a quilometragem do veiculo? </b></p>
                  <p> <?= $value["quilometragem_veiculo"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Deseja cobertura para outros condutores até 25 anos?</b></p>
                  <p> <?= $value["condutores_ate_25_anos"] ?> </p>
              </div>
          
              <div class="col-md-4"> 
                  <p><b>Número de Roubos ou Furtos de veículos nos últimos 12 meses?</b></p>
                  <p> <?= $value["roubo_12_meses"] ?> </p>
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
                <td> Excluir </td>
            </tr>
            <?php } ?>
        </tbody>
    
    </table>

</div>
