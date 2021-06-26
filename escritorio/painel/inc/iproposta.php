<div class="col-md-12"> 
    <?php
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    unset($filtro['files']);
    unset($filtro['cadastra']);
    if ($filtro):


        $cad = new Create();
        $cad->exeCreate("proposta", $filtro);
        $cad->getResult();

        if ($cad->getResult()):
            echo "<div class=\"alert alert-success\" role=\"alert\">cadastro realizado com sucesso</div>";

        else:
            echo "<div class=\"alert alert-danger\" role=\"alert\">Erro ao cadastrar</div>";

        endif;

    endif;


    //var_dump($filtro);
    ?>

    <div class="page-header"> <h3>Inserir Propostas</h3> </div>
    <form name="form" action="" method="post"> 
        <div class="form-group"> 
            <label>Automação </label>
            <input type="text" class="form-control" name="automacao" />
        </div>
        <div class="form-group"> 
            <label>Nome Proposta </label>
            <input type="text" class="form-control" name="nome_proposta" />
        </div>
        <div class="form-group">
            <textarea id="summernote" name="proposta"> </textarea>
        </div>
        <div class="form-group">
            <input type="hidden" name="relacionado" value="<?= $_COOKIE['logprot_id_usuario'] ?>" />
            <input type="submit" name="cadastra" class="btn btn-primary" value="CADASTRAR" />
        </div>

    </form>
    
    <textarea> 
     <div class="gs" style="padding-bottom: 20px; width: 958px; font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: medium;"><div class="" style=""><div id=":me" class="ii gt" style="font-size: 12.8px; direction: ltr; margin-top: 8px; position: relative;"><div id=":md" class="a3s aXjCH " style="overflow: hidden; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: small; line-height: 1.5; font-family: Arial, Helvetica, sans-serif;"><div class="m_-565620090512604209page-header" style="color: rgb(34, 34, 34);"><img src="https://ci5.googleusercontent.com/proxy/1BSAr5ySlhnyhQmgJYnAWCP7B8-MBy2mikNTIuB2daxxgmF_J2YqauCFwHOI7p9U915ef6XfSwfGSsqHV59WBzIhEcL-Zw4kHKJ7ZfsnfFO3SKDtjjYx0g=s0-d-e1-ft#http://www.seguritysistem.com.br/themes/default/img/topo-email.png" class="m_-565620090512604209img-responsive CToWUd a6T" tabindex="0" style="cursor: pointer; outline: 0px;"></div><div class="m_-565620090512604209col-md-12" style=""><p style="color: rgb(34, 34, 34);">Ola, {Nome do Cliente}, somos a Segurity System, somos maior grupo de monitoramento e rastreamento do Brasil , empresa especializada em recuperação de veículos roubados.</p><p style="color: rgb(34, 34, 34);"><span class="m_-565620090512604209glyphicon m_-565620090512604209glyphicon-screenshot"></span>Protegemos seu veículo com bloqueador e rastreador.</p><p style="color: rgb(34, 34, 34);"><span class="m_-565620090512604209glyphicon m_-565620090512604209glyphicon-eye-open"></span>Monitoramos 24 horas todos os dias da semana.</p><p style="color: rgb(34, 34, 34);"><span class="m_-565620090512604209glyphicon m_-565620090512604209glyphicon-erase"></span>Você pode também monitorar de onde estiver , pode ver a rua , velocidade, casa , bairro e pode inclusive recuperar imagem de até 3 meses de posicionamento.</p><p style="color: rgb(34, 34, 34);"><span class="m_-565620090512604209glyphicon m_-565620090512604209glyphicon-check"></span>Nosso sistema é preparado para evitar o sucesso do bandido com bateria reserva , vacina contra roubo , ant Jammer que é um aparelho importado que previne o uso do chupa cabra , nosso sistema é silêncioso, sem adesivos sem sirenes para não colocar sua vida em risco.</p><p style="color: rgb(34, 34, 34);"><span class="m_-565620090512604209glyphicon m_-565620090512604209glyphicon-usd"></span>E mais importante, indenizamos 100% da tabela FIPE em caso de não recuperação ou recuperação com perda total ou veículo danificado.</p><h3 style="color: rgb(34, 34, 34);">Moto</h3><table class="m_-565620090512604209table m_-565620090512604209table-bordered" style="color: rgb(34, 34, 34);"><thead><tr><th>Motos até R$8.000,00</th><th>Motos até R$15.000,00</th><th>Motos até R$20.000,00</th><th>Motos até R$30.000,00</th></tr></thead><tbody><tr><td style="font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif;">R$ 79,00 mensal</td><td style="font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif;">R$ 99,00 mensal</td><td style="font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif;">R$ 149,00 mensal</td><td style="font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif;">R$ 279,00 mensal</td></tr></tbody></table><h3 style="color: rgb(34, 34, 34);">Veículos</h3><table class="m_-565620090512604209table m_-565620090512604209table-bordered" style="color: rgb(34, 34, 34);"><thead><tr><th>Veículos até R$35.000,00</th><th>Veículos até R$45.000,00</th></tr></thead><tbody><tr><td style="font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif;">R$ 99,00 mensal</td><td style="font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif;">R$ 139,00 mensal</td></tr></tbody></table><p style="color: rgb(34, 34, 34);"><span class="m_-565620090512604209glyphicon m_-565620090512604209glyphicon-thumbs-up"></span>Adquirindo o nosso produto em até 48 horas você ganha um aparelho anti jammer que é um produto importado para prevenir seu veículo do uso do sistema chupa cabra dos bandidos .</p><p style="color: rgb(34, 34, 34);"><span class="m_-565620090512604209glyphicon m_-565620090512604209glyphicon-phone-alt"></span>Fale agora mesmo com um representantes ligue (11)5843-6287 atendimento 24hs</p><p style=""><font color="#1155cc">Duvidas</font></p><p style=""><font color="#1155cc">Marcio Leite (11)950015805</font></p><p style=""><font color="#1155cc"><br></font></p><div style="color: rgb(34, 34, 34);"><br></div></div><font color="#222222"><u></u></font><div class="yj6qo" style="color: rgb(34, 34, 34);"></div><div class="adL" style="color: rgb(34, 34, 34);"></div></div></div><div class="hi" style="color: rgb(34, 34, 34); border-bottom-left-radius: 1px; border-bottom-right-radius: 1px; width: auto; background: rgb(242, 242, 242);"></div></div></div> 
    </textarea>
</div>