<section class="main"> 
    <header> <h1>Orçamentos do Site</h1></header>
    <article>
        <div class="blococontatotop"> 
            <div class="blococontato10top"> Data </div>
            <div class="blococontato10top"> Nome </div>
            <div class="blococontato10top"> E-mail </div>
            <div class="blococontato10top"> Telefone</div>
            <div class="blococontato10top"> Celular</div>
            <div class="blococontato10top"> Mensagem</div>
            <div class="blococontato10top"> Vendedor</div>
            <div class="blococontato10top"> Detalhes</div>
            <div class="blococontato10top"> Editar</div>
            <div class="blococontato10top"> Deletar</div>
        </div>
        
        <?php 
        $read = new Read;
        $read->ExeRead('ws_orcamento');
        $read->getResult();
        
        if(!empty($read->getResult())):
            foreach ($read->getResult() as $value) {
            $data = date("d/m/Y H:i:s", strtotime($value['data']));
            echo "        
        <div class=\"blococontatotop\"> 
            <div class=\"blococontato10top\"> {$data} </div>
            <div class=\"blococontato10top\"> {$value['RemetenteNome']} </div>
            <div class=\"blococontato10top\"> {$value['RemetenteEmail']} </div>
            <div class=\"blococontato10top\"> {$value['RemetenteTelefone']}</div>
            <div class=\"blococontato10top\"> {$value['RemetenteCelular']}</div>
            <div class=\"blococontato10top\"> {$value['Mensagem']}}</div>
            <div class=\"blococontato10top\"> Vendedor</div>
            <div class=\"blococontato10top\"> Detalhes</div>
            <div class=\"blococontato10top\"> Editar</div>
            <div class=\"blococontato10top\"> Deletar</div>
            <div class=\"clearcontato\"> </div>
        </div> <div class=\"clearcontato\"> </div>";
                
            }
        endif;
        ?>


        <article>
            </section>