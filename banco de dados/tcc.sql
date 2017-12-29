-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Dez-2017 às 19:46
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `amigos`
--

CREATE TABLE `amigos` (
  `cod_cliente` int(4) NOT NULL,
  `cod_amigo` int(4) NOT NULL,
  `data` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `amigos`
--

INSERT INTO `amigos` (`cod_cliente`, `cod_amigo`, `data`) VALUES
(22, 21, '29/12/2017'),
(22, 25, '29/12/2017');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `cod_reserva` int(3) UNSIGNED NOT NULL,
  `cod_produto` int(3) NOT NULL,
  `cod_cliente` int(3) NOT NULL,
  `data` varchar(10) NOT NULL,
  `quantidade` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `cliente` (
  `cod_cliente` int(3) UNSIGNED NOT NULL,
  `nome` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_nascimento` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_cadastro` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nivel` int(1) NOT NULL DEFAULT '1',
  `ativo` int(1) NOT NULL DEFAULT '1',
  `foto` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `frasePerfil` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `nome`, `data_nascimento`, `email`, `login`, `senha`, `sexo`, `data_cadastro`, `nivel`, `ativo`, `foto`, `frasePerfil`) VALUES
(21, 'Luis Gustavo', '11/05/1995', 'adm@adm.com', 'adm', 'adm', 'masculino', '29/12/2017', 2, 1, 'upload/User1.png', ''),
(22, 'joao abreu', '25/06/1988', 'joao@teste.com', 'joao', 'joao', 'masculino', '29/12/2017', 1, 1, 'upload/User1.png', ''),
(23, 'Carlos Andrade', '10/04/1985', 'carlos@teste.com', 'carlos', 'carlos', 'masculino', '29/12/2017', 1, 1, 'upload/User1.png', ''),
(24, 'JoÃ£o Fernandes', '14/07/1991', 'fernandes@teste.com', 'fernandes', 'fernandes', 'masculino', '29/12/2017', 1, 1, 'upload/User1.png', ''),
(25, 'MÃ¡rcio Santos', '18/11/1974', 'marcio@teste.com', 'marcio', 'marcio', 'masculino', '29/12/2017', 1, 1, 'upload/User1.png', ''),
(26, 'Rubens Junior', '15/04/1994', 'rubens@teste.com', 'rubens', 'rubens', 'masculino', '29/12/2017', 1, 1, 'upload/User1.png', ''),
(27, 'AntÃ´nio Nascimento', '26/08/1998', 'antonio@teste.com', 'antonio', 'antonio', 'masculino', '29/12/2017', 1, 1, 'upload/User1.png', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `cod_noticia` int(3) UNSIGNED NOT NULL,
  `cod_produto` int(3) NOT NULL,
  `titulo` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`cod_noticia`, `cod_produto`, `titulo`, `descricao`, `imagem`, `data`) VALUES
(23, 999, 'Fim de uma era: serviÃ§os online de Gran Turismo 6 serÃ£o desativados em 2018', '\r\n\r\nSem dÃºvidas, Gran Turismo 6 foi um dos grandes games de PlayStation 3 â€“ e ainda Ã© para muitos que estÃ£o na geraÃ§Ã£o passada. Portanto, temos uma mÃ¡ notÃ­cia para vocÃª: os serviÃ§os online do jogo serÃ£o desativados em 2018 (mais precisamente no dia 28 de marÃ§o de 2018).\r\n\r\nMas o que isso significa exatamente? Na verdade, sÃ£o um compilado de elementos que serÃ£o desativados, com alguns menos importantes e outros essenciais para a diversÃ£o. Confira abaixo a lista de coisas que deixarÃ£o de funcionar no game:\r\n\r\n    Comunidade\r\n    Lobby aberto\r\n    Partida rÃ¡pida\r\n    Eventos sazonais\r\n\r\nA equipe reforÃ§a tambÃ©m para que os jogadores peÃ§am o reembolso dos crÃ©ditos in-game ou que os instalem novamente (caso tenham deletado). Caso os usuÃ¡rios nÃ£o faÃ§am isso atÃ© o dia 28 de marÃ§o, nÃ£o serÃ¡ possÃ­vel recuperar esses crÃ©ditos. AlÃ©m disso, o app de editor de pistas para Android e iOS tambÃ©m serÃ¡ desativado na data. PorÃ©m, todo o conteÃºdo offline de Gran Turismo 6 continuarÃ¡ funcionando normalmente, como Ã© esperado.\r\n', 'noticias/28142934287002.jpg', '29/12/2017'),
(24, 999, 'Double Dragon IV estÃ¡ disponÃ­vel a partir de hoje para Android e iOS', 'Double Dragon em 8 bits parece ser algo que foi lanÃ§ado hÃ¡ dÃ©cadas, mas nÃ£o Ã© exatamente esse o caso. Assim como a Capcom fez com Mega Man 9 e 10 no Wii, a Arc System Works lanÃ§ou em pleno 2017 Double Dragon IV, com visuais bem retrÃ´, para o PS4, PC e Switch. Agora, ele chega ao mobile tambÃ©m.', 'noticias/28130036769049.jpg', '29/12/2017'),
(25, 999, 'Desenvolvedores da Sony japonesa prometem projetos e games novos para 2018', 'Apesar de a Sony ser uma empresa bem globalizada nos dias de hoje, o setor japonÃªs nÃ£o sÃ³ continua firme e forte como tambÃ©m Ã© um dos principais da empresa. Por isso Ã© bem interessante saber que os desenvolvedores da Terra do Sol Nascente estÃ£o com planos interessantes para 2018.\r\n\r\nDurante uma entrevista ao site japonÃªs 4Gamer, diversos produtores comentaram quais sÃ£o os planos para o ano que vem. Por exemplo: Teruyuki Toriyama, produtor de Bloodborne e de No Heroes Allowed! VR, disse que estÃ¡ interessado em embarcar em novos desafios e que revelarÃ¡ um jogo ambicioso e o comeÃ§o de um projeto que estarÃ¡ na fase conceitual. Toriyama esteve trabalhando atrÃ¡s das cortinas depois de Bloodborne e os resultados serÃ£o revelados no ano que vem.', 'noticias/28122738475041.jpg', '29/12/2017'),
(26, 999, 'Framboesa de Ouro: confira os piores jogos de 2017', 'Sem dÃºvidas, 2017 teve uma lista enorme de jogos maravilhosos (a seleÃ§Ã£o dos indicados ao Game of the Year que o diga).  PorÃ©m, isso tambÃ©m nÃ£o quer dizer que o universo sÃ£o apenas flores. O que teve de coisa boa, teve de coisa ruim tambÃ©m. Claro, o saldo final foi bem positivo, mas tivemos alguns games bem abaixo do esperado nesse perÃ­odo.\r\n\r\nPor conta disso, vamos fazer essa lista para relembrar quais foram os fracassos, decepÃ§Ãµes e games abaixo da mÃ©dia de 2017. Nem todos sÃ£o necessariamente aquela bomba que vocÃª espera, mas, certamente, nÃ£o atenderam Ã s expectativas de uma maneira satisfatÃ³ria. EntÃ£o vem com a gente conferir a lista!', 'noticias/28200556009014.jpg', '29/12/2017'),
(27, 999, 'SerÃ¡? Red Dead Redemption 2 ganha data de lanÃ§amento em loja dinamarquesa', 'Um dos jogos mais aguardados de 2018 Ã©, sem dÃºvidas, Red Dead Redemption 2. Depois de ter sido adiado para a primavera do ano que vem, muitos se perguntam: quando ele sai exatamente? NÃ£o sabemos, mas uma loja dinamarquesa pode saber e ter vazado sem querer.\r\n\r\nSegundo a pÃ¡gina do produto na loja, Red Dead Redemption 2 sairia no dia 8 de junho de 2018, uma sexta-feira. A data estÃ¡ dentro da janela de tempo estipulada e cairia numa sexta-feira, um dia que, ao lado das terÃ§as, Ã© comum para lanÃ§amentos.', 'noticias/29123112294006.jpg', '29/12/2017'),
(28, 999, 'Produtor da sÃ©rie Yakuza diz que teremos surpresas e novos jogos em 2018', 'Com o caminhar das notÃ­cias desse fim de ano, parece que 2018 nÃ£o serÃ¡ nada fraco. Agora, o produtor executivo da sÃ©rie Yakuza e o chefe criativo da Sega, Toshihiro Nagoshi, disse em uma entrevista recente ao site japonÃªs 4Gamer que 2018 trarÃ¡ surpresas e anÃºncios. O que serÃ¡ vem que por aÃ­?\r\n\r\nSegundo o executivo, o time estarÃ¡ muito focado em produzir e entregar os games jÃ¡ anunciados, como Hokuto Ga Gotoku (de Fist of the North Star) e provavelmente o novo Yakuza, que jÃ¡ teve alguns detalhes confirmados. PorÃ©m, hÃ¡ novidades vindo tambÃ©m. De acordo com Nagoshi, hÃ¡ coisas novas no forno, mas a empresa nÃ£o sabe bem qual Ã© a melhor hora de revelÃ¡-las em 2018. Vale ressaltar: o que quer que possa ser revelado nÃ£o necessariamente tem relaÃ§Ã£o com a sÃ©rie Yakuza.', 'noticias/29150645710049.jpg', '29/12/2017'),
(29, 999, 'CyberConnect2, dev de Naruto e jogos de anime, revelarÃ¡ novos games em 2018', 'VocÃª jÃ¡ deve ter ouvido falar da CyberConnect2, principalmente se for fÃ£ de animes. AlÃ©m de jÃ¡ ter trabalhado em vÃ¡rios jogos de Naruto, a desenvolvedora jÃ¡ mexeu com JoJo, .hack e atÃ© games originais, como Asuraâ€™s Wrath. Agora, o presidente da companhia, Hiroshi Matsuyama, disse que revelarÃ¡ algo novo em fevereiro de 2018.\r\n\r\nSegundo o presidente, a revelaÃ§Ã£o vai ocorrer no dia 1 de fevereiro, o que deixa a novidade ainda mais prÃ³xima. Trata-se de um evento da desenvolvedora que mostrarÃ¡ alguns planos para o futuro da empresa que, como vocÃªs devem imaginar, tambÃ©m envolve novos jogos.', 'noticias/29125348813028.jpg', '29/12/2017'),
(30, 999, 'Dynasty Warriors 9 revela diversos personagens e ganha muitos gameplays', 'Apesar de ter ficado sem muitos detalhes (e atÃ© sem data) durante um bom tempo, Dynasty Warriors 9 finalmente ganhou diversos novos detalhes. AlÃ©m de revelar muitos personagens de uma sÃ³ vez, a Koei Tecmo, produtora do tÃ­tulo, tambÃ©m soltou muitos gameplays.\r\n\r\nNas imagens abaixo, vocÃª confere imagens Yue Jin, Lianshi, Guan Xing, Fa Zheng, e Zhong Hui. AlÃ©m disso, Ã© possÃ­vel ver detalhes da jogabilidade de cada um deles logo em seguida, trazendo a porradaria clÃ¡ssica que conhecemos da franquia. Confira:', 'noticias/28144849674014.jpg', '29/12/2017'),
(31, 999, 'Gran Turismo Sport receberÃ¡ updates no futuro para trazer chuva Ã s pistas', 'Atualmente, apenas uma pista de Gran Turismo Sport tem suporte ao clima chuvoso: Northern Isle Speedway (que nem Ã© uma chuva propriamente dita). Considerando que os principais concorrentes, Project Cars 2 e Forza Motorsport 7, tÃªm um excelente sistema de chuva (que Ã© dinÃ¢mico), o jogo da Sony ficou para trÃ¡s. PorÃ©m, parece que a desenvolvedora estÃ¡ ciente disso e quer corrigir o problema.\r\n\r\nSegundo Kazunori Yamauchi, criador da sÃ©rie, todos os carros do game foram produzidos para funcionarem com mecÃ¢nicas de FÃ­sica de chuva (incluindo animaÃ§Ãµes para limpar os para-brisa) e que mais pistas terÃ£o suporte no futuro. Os dados foram revelados durante uma entrevista ao site GT Planet.', 'noticias/28164858109047.jpg', '29/12/2017');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `cod_produto` int(3) UNSIGNED NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `preco_c` double NOT NULL,
  `preco_v` double NOT NULL,
  `descricao` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estoque` int(3) NOT NULL,
  `plataforma` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`cod_produto`, `nome`, `preco_c`, `preco_v`, `descricao`, `estoque`, `plataforma`, `imagem`) VALUES
(14, 'Adidas miCoach', 80, 100, 'Quer ficar mais rÃ¡pido, mais forte e melhor que os demais? Deixe que o miCoach reÃºna seus dados durante treinos ou competiÃ§Ãµes, identifique seu potencial e o estenda por meio de programas ideais para aumentar sua velocidade, resistÃªncia e forÃ§a.', 2, 'PS3', 'produtos/8758_1_20141019115026.jpg'),
(15, 'Assassins Creed 2 (II)', 60, 94.9, 'VocÃª assume o papel de Ezio Auditore Di Firenzi, um nobre, agora assassino, que busca vinganÃ§a pela morte de sua famÃ­lia.', 1, 'PS3', 'produtos/1263_1_20140217152031.jpg'),
(16, 'Batman: Arkham City Game of the Year Edition', 89.9, 115, 'Batman Arkham City Ã© o sucessor do cÃ©lebre Batman Arkham Asylum. Em vez de concentrar a experiÃªncia de jogo dentro dos muros do clÃ¡ssico asilo de super-vilÃµes, Arkham City toma como palco uma ampla Ã¡rea de Gotham City.', 3, 'PS3', 'produtos/4561_1_20120923221401.jpg'),
(17, 'Bodycount', 49.9, 89.9, 'Bodycount Ã© um FPS (jogo de tiro em perspectiva de primeira pessoa) que coloca os jogadores em uma legÃ­tima confusÃ£o de tiroteios e explosÃµes em cenÃ¡rios destrutÃ­veis. Pois Ã©: nÃ£o procure cobertura de fogo atrÃ¡s de objetos que podem ser facilmente destroÃ§ados por disparos nervosos dos seus oponentes.', 2, 'PS3', 'produtos/6774_1_20130830010432.jpg'),
(18, 'Brink', 69.9, 99.9, 'O jogo Ã© ambientado em Ark, uma cidade flutuante erguida pelo homem que estÃ¡ Ã  beira de uma guerra civil. Originalmente construÃ­da como um experimento, auto-suficiente e 100% "verde", devido ao aquecimento global, o aumento no volume dos oceanos da Terra transformou Ark em moradia, nÃ£o apenas de seus fundadores e seus descendentes, mas tambÃ©m para milhares de refugiados. ', 5, 'PS3', 'produtos/2684_1.jpg'),
(19, 'Call of Duty Modern Warfare Trilogy', 120, 169.9, 'Prepare-se para uma das melhores sÃ©ries de FPS\'s dos Ãºltimos anos. \r\nEsse pacote inclui todos os jogos da trilogia Modern Warfare.', 2, 'PS3', 'produtos/12687_1_20170211132334.jpg'),
(20, 'Crysis 3', 89.9, 129.9, 'Famosa por seus incrÃ­veis grÃ¡ficos, a sÃ©rie Crysis chega ao seu terceiro capÃ­tulo com um visual ainda mais impressionante. No entanto, a Crytek decidiu apostar suas fichas em um enredo e mostrar que a franquia Ã© muito mais do que um rostinho bonito.\r\n\r\nO grande destaque do novo jogo estÃ¡ exatamente na ambientaÃ§Ã£o dada, combinando o que hÃ¡ de melhor no cenÃ¡rio de seus antecessores. Com isso, temos uma cidade de Nova York totalmente abandonada e tomada pela vegetaÃ§Ã£o, o que faz com que floresta e Ã¡reas urbanas se tornem uma coisa sÃ³.\r\n\r\nAlÃ©m disso, Crysis 3 serÃ¡ focado na sobrevivÃªncia e em como a caÃ§a pode se tornar o caÃ§ador. Isso porque o personagem principal serÃ¡ o alvo tanto da raÃ§a alienÃ­gena Ceph quanto dos soldados da CELL, que tentarÃ£o prendÃª-lo para obter a icÃ´nica nanosuit.', 3, 'PS3', 'produtos/5503_1_20140209010636.jpg'),
(21, 'Dead or Alive 5 Ultimate', 59.9, 94.9, 'Os fÃ£s de Dead or Alive irÃ£o Ã  loucura com essa nova versÃ£o do game! A principal novidade de Dead or Alive 5 Ultimate sÃ£o os novos personagens: Ein, Leon, Momiji, Rachel (ambas de Ninja Gaiden) e Jacky Bryant (de Virtua Fighter). AlÃ©m de novos lutadores, tambÃ©m terÃ£o novas fases (ou cenÃ¡rios) para os fÃ£s delirarem!\r\n\r\nNÃ£o Ã© sÃ³ a questÃ£o de personagens ou fases que foi alterada, tambÃ©m foram adicionadas novas mecÃ¢nicas ao jogo, como, por exemplo, o Power Launcher, que faz com que o oponente seja lanÃ§ado bem alto, melhorando a possibilidade de criar um combo para derrotÃ¡-lo. Jogue online e mostre que vocÃª consegue ser o melhor de todos.\r\n', 1, 'PS3', 'produtos/6901_1_20130922040950.jpg'),
(22, 'Dead Rising 2', 59.9, 79.9, 'VÃ¡rios anos se passaram desde a terrÃ­vel invasÃ£o de zumbis em Wilamette, e essa ediÃ§Ã£o da sÃ©rie troca a aÃ§Ã£o do cotidiano do centro-oeste americano para o glamour da Fortune City, o maior e mais recente local de entretenimento e apostas dos EUA. \r\n\r\nAs pessoas vÃªm do mundo todo para Fortune City para fugir da realidade, com a possibilidade de ganhar muito dinheiro. Chuck Greene, ex-campeÃ£o de motocross, assim como milhÃµes de americanos, estÃ¡ atraÃ­do pelo programa sensaÃ§Ã£o de TV â€œTerror is Realityâ€. \r\n\r\nApresentado pelo exagerado Tyrone King, o show reÃºne pessoas comuns em uma arena cheia de zumbis com um desafio simples: matar mais zumbis que seu adversÃ¡rio e permanecer vivo, sendo que o vencedor ganha uma bolada e a chance de voltar e garantir prÃªmios ainda maiores. \r\n\r\nO que levou Chuck a arriscar sua vida em Fortune City nesta disputa de gladiadores dos dias atuais? SerÃ¡ que ele tem algum motivo para odiar os zumbis ou estÃ¡ na briga sÃ³ por dinheiro?', 2, 'PS3', 'produtos/1653_1.jpg'),
(23, 'Assassins Creed Rogue', 79.9, 109.9, 'Assassin\'s Creed Rogue se passa durante a Guerra dos Sete Anos, em 1751.\r\n\r\nDesta vez vocÃª nÃ£o jogarÃ¡ com um assassino, mas sim com o lado oposto da histÃ³ria: um templÃ¡rio buscando vinganÃ§a.\r\n\r\nVocÃª estarÃ¡ na pele de Shay Patrick Cormac, um homem que deixou a ordem dos Assassinos apÃ³s uma missÃ£o que deu terrivelmente errado, sendo traÃ­do pelos membros da ordem que chamava de irmÃ£os. Ã‰ entÃ£o que ele se torna um caÃ§ador de assassinos, o mais temido da histÃ³ria.\r\n\r\nA histÃ³ria\r\n\r\nAmÃ©rica do Norte, sÃ©culo XVIII No caos e violÃªncia da Guerra Franco-IndÃ­gena, Shay Patrick Cormac, um jovem destemido e membro da Ordem dos Assassinos, sofre uma sombria transformaÃ§Ã£o que irÃ¡ mudar para sempre o futuro das colÃ´nias. ApÃ³s uma perigosa missÃ£o terminar de maneira trÃ¡gica, Shay abandona os Assassinos que, em resposta, tentam tirar sua vida. Banido por aqueles que um dia chamou de irmÃ£os, Shay inicia uma missÃ£o para destruir todos aqueles que o traÃ­ram e tornar-se, enfim, o mais temido caÃ§ador de Assassinos da histÃ³ria.\r\n\r\nApresentando Assassinâ€™s CreedÂ® Rogue, o capÃ­tulo mais sombrio da franquia Assassinâ€™s CreedÂ® jÃ¡ produzido. No papel de Shay, vocÃª irÃ¡ viver a lenta transformaÃ§Ã£o de Assassino a caÃ§ador de Assassinos. Siga sua prÃ³pria convicÃ§Ã£o e parta para uma jornada extraordinÃ¡ria pela cidade de Nova Iorque, pelo vale do Rio Selvagem, atÃ© as Ã¡guas geladas do AtlÃ¢ntico Norte, em busca do seu objetivo final: destruir os Assassinos.\r\n\r\nViva o universo de Assassinâ€™s Creed pela perspectiva de um TemplÃ¡rio. Jogue como Shay que, alÃ©m de suas habilidades mortais de Mestre Assassino, tambÃ©m possui habilidades e armas nunca vistas antes.\r\n\r\nUse o mortal rifle de pressÃ£o de Shay, tanto para combate em curtas quanto longas distÃ¢ncias. Distraia, elimine ou confunda inimigos usando uma variedade de muniÃ§Ãµes, incluindo granadas especializadas.\r\nProteja-se de Assassinos escondidos com sua VisÃ£o Aquilina aprimorada. Use a VisÃ£o Aquilina para monitorar constantemente os arredores e detecte Assassinos, escondidos nas sombras, nos telhados ou em meio Ã  multidÃ£o.\r\n\r\nTestemunhe a transformaÃ§Ã£o de Shay, de um Assassino aventureiro para um sinistro e fiel TemplÃ¡rio, disposto a eliminar seus antigos aliados. Acompanhe, em primeira mÃ£o, os eventos que levarÃ£o Shay a um caminho sombrio, em circunstÃ¢ncias que mudarÃ£o para sempre o destino da Ordem dos Assassinos.\r\n\r\nEmbarque no seu navio, o Morrigan, e lute em seu curso pelos mares congelantes do AtlÃ¢ntico Norte e pelas Ã¡guas rasas dos vales dos rios da AmÃ©rica do Norte. Assassinâ€™s Creed Rogue acrescenta elementos novos Ã  experiÃªncia naval premiada de Assassinâ€™s CreedÂ® IV Black Flagâ„¢, incluindo:\r\n\r\n- Novas tÃ¡ticas inimigas. Defenda-se de Assassinos que tentam embarcar no seu navio e derrotar sua tripulaÃ§Ã£o. Expulse-os rapidamente para nÃ£o perder muitos membros da tripulaÃ§Ã£o.\r\n\r\n- Novas armas, como Ã³leo inflamÃ¡vel, que deixa um rastro de fogo que queima navios inimigos, e a metralhadora Puckle, capaz de disparar continuamente.\r\n\r\n- Um mundo Ã¡rtico cheio de possibilidades. Quebre camadas de gelo com seu navio para descobrir locais escondidos e use icebergs como cobertura durante batalhas navais.\r\n\r\nA histÃ³ria de Shay permite que vocÃª explore trÃªs ambientes Ãºnicos.\r\n\r\n- Norte do Oceano AtlÃ¢ntico: Experimente os ventos gelados e os enormes icebergs do Ãrtico neste grande parque naval.\r\n\r\n- Vale dos Rios: Um cenÃ¡rio vasto e hÃ­brido da fronteira americana, que mistura rios perfeitos para navegaÃ§Ã£o e exploraÃ§Ã£o em terra firme.\r\n\r\n- Cidade de Nova Iorque: Uma das cidades mais famosas do mundo, totalmente recriada como era no sÃ©culo XVIII.', 4, 'XBOX360', 'produtos/8452_1_20170802204625.jpg'),
(24, 'Battlefield 4', 69.9, 119.9, 'Battlefield 4 Ã© o enorme sucesso dos jogos de aÃ§Ã£o que definiu um gÃªnero, feito dos momentos que se equilibram entre o jogo e a glÃ³ria. Momentos esses sÃ³ encontrados em Battlefield. Com a ajuda da potÃªncia e fidelidade da prÃ³xima geraÃ§Ã£o do Frostbite 3, o Battlefield 4 proporciona uma experiÃªncia dramÃ¡tica e visceral como nenhuma outra.\r\n\r\nApenas em Battlefield vocÃª irÃ¡ explodir as fundaÃ§Ãµes de uma represa ou reduzir um arranhacÃ©u a escombros. Apenas em Battlefield vocÃª vai liderar um ataque naval na traseira de uma lancha de combate. Battlefield dÃ¡ a vocÃª a liberdade de fazer e ser muito mais enquanto joga com o mÃ¡ximo de intensidade e trilha o seu prÃ³prio caminho para a vitÃ³ria.\r\n\r\nAlÃ©m do seu multiplayer inconfundÃ­vel, Battlefield 4 apresenta uma campanha intensa e dramÃ¡tica focada nos personagens, que tem inÃ­cio com a evacuaÃ§Ã£o de cidadÃ£os norteamericanos importantes de Xangai e acompanha a luta de sua equipe para voltar para casa.\r\n\r\nNÃ£o hÃ¡ comparaÃ§Ãµes. Mergulhe no caos glorioso de uma guerra declarada, sÃ³ encontrada em Battlefield.\r\n\r\n- Requer HD para jogar. ', 2, 'XBOX360', 'produtos/7015_1_20140709002035.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`cod_reserva`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indexes for table `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`cod_noticia`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`cod_produto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `cod_reserva` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `noticia`
--
ALTER TABLE `noticia`
  MODIFY `cod_noticia` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `cod_produto` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
