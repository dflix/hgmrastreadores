<?php
if (!empty($_GET["edit"])) {
    $edit = new Source\Models\Read();
    $edit->ExeRead("app_prevenda", "WHERE id = :a", "a={$_GET['edit']}");
    $edit->getResult();
}
?>

<!-- Adicionando Javascript -->
<script type="text/javascript" >

    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('logradouro').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('uf').value = ("");

    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logradouro').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('uf').value = (conteudo.uf);

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
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('logradouro').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('uf').value = "...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

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
    }
    ;

</script>

<script>



    $(function () {

        $('select[name=veiculo]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/marca.php",
                    {veiculo: $(this).val()},
                    function (veiculo) {

                        $('select[name=marca1]').html(veiculo)

                    })
        });

        $('select[name=marca1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/modelo.php",
                    {marca: $(this).val()},
                    function (marca) {

                        $('select[name=modelo1]').html(marca)

                    })
        });

        $('select[name=modelo1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/ano.php",
                    {modelo: $(this).val()},
                    function (modelo) {

                        $('select[name=ano1]').html(modelo)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/ano.php",
                    {modelo: $(this).val()},
                    function (modelo) {

                        $('select[name=fipe]').html(modelo)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/codigofipe.php",
                    {fipe: $(this).val()},
                    function (fipe) {

                        $('select[name=fipe]').html(fipe)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/preco.php",
                    {valor: $(this).val()},
                    function (valor) {

                        $('select[name=valor]').html(valor)

                    })
        });

        $('select[name=plano]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/plano_desc.php",
                    {plano: $(this).val()},
                    function (plano) {

                        $('select[name=plano_desc]').html(plano)

                    })
        });

        $('select[name=plano]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/plano_valor.php",
                    {plano: $(this).val()},
                    function (plano) {

                        $('select[name=plano_valor]').html(plano)

                    })
        });





    });





</script>

<style> 
    h3{ background: orange; color: white; padding: 10px; font-size:2em;}
</style>

<h3> CADASTRO </h3>

<?php
$prevenda = new Source\Core\Prevenda();
if (!empty($_GET["edit"])) {
    $prevenda->Update();
} else {
    $prevenda->Cadastro();
}
?>

