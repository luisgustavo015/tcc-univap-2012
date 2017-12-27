-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 05/10/2012 às 04h33min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `amigos`
--

CREATE TABLE IF NOT EXISTS `amigos` (
  `cod_cliente` int(4) NOT NULL,
  `cod_amigo` int(4) NOT NULL,
  `data` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `amigos`
--

INSERT INTO `amigos` (`cod_cliente`, `cod_amigo`, `data`) VALUES
(2, 8, '13/09/2012'),
(2, 9, '13/09/2012'),
(11, 2, '13/09/2012'),
(11, 1, '13/09/2012'),
(11, 9, '13/09/2012'),
(2, 9, '14/09/2012'),
(12, 1, '20/09/2012'),
(2, 7, '28/09/2012'),
(4, 2, '28/09/2012'),
(2, 4, '28/09/2012'),
(17, 1, '28/09/2012'),
(2, 17, '28/09/2012'),
(18, 1, '28/09/2012'),
(19, 1, '29/09/2012'),
(19, 1, '29/09/2012'),
(20, 2, '29/09/2012'),
(20, 1, '29/09/2012'),
(20, 9, '29/09/2012'),
(20, 19, '29/09/2012');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE IF NOT EXISTS `carrinho` (
  `cod_reserva` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `cod_produto` int(3) NOT NULL,
  `cod_cliente` int(3) NOT NULL,
  `data` varchar(10) NOT NULL,
  `quantidade` int(3) NOT NULL,
  PRIMARY KEY (`cod_reserva`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`cod_reserva`, `cod_produto`, `cod_cliente`, `data`, `quantidade`) VALUES
(1, 1, 2, '25/07/2012', 1),
(2, 1, 4, '06/08/2012', 1),
(3, 3, 2, '06/08/2012', 1),
(4, 2, 9, '25/08/2012', 3),
(5, 3, 2, '10/09/2012', 2),
(6, 2, 12, '20/09/2012', 1),
(7, 11, 16, '28/09/2012', 1),
(8, 2, 2, '28/09/2012', 2),
(9, 11, 4, '28/09/2012', 1),
(10, 9, 17, '28/09/2012', 1),
(11, 5, 18, '28/09/2012', 1),
(12, 5, 4, '29/09/2012', 1),
(13, 2, 20, '29/09/2012', 1),
(14, 2, 20, '29/09/2012', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `cod_cliente` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `data_nascimento` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `sexo` varchar(40) NOT NULL,
  `data_cadastro` varchar(10) NOT NULL,
  `nivel` int(1) NOT NULL DEFAULT '1',
  `ativo` int(1) NOT NULL DEFAULT '1',
  `foto` varchar(250) NOT NULL,
  `frasePerfil` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`cod_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `nome`, `data_nascimento`, `email`, `login`, `senha`, `sexo`, `data_cadastro`, `nivel`, `ativo`, `foto`, `frasePerfil`) VALUES
(1, 'Luis Gustavo Rangel', '11/05/1995', 'luisgustavo_015@hotmail.com', 'adm', 'adm', 'masculino', '', 2, 1, 'upload/User1.png', ''),
(2, 'Thiago Rangel', '21/02/2002', 'thi.rangel@hotmail.com', 'thiago', 'thiago123', '', '', 1, 1, 'upload/Lighthouse.jpg', 'Eu adoro games !!!'),
(4, 'João', '18/09/1996', 'joao@teste.com', 'joao', 'joao', 'masculino', '', 1, 1, 'upload/User1.png', 'h'),
(7, 'Gabriel', '28/07/1998', 'gabriel@teste.com', 'gabriel', 'gabriel123', 'masculino', '', 1, 1, 'upload/User1.png', ''),
(8, 'Rogerio', '00/00/0000', 'rogerio@teste.com', 'rogerio', 'rogerio123', '', '', 2, 1, 'upload/User1.png', ''),
(9, 'Sandro', '14/10/1994', 'sandro@teste.com', 'sandro', 'sandro123', 'masculino', '', 1, 1, 'upload/User1.png', ''),
(10, 'Adriano', '15/04/1994', 'adriano@teste.com', 'adriano', 'adriano123', 'masculino', '25/07/2012', 1, 1, 'upload/User1.png', ''),
(11, 'Alexandre Gonçalves Lemes', '28/02/1987', 'alexandre@hotmail.com', 'alexandre', 'alexandre123', 'masculino', '13/09/2012', 1, 1, 'upload/User1.png', 'HAHAHAHAHAHA ;D'),
(12, 'Sandro Luiz', '14/04//199', 'sandrin@hotmail.com', 'sandrin', 'sandrin', 'masculino', '20/09/2012', 1, 1, 'upload/1078capa_ps3.jpg', ''),
(15, 'João Verlene Bernardes junior', '01/03/1996', 'naoedasuaconta@hotmail.com', 'jbernardes', 'coco', 'masculino', '28/09/2012', 1, 1, 'upload/User1.png', ''),
(17, 'luciano', '03/10/2000', 'luciano_uivio@hotmail.com', 'lu123', '123456', 'masculino', '28/09/2012', 1, 1, 'upload/4277.jpg', 'yfcrvbd'),
(18, 'antonio', '25/01/1996', 'antonio.cavalcanti@hotmail.com', 'tonho', 'mslj0305', 'masculino', '28/09/2012', 1, 1, 'upload/User1.png', ''),
(19, 'Lucas Mancilha Leite', '11/07/1995', 'lukas.mancilha@hotmail.com', '@_LuuHMancilha', 'lukas2012', 'masculino', '29/09/2012', 1, 1, 'upload/User1.png', 'kdfunvk'),
(20, 'Igor Branco Ferreira', '15/10/1996', 'igor-pml@hotmail.com', 'negao_30cm', '123456', 'masculino', '29/09/2012', 1, 1, 'upload/Camiseta 13 anos branca.jpg', 'Eu nasci a 10 mil anos atrás ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `cod_noticia` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `cod_produto` int(3) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `data` varchar(10) NOT NULL,
  PRIMARY KEY (`cod_noticia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`cod_noticia`, `cod_produto`, `titulo`, `descricao`, `imagem`, `data`) VALUES
(12, 0, 'Call of Duty Elite é renovado para Black Ops II; vídeo do multi, bots e mais', 'O site oficial de "Call of Duty Elite", o programa que você pode assinar para receber os DLCs de Call of Duty e diversas exclusividades, foi renovado para a chegada de Black Ops II. Você pode conferir a lista de mudanças clicando aqui e o site oficial do programa, aqui. \r\n\r\nAlém disso, de acordo com o site Joystiq, para incentivar os jogadores que mais vêem "Kill Cams" do que o próprio jogo (ou seja, morrem o tempo todo), a Treyarch focou sua atenção no Combat Training, introduzindo o básico do multiplayer em um modo que o jogador pode jogar contra bots. \r\n\r\nNo Combat Training, você também pode ganhar XP e mesclar jogadores e bots. Mas só pode evoluir até o nível 10, até entender tudo que conseguir. Se ainda assim os jogadores não se sentirem confortáveis e partir para o online, eles podem continuar no Combat Training e jogar o modo "Objective" onde há competições de dois times de seis jogadores (3 humanos e 3 bots). Aqui eles podem evoluir acima do nível 10, mas só receberão metade do XP que receberia normalmente. \r\n\r\nPor fim, o "Bot Stomp" é uma experiência que não ganha XP e é onde seis jogadores humanos enfrentam seis bots em qualquer tipo de gameplay que desejarem. \r\n', 'noticias/6876.jpg', '28/09/2012'),
(13, 0, 'Revelado, Watch Dogs com legendas em português-Br', 'A notícia foi anunciada pelo diretor da Ubisoft Brasil, Bertand Chaverot. Segundo ele, as legendas e os menus estarão em nosso idioma, além disso, explica que a possibilidade de Watch Dogs chegar ao mercado com dublagem em Português não foi descartada, mas é precisa levar em conta alguns fatores externos para torná-lo viável. Para ele, as vozes serão traduzidas somente se os gastos no local sejam "amortecidos", e se isso não impede que o título chegue na mesma data que os Estados Unidos. \r\n\r\nE sobre o mistério da plataforma de lançamento, o diretor da Ubisoft não quis falar muito, se limita a dizer que o título tem "cheiro de nova geração".\r\n', 'noticias/Watch-Dogs.jpg', '28/09/2012'),
(14, 0, 'Phantasy Star Online 2 Novo Sistema de subclasse e a Ruins', 'A segunda apresentação do PSO2 na Tokyo Game Show 2012 mostrou a versão para smartphone do PSO2 chamada de Phantasy Star Online 2 es. Depois, finalmente foi mostrado algumas cenas da nova Fase e do novo Chefe. Este é um resumo de informações pegada dos sites 4Gamer e Shougai. \r\nA próxima Fase que está chegando no PSO2 é chamada de "??" de ruins, é uma fase no planeta Naberius e coberta por plantas. O Chefe desta Nova fase é o ??????? Zeshreida que se parece com uma estrela do mar só que do mal. Esta fase é repleta de darkers. \r\nEm seguida, eles mostraram o trailer do próximo update do jogo o "Call of Mortality", que será lançado em outubro. Esta é atualização é focada no sistema de subclasse. \r\nO novo sistema de subclasse permite que você utilize duas classes, ao mesmo tempo. Você poderá ser um Hunter/Force, Ranger/Hunter ou Fighter/Gunner. Você pode usar os poderes das subclasse como as " photon arts, technics, e skills mas há um porém. Você só pode usar as armas da sua classe principal. \r\n\r\nEntão, como um Hunter vai usar o weak bullet quando só os Assault Rifles podem usar essa habilidade? A uma falha no sistema de subclasse dependente das armas que podem ser equipadas por todas as classes. Por exemplo, se você é um Hunter/Ranger, você pode usar o weak bullet usando o Bouquet Rifle , então é só você mudar o tipo de arma do Hunter para atacar usando essa habilidade. \r\n\r\nTeremos um novo modo de dificuldade o Very Hard em outubro, nesta dificuldade, você poderá encontrar Chefes raros como King Vardha e o Rock Belt. Agora podem Esperar por armas superiores a 10 estrelas, Novas PAs e Technics, e novos eventos de interrupção.\r\n', 'noticias/yjyj.jpg', '28/09/2012'),
(15, 0, 'FIFA 13 vende 353.000 cópias nas primeiras 24 horas', 'A EA anunciou um dia da abertura o recorde do título FIFA Soccer 13. Em suas primeiras 24 horas de venda, 353 mil cópias de FIFA 13 foram vendidos para Xbox 360 e PlayStation 3 na América do Norte, marcando um aumento de 42% em relação ao FIFA 12. Mais de 1,4 milhões de jogos on-line foram disputadas no primeiro dia, 35% a mais que no ano passado. \r\nA versão do iPhone também viu números grandes dia de abertura, marcando "o maior desempenho em lançamento global de qualquer jogo iOS no iPhone, iPad e iPod touch na história da EA." As vendas de Fifa 13 subiram 62% no iOS, tornando-se o número um nos top jogos pagos em 55 países na App Store e o jogo de maior bilheteria em 24 países.\r\n"Estamos emocionados que os fãs da América do Norte adotaram FIFA Soccer 13 de maneira tão grande", disse o vice-presidente executivo da EA Sports Andrew Wilson. "Os norte-americanos apreciam um grande jogo e seu nível de envolvimento com o nosso jogo está ajudando a impulsionar a popularidade do esporte nos Estados Unidos." \r\n\r\nAté agora, FIFA 13 só foi lançado na América do Norte e vai lançar no resto do mundo amanhã. A EA já anunciou promissores números de pré-venda para FIFA 13, com 1,3 milhões de cópias pré-ordenadas em todo o mundo. Isso marca a continuação de um grande mês para a EA Sports, com 1,6 milhões de cópias de Madden 13 vendidos e recordes de vendas para NHL 13.', 'noticias/FIFA13_64213_screen.jpg', '28/09/2012'),
(16, 0, 'Need For Speed: Most Wanted PC - DX11 oferece um desempenho 300% melhor do que DX9', 'Boa notícia para todos os fãs de corrida de PC, parece que a Criterion irá otimizar ainda mais a versão PC do seu próximo jogo, Need For Speed: Most Wanted. Em uma entrevista interessante com games.on.net, Leanne Loombe da Criterion revelou que a versão para PC de Need For Speed: Most Wanted irá ostentar alguns recursos exclusivos gráficos e que o DX11 vai oferecer um desempenho 300% melhor do que DX9.\r\nLoombe também revelou as características que a Criterion tem implementado na versão PC de NFS: MW. A versão PC suportará oclusão de ambiente(AO) em tempo real, assim como os algoritmos de espalhamento de luz. \r\n\r\nAlém disso, NFS: MW PC contará com uma série de recursos avançados de gráficos, incluindo SSAO, espalhamento de luz, high dynamic range motion blur, texturas de alta resolução, modelos avançados de iluminação especular, projeção de sombra do farol, qualidade VFX aprimorada, e níveis de qualidade aprimorada de sombra. \r\n\r\nNeed For Speed: Most Wanted está planejado para 02 de novembro para PC, X360 e PS3!', 'noticias/nfsmwint2.jpg', '28/09/2012'),
(17, 0, 'Wii U Sai Por R$ 1.500 No Brasil', 'Quem espera adquirir o Nintendo Wii U em terras brasileiras antes do natal deste ano já pode comprar o novo console pelo preço inicial de R$ 1.350. Apesar de a Gaming do Brasil (distribuidora oficial da Nintendo no país) ainda não ter dito quanto será cobrado pelo aparelho, diversos vendedores de sites como o Mercado Livre já oferecem o novo produto. \r\n\r\nEnquanto o modelo básico está sendo comercializado pelos já citados R$ 1.350, a versão Deluxe, que acompanha o game Nintendo Land, sai por cerca de R$ 1.500. Os preços não chegam a ser exatamente surpreendentes quando se leva em conta o histórico da inflação que o valor cobrado por consoles sofre no Brasil. \r\n\r\nPara efeitos de comparação, quando o PlayStation 3 chegou às terras nacionais, empresas como as Lojas Americanas chegaram a cobrar R$ 7.980 pelo console. \r\n\r\nNos Estados Unidos, o preço era de US$ 600, aproximadamente R$ 1.200. Resta esperar pelo lançamento brasileiro oficial do Nintendo Wii U para conferir se a história vai se repetir ou se o preço do aparelho vai ser semelhante àquele praticado em terras estrangeiras.', 'noticias/Wii-U-001.jpg', '28/09/2012'),
(18, 0, 'Estudantes europeus competem para ganhar licença da nova Unreal Engine 4', 'A Epic Games anunciou a edição desse ano da competição Make Something Unreal. Nela, estudantes de toda a Europa devem enviar seus jogos criados com a Unreal Engine para serem avaliados pela companhia. O melhor de todos leva uma licença da nova Unreal Engine 4.\r\nO tema desse ano é “Herança Mendeliana: genética e genoma” e os participantes terão até o dia 2 de novembro para enviar as suas criações para a Epic. Mais informações podem ser encontradas no site oficial da competição.', 'noticias/content_pic.jpg', '04/10/2012'),
(19, 0, 'Borderlands 3 não está em desenvolvimento, diz fundador da Gearbox', 'O fundador da Gearbox Software  Randy Pitchford, veio a público (via Twitter) recentemente para dizer com todas as letras: Borderlands 3 ainda não está em desenvolvimento. Além disso, Pitchford pediu para que os espalhadores de rumores internet afora para se acalmarem.\r\n“Relaxe, internet. Ninguém trabalha atualmente em uma sequência para Borderlands 2  É divertido falar e pensar, mas os nossos esforços atuais estão focados nos DLCs de Borderlands 2, em Aliens etc.” Em outras palavras, todo o desenvolvimento relacionado à série “está relacionado a Borderlands 2”.\r\nNaturalmente, Pitchford reconhece que os planos podem se alterar em algum momento. “Eu espero que isso mude em determinado ponto, mas não se trata do status atual”. A ideia de que o próximo Borderlands poderia estar em desenvolvimento surgiu recentemente, quando o roteirista da franquia soltou que a Gearbox Software já começava a planejar uma sequência.', 'noticias/img_normal (1).jpg', '04/10/2012'),
(20, 0, 'Capcom instrui jogadores sobre como corrigir erro em Resident Evil 6', 'Resident Evil 6 só chega amanhã ao Brasil, mas seu lançamento mundial já está deixando muitos fãs de cabelo em pé. Não por causa dos sustos dados pelos monstrengos durante a jogatina, e sim pela série de defeitos e bugs que estão batendo de frente com a paciência dos fãs mais calmos.\r\nO problema é que alguns jogadores que adquiriram o game para o PlayStation 3 no período de pré-compra não estão conseguindo logar no jogo. Assim que o download termina, a tela é tomada por uma mensagem exibindo um “error 80029513”, que aponta para problemas ocorridos durante o download na PSN.\r\nA Capcom se manifestou ao site IGN, emitindo um comunicado oficial, no qual ela alega reconhecer os problemas que estão ocorrendo. No entanto, essas deficiências devem estar sendo enfrentadas somente por aqueles jogadores que adquiriram as primeiras versões disponibilizadas na PSN — assim que o jogo foi lançado. A desenvolvedora também alertou que essas mesmas pessoas ainda não conseguirão acessar o ResidentEvil.net.\r\nAgora, a empresa está trabalhando em conjunto com a Sony para entregar o quanto antes um patch de correção, para que o game possa funcionar de maneira adequada. De momento, a Capcom instrui aqueles que presenciaram a tela de erro para desinstalar e baixar novamente o jogo. Isso fará com que o título não faça o download de um determinado patch (o culpado pelo ocorrido) e que possa funcionar normalmente.', 'noticias/img_normal (2).jpg', '04/10/2012'),
(21, 0, 'Resident Evil 6: Capcom comenta escolha pelo caminho da ação e vontade dos fãs', 'Em entrevista ao PlayStation Blog, o produtor de Resident Evil 6, Hiroyuki Kobayashi, afirmou que a Capcom e os fãs da franquia são como os pais de uma criança. Da mesma forma como nem sempre é possível concordar sobre qual a melhor maneira de educar os filhos, os fãs e a empresa nem sempre acreditam que as mesmas decisões são as melhores para a série.\r\nKobayashi, no entanto, garante que a companhia está sempre averiguando o feedback de seus consumidores e tudo é sempre levado em consideração na hora da produção dos games. No entanto, a empresa tem a responsabilidade (e a pressão) de entregar novas experiências aos jogadores – algo que acaba gerando as discordâncias com o público.\r\nApelo para as massas\r\nAs declarações de Kobayashi seguiram-se a uma entrevista do produtor ao site 1UP na qual Kobayashi afirmou que, ao produzir Resident Evil 6, a Capcom tentou ser o mais inclusiva possível.\r\nSegundo o diretor, manter o clima de terror e tentar criar um jogo que seja inclusivo foi um grande desafio. “Incluir o tipo certo de ação para o game não quebrar o ritmo é o mais complicado. O que nós realmente queremos em Resident Evil 6 é um diagrama de Venn que inclua pessoas que gostem de horror e pessoas que gostem de video games e Resident Evil!, explicou.\r\nResident Evil 6 foi lançado na última terça-feira, dia 2, para PlayStation 3 e Xbox 360. Você poderá conferir a análise completa do game a partir desta quinta, aqui no Baixaki Jogos!', 'noticias/img_normal (3).jpg', '04/10/2012'),
(22, 0, 'Criadora de Minecraft tem o escritório mais estiloso da Suécia ', 'Se você não acha o seu ambiente de trabalho muito confortável ou tão atraente como deveria ser, que tal trabalhar para os desenvolvedores de Minecraft e passar o dia no escritório mais estiloso da Suécia?\r\nA Mojang Specifications teve algumas imagens do ambiente de trabalho que seus colaboradores compartilham divulgadas na internet e surpreendeu muita gente nos fóruns. Na galeria, você pode ver a “perfeita harmonia” entre uma mesa de sinuca e diversas peças de Lego tudo no mais alto estilo.\r\nApesar de mais parecer um bar bastante pomposo, o escritório da empresa chama atenção justamente por ser diferente do que se vê em toda parte, principalmente quando se fala no mundo dos games. E você? O que achou do local de trabalho dos criadores de Minecraft?', 'noticias/content_pic (1).jpg', '04/10/2012');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `cod_produto` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `preco_c` double NOT NULL,
  `preco_v` double NOT NULL,
  `descricao` text NOT NULL,
  `estoque` int(3) NOT NULL,
  `plataforma` varchar(25) NOT NULL,
  `imagem` varchar(500) NOT NULL,
  PRIMARY KEY (`cod_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`cod_produto`, `nome`, `preco_c`, `preco_v`, `descricao`, `estoque`, `plataforma`, `imagem`) VALUES
(2, 'Little Big Planet 2', 120, 160, 'jogo para crianças', 5, 'PS3', 'produtos/LBP2.jpg'),
(3, 'Battlefield 3', 120, 179.9, 'Jogo de tiro em primeira pessoa.', 8, 'XBOX360', 'produtos/battlefield3XBOX360.jpg'),
(4, 'Call of Duty MW 2', 100, 140, 'Jogo mt loko.', 2, 'XBOX360', 'produtos/250px-Modern_Warfare_2_cover.PNG'),
(5, 'The Elder Scrolls V Skyrim', 100, 200, 'Melhor RPG de Todos!!', 2, 'PS3', 'produtos/1078capa_ps3.jpg'),
(6, 'Max Payne 3', 50, 100, 'bom', 4, 'PC', 'produtos/51bLDO97AXL._AA300_.jpg'),
(7, 'Call of Duty 4 Modern Warfare', 40, 80, '+-', 6, 'XBOX360', 'produtos/Capa_Call_Of_Duty_Modern_Warfare_Xbox360__37150_zoom.jpg'),
(8, 'GTA IV', 10, 140, 'sdbisibi', 3, 'PS3', 'produtos/600full-grand-theft-auto-iv-cover.jpg'),
(9, 'God Of War 3', 1, 10, 'bbwbbb', 1, 'PS3', 'produtos/20100905182531!God_of_War_III_Capa.jpg'),
(11, 'Call of Duty: Modern Warfare 3', 120, 160, 'Jogo de guerra em 1ª Pessoa', 5, 'PC', 'produtos/CODMW3.jpg'),
(12, 'Darksiders', 80, 100, 'Nenhuma', 4, 'PS3', 'produtos/Darksidera.jpg'),
(13, 'Fórmula 1 2011', 50, 100, 'Simulador de Fórmula 1.', 3, 'PS3', 'produtos/F1 2011.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
