    <!-- Adicionando Javascript -->
    <script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('endereco').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
           
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
               

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>
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


 
<script type='text/javascript' src='js/jquery.js'></script>


<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>
<main> 

    <h1>INSERIR VENDA PROTEGE </h1>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if($form && $form['button']):
        unset($form['button']);
    
    $cadastra = new Create();
    $cadastra->ExeCreate("prevenda", $form);
    $cadastra->getResult();
    if($cadastra->getResult()){
        echo "<p class=\"cadastro\">cadastro realizado com sucesso</p>";
       
    }else{
        echo "ERRO ao cadastrar";
    }
    endif;

    //var_dump($cadastra, $form);
    ?>


    <form id="form1" name="form1" method="post" action="">
        <table width="100%" cellpadding="5" cellspacing="5">
            <tbody>
            <col/>
            <col/>
            <col />
            <col  />
            <col  />
            <col  />
            <col  />
            <col  />
            <col />
            <col />
            <tr height="26">
                <td height="26" colspan="10">Vendedor</td>
            </tr>
            <tr height="26">
                <td height="26" colspan="10"><label>
                        <select name="vendedor" id="vendedor">
                            <option value=""> Selecione o Vendedor</option>
                            <?php
                            $vend = new Read();
                            $vend->ExeRead("usuario", "WHERE nivel= :p ORDER BY nome ASC", "p=2");
                            $vend->getResult();

                            foreach ($vend->getResult() as $valor) {
                                echo "<option value=\"{$valor['id_usuario']}\">{$valor['nome']}</option>";
                            }
                            ?>



                        </select>
                    </label></td>
            </tr>
            <tr height="26">
                <td height="26" colspan="10">DADOS DO CLIENTE</td>
            </tr>
            <tr height="22">
                <td height="16" colspan="10"><p>CLIENTE :</p>
                    <label>
                    </label></td>
            </tr>
            <tr height="22">
                <td height="16" colspan="10"><input name="cliente" type="text" id="cliente" size="75" /></td>
            </tr>
            <tr height="22">
                <td height="16" colspan="10"><p>DATA NASCIMENTO</p></td>
            </tr>
            <tr height="22">
                <td height="16" colspan="10"><input name="data_nasc" type="text" id="data_nasc" size="10" onKeyPress="MascaraData(form.data_nasc)" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>CPF: </p>


                </td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input type="text" name="cpf" id="cpf" onKeyPress="MascaraCPF(form.cpf)" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><P>RG</P></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input type="text" name="rg" id="rg" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>TEL: Residencial.</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input name="telres" type="text" id="telres" onKeyPress="MascaraTelefone(form.telres)" size="12" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>TEL: Celular</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input name="telcel" type="text" id="telcel" onKeyPress="MascaraTelefone(form.telcel)" size="12" /></td>
            </tr>
            <tr height="18">
                <td height="29" colspan="10">&nbsp;</td>
            </tr>
            <tr height="18">
                <td height="29" colspan="10">DADOS DE COBRANÇA</td>
            </tr>
<!--            <tr> 
                <td><?php //include ("inc/cep.php");?> </td>
            </tr>-->
           <tr height="22">
                <td height="22" colspan="10"><p>CEP</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10">
                    <p>
        <label>
         <input name="cep" type="text" id="cep" value=""  maxlength="9"
               onblur="pesquisacep(this.value);" /></label><br />
                    </p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>END.RES:</p>

                </td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"> <input name="endereco" type="text" id="endereco" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><P>Numero
                        º</P></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input name="numero" type="text" id="numero"  /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><label> </label>
                    <p>COMPLEMENTO:</p>
                </td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input name="complemento" type="text" id="complemento" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>BAIRRO :</p>
                </td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input name="bairro" type="text" id="bairro"  /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>CIDADE:</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input name="cidade" type="text" id="cidade"  /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>UF:</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input name="uf" type="text" id="uf" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>EMAIL:</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><u>
                <input name="email" type="text" id="email" size="75[" />
            </u></td>
            </tr>
            <tr height="18">
                <td width="58" height="18"></td>
                <td width="73"></td>
                <td width="47"></td>
                <td width="52"></td>
                <td width="17"></td>
                <td width="164"></td>
                <td width="72"></td>
                <td width="148"></td>
                <td width="60"></td>
                <td width="206"></td>
            </tr>
            <tr height="22">
                <td colspan="10" height="32"><h2>DADOS DO VEÍCULO</h2></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>MARCA: 
                    </p>
                </td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input type="text" name="marca" id="marca" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>MODELO </p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input type="text" name="modelo" id="modelo" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>ANO:</p>
                    <p></p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input name="ano" type="text" id="ano" size="5" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>COR:</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input type="text" name="cor" id="cor" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>CHASSI:</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input type="text" name="chassi" id="chassi" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>RENAVAM:</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input type="text" name="renavam" id="renavam" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><p>PLACA</p></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10"><input type="text" name="placa" id="placa" /></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10">&nbsp;</td>
            </tr>
