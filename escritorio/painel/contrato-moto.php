<?php 
session_start();
require('../_app/Config.inc.php');

$id= $_GET['id'];

$ver = new Read();
$ver->ExeRead("prevenda", "WHERE id_venda= :p", "p={$id}");
$ver->getResult();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Contrato Protege</title>
                <style> 
<?php
require('./estilo.css');
?>
        </style>
    </head>
    <body>
                <header class="cabecalho"> 
            <div class="logoadesao">
                <img src="img/contrato.png" style="width:500; margin: 0 auto;"  />
            </div>
                    <div class="clear"> </div>
            <div class="sessao"> 
                <p> Contrato Nº <?= $ver->getResult()[0]['codigo']; ?>  </p>
                </br>
            </div>
        </header>
 <h3> 1. INTRODUÇÃO E CONCEITOS </h3>
            <p> <b>1.1</b> A PROTEGCAR PROTEÇÃO E RECUPERAÇÃO DE VEÍCULOS LTDA, é uma sociedade empresária limitada, inscrita no CNPJ/MF sob nº 05.128.637/0001-81, com sede na Rua Cantagalo, nº 1145, Bairro: Vila Gomes Cardim, CEP: 03319-001, na cidade de São Paulo/SP, que opera serviços de rastreamento e ativação de sistemas de alarmes a distância contra roubos, bem como recuperação de veículos avariados, doravante denominada “CONTRATADA”. O CONTRATANTE é a pessoa física ou jurídica que contrata os serviços prestados pela CONTRATADA. <br /></p>
            <p><b>1.2</b> O objeto deste contrato é a compra pelo cliente de um equipamento bloqueador e comodato de um equipamento Rastreador, desta forma, a
                empresa PROTEGCAR cede em comodato o equipamento rastreador que deverá ser restituído ao termino do contrato(caso não haja a
                renovação), sendo que o equipamento bloqueador ao termino do pagamento da compra, passa a ser de propriedade do contratante. </p>
            <p><b>1.3</b> O SISTEMA RASTREADOR é aquele que permite o seu usuário requerer da Central de Operações da CONTRATADA a emissão de
                comandos destinados ao rastreamento do veículos, parado ou em movimento, permitindo que o cliente tenha a visualização do veiculo
                através da internet, utilizando-se de nosso portal, através de uma senha (login) fornecida por nós. O Sistema de rastreamento é composto por
                um kit que contem: 1 (um) módulo eletrônico; 1 (um) conjunto de chicote completo, antena GPS e 1 (uma) antena GSM(as antenas são
                embutidas dentro do equipamento, podendo ser utilizada uma antena externa coso seja necessário) 
            </p>
            <p> Obs.: em caso de roubo, onde nossa equipe já esteja no procedimento de recuperação do veiculo, poderá ser bloqueado o acesso do cliente
                pela internet, visando a segurança do próprio cliente e a segurança da operação de recuperação.
            </p>
            <p> <b>1.4</b> O Sistema se apóia na tecnologia GPS, no funcionamento eletrônico do equipamento adquirido pelo CONTRATANTE, que deverá sempre
                manter a sua conservação e verificação através dos testes mensais. 
            </p>

            <h3>2. SERVIÇOS  </h3>
            <p><b>2.1</b> O objeto da prestação de serviços ora avançada é a emissão e recepção de comandos (sinais) destinados a desencadear o processo de
                monitoramento do veículo, respeitados os limites decorrentes das áreas de cobertura.
            </p>
            <p><b>2.2</b> O serviço adquirido não é e não engloba qualquer tipo de gerenciamento de risco, não resultando em responsabilidade da CONTRATADA as
                conseqüências de qualquer natureza advindas do seqüestro de pessoas ou do roubo de cargas, quando da ocorrência de roubo. </p>

            <h3>3. DO PRODUTO E DO SERVIÇO </h3>

            <p><strong><b>3.1</b> A CONTRATADA garante que, acionada por meio de sua Central de Operações, emitirá sinais para conexão com o Sistema de
                    rastreamento do veículo dentro da área de cobertura. Para efeitos deste Contrato, área de cobertura indicada pela operadora de telefonia
                    móvel CLARO (Todo Território Nacional).</strong>
            </p>
            <p> <b>3.2</b> - Em caso de necessidade de assistência por defeito apresentado no (s) equipamento (s) objeto (s) deste Contrato, o Serviço de Atendimento
                ao Cliente da CONTRATADA designará um técnico que prestará à assistência no prazo máximo de 48 (quarenta e oito) horas(se dentro da grande
                São Paulo) após a comunicação à empresa e de melhor conveniência para a CONTRATANTE. </p>

            <p>Parágrafo único – O equipamento rastreador é projetado para as especificações de bateria de motocicleta,possuindo um sistema “sleep” (acionado
                5 minutos após o veiculo ser desligado)que reduz o consumo de bateria do veiculo(1,5 mA/h), no entanto, não deve o veiculo ficar sem uso por
                longos períodos. </p>
            <p><b>3.3</b> - Os serviços da assistência técnica e manutenção por ventura decorrente de defeitos de fabricação não serão cobrados, se ocorridos dentro do
                prazo de garantia do equipamento (1 (um) ano a contar da data de instalação).
            </p>
            <p><b>3.4</b>- A garantia dos equipamentos objeto deste Contrato está restrita a defeitos de fabricação não abrangendo danos provocados por mau uso,
                incêndios, infiltração de água, agentes químicos ou decorrentes de forças da natureza entre outros. </p>
            <p><b>3.5</b> - É de inteira responsabilidade do (a) CONTRATANTE, o uso indevido dos serviços de monitoramento assim como a divulgação a terceiros do
                número telefônico da Central de Monitoramento PROTEGCAR, do Serviço de Atendimento a Clientes e de seus dados pessoais..  </p>
            <p><b>3.6</b> - Não caberá a CONTRATADA qualquer responsabilidade por eventuais problemas no desempenho dos serviços objeto deste Contrato
                decorrente de ineficiência dos serviços de comunicação utilizados para a transmissão de dados entre o (s) equipamento (s) objeto (s) deste
                Contrato e a Central de rede pública ou privada, bem como não cabe a CONTRATADA responder por perdas, danos ou lucros cessantes do
                CONTRATANTE, cujas causas possam ser atribuídas à utilização ou interrupção dos serviços de telecomunicação por determinação dos poderes 
                públicos ou por casos fortuitos e/ou motivos de força maior, cabendo apenas a indenização decorrente da não recuperação do veiculo, conforme
                condições descritas neste contrato </p>

            <p><b>3.7</b> - Todo e qualquer problema, incidente ou acidente provenientes do bloqueio do veículo (desligamento do motor) efetuado automaticamente pelo
                equipamento ou pela Central de Monitoramento PROTEGCAR em atendimento as orientações expresses do CONTRATANTE, serão de
                inteira responsabilidade deste último. </p>
            <p><b>3.8</b> - O equipamento PROTEGCAR é um dispositivo complementar e de apoio ao veículo, não sendo garantida a sua recuperação. A sua
                aquisição não dispensa a contratação de seguro. </p>

            <h3> 4. SERVIÇOS EXCEDENTES</h3>

            <p><b>4.1</b> Os seguintes serviços excedentes serão cobrados separadamente: a) a transferência do Sistema de um veiculo para outro veículo, sendo que
                o custo de cada um dos serviços e a forma de pagamento, sempre serão informados pela CONTRATADA ao CONTRATANTE, sendo informado o
                valor no momento da solicitação da prestação dos serviços de acordo com a tabela vigente à época , b) a substituição ou troca de qualquer
                equipamento, cujo o defeito se deu pela má utilização do produto ou em desconformidade com o indicado pela empresa contratada </p>
            <p>PARAGRAFO UNICO - caso o contratante solicite a visita de um técnico do contratado e seja constatado que o defeito não é do equipamento, a
                visita do técnico será cobrada a parte,sendo enviado um boleto para pagamento em até 20 dias.  </p>

            <h3>5. OBRIGAÇÕES DA CONTRATADA </h3>

            <p><b>5.1</b> A CONTRATADA deverá iniciar o processo de envio de sinais destinados ao rastreamento do veículo ao receber o comunicado de roubo feito
                pelo CONTRATANTE e, concomitantemente deverá dar início ao serviço de busca do veículo, por si ou por empresas contratadas, os quais se
                prorrogarão por 30 ( trinta)dias. </p>
            <p><b>5.2</b> É obrigação da CONTRATADA instalar o Sistema no veículo do CONTRATANTE, fazendo a avaliação do estado geral da motocicleta
                na presença do CONTRATANTE ou de pessoa por este indicada e, executar a vistoria, cuja data da realização servirá de termo inicial para
                a vigência do pacto adjeto de promessa de compra sobre documentos, de acordo com a clausula 10.1(o Termo de "ordem de serviço"
                prova a instalação do dispositivo rastreador, sendo emitido em duas vias, uma ficando com o contratante e outra com a contratada, e é o
                termo que inicia o pacto adjeto de compra sobre documentos descrito neste contrato).
            </p>
            <p> <b>5.3</b> É obrigação da CONTRATADA fazer as adaptações necessárias ao bom funcionamento do Sistema quando os veículos necessitarem de
                componentes diferenciados, como eletroválvula ou relê, devendo o CONTRATANTE arcar com os custos decorrentes da instalação e adaptação.</p>

            <h3> 6 - CONFIDENCIALIDADE  </h3>

            <p> <b>6.1</b> - Fica claro ao CONTRATANTE que o(s) equipamento(s) objeto(s) deste Contrato é composto dos mais modernos
                componentes destinados ao bloqueio, rastreamento e monitoramento de veículos, constituindo-se em produto(s)
                essencial (ais) e de elevada tecnologia a respeito dos quais o CONTRATANTE manterá total confidencialidade,
                comprometendo-se a não permitir consultas, exames ou divulgação dos mesmos sem prévia e expressa autorização
                da CONTRATADA.  </p>
            <p>Parágrafo Único- O contratante deve permitir que a empresa contratada instale o equipamento em total sigilo, sem a
                presença do contratante ou qualquer pessoa que não seja autorizada pela contratada, evitando assim que o
                contratante ou outra pessoa saiba o local exato em que se encontra o equipamento, como medida de segurança para
                o contratante e para a contratada, sob pena de exclusão do pacto adjeto de compra sobre documentos.  </p>
            <p> <b>6.2</b> – Fica claro ao CONTRATANTE que o efetivo bloqueio do veiculo em caso de roubo ficara a critério da empresa contratada(mediante
                solicitação da equipe de recuperação), visto que em muitos casos o bloqueio do veiculo apenas diminui a chance de recuperação do veiculo, alem
                da destruição do veiculo realizada pelos assaltantes.</p>

            <h3> 7. OBRIGAÇÕES DO CONTRATANTE </h3>

            <p> <strong>7.1 O CONTRATANTE deverá comparecer ao local indicado pela CONTRATADA para a instalação do Sistema
                    ou optar que a mesma seja efetuada no seu domicílio. Haverá apenas um teste (1 dia após a instalação),
                    sendo obrigatório a sua realização e faz parte do dever de manutenção do Sistema, sendo que a falta do teste
                    a ser realizado pelo CONTRATANTE exonera a CONTRATADA de dar cumprimento ao pacto adjeto de
                    compromisso de compra dos documentos do veículo, independentemente do cumprimento das demais
                    obrigações contratuais(será enviado protocolo deste teste) </strong></p>

            <p><Strong>Parágrafo primeiro: A geração de numero de protocolo é feita de forma autônoma do sistema de controle de
                    clientes, desta forma, NUNCA ocorrera falhas na geração de seus números em decorrência de possível falhas
                    no sistema; E sua emissão ao cliente se faz por meio de envio de email/SMS, desta forma, não serão aceitos
                    como justificativa de não apresentação dos protocolos obrigatórios, desculpas como falha no sistema na data
                    em que realizou o teste, etc., pois tais argumentos não são verídicos.</strong> 
            </p>
            <p><strong>Parágrafo segundo: O referido teste consiste em uma simples ligação que o contratante devera fazer para a
                    central de atendimento (sac) da contratada, onde esta ira verificar o funcionamento do equipamento,
                    informando a localidade onde o veiculo se encontra, emitindo protocolo, após a confirmação de localização
                    do veiculo pelo contratante.</strong>  </p>
            <p>Parágrafo terceiro: A não realização do referido teste (teste pós instalação)acarreta a perda do direito a indenização
                descrita neste contrato, independentemente de notificação por parte do contratante </p>
            <p><b>7.2</b> Após a recuperação do veículo o cliente deverá solicitar à CONTRATADA um técnico para avaliar as condições do Sistema, para que se
                verifique se houve ou não danos à sua instalação. Na ausência de quaisquer componentes do Kit essencial ao funcionamento do Sistema, a
                CONTRATADA se compromete a instalar novo equipamento a preço de custo (inicial) da habilitação. </p>
            <p><b>7.3</b> É obrigação de o CONTRATANTE comunicar a CONTRATADA sobre eventuais reparos mecânicos ou elétricos que sujeitar os veículos
                protegidos, decorrentes de desgaste natural, viagens longas, intempéries ou acidentes, pois todas estas circunstâncias podem resultar em vício no
                funcionamento do Sistema.
            </p>

            <h3>8. DA INADIMPLÊNCIA </h3>

            <p><b>8.1</b>. A CONTRATADA não prestará qualquer serviço previsto ou decorrente deste contrato para o CONTRATANTE que
                estiver financeiramente inadimplente, sendo considerado dessa forma o CONTRATANTE que não cumprir com as obrigações
                previstas neste Contrato, incluindo valor da habilitação e da prestação de serviços. A retomada da prestação de serviços está
                condicionada à efetiva comprovação da regularização do pagamento, incluindo-se o pagamento da taxa de reativação do sistema,
                sob pena de imediata interrupção.  </p>
            <p>Parágrafo primeiro- A inadimplência nos pagamentos das obrigações pecuniárias descritas neste contrato autorizará a contratada a
                rescindir o contrato (após notificação por email conforme descrito na clausula 14) e a cobrar judicialmente os valores devidos ,
                incluindo-se multa por rescisão e demais valores(conforme clausula 14) inclusive com a emissão de boleto no valor total da divida </p>
            <p> <b>8.2</b> O CONTRATANTE NÃO PODERÁ EXIGIR DA CONTRATADA O CUMPRIMENTO DO PACTO ADJETO DE PROMESSA DE COMPRA
                SOBRE DOCUMENTOS SE, NA DATA DO ROUBO ESTIVER INADIMPLENTE. EM RELACAO: (I) A QUALQUER PAGAMENTO DEVIDO PELO
                CONTRATANTE (valor da habilitação e da prestação de serviços); OU (2) AO DEVER DE SOLICITAR O TESTE;(3) AO NÃO COMUNICADO ÁO
                DEPTO. TÉCNICO SOB QUAISQUER FALHAS OU POSSÍVEIS DANOS QUE O EQUIPAMENTO POSSA APRESENTAR, CARACTERIZANDOSE
                ASSIM NEGLIGÊNCIA, O QUE DESOBRIGA Á CONTRATADA O CUMPRIMENTO DA INDENIZAÇÃO; (4) NÃO TER REALIZADO A
                “VACINA” CONFORME DESCRITO NO CONTRATO NA CLAUSULA 7.4.  </p>
            <p><b>8.3</b> É DE RESPONSABILIDADE DO CONTRATANTE dar baixa nos protesto oriundos de seu inadimplemento referente a
                quaisquer valores devido para a contratada que não tenha sido pago na data de seu vencimento(e que, desta forma, tenha
                sido protestado por falta de pagamento), devendo ainda o contratante arcar com as custas de baixa nos
                cartórios(emolumentos, custas, etc.).  </p>
            <p><strong>Parágrafo Primeiro: Após o pagamento do valor devido a CONTRATADA(incluindo-se multa e juros), esta emitira CARTA
                    DE ANUÊNCIA(ou entregara o instrumento de protesto) para que o CONTRATANTE possa dar as devidas baixas nos
                    cartórios, devendo o contratante retirar a CARTA DE ANUÊNCIA no endereço comercial da CONTRATADA(providenciando
                    o reconhecimento de firma da assinatura no cartório indicado pela CONTRATADA). 
                </strong> </p>

            <h3> 9. COBRANÇAS </h3>
            <p><b>9.1</b> O não recebimento do boleto referente à cobrança da prestação de serviço (mensalidade) até a data do vencimento não exime o
                CONTRATANTE da obrigação de pagar, devendo entrar em contato imediatamente com a CONTRATADA, antes do vencimento. Caso o
                pagamento seja feito com atraso o comprovante deverá ser remetido por fax à CONTRATADA, a maior brevidade possível, para restabelecimento
                da prestação de serviços. </p>
            <p>a) Em caso de não pagamentos da habilitação se aplicam as mesmas regras previstas nas cláusulas “8.1” e “8.2 </p>
            <p>b) Será concedido o desconto conforme descrito na capa deste contrato ao contratante que pagar a
                mensalidade até a data de seu vencimento (o desconto estará especificado no boleto de cobrança
                emitido).  </p>
            <p>c) Após o vencimento, será cobrado o valor sem desconto, acrescido de multa de 2% alem de 1% de
                juros mensais. </p>
            <p><b>9.2</b> A partir do 30° (trigésimo) dia contado da data da instalação do sistema, o CONTRATANTE fica obrigado a pagar a Mensalidade referente ao
                serviço de monitoramento prestado no mês vencido. 
            </p>
            <p><b>9.3</b> A partir do vencimento de quaisquer pagamento devido pelo contratante,os SERVIÇOS DE RASTREAMENTO,
                BLOQUEIO E RECUPERAÇÃO DO VEICULO ESTARÃO SUSPENSOS e a empresa contratada se eximirá da
                responsabilidade de cumprir o pacto adjeto de promessa de compra sobre o documento. </p>
            <p><b>9.4</b>O CONTRATANTE poderá ser reabilitado na base da CONTRATADA mediante cumprimento das obrigações a seguir
                cumulativamente: (I) pagamento dos valores vencidos e não quitados, acrescido da multa bancaria descrita no boleto, na ordem de
                10% do valor em aberto; (II) pagamento de uma taxa de reabilitação (taxa de nova vistoria), cujo valor será informado ao
                CONTRATANTE por meio da Central de Operações da CONTRATADA e, após regularização dos pagamentos, deverá o
                CONTRATANTE comparecer ao local indicado pela CONTRATADA para nova vistoria do sistema. 
            </p>
            <p><b>9.5</b> A ocorrência de desabilitação afasta o dever de cumprimento do pacto adjeto de promessa de compra
                sobre documentos. O pacto somente volta a obrigar a CONTRATADA quando o CONTRATANTE quitar os
                débitos e proceder a nova vistoria/avaliação. 
            </p>
            <p> <b>9.6</b> A empresa CONTRATADA poderá solicitar a qualquer tempo que o CONTRATANTE envie a CONTRATADA
                os comprovantes de pagamento(mensalidades, compra equipamento, etc.), sendo que a recusa no envio
                deste comprovante(mesmo que esteja em dia com os pagamentos) acarretará a desobrigação da contratada
                em cumprir o pacto adjeto de promessa de compra sobre documentos e demais avenças e suspensão dos
                serviços
            </p>

            <h3> 10. PRAZO DE VIGÊNCIA DO CONTRATO DE PRESTAÇÃO DE SERVIÇOS COM PACTO ADJETO DE PROMESSA DE
                COMPRA SOBRE DOCUMENTOS DE VEÍCULOS DE USO PARTICULAR.
            </h3>

            <p><b>10.1</b> O presente Contrato de prestação de serviços vigerá por 36(trinta e seis) meses, a contar da data de instalação do equipamento descrito neste
                contrato no veiculo descrito na capa deste instrumento, sendo que a primeira parcela de prestação de serviço vencer-se-á trinta dias após.  </p>
            <p> Parágrafo primeiro – Serão emitidos 12 boletos (referente a 12 meses) para pagamento, sendo que após o termino destes boletos será feita uma
                nova vistoria e o envio de mais 12 boletos, sendo que após o vencimento destes boletos será feita nova vistoria e envio dos últimos 12 boletos,
                totalizando 36 boletos. 
            </p>
            <p> <b>10.2</b> O presente contrato poderá ser rescindido por qualquer uma das partes mediante aviso, por escrito, com antecedência de 30 (trinta) dias. O
                CONTRATANTE é obrigado ao pagamento dos serviços relativos ao período completo do mês em que solicitar o cancelamento, sendo que a
                CONTRATADA não prestara mais os serviços descrito neste contrato a partir da data do recebimento(por email ou por correio) da solicitação de
                cancelamento. Entretanto, fica estabelecida multa de 20% (vinte por cento) sobre o período restante em caso de rescisão imotivada, sem prejuízo
                do disposto nas condições gerais deste contrato.  </p>
            <p> Parágrafo primeiro: O efetivo cancelamento somente se realizara após a devida devolução do equipamento RASTREADOR para a Contratada,
                caso não seja devolvido pelo contratante o referido equipamento, continuara sendo cobrada as mensalidades até a efetiva devolução do
                equipamento Rastreador instalado em Comodato(tal mensalidade é devida até a data da efetiva devolução do Rastreador visto que a empresa
                contratada paga mensalmente o serviço de telemetria referente ao modulo interno de transmissão do equipamento , sendo tal serviço suspenso de
                cobrança apenas com a devolução do referido modulo de transmissão ao fabricante) </p>
            <p>10.3 O presente Contrato será encerrado após o transcurso do prazo previsto na Cláusula 10.1, desde que este não seja expressamente
                prorrogado mediante assinatura de termo próprio. A partir da data do encerramento, não surgirá qualquer direito ou obrigação para a
                CONTRATANTE e a CONTRATADA relativas a este Contrato(não existe renovação automática).  </p>

            <h3>  11. DO PACTO ADJETO DE PROMESSA DE COMPRA SOBRE DOCUMENTOS E DEMAIS AVENÇAS</h3>

            <p><b>11.1</b> CLÁUSULAS MANDATO – Com a assinatura do presente contrato o CONTRATANTE outorga à CONTRATADA poderes especiais para, em
                caso de roubo do veículo monitorado, proceder aos atos necessários junto às autoridades judiciais, policiais e administrativas competentes, bem
                como promover a contratação de outras empresas especializadas com o fim de tentar recuperar o bem. </p>

            <p><b>11.2</b> A cláusula 11.1 não ofende a qualquer princípio legal e, em especial não contraria o artigo 51, inciso VIII do
                Código de Defesa do Consumidor, uma vez que o presente mandato é instituído para a prática de atos favoráveis aos
                interesses do CONTRATANTE, pois visa auxiliá-lo no intento de otimizar as possibilidades de recuperação do bem. </p>
            <p> <b>11.3</b> O pacto adjeto de promessa de compra sobre documentos somente será válido se o evento ocorrer dentro da área de cobertura
                (TERRITÓRIO BRASILEIRO).</p>
            <p> <b>11.4</b> DA PROMESSA DE COMPRA SOBRE DOCUMENTOS DE VEÍCULO – ACONTRATADA compromete-se a
                comprar do CONTRATANTE os documentos do veículo monitorado caso o mesmo seja objeto de roubo e não
                seja recuperado em até 30 (trinta) dias contados da data do evento, ou mesmo que recuperado, se houver a
                perda total do veiculo (perda superior a 70% do valor do veiculo). A presente promessa se converterá em
                obrigação de compra somente se respeitados pelo CONTRATANTE os deveres contratuais atinentes ao
                pagamento, às avaliações, aos testes e, especialmente, á conservação e utilização do equipamento, sob pena
                de desobrigação da promessa de compra ora estabelecida, sendo que descumprimento de qualquer destas
                obrigações por parte do CONTRATANTE configura sua culpa e exonera a CONTRATADA do dever de dar
                cumprimento à promessa de compra sobre os documentos do veículo.  </p>
            <p><strong>Parágrafo primeiro: A contratada poderá a seu critério, dar em pagamento do compromisso
                    de compra e venda, um veiculo de mesmo modelo, ano de fabricação, valor e características  </strong> </p>
            <p>Parágrafo segundo: O pacto adjeto de compra sobre documentos descrito neste instrumento trata-se de
                garantia referente a prestação de serviços, equiparando-se a responsabilidade civil (artigo 927 do
                Código Civil Brasileiro) pela correta prestação do serviço de recuperação do bem, não sendo
                equivalente e não dispensando a contratação de seguros  </p>
            <p>Parágrafo terceiro: Tendo em vista que a recuperação do veiculo é inteiramente baseado no efetivo
                funcionamento do equipamento instalado (rastreador e bloqueador), e que é sabido que em caso de
                roubo, devido ao grande lapso de tempo existente entre a ocorrência do roubo e a comunicação do
                ocorrido acarreta a desmontagem do veiculo e efetivo desligamento do equipamento do rastreador feito
                pelos assaltantes, A INDENIZAÇÃO descrita neste contrato somente ocorrera única e exclusivamente
                em caso de ROUBO. 
            </p>
            <p> <strong>11.5 DA CONVERSÃO DA PROMESSA EM COMPROMISSO – No 30º (trigésimo) dia após o roubo, não se
                    verificando a recuperação do veículo e certificadas por cumpridas as obrigações do CONTRATANTE, o pacto
                    adjeto de promessa de compra sobre documentos converte-se em compromisso de compra e venda ou de
                    substituição do bem, vinculando CONTRATANTE e CONTRATADA que passam a ser vendedor e comprador,
                    respectivamente. 
                </strong></p>
            <p><b>11.6</b> DA OBRIGAÇÃO DE ENTREGA DOS DOCUMENTOS – Para possibilitar a venda sobre documentos do veículo ou substituição do bem, o
                CONTRATANTE, ora vendedor deverá entregar à CONTRATADA, ora compradora os seguintes documentos: </p>
            <p>a – A Comprovante de quitação das obrigações pecuniárias, bem como das demais obrigações com a CONTRATADA previstas no presente
                contrato;
            </p>
            <p>b – Boletim de Ocorrência e formulário de descrição do ato infracional ocorrido, preferencialmente escrito de próprio punho pelo
                CONTRATANTE ou usuário na data. </p>
            <p>c – Original do Certificado de Registro e Licenciamento do Veículo (CRLV) (“documento de porte obrigatório”); </p>
            <p>d – ORIGINAL do Documento Único de Transferência (“DUT”) assinado pelo CONTRATANTE ou proprietário do veículo, com firma reconhecida
                por verdadeira, transferindo a propriedade do veículo para a CONTRATADA ou para quem esta indicar; </p>
            <p>e – Na falta do DUT: original da Declaração de Extravio do DUT, endereçada ao órgão de trânsito competente [no caso do Estado de São Paulo, o
                DEPARTAMENTO ESTADUAL DE TRÂNSITO DE SÃO PAULO (“DETRANSP”)], com firma reconhecida por verdadeira, bem como procuração
                outorgada pelo proprietário do veículo à CONTRATADA, com poderes específicos para, em nome do outorgante, comparecer aos órgãos de
                trânsito ou a qualquer outra repartição Pública ou particular para regularizar a condição do veículo, com firma reconhecida, por verdadeira e
                cópia autenticada do RG, CPF/MF e comprovante de residência do CONTRATANTE ou proprietário do veículo;
            </p>
            <p>f - Demonstrativo de Débitos perante os órgãos de trânsito competentes até a data do ato criminal ocorrido(por meio da emissão de certidão oficial,
                sendo inaceitável a mera impressão de consulta pela internet), bem como Termo de Responsabilidade por Multas, com firma reconhecida; </p>

            <p>g – No caso de veículos adquiridos pela CONTRATANTE e/ou pelo proprietário por meio de financiamento é obrigatório, apresentar carne, e
                contrato de financiamento, quando não estiver quitado; </p>
            <p> h – Cópia do RG e CPF/MF e da CNH do CONTRATANTE e do condutor na data da elaboração do B.O </p>
            <p> i - IPVA referente ao exercício anterior, até a data da elaboração do boletim de ocorrência, sendo aceitável o "nada consta de débitos" desde que
                acompanhado de comprovante do exercício anual. 
            </p>
            <p> j- TERMO DE NÃO LOCALIZAÇÃO DO VEICULO emitido pela secretaria de segurança publica do estado. </p>

            <h3>12. DO PREÇO E DO PAGAMENTO – A CONTRATADA, ora compradora, pagará ao CONTRATANTE, ora
                vendedor, pelos documentos de sua motocicleta o preço de mercado ou substituirá o bem, sem qualquer
                benfeitoria ou acessório, tomando-se por base a tabela FIPE em avarias no ato da contratação e de acordo
                com a vistoria prévia, respeitando-se sempre o limite máximo de R$15.000,00 para motos. 
            </h3>

            <p><strong> PARAGRAFO ÚNICO- Havendo avarias no veiculo na data da contratação e/ou do roubo, estes serão devidamente descontados no ato do pagamento ao
                    contratante. </strong> </p>

            <p><b>12.1</b> Em caso de ROUBO, do valor mencionado na cláusula “12”, deverá ser descontado o valor das
                mensalidades referentes ao período faltante para conclusão de todo o contrato e o valor de compra do
                equipamento rastreador em comodato, conforme clausula 14.2 parágrafo primeiro.  </p>
            <p<b>12.2</b> Será descontado do valor a ser pago os valores referentes a taxa de transferência do veiculo e eventuais multas e débitos existentes
                referentes ao veiculo, sendo pago referido pacto de acordo com a forma estabelecida pela empresa. </p>
            <p> <b>12.3</b> No caso do valor do bem exceder o limite previsto na cláusula 12, a contratada fica desobrigada ao pagamento da diferença,
                reembolso ou compensação de qualquer espécie. O mesmo se aplica aos acessórios e outros equipamentos instalados no veículo. </p>

            <p> <b>12.4</b> - NO CASO DE VEÍCULO FINANCIADO OU ALIENADO, A CONTRATADA FARÁ A QUITAÇÃO DO BEM ATÉ O LIMITE PREVISTO NA
                CLÁUSULA 12. SE O VALOR PARA QUITAÇÃO DO FINANCIAMENTO DO VEÍCULO EXCEDER ESTE LIMITE, A CONTRATADA SOMENTE
                SE OBRIGA PELO CUMPRIMENTO DO COMPROMISSO DE COMPRA E VENDA SOBRE OS DOCUMENTOS OU SUBSTITUIÇÃO DO BEM
                CASO O CONTRATANTE SE RESPONSABILIZE PELO PAGAMENTO DA DIFERENÇA DO VALOR JUNTO À INSTITUIÇÃO FINANCEIRA,
                tendo em vista que a compra é efetuado sobre o documento do veículo, sendo necessário transferência de propriedade.</p>
            <p><b>12.5</b>. No caso do pacto adjeto de promessa de compra e venda sobre documento, a contratada pagara na forma e condições estabelecida
                pela mesma, podendo substituir o bem com iguais condições e características, observando-se o estado do bem descrito no termo de
                vistoria e avaliação prévia. </p>
            <p><b>12.6</b>. SE O VEÍCULO POSSUIR SEGURO CONTRA ROUBO, O CONTRATANTE DEVERÁ OPTAR EM RECEBER A INDENIZAÇÃO DA
                COMPANHIA DE SEGURO OU DA CONTRATADA, SOB PENA DE CARACTERIZAR FRAUDE, tendo em vista que o presente contrato de
                compromisso de venda e compra, previsto na cláusula 11.4, se dá sobre documento do veículo, ou seja, com transferência de
                propriedade do bem à contratada.  </p>
            <p><strong>PARAGRAFO ÚNICO – Caso o contratante opte por receber a indenização da empresa contratada, o contratante deverá transferir seus
                    direitos a indenização a ser paga pela companhia de seguros ao contratado, desta forma portanto, caberá ao contratante providenciar que
                    seja feita a sub-rogação dos direitos a indenização inerentes ao seguro perante a companhia de seguros em favor da contratada.  </strong> </p>
            <p><b>12.7</b> DO PRAZO PARA PAGAMENTO – O prazo para pagamento é de 30 (trinta) dias após a entrega de todos os
                documentos obrigatórios, os quais somente serão recebidos a partir do 30º (trigésimo) dia do roubo. Sem que haja a
                entrega de todos os documentos não se computará o presente prazo, o qual somente passará a correr quando da
                entrega efetiva de todos os documentos exigidos.  </p>
            <p><b>12.8</b> É dever de o contratante providenciar a imediata comunicação do roubo do veiculo para a empresa contratada, bem
                como a autoridade policial, elaborando o competente boletim de ocorrência (B.O.), bem como informar o COPOM (190) no
                momento do roubo. </p>
            <p>PARAGRAFO PRIMEIRO- Será considerado para todos os efeitos deste contrato (inclusive para pagamento de eventual
                indenização), a data da elaboração do boletim de ocorrência e comunicação a empresa contratada da ocorrência do roubo
                como sendo a data e hora do efetivo roubo.  </p>
            <p> PARAGRAFO SEGUNDO- Caso o contratante não comunique imediatamente (no primeiro momento possível) a ocorrência
                do roubo de seu veiculo a empresa contratada, acarretara na perda do direito a indenização. </p>
            <p> <b>13</b>. DO INDÍCIO DE FRAUDE - Havendo indícios de fraude, má-fé e dolo do CONTRATANTE na perda do veículo
                monitorado, ou verificado o descumprimento das demais condições deste Contrato, o pacto adjeto de promessa de
                compra sobre documentos não se converterá em compromisso de compra e venda, desobrigando a CONTRATADA da
                promessa e do conseqüente compromisso.  </p>
            <p><b>13.1</b> - Será considerada fraude para efeitos desse contrato a comunicação de roubo da motocicleta ou do veículo fora do local em que ocorreu o
                fato, devendo nesses casos o CONTRATANTE comunicar ou efetuar o Boletim de Ocorrência no Distrito Policial mais próximo do local do sinistro, </p>
            <p>Sob pena de invalidar o pacto adjeto de promessa de compra sobre documentos. Se houver indícios de inobservância dessa cláusula, a
                CONTRATADA adotará todas as providências no sentido de se apurar os fatos e onde efetivamente ocorreu o sinistro, podendo inclusive
                o CONTRATANTE responder criminalmente se comprovada a fraude. </p>
            <p><b>13.2</b> - As informações pessoais e do veiculo preenchidas pelo CONTRATANTE no momento da contratação deverão corresponder à
                verdade, sob pena de responder por falsa declaração e nulidade do pacto adjeto de promessa de compra sobre documentos. Na mesma
                pena ocorrerá ao CONTRATANTE que omitir ou ocultar informações necessárias e indispensáveis para análise de seu perfil pela
                CONTRATADA.  </p>
            <p>PARAGRAFO PRIMEIRO – Será solicitado informações sobre a vida pregressa criminal do contratante na capa deste instrumento, tal
                informação devera corresponder à verdade,sob pena de responder por falsa declaração e nulidade do pacto adjeto de promessa de
                compra sobre documentos( no ato da entrega dos documentos descrito na clausula 11.6 será feito o levantamento criminal do
                contratante, sendo constatado a ocorrência de processos criminais que não foram informados na capa deste instrumento, bem como
                crimes de estelionato, roubo, ou receptação, acarretara a perda do direito ao pacto adjeto de compra sobre documentos).  </p>
            <p>PARAGRAFO SEGUNDO - acarretara a perda do direito de indenização descrita neste contrato se o condutor do veiculo roubado não
                possuir habilitação para dirigir ou se sua habilitação estiver suspensa ou caçada(não haverá o pagamento da indenização descrita neste
                contrato nestes casos citados).
            </p> 
            <p> <b>13.3</b> - Caso seja apurado que o CONTRATANTE declarou informação falsa, omitiu fatos ou ocultou dados de sua pessoa esta atitude será
                considerada fraude e a CONTRATADA poderá declarar rescindido o pacto adjeto de promessa de compra sobre documentos em face do
                ocorrido. </p>
            <p><b>13.4</b> - Caso o contratante efetue a venda de seu veiculo para terceiros, devera comunicar imediatamente a contratada, sob pena de perder
                o direito a qualquer indenização descrita neste contrato.  </p>
            <p>Parágrafo primeiro: para que seja realizado a transferência de titularidade do contratante, devera o mesmo ser solicitado pelo contratante,
                efetuando-se o pagamento referente a transferência de titularidade e mediante a autorização da contratada( visto que serão verificados os
                cadastros de credito do novo contratante), caso não seja aceito pela contratada a transferência de titularidade, poderá o contratante
                optar pelo cancelamento do contrato (conforme clausulas 14 e seguintes) ou manter o contrato em sua titularidade. </p>

            <h3> 14. DISPOSIÇÕES GERAIS - RESCISÃO  </h3>
            <p><b>14.1</b> – Na hipótese de rescisão pelo CONTRATANTE, todas as parcelas pagas, seja pela habilitação do equipamento ou pela
                contratação do serviço, não serão restituídas pela CONTRATADA. No caso de existirem parcelas pendentes com relação à
                habilitação ou compra do equipamento, o CONTRATANTE deverá pagar à CONTRATADA.  </p>
            <p><b>14.2</b>– Na hipótese de rescisão pela CONTRATADA, o valor pago pelo CONTRATANTE com relação a compra do equipamento não
                será reembolsado pela CONTRATADA, tendo em vista que o equipamento já pago é de propriedade do contratante(devendo ser
                restituído a empresa o equipamento rastreador em comodato, ficando o bloqueador vendido com o cliente), (sendo que a retirada
                do referido equipamento devera ser feito no endereço da Contratada), tendo sido a compra do mesmo consumada e perfeita. Se
                houve pagamento antecipado de serviços (pagamento anual da taxa mensal de monitoramento), este será reembolsado de
                forma proporcional ao período restante do término do contrato.  </p>
            <p>Parágrafo primeiro: Caso o Contratante não devolva (até o prazo limite de 20 dias a partir do pedido de
                cancelamento/encerramento do contrato ou 45 dias de inadimplência) o equipamento Rastreador deixado em comodato pela
                PROTEGCAR do Brasil , esta cobrara o valor de venda do equipamento ao cliente, equivalente a R$3.500,00( dois mil e
                quinhentos reais) a titulo de compra do equipamento, alem do previsto na clausula 10.2 parágrafo primeiro.  </p>
            <p>Parágrafo Segundo: Na hipótese de rescisão pelo CONTRATANTE, este devera pagar a importância de 20% do valor total das
                mensalidades a titulo de quebra de contrato, valores estes que deverão cobrir os gastos da empresa com a referida rescisão
                (cancelamento de boletos, etc.)  </p>

            <p>Parágrafo terceiro: A contratada não aceitara a devolução do equipamento com avarias (em decorrência da retirada do
                equipamento pelo próprio contratante), bem como não aceitara a devolução do equipamento caso a contratada tenha impetrado
                ação judicial (após decurso dos prazos descritos nesta clausula) para reaver o valor referente a compra do equipamento descrito
                no parágrafo primeiro desta clausula, nestes casos, somente será aceito o valor requerente a compra do equipamento conforme já
                descrito. </p>
            <p> Parágrafo quarto: A não devolução do equipamento rastreador no prazo descrito nesta clausula(parágrafo primeiro) configurara a
                AQUISIÇÃO DO EQUIPAMENTO RASTREADOR por parte do contratante, desta forma, o Contratante autoriza que a contratada ,
                após o transcurso do prazo supra mencionado, EMITA BOLETO BANCARIO COM AVISO DE PROTESTO com o valor referente a
                compra do rastreador conforme parágrafo primeiro, sendo que o envio de tal boleto será feito feto diretamente no
                email informado pelo cliente na capa deste contrato ( a critério da contratada poderá ser encaminhado também por
                correio).</p>
            <p>Parágrafo quinto: Caso não haja a devolução voluntario do equipamento rastreador,conforme descrito no parágrafo primeiro desta
                clausula, e no parágrafo segundo(pagamento da multa contratual), A CONTRATADA FICA AUTORIZADA PELA CONTRATANTE
                A ENCAMINHAR BOLETO DE PAGAMENTO COM O VALOR INTEGRAL DESCRITO no montante de R$3.500,00 acrescido da
                multa contratual e das mensalidades até a data do pagamento referente a compra(encaminhara por email ou por correio), PARA
                PAGAMENTO EM ATÉ 15 DIAS, sob pena de protesto e ações judiciais para a recuperação do credito em favor da contratada.  </p>
            <p>Parágrafo sexto: todas as notificações serão feitas preferencialmente através do E-Mail informado pelo Contratante
                (descrito na capa deste contrato), considerando-se intimado da notificação após o envio da Notificação.  </p>
            <p>Parágrafo sétimo: O não pagamento do boleto descrito nesta clausula acarretara a execução dos valores não adimplidos , com
                base no artigo 585 inciso II do Código de Processo Civil Brasileiro 
            </p>
            <p> <b>14.3</b> O descumprimento de qualquer disposição deste Contrato pela CONTRATANTE autorizará a CONTRATADA a
                suspender imediatamente à prestação de serviço, independentemente de prévia comunicação, notificação ou
                interpelação judicial ou extrajudicial e sem que qualquer direito à indenização assista o CONTRATANTE.
            </p>
            <p><b>14.4</b> O CONTRATANTE declara estar devidamente instruído pela CONTRATADA quanto à forma e condições deste
                contrato, bem como declara que tomou conhecimento prévio do inteiro teor deste instrumento </p>
            <p><b>14.5</b> A solicitação de cancelamento do contrato somente será efetivada após a devolução do equipamento rastreador
                ou o pagamento do valor referente a compra do equipamento no montante de R$3.500,00 (conforme clausulas
                acima), desta forma, até que se efetive o cumprimento das obrigações descritas nesta clausula, serão cobradas
                mensalmente o valor da mensalidade descrita na capa do contrato, a titulo de locação do equipamento rastreador,
                conforme prescreve o artigo 582 do Código Civil Brasileiro 
            </p>

            <h3>15. DA PREFERÊNCIA DE COMPRA PELO CONTRATANTE EM CASO DE RECUPERAÇÃO DO BEM APÓS A VENDA
                SOBRE DOCUMENTO </h3>
            <p>- As partes ajustam que na hipótese da recuperação do veículo monitorado, dentro do período de 12 (doze)
                meses contados a partir do pagamento decorrente da venda sobre documentos, a CONTRATADA, na condição de nova
                proprietária do veículo, notificará, por escrito, o CONTRATANTE acerca da recuperação e da faculdade deste optar pela compra do
                bem em iguais condições que serão ofertadas aos terceiros.  </p>
            <p><b>15.1</b>. O contratante terá prazo de 10(dez) dias, a partir do recebimento da notificação, para manifestar interesse pela recompra do
                bem, caso contrário perderá o direito de preferência e a contratada poderá dispor livremente do veículo, sem necessidade de
                prestação de conta ao contratante. 
            </p>

            <h3>16. O SISTEMA DE SEGURANCA OPERADO PELA CONTRATADA NÃO É E NÃO EQUIVALE A UM CONTRATO DE
                SEGURO. PORTANTO, NÃO HÁ COBERTURA DE FURTO, INCÊNDIO, COLISÃO, ENCHENTE, NÃO SE ESTABELECE
                PRÊMIO E NÃO SE INDENIZA TERCEIROS. 
            </h3>

            <h3>17. Esclarecimento sobre a diferença entre furto e roubo: furto – subtração do bem sem o uso de violência ou
                grave ameaça, onde não há o contato com a vitima, já no roubo há o emprego de violência ou grave ameaça e
                é essencial a presença da vitima.  </h3>

            <h3> 18. DO PREÇO DA HABILITAÇÃO E DO MONITORAMENTO. DA FORMA DE PAGAMENTO. O valor da
                habilitação do sistema e o valor da mensalidade do monitoramento estão descrita no descritivo (capa do contrato), que faz
                parte integrante deste instrumento; a mensalidade aqui descrita devera ser paga mediante boleto bancário, sendo o
                primeiro 30 dias após a instalação do equipamento (pagamento referente ao período já utilizado), sendo que o
                CONTRATANTE recebe no ato da instalação do equipamento os primeiros 12(doze) boletos para pagamento mensal.</h3>

            <h3>DA RENOVAÇÃO CONTRATUAL  </h3>

            <p>19. As partes em comum acordo poderão fazer a renovação deste contrato por igual período (36 meses), devendo o
                CONTRATANTE entrar em contato com a empresa CONTRATADA no mês do vencimento de seu contrato para efetuar a
                renovação contratual, bem como pagamento de taxa de vistoria e outras taxas a serem acordadas pelas partes. 
            </p>
            <p>20. AS PARTES DECIDEM EM COMUM ACORDO que com a assinatura deste contrato fica rescindido quaisquer contratos
                anteriores referente a proteção do mesmo veiculo, desta forma, sendo revogado quaisquer contratos anteriores assinados
                referente a proteção do veiculo descrito neste contrato.  </p>
            <p>21. As partes elegem o Foro de São Paulo para dirimir quaisquer controvérsias oriundas do presente Contrato e por estarem assim
                justas e contratadas, as partes obrigam-se ao integral cumprimento do presente instrumento, assinando-o em 2 (duas) vias de igual
                teor e forma, na presença de duas testemunhas. 
            </p>
            
           

            <div style="float:left; width: 45%; margin-left: 4%; ">
____________________________________________________________________________</p>
<p> CONTRATANTE (assinatura igual cheque/documento)</p>
<p><?= $ver->getResult()[0]['cliente']; ?></p>
<p> 
    </div>
            
             <div style="float:left; width: 45%; margin-left: 4%; ">
  
____________________________________________________________________________ </p>
<p>Local e data </p>
<p>PROTEGE FACIL PROTEÇÃO E RECUPERAÇÃO DE VEICULOS LTDA</p>

    </div>
            
            </br></br>
            
    <div style="float:left; width: 45%; margin-left: 4%; ">        
    <br />
  Testemunhas: 1._________________________________
    </div>
  <div style="float:left; width: 45%; margin-left: 4%; ">   
  <br />
  Testemunhas: 2. _________________________________
  </div>

    </body>
</html>
