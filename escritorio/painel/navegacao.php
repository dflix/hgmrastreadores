    <!-- Barra navegação -->
    <nav class="navbar navbar-default">
      <div class="container">
        
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" 
                  data-toggle="collapse" data-target="#barra-navegacao">
            <span class="sr-only">Alternar Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a href="index.php" class="navbar-brand"> ASSOCIAÇÃO | PROTEGE</a>
        </div>

        <div class="collapse navbar-collapse" id="barra-navegacao">

          <ul class="nav navbar-nav navbar-right">
            <li> <a href="index.php?p=home">HOME</a> </li>
<!--            <li> <a href="#">empresa</a> </li>
            <li> <a href="#">clientes</a> </li>
            <li> <a href="#">produtos</a> </li>-->

            <li class="dropdown"> 
              <a href="index.php?p=eprotege" class="dropdown-toggle" data-toggle="dropdown">
                PROTEGE <span class="caret"></span>
              </a> 
              <ul class="dropdown-menu">
        	<li><a href="index.php?p=iprotege">INSERIR</a></li>
            <li><a href="index.php?p=eprotege">EDITAR</a></li>
            <li><a href="index.php?p=pprotege">ENVIAR PROPOSTA</a></li>
              </ul>

            </li>
            <li class="dropdown"> 
              <a href="index.php?p=eacasp" class="dropdown-toggle" data-toggle="dropdown">
                ASSOCIAÇÃO<span class="caret"></span>
              </a> 
              <ul class="dropdown-menu">
        	<li><a href="index.php?p=oacasp">ORÇAMENTO</a></li>
        	<li><a href="index.php?p=pacasp">PROPOSTA ASSOCIAÇÃO</a></li>
        	<li><a href="index.php?p=iacasp">INSERIR</a></li>
            <li><a href="index.php?p=eacasp">EDITAR</a></li>
              </ul>

            </li>
            <li class="dropdown"> 
              <a href="index.php?p=eprotege" class="dropdown-toggle" data-toggle="dropdown">
                INDICAÇÕES<span class="caret"></span>
              </a> 
              <ul class="dropdown-menu">
        	<li><a href="index.php?p=leadacasp">ASSOCIAÇÃO</a></li>
            <li><a href="index.php?p=leadprotege">PROTEGE</a></li>
              </ul>

            </li>

          </ul>

        </div>

      </div>
    </nav>