<?php

namespace Source\Core;

class Leads {

    private $filtro;

    public function __construct() {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->filtro = $filtro;
    }

    public function Leads() {

        // rastreamento
        if ($this->filtro["tipo_orcamento"] == "rastreamento") {

            $view = new \Source\Models\View(__DIR__ . "/../../themes/views/email");
            $message = $view->render("mail", [
                "message" => ""
                . "<h3> PROPOSTA INSAT RASTREADORES</h3>"
                . "<p>A INSAT é uma empresa que vêm se destacando na área de desenvolvimento e implantação de tecnologias, rastreamento e recuperação de veículos onde é especialista. </p>"
                . "<p>Investindo em pesquisas e operações de campo, objetivando preencher um espaço vazio, e satisfazer as necessidades de um mercado carente e ávido de soluções para problemas que vêm se agravando dia-a-dia como a segurança pessoal e patrimonial.  </p>"
                . "<P>Os avanços logrados nas áreas de telecomunicações e informática aliado a uma irrevogável vocação de prestadores de serviços, fazem hoje da INSAT um dos destaques no mercado de consumo.  </P>"
                . "<p>Os resultados das pesquisas podem ser traduzidos na atualidade em quatro grandes objetivos: </p>"
                . "<ul> "
                . "<li>1) diminuir as probabilidades de furto ou roubo de veículos;</li>
<li>2) aumentar as possibilidades de recuperar veículos e cargas roubadas; </li>
<li>3) auxiliar na logística do controle de frotas; </li>
<li>4) aprimorar os instrumentos de segurança pessoal;
 </li>"
                . "</ul>"
                . "<p>Empresas de tecnologia e de operação, concessionárias, transportadoras, equipes de negócios, famílias, entre outros, constituem os segmentos que estão formando parcerias com a INSAT, procurando também atender requisitos do mercado na área de segurança pessoal e patrimonial.  </p>"
                . "<p>A maturidade tecnológica alcançada ao nível de produtos e serviços pela INSAT, transforma a empresa e seus parceiros de negócios, sejam eles representantes, distribuidores ou franqueados, em um grupo com inquestionáveis vantagens competitivas e alto valor agregado. 

 </p>
 "
                ."<p>Para tanto, objetivamos nesta proposta o Sistema Rastreador GPS/GPRS.  </p>"
                . "<h3> RASTREADOR GPS/GPRS PLANOS COMODATOS </h3>"
                . "<p>O sistema de rastreamento e monitoramento consiste em uma solução que possibilita o acesso às posições dos veículos em intervalos de até 01 minuto, via internet, tablet ou celular, com diversas ferramentas de controle ao usuário. </br>
O equipamento consiste em: </br>
- Módulo de Rastreamento e de GSM/GPRS </br>
- Softwares de Monitoramento (acesso via WEB e APP). 
 </p>"
                ."<h3> PRINCIPAIS BENEFÍCIOS: </h3>"
                . "<p>- Baixo custo de adesão e mensalidades reduzidas de acordo com prazo de contrato;</br>
- Localização do veículo 24 horas via internet, celular ou tablet;</br> 
- Cobertura em todo território nacional; 
 </p>"
                ."<h3>FERRAMENTAS DISPONIBILIZADAS: </h3>"
                . "<p>- Localização em tempo real </br>
- Bloqueio e desbloqueio via celular, aplicativo ou computador </br>
- Ignição ligada e desligada </br>
- Alerta de movimento </br>
- Tempo de parada </br>
- Cerca virtual com alerta </br>
- Monitoramento individual ou coletivo </br>
- Histórico das posições dos últimos 90 dias </br>
- Hodômetro </br>
- Simulador de rotas percorridas </br>
- Plataforma on-line com acesso ilimitado 24hs </br>
- Aplicativo Android e IOS </br>
- Street View </br>
- Memória interna, que armazena as informações e descarrega posições assim que houver sinal; </br>
- Criação de Pontos de Referências; </br> 
- Antifurto Virtual;  </br>
- Cerca Eletrônica (entrada e saída), com notificação no site e APP; </br> 
- Sensor de movimento; </br>
- Controle de velocidade (determinada pelo administrador), com notificação via relatório; </br>
- Exportação de relatórios diários, semanais ou mensais (para arquivo e controle) em Excel e PDF, com todas as informações necessárias.
 </p>"
                ."<h3 style='color:orange;'> VALOR DO EQUIPAMENTO (COMPRA SEM MENSALIDADE) </h3>"
                . "<p>- EQUIPAMENTO – R$ 599,00 (garantia 6 meses) </br>
- CHIP (POR CONTA DO CLIENTE)</br>
* INSTALAÇÃO INCLUSA
 </p>"
                ."<h3 style='color:orange;'> COMODATO I (1 ano de Contrato)  </h3>"
                . "<p>Adesão R$ 100,00 </br>
Mensalidade R$ 69,00 
 </p>"
                ."<h3 style='color:orange;'> COMODATO II (2 ano de Contrato)  </h3>"
                . "<p>Adesão R$ 100,00 </br>
Mensalidade R$ 65,00 
 </p>"
                ."<h3 style='color:orange;'> COMODATO III (3 ano de Contrato)  </h3>"
                . "<p>Adesão R$ 100,00 </br>
Mensalidade R$ 59,00 
 </p>"
                ."<p style='color:orange;'> *Caso tenham interesse pela Assistência 24hs, acrescenta o valor de R$ 30,00 na mensalidade. </p>"
                ."<p>Qualquer dúvida estamos a disposição </p>"
                . "<p><a href='https://www.rastreadoresinsat.com'> www.rastreadoresinsat.com </a></p>"
           
                ]);
            
            $email = new \Source\Support\Email();
            $email->bootstrap(
                    "Orçamento Rastreadores INSAT", 
                    $message, 
                    "send@sistemasinsat.com.br", 
                    $this->filtro["nome"])->send($this->filtro["email"]);
            
            $Dados = [
                "nome" => $this->filtro["nome"],
                "email" => $this->filtro["email"],
                "telefone" => $this->filtro["telefone"],
                "mensagem" => $this->filtro["mensagem"],
                "tipo_orcamento" => $this->filtro["tipo_orcamento"],
                "data" => date("Y-m-d H:i:s")
            ];
            
            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_leads", $Dados);
            
            if($email->send()){
                echo "<p class='alert alert-success'> Email enviado com sucesso </p>";
            }else{
               echo "<p class='alert alert-danger'> Email enviado com sucesso </p>"; 
            }
            
            

            //var_dump($this->filtro);
        }
        
        
        if($this->filtro["tipo_orcamento"] == "seguro"){
            
            $this->filtro["tipo"] = $this->filtro["veiculo"];
            
            $marca = explode("|", $this->filtro["marca1"]);
            
            $modelo = explode("|", $this->filtro["modelo1"]);
            $ano = explode("|", $this->filtro["ano1"]);
            
            $this->filtro["marca"] = $marca[0];
            $this->filtro["modelo"] = $modelo[3];
            $this->filtro["ano"] = $ano[4];
            $this->filtro["data"] = date("Y-m-d H:i:s");
            
            unset($this->filtro["veiculo"]);
            unset($this->filtro["submit"]);
            unset($this->filtro["marca1"]);
            unset($this->filtro["modelo1"]);
            unset($this->filtro["ano1"]);
//            unset($this->filtro["data"]);
//            unset($this->filtro["data_nascimento"]);
            
            $Dados = [
                "nome" => $this->filtro["nome"],
                "email" => $this->filtro["email"],
                "telefone" => $this->filtro["telefone"]
                
            ];
            
            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_leads", $this->filtro);
            $cad->getResult();
            if($cad->getResult()){
                echo "<div class='alert alert-success'> Orçamento enviado com sucesso , aguarde informações </div>";
            }else{
               echo "<div class='alert alert-danger'>ERROr </div>"; 
            }
            
            //var_dump($this->filtro); 
        }
    }

}
