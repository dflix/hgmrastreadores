<?php

/**
 * Classe responsavel por capturar trafego di ste
 *
 * @author usuario
 */
class BaixaCaixa {

    private $placa;
    private $nome;
    private $data;
    private $valor;
    private $dados;


    function __construct() {
            
        
        $this->Cadastra();
    }
    
    
    private function Leitura() {
                // Abre o Arquvio no Modo r (para leitura)
$arquivo = fopen ('newcaixa.txt', 'r');
	
// Lê o conteúdo do arquivo 
while(!feof($arquivo))
{
//Mostra uma linha do arquivo
    
    echo "INICIO DO LOOP </BR>";
$linha = fgets($arquivo, 1024);
 ECHO $linha.'<br />';
$string_letras=$linha;
 
 
 
 
 
 '</br>';
 

 
 /**
  * Esse codigo abaixo consegui capturar as letras da placa
  */
 
 $letra = eregi_replace("([^a-z])", "", $string_letras);
 
  $letraplaca = substr($letra, 1,3);

 echo "<hr>";
 
 /**
  * Esse codigo abaxo vou tentar capturar os numeros da placa
  */
 
 $texto = $string_letras;
 $numeros = preg_replace("/[^a0-z9]/", "", $texto);   
  $numerosplaca = substr($numeros, 57,4);
  
  
   /**
  * Esse codigo recupera valor do boeto
  */
 
 $texto = $string_letras;
 $boleto = preg_replace("/[^a0-z9]/", "", $texto);   
  $valorboleto = substr($boleto, 82,5);
  
  //echo $numeroplaca;

 
 //echo $texto;
 /**
  * COdigo abaixo conseguimos extrair e tratar a plaa do caminhão
  */
 
 $placa = $letraplaca . $numerosplaca;
 
 "Placa do Veiculo =". $placa;
 
 
 
 
// 
// echo "<hr>";
// 
 $letra2 = eregi_replace("([^a-z])", "", $string_letras);
 
$nomecli = substr($letra2, 7, 30);
// 
$valorboleto;
  
  echo "</br>";
  echo "<hr>";
  
  $verifica = new Read();
  $verifica->ExeRead("prevendaacasp","WHERE placa1 = :p","p={$placa}");
  $verifica->getResult();
  
  $verifica->getResult()[0]['associado'];
  
  echo "Cliente". $associado = $verifica->getResult()[0]['associado'];
  echo "</br>";
  echo "Placa". $placa = $verifica->getResult()[0]['placa1'];
  echo "</br>";
  echo "Valor Boleto". $valorboleto;
  echo "</br>";
  echo "Data". $data = $date = date("Y-m-d");
  echo "</br>";
  
  //$Dados = array([placa=>"$placa",nome=>"$associado",valor=>"$valorboleto",data=>"$data"]);

        $Dados = [
            "placa => $placa",
            "nome => $associado",
            "valor => $valorboleto",
            "data => $data"
        ];

    print_r($Dados);

        
  
   echo "<hr>";
 
 
}
        
    }



    private function Cadastra() {

        $this->dados = [
            "placa => $placa",
            "nome => $associado",
            "valor => $valorboleto",
            "data => $data"
        ];

        $cad = new Create;
        $cad->ExeCreate('baixacaixa', $this->dados);
        $cad->getResult();
    }

}
