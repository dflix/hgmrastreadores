/**
* Capturar itens do banco de dados
*/
function carregarItens(){
	//variáveis
	var itens = "", url = "http://fipeapi.appspot.com/api/1/carros/veiculos/{"+ $_POST['marca'] +"}.json";

    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
	    url: url,
	    cache: false,
	    dataType: "json",
	    beforeSend: function() {
		    $("h2").html("Carregando..."); //Carregando
	    },
	    error: function() {
		    $("h2").html("Há algum problema com a fonte de dados");
	    },
	    success: function(retorno) {
		    if(retorno[0].erro){
			    $("h2").html(retorno[0].erro);
		    }
		    else{
			    //Laço para criar linhas da tabela
			    for(var i = 0; i<retorno.length; i++){
				   
				    itens += "<option value=" + retorno[i].id + ">" + retorno[i].name + "</option>";

			    }
                            
                            
			    //Preencher a Tabela
			    $("#modelo").html(itens);
                            
                            
			    
			    //Limpar Status de Carregando
			    $("h2").html("Carregado");
		    }
	    }
    });
}


