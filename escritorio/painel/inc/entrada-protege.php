<article> 
    <p class="titulo"> ENTRADA PROTEGE </p>
    <p> Resultados do dia <b> <?= $dia ?>/<?= $mes ?>/<?= $ano ?> </b> </p>
</article>

<article class="quarenta"> 
    <h1>Entrada Manual</h1>
    <form action="" name="manual" method="get"> 
        <label> 
            <p>Motivo </p>
            <input type="text" name="motivo" />
        </label>
        <label> 
            <p>Valor </p>
            <input type="text" name="valor" />
        </label>
        <label> 
            <p>Comprovante </p>
            <input type="file" name="imagem"/>
        </label>
        <label> 
            <input type="hidden" name="ano" value="<?= $ano ?>" />
            <input type="hidden" name="mes" value="<?= $mes ?>" />
            <input type="hidden" name="dia" value="<?= $dia ?>" />
            <input type="hidden" name="p" value="fluxocaixa" />
            <input type="hidden" name="view" value="entrada-protege" />
            <input type="submit" name="cadastra" value="ENTRADA" class="botao" />
        </label>
    </form>
</article>



<article class="sessenta"> 
    <h1> Resultados </h1>
    <p> Resultados </p>
    <p> Resultados </p>
    <p> Resultados </p>
    <p> Resultados </p>
</article>

<div class="clear"> </div>