<form method="post" action=""> 

    <div class="row"> 

        <h3 class="border-bottom col-md-12"> DADOS DO CLIENTE </h3>

        <div class="col-md-2"> 
            <b> *  CONTRATO </b>
            <input type="text" class="form-control" name="contrato" <?php
            if (!empty($_GET["edit"])) {
                echo "value='{$edit->getResult()[0]["contrato"]}'";
            }
            ?> />
        </div>

        <div class="col-md-10"> 
            <b> *  NOME </b>
            <input type="text" class="form-control" name="nome" <?php
            if (!empty($_GET["edit"])) {
                echo "value='{$edit->getResult()[0]["nome"]}'";
            }
            ?> />
        </div>

        <div class="col-md-4"> 
            <b> *  CPF / CNPJ </b>
            <input type="text" class="form-control" name="cpf_cnpj" <?php
            if (!empty($_GET["edit"])) {
                echo "value='{$edit->getResult()[0]["cpf_cnpj"]}'";
            }
            ?> />
        </div>

        <div class="col-md-4"> 
            <b> *  RG / IE </b>
            <input type="text" class="form-control" name="rg_ie" <?php
            if (!empty($_GET["edit"])) {
                echo "value='{$edit->getResult()[0]["rg_ie"]}'";
            }
            ?> />
        </div>

        <div class="col-md-4"> 
            <b> *  E-MAIL </b>
            <input type="text" class="form-control" name="email" <?php
            if (!empty($_GET["edit"])) {
                echo "value='{$edit->getResult()[0]["email"]}'";
            }
            ?> />
        </div>

        <div class="col-md-6"> 
            <b> *  TELEFONE </b>
            <input type="text" class="form-control" name="telefone" <?php
            if (!empty($_GET["edit"])) {
                echo "value='{$edit->getResult()[0]["telefone"]}'";
            }
            ?> />
        </div>

        <div class="col-md-6"> 
            <b> *  CELULAR </b>
            <input type="text" class="form-control" name="celular" <?php
            if (!empty($_GET["edit"])) {
                echo "value='{$edit->getResult()[0]["celular"]}'";
            }
            ?> />
        </div>

        <h3 class="border-bottom col-md-12"> ENDEREÇO DE COBRANÇA </h3>



        <div class="col-md-6">
            <label>Selecione o Tipo </label>


            <select name="tipo" class="form-control"> 
                <?php
                if (!empty($_GET["edit"])) {
                    echo "<option value='{$edit->getResult()[0]["tipo"]}'> {$edit->getResult()[0]["tipo"]} </option>";
                }
                ?>
                <option value="#">Tipo de Endereço </option>
                <option value="1">Residêncial </option>
                <option value="2">Empresarial </option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Cep </label>
            <input type="text" id="cep"  onblur="pesquisacep(this.value);" class="form-control" placeholder="CEP" name="cep" <?php
            if (!empty($_GET["edit"])) {
                echo "value='{$edit->getResult()[0]["caixa_postal"]}'";
            }
            ?> />
        </div>


    </div>


    <div class=" col-md-12"> 

        <div class="row"> 
            <div class="col-md-10"> 
                <label>Logradouro </label>
                <input type="text" id="logradouro" class="form-control" name="logradouro" placeholder="logradouro" <?php
                if (!empty($_GET["edit"])) {
                    echo "value='{$edit->getResult()[0]["logradouro"]}'";
                }
                ?> />
            </div>
            <div class="col-md-2"> 
                <label>Numero </label>
                <input type="text"   class="form-control" name="numero" placeholder="nº" <?php
                if (!empty($_GET["edit"])) {
                    echo "value='{$edit->getResult()[0]["numero"]}'";
                }
                ?> />
            </div>
        </div>

        <div class="row"> 
            <div class="col-md-8"> 
                <label>Complemento </label>
                <input type="text"  class="form-control" name="complemento" placeholder="complemento"
                <?php
                if (!empty($_GET["edit"])) {
                    echo "value='{$edit->getResult()[0]["complemento"]}'";
                }
                ?>
                       />
            </div>
            <div class="col-md-4"> 
                <label>Bairro </label>
                <input type="text"  id="bairro"  class="form-control" name="bairro" placeholder="bairro"
                <?php
                if (!empty($_GET["edit"])) {
                    echo "value='{$edit->getResult()[0]["bairro"]}'";
                }
                ?>

                       />
            </div>
        </div>

        <div class="row"> 
            <div class="col-md-6"> 
                <label>Cidade </label>
                <input type="text"  id="cidade" class="form-control" name="cidade" placeholder="cidade" 
                <?php
                if (!empty($_GET["edit"])) {
                    echo "value='{$edit->getResult()[0]["cidade"]}'";
                }
                ?>       
                       />
            </div>
            <div class="col-md-6"> 
                <label>UF </label>
                <input type="text"  id="uf"  class="form-control" name="uf" placeholder="uf"
                <?php
                if (!empty($_GET["edit"])) {
                    echo "value='{$edit->getResult()[0]["uf"]}'";
                }
                ?>

                       />
            </div>
        </div>

    </div>


    <h3 class="border-bottom col-md-12"> DADOS DO VEICULO </h3>

    <div class="form-group col-md-4">
        <label >VEICULO: </label>
        <select name="veiculo" id="veiculo"  class="form-control"> 
            <?php
            if (!empty($_GET["edit"])) {
                echo "<option value='{$edit->getResult()[0]["veiculo"]}'> {$edit->getResult()[0]["veiculo"]} </option>";
            }
            ?>
            <option value="#"> Selecione o veiculo</option>
            <option value="motos"> Motos</option>
            <option value="carros"> Carros</option>
            <option value="caminhoes"> Caminhão</option>

        </select>
    </div>
    <div class="form-group col-md-4">
        <label >MARCA: </label>

        <select name="marca1" id="marca1"  class="form-control">
            <?php
            if (!empty($_GET["edit"])) {
                echo "<option value='{$edit->getResult()[0]["marca"]}'> {$edit->getResult()[0]["marca"]} </option>";
            }
            ?>
        </select>


    </div>

    <div class="form-group col-md-4">
        <label>MODELO </label>
        <select name="modelo1" id="modelo1" class="form-control">
            <?php
            if (!empty($_GET["edit"])) {
                echo "<option value='{$edit->getResult()[0]["modelo"]}'> {$edit->getResult()[0]["modelo"]} </option>";
            }
            ?>
        </select>
        </label>
    </div>

    <div class="form-group col-md-4">
        <label>ANO:</label>
        <select name="ano1"  id="ano1" class="form-control"  > 
            <?php
            if (!empty($_GET["edit"])) {
                echo "<option value='{$edit->getResult()[0]["ano"]}'> {$edit->getResult()[0]["ano"]} </option>";
            }
            ?>
        </select>

    </div>

    <div class="form-group col-md-4">
        <label>
            CODIGO FIPE:</label>
        <select  name="fipe" id="fipe" class="form-control" >

            <?php
            if (!empty($_GET["edit"])) {
                echo "<option value='{$edit->getResult()[0]["fipe"]}'> {$edit->getResult()[0]["fipe"]} </option>";
            }
            ?>
        </select>

    </div>

    <div class="form-group col-md-4">
        <label>
            VALOR:</label>
        <select  name="valor" id="valor" class="form-control">
            <?php
            if (!empty($_GET["edit"])) {
                echo "<option value='{$edit->getResult()[0]["valor"]}'> {$edit->getResult()[0]["valor"]} </option>";
            }
            ?>
        </select>

    </div>

    <div class="form-group col-md-3">
        <label>
            CHASSI:</label>
        <input type="text"  name="chassi" id="chassi" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["chassi"]}'";
        }
        ?>
               /> 

    </div>

    <div class="form-group col-md-3">
        <label>
            RENAVAM:</label>
        <input type="text"  name="renavam" id="renavam" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["renavam"]}'";
        }
        ?>
               /> 

    </div>

    <div class="form-group col-md-3">
        <label>
            PLACA:</label>
        <input type="text"  name="placa" id="placa" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["placa"]}'";
        }
        ?>
               /> 

    </div>

    <div class="form-group col-md-3">
        <label>
            COR:</label>
        <input type="text"  name="cor" id="cor" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["cor"]}'";
        }
        ?>
               /> 

    </div>

    <h3 class="border-bottom col-md-12"> PLANO  </h3>

    <!--    <div class="col-md-4">
            <label>
                SELECIONE O PLANO:</label>
            <select class="form-control" name="plano"> 
                <option>Selecione o Plano </option>
    <?php
    $plano = new Source\Models\Read();
    $plano->ExeRead("app_planos_user", "ORDER BY id DESC");
    $plano->getResult();
    foreach ($plano->getResult() as $planos) {
        ?>
                        <option value="<?= $planos["plano"] ?>"> <?= $planos["plano"] ?> </option>
        
    <?php } ?>
            </select>
        </div>
    
        <div class="col-md-4">
            <label>
                DESCRIÇÃO:</label>
            <select  name="plano_desc" id="plano_desc" class="form-control" > </select>
    
        </div>
    
        <div class="col-md-4">
            <label>
                MENSALIDADE:</label>
            <select  name="plano_valor" id="plano_valor" class="form-control" > </select>
    
        </div>-->
    <div class="col-md-4">
        <label>
            SELECIONE O PLANO:</label>
        <input type="text" class="form-control" name="plano"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["plano"]}'";
        }
        ?>
               />

    </div>

    <div class="col-md-4">
        <label>
            DESCRIÇÃO:</label>
        <input type="text" class="form-control" name="plano_desc"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["descricao_plano"]}'";
        }
        ?>
               />

    </div>

    <div class="col-md-4">
        <label>
            MENSALIDADE:</label>
        <input type="text" class="form-control" name="plano_valor"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["mensalidade"]}'";
        }
        ?>
               />

    </div>

    <h3 class="border-bottom col-md-12"> ASSISTÊNCIA 24HS   </h3>

    <div class="col-md-12"> 
        <b> * Assistência 24Hs </b>
        <input type="text" name="assistencia" placeholder="valor assistência 24hs" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["assistencia"]}'";
        }
        ?>
               />
    </div>

    <?php
    if (!empty($_GET["edit"])) {
        $agenda = new Source\Models\Read();
        $agenda->ExeRead("eventos", "WHERE placa = :a", "a={$edit->getResult()[0]["placa"]}");
        $agenda->getResult();
    }
    ?>
    
      <?php
    if (!empty($_GET["edit"])) {
       echo "Nada aqui";
    } else {
    ?>

    
    <h3 class="border-bottom col-md-12"> DADOS INSTALAÇÃO   </h3>

    <div class="col-md-12"> 
        <label>local de instalação </label>
        <input type="text" class="form-control" name="title"
               <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$agenda->getResult()[0]["title"]} {$agenda->getResult()[0]["start"]}'";
        }
        ?>
               />
    </div>

    <div class="col-md-6"> 
        <label> Data Inicio </label>

        <input  type="text" id="date" class="form-control"  
                <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$agenda->getResult()[0]["start"]}'";
        }
        ?>
               />

    </div>

    <div class="col-md-3"> 
        <label>Horas </label>
        <select class="form-control" name="start_horas">
            <?php for ($i = 0; $i <= 24; $i++) { ?>
                <option value="<?= $i ?> "> <?= $i ?> </option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-3"> 
        <label>Minutos</label>
        <select class="form-control" name="start_minutos">

            <option value="00"> 00 </option>
            <option value="15"> 15 </option>
            <option value="30"> 30 </option>
            <option value="45"> 45 </option>

        </select>
    </div>

    <div class="col-md-6"> 
        <label> Data Fim </label>

        <input type="date" id="date" class="form-control"  name="end_dia" />

    </div>



    <div class="col-md-6"> 
        <label>Cor </label>
        <select name="color" class="form-control"> 
            <option value="#6A5ACD" style="background: #6A5ACD;">  AZUL  </option>
            <option value="#00FFFF" style="background: #00FFFF;">  ACQUA  </option>
            <option value="#FFFF00" style="background: #FFFF00;">  AMARELO </option>
            <option value="#F5F5DC" style="background: #F5F5DC;">  BEGE </option>
            <option value="#FFA500" style="background: #FFA500;">  LARANJA </option>
            <option value="#00FF00" style="background: #00FF00;">  VERDE </option>

            <option value="##40E0D0" style="background: #40E0D0;">  TURQUESA </option>
            <option value="#DAA520" style="background: #DAA520;">  GOLDEN </option>
            <option value="#FF6347" style="background: #FF6347;">  VERMELHO </option>
        </select>
    </div>
    
    <?php } ?>

    <h3 class="border-bottom col-md-12"> ADESÃO   </h3>

    <div class="col-md-4"> 
        <b> * ADESÃO </b>
        <input type="text" name="adesao" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["adesao"]}'";
        }
        ?>
               />
    </div>

    <div class="col-md-4"> 
        <b> * FORMA DE PAGAMENTO </b>
        <input type="text" name="forma_pagamento_adesao" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["forma_pagamento_adesao"]}'";
        }
        ?>
               />
    </div>

    <div class="col-md-4"> 
        <b> * VENDEDOR </b>
        <input type="text" name="vendedor" class="form-control" 
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["vendedor"]}'";
        }
        ?>
               />
    </div>

    <h3 class="border-bottom col-md-12"> DADOS ADMINISTRATIVOS   </h3>

    <div class="col-md-4"> 
        <b> * EQUIPAMENTO EMPRESA </b>
        <input type="text" name="equipamento_empresa" class="form-control" 
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["equipamento_empresa"]}'";
        }
        ?>
               />
    </div>

    <div class="col-md-4"> 
        <b> * EQUIPAMENTO ID  </b>
        <input type="text" name="equipamento" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["equipamento"]}'";
        }
        ?>
               />
    </div>

    <div class="col-md-4"> 
        <b> * CHIP  </b>
        <input type="text" name="chip" class="form-control"  <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["chip"]}'";
        }
        ?> />
    </div>

    <div class="col-md-4"> 
        <b> * LOGIN  </b>
        <input type="text" name="login" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["login"]}'";
        }
        ?>
               />
    </div>

    <div class="col-md-4"> 
        <b> * SENHA  </b>
        <input type="text" name="senha" class="form-control"  <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["senha"]}'";
        }
        ?> />
    </div>

    <div class="col-md-4"> 
        <b> * CENTRAL </b>
        <input type="text" name="central" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["central"]}'";
        }
        ?>
               />
    </div>

    <div class="col-md-6"> 
        <b> * LOCAL DE INSTALAÇÂO </b>
        <input type="text" name="instalacao" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["instalacao"]}'";
        }
        ?>
               />
    </div>

    <div class="col-md-3"> 
        <b> * STATUS </b>
        <input type="text" name="status" class="form-control"
        <?php
        if (!empty($_GET["edit"])) {
            echo "value='{$edit->getResult()[0]["status"]}'";
        }
        ?>
               />
    </div>
    
    <div class="col-md-3"> 
        <b>CONTRATO VIGENTE </b>
        <select name="id_contrato" class="form-control"> 
             <?php
        if (!empty($_GET["edit"])) {
            echo "<option value='{$edit->getResult()[0]["id_contrato"]}'> {$edit->getResult()[0]["id_contrato"]} </option>";
        }
        ?>
            <option> Selecione Contrato </option>
            <?php 
            $contrato = new Source\Models\Read();
            $contrato->ExeRead("app_contratos", "ORDER BY id DESC");
            $contrato->getResult();
            foreach ($contrato->getResult() as $value) {
    
            ?>
            <option value="<?=$value["id"] ?>"> <?=$value["nome"] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-12"> 
        <b> * OBSERVAÇÔES </b>
        <textarea name="observacao" class="form-control">
            <?php
            if (!empty($_GET["edit"])) {
                echo "{$edit->getResult()[0]["observacao"]}";
            }
            ?>
        </textarea>
    </div>
    </br></br>

    <div class="col-md-12"> 
        <?php
        if (!empty($_GET["edit"])) {
            echo "<input type='hidden' name='id' value='{$edit->getResult()[0]["id"]}' />";
        }
        ?>
        <input type="submit" value="cadastrar" class="btn btn-success" />
    </div>

</div>

</form>