<!--             <tr height="22">
                <td height="22" colspan="10">ASISTÊNCIA 24 HORAS</td>
            </tr>
           <tr height="22">
                <td height="22" colspan="10"><label>
                        <select name="assistencia" id="assistencia">
                            <option>SELECIONE A OPÇÃO</option>
                            <option value="0.00">Sem Assistencia R$0.00</option>
                            <option value="14.90"> Opção 1 R$14.90</option>
                            <option value="24.90">Opção 2 R$24.90</option>
                        </select>
                    </label></td>
            </tr>-->
            <tr height="22">
                <td height="22" colspan="10"><h2>SELECIONE O PLANO</h2></td>
            </tr>
            <tr height="22">
                <td height="22" colspan="10">&nbsp;</td>
            </tr>
            <tr height="22">
                <td height="46" colspan="10">

                        <?php
                        $readplano = new Read();
                        $readplano->ExeRead("planos", "ORDER BY id_plano ASC");
                        $readplano->getResult();

                        foreach ($readplano->getResult() as $plano) {

                            echo"                       
                                
                            <div class=\"planos \">
                               <label> <input type=\"radio\" name=\"tipo_plano\" value=\"{$plano['plano']}\" style=\"float:left; width:20px;\"> <b> Plano </b> {$plano['plano']}</label> </br></br>
                                <label><input type=\"radio\" name=\"plano_desc\" value=\"{$plano['descricao']}\" style=\"float:left; width:20px;\"> <b> Descrição </b> {$plano['descricao']} </label></br></br>
<label><input type=\"radio\" name=\"id_plano\" value=\"{$plano['id_plano']}\" id=\"plano_{$plano['id_plano']}\" style=\"float:left; width:20px;\"> <b>ID </b> {$plano['id_plano']} </label></br></br>
                                    <label><input type=\"radio\" name=\"plano\" value=\"{$plano['valor']}\" style=\"float:left; width:20px;\"> <b> Valor R$</b> {$plano['valor']} </label></br></br>

      
                        
                    </label> </div>";
                        }
                        ?>

            </tr>
            <tr height="22">
                <td height="32" colspan="10"><p>Adesão</p>
                </td>
            </tr>
            <tr height="22">
                <td height="43" colspan="10"><input type="text" name="adesao" id="adesao" /></td>
            </tr>
            <tr height="22">
                <td height="39" colspan="10"><P>Forma de pagamento</P> </td>
            </tr>
            <tr height="22">
                <td height="61" colspan="10"><input name="pgto_adesao" type="text" id="pgto_adesao" size="75" /></td>
            </tr>
            <tr height="22">
                <td height="29" colspan="10"><P>Contrato</P>
                </td>
            </tr>
            <tr height="22">
                <td height="61" colspan="10"><input name="codigo" type="text" id="codigo" /></td>
            </tr>
            <tr height="22">
                <td height="29" colspan="10"><p>Status</p></td>
            </tr>
            <tr height="22">
                <td height="61" colspan="10"><select name="status" id="status">
                        <option value="#">Selecione Opção</option>
                        <option value="1">Em Análise</option>
                        <option value="2">Agendado</option>
                        <option value="3">Instalado</option>
                        <option value="4">Cancelado</option>
                    </select></td>
            </tr>
            <tr height="22">
                <td height="34" colspan="10"><p>data vencimento</p> </td>
            </tr>
            <tr height="22">
                <td height="61" colspan="10"><input name="vencimento" type="text" id="vencimento" " /></td>
            </tr>
            <tr height="22">
                <td height="50" colspan="10"><label>
                        <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
                        <input type="hidden" name="data" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                        <input type="submit" name="button" id="button" value="Inserir Venda"  style=" width:180px; height:auto; padding:8px; border-radius:8px; background:#333; color:#FFF;"  />
                    </label></td>
            </tr>
            </tbody>
        </table>

    </form>



</main>