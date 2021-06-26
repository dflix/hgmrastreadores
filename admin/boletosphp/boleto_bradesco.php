<?php
header("Content-type: text/html; charset=utf-8"); 
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa			       	  |
// | 																	                                    |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Bradesco: Ramon Soares						            |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE

date_default_timezone_set('America/Sao_Paulo');

$dias_de_prazo_para_pagamento = 0;
$taxa_boleto = 0.00;
$data_venc = date("{$_GET['data']}", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
//$data_venc = {$_GET['data']};  // Prazo de X dias OU informe data: "13/04/2006";
$valor_cobrado = "{$_GET['valor']}"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');



$dadosboleto["cpf"] = "{$_GET['cpf']}";  // Nosso numero sem o DV - REGRA: M�ximo de 11 caracteres!
$dadosboleto["cpfcli"] = "{$_GET['cpfcli']}";  // Nosso numero sem o DV - REGRA: M�ximo de 11 caracteres!
$dadosboleto["nosso_numero"] = "{$_GET['cpf']}";  // Nosso numero sem o DV - REGRA: M�ximo de 11 caracteres!
$dadosboleto["numero_documento"] = $dadosboleto["nosso_numero"];	// Num do pedido ou do documento = Nosso numero
$dadosboleto["desconto"] = $_GET['desconto'];	// Num do pedido ou do documento = Nosso numero
$dadosboleto["nosso_numero"] = $dadosboleto["nosso_numero"];	// Num do pedido ou do documento = Nosso numero
$dadosboleto["nosso_numero_dv"] = $_GET['dv'];	// Num do pedido ou do documento = Nosso numero
$dadosboleto["documento"] = $_GET['numero_documento'];	// Num do pedido ou do documento = Nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = "{$_GET['cliente']}";
$dadosboleto["endereco1"] = "{$_GET['endereco']} {$_GET['numero']}";
$dadosboleto["endereco2"] = "{$_GET['cidade']} - {$_GET['estado']} -  CEP: {$_GET['cep']}";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "SECURITY SISTEMA DE RASTREAMENTO LTDA - ME - ";
//$dadosboleto["demonstrativo2"] = "Mensalidade referente a mensalidade de monitoramento CPF {$_GET['cpf']} <br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo2"] = "Conceder desconto de {$_GET['desconto']} até a data de vencimento";
$dadosboleto["demonstrativo3"] = "Segurity Sistem - http://www.seguritysistem.com.br";
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
$dadosboleto["instrucoes2"] = "- Receber ate 2 dias apos o vencimento";
$dadosboleto["instrucoes3"] = "- Em caso de duvidas entre em contato conosco: contato@seguritysistem.com.br";
$dadosboleto["instrucoes4"] = "- Conceder desconto de {$_GET['desconto']} até a data de vencimento";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DS";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - Bradesco
$dadosboleto["agencia"] = "0963"; // Num da agencia, sem digito
$dadosboleto["agencia_dv"] = "-6"; // Digito do Num da agencia
$dadosboleto["conta"] = "0017234"; 	// Num da conta, sem digito
 	
$dadosboleto["conta_dv"] = "0"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - Bradesco
$dadosboleto["conta_cedente"] = "0017234"; // Conta Cedente do Cliente, sem digito (Somente N�meros)
$dadosboleto["conta_cedente_dv"] = "0"; // Digito da Conta Cedente do Cliente
$dadosboleto["carteira"] = "09";  // C�digo da Carteira: pode ser 06 ou 03

// SEUS DADOS
$dadosboleto["identificacao"] = "SECURITY SISTEMA DE RASTREAMENTO LTDA - ME </br>Estrada do Campo Limpo , 2745 - Vila Prel - 05777-001</br>São Paulo / SP";
$dadosboleto["cpf_cnpj"] = "031.765.416/0001-28";
$dadosboleto["endereco"] = "Estrada do Campo Limpo , 2745 - Vila Prel - 05777-001 ";
$dadosboleto["cidade_uf"] = "São Paulo / SP";
$dadosboleto["cedente"] = "SECURITY SISTEMA DE RASTREAMENTO LTDA - ME - 031.765.416/0001-28  ";

// N�O ALTERAR!
include("include/funcoes_bradesco.php");
include("include/layout_bradesco.php");
?>
