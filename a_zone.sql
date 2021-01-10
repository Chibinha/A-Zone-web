-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 10, 2021 at 03:10 AM
-- Server version: 5.7.26
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a+zone`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL),
('worker', '2', NULL),
('worker', '3', NULL),
('worker', '4', 1610212211),
('worker', '5', 1610212143);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Can access every part and feature of the application. This includes frontend, backend and user management.', NULL, NULL, NULL, NULL),
('worker', 1, 'The worker is granted access to the backend but not the user management.', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `description`, `parent_id`) VALUES
(1, 'Informática', NULL),
(2, 'Desktops', 1),
(3, 'Componentes', 1),
(4, 'Portateis', 1),
(6, 'Ferramentas', NULL),
(7, 'Mobiliário de Escritório', NULL),
(8, 'Cadeiras', 7),
(9, 'Secretárias', 7),
(10, 'Sistemas e Dispositivos de Audio', NULL),
(11, 'Colunas Portáteis', 10),
(12, 'Auscultadores', 10),
(13, 'Sistemas de som', 10);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1578415511),
('m130524_201442_init', 1578415513),
('m190124_110200_add_verification_token_column_to_user_table', 1578415513);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `unit_price` decimal(12,2) DEFAULT NULL,
  `is_discontinued` bit(1) NOT NULL DEFAULT b'0',
  `description` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `unit_price`, `is_discontinued`, `description`, `product_image`, `id_category`) VALUES
(1, 'Berbequim Aparafusador SKIL 2695 AD (12 V - 0-550)', '86.50', b'0', 'Marca: ARTIZLEE\r\nModelo: Art-Drill-01\r\nCor: Vermelho e Preto\r\nPeso:4 Kg\r\nDimensões: 36.83 x 30.48 x 11.68 cm\r\nTipologia: Chaves de Fendas\r\nAcessórios Incluídos: 21 Acessórios', 'b87e329d965139939b24109b92490e3e.jpg', 6),
(2, 'Berbequim DEWALT DCD777S2T-QW', '216.25', b'0', 'Marca: DEWALT\r\nModelo: DCD777S2T-QW\r\nQuantidade: 1\r\nFonte de alimentação: Bateria\r\nTipologia: Berbequins', '5ccc05166488dab1dc3aff156a8c9c47.jpg', 6),
(3, 'Multiferramenta SKIL 1116 AD (315 W - 15000-35000)', '57.15', b'0', 'Marca: SKIL\r\nModelo: 1116 AD\r\nCor: Preto\r\nPeso: 0.6 kg\r\nPotência: 315 W\r\nVelocidade de rotação (rpm): 15000-35000 rpm\r\nVelocidade variável: Sim\r\nInclui mala de transporte: Sim\r\nLigação: Com Fio\r\n\r\nConteúdo Extra Incluído na Caixa: 60 acessórios, chave para encaixes, encaixes de 2.4 e 3.2 mm, chave para acessórios, encaixe extra de 3.2 mm\r\nMais Informações: Indicado para cortar, rebarbar, lixar, polir e gravar, bloqueio de fuso', 'ff48fae02a45bd1a66da3a9546b7473c.jpg', 6),
(4, 'Corta-Relvas Elétrico BLAUPUNKT GX4000 (1300 W)', '179.90', b'1', 'Corta-Relvas Elétrico.\r\nMotor de 1300W e 3600rpm de alto desempenho.\r\nCinco ajustes da altura de corte.\r\nDiâmetro de corte de 33cm.\r\nSaco coletor de relva de 35L com indicação quando está cheio.\r\nDesign moderno, silencioso, compacto, dinâmico e ergonómico.\r\nPunho macio e controlo de potência em estilo barra.\r\nAlça de transporte.\r\nAlimentação: 230V AC.\r\nPeso: 15.5Kg.\r\nDimensões: 104 x 38 x 108 cm\r\nPotência: 1300 W\r\nVelocidade de rotação (rpm): 3600 rpm', 'eee8ff2e1618e950f6e874237d949f72.jpg', 6),
(5, 'Berbequim Aparafusador PECOL POWER TOOLS APRO-0', '55.45', b'0', 'Com motor de 20V e 1.1 kg de peso, garante versatilidade e controlo em qualquer aplicação. \r\nEquipada com bucha de aperto rápido permite a fluidez do ritmo de trabalho tanto na fixação de parafusos ou furações, basta configurar o binário e a velocidade necessária para cada aplicação.\r\nO design ergonómico proporcina controlo total e equilibrado, aliando o peso e acabamentos de borracha macia para garantir conforto na utilização. A luz LED branca, proporciona maior visibilidade para acesso a zonas mais protegidas. Integra um sistema de indicação do estado da bateria. Sistema de protecção térmica e de sobrecarga para salvaguardar a integridade do equipamento', '7dc30e8f9591880fa337ee829ca33f1d.jpg', 6),
(6, 'Conjunto Rebarbadora BLAUPUNKT BP 3035 ', '69.90', b'0', 'Rebarbadora com interruptor de remos e disco de corte de 125mm.\r\nMotor de 240v, 1200W e controlo eletrónico de velocidade entre 1500 e 4800rpm.\r\nA rebarbadora fornece alta potência de saída e velocidade para aplicações profissionais de corte e retificação e remoção mais rápida de material.\r\nEngrenagens helicoidais em aço, caixa de engrenagens robusta em liga leve, caixa GFN anti-impacto e motor profissional potente para aplicações pesadas.\r\nProteção contra poeiras e abrasivos.\r\nCom a qualidade Blaupunkt.', '52ae3529b8a5192d2606072476710099.jpg', 6),
(7, 'Placa Gráfica Asus Radeon RX 6900 XT 16GB GDDR6', '1099.00', b'0', 'PORQUE O DESEMPENHO É A REGRA DO JOGO COM A RADEON™ RX 6900 XT\r\nA placa gráfica AMD Radeon™ RX 6900 XT, alimentada pela arquitetura AMD RDNA™ 2, com 80 unidades avançadas de computação poderosas, 128 MB da mais recente AMD Infinity Cache e 16GB de memória GDDR6 dedicada, foi criada para oferecer taxas de frames ultra altas e jogos em resolução 4K de alto nível.\r\n\r\nMotor Gráfico: AMD Radeon RX 6900 XT\r\nBus: PCI Express 4.0\r\nMemória: 16GB GDDR6\r\nClock GPU:\r\nBase: 1825MHz\r\nGame: 2015MHz\r\nBoost: 2250MHz\r\nStream Processors: 5120\r\nClock de Memória: 16.0 Gbps\r\nInterface de Memória: 256 Bits\r\nInterface:\r\n2 x DisplayPort (v1.4)\r\n1 x HDMI 2.0b\r\n1 x USB Type-C\r\nSuporte HDCP: Sim\r\nOpenGL: 4.6\r\nDirectX®: 12\r\nDimensões do Produto: 266.70 x 119.75 x 49.75 mm', '306352c36e2d12ffa335baf7216dd253.jpg', 3),
(8, 'Placa Gráfica Zotac Gaming GeForce RTX 3070 8GB GD', '599.90', b'0', 'As placas gráficas GeForce RTX™ Série 30 oferecem o melhor desempenho para jogadores e criadores. Elas são alimentados por Ampere - a arquitetura RTX de 2ª geração da NVIDIA - com novos núcleos RT, núcleos Tensor e multiprocessadores de streaming para gráficos Ray Tracing mais realistas e recursos de AI de ponta.\r\n\r\nOs programadores podem agora acrescentar ainda mais efeitos gráficos espetaculares aos jogos para PC executáveis no Microsoft Windows. As placas gráficas GeForce RTX oferecem funcionalidades DX12 avançadas, como o ray tracing e o sombreamento de frequência variável, criando jogos dotados de efeitos visuais ultrarrealistas e velocidades de fotogramas ainda mais rápidas.\r\n\r\nMotor Gráfico: NVIDIA® GeForce® RTX 3070\r\nBus: PCI Express 4.0 16x\r\nClore Clock: Base: 1500 MHz, Boost: 1755 MHz\r\nClock de Memória: 14 Gbps\r\nNúcleos CUDA: 5888\r\nMemória: 8GB GDDR6\r\nInterface de Memória: 256 Bits\r\nInterface I/O:\r\n3 x DisplayPort 1.4a (até 7680x4320@60Hz)\r\n1 x HDMI 2.1 (até 7680x4320@60Hz)\r\nSuporte HDCP 2.3\r\nVersão DirectX: 12\r\nVersão OpenGL: 4.6\r\nDimensões do produto: 231.9mm x 141.3mm x 41.5mm', '43bdd52a9d4ef3f60c748c1046aba900.jpg', 3),
(9, 'Memória RAM Corsair Vengeance RGB Pro 16GB (2x8GB)', '99.90', b'0', 'VISUALIZE. SINCRONIZE. MEMORIZE.\r\nAs memórias DDR4 VENGEANCE RGB PRO Series com overclocking iluminam o seu PC com luzes RGB dinâmicas multizona enquanto oferece o melhor desempenho.\r\n\r\nCapacidade: 16 GB (2 x 8 GB)\r\nTipo de memória: DDR4\r\nVelocidade de frequência: 3600 MHz\r\nLatência: 18-22-22-42\r\nTensão: 1.35V\r\nECC: NON-ECC\r\nTipo DIMM: Unbuffered', '8bf634c51b0df5b9f19de37e97f1f491.jpg', 3),
(10, 'Fonte Alimentação MSI MPG A650GF 650W 80 PLUS Gold', '124.90', b'0', 'CERTIFICAÇÃO 80 PLUS GOLD\r\nA eficiência da fonte de alimentação influencia diretamente o desempenho do sistema e o consumo de energia. A certificação 80 PLUS Gold promete menor consumo de energia e maior eficiência.\r\n\r\nEspecificações:\r\nCapacidade máxima: 650 W\r\nEficiência: Até 90% (80 Plus Gold)\r\nDC Output: 20A@+5V | 20A@+3.3V | 25@+12VMBPH | 25A@+12VCPU | 30A@+12VVGA1 | 30A@+12VVGA2 | 0.3A@-12V | 2.5A@+5VSB\r\nRefrigeração: 1 x Ventoinha 140mm\r\nProteções: OCP / OVP / OPP / OTP / SCP / UVP\r\nDimensões do produto: 150mm x 160mm x 86mm\r\n\r\nConectores:\r\n1 x ATX 24-PIN @ 600mm ± 10mm\r\n4 x PCI-E 8-PIN (6+2) @ 500mm ± 10mm\r\n8 x SATA @ 950mm ± 10mm\r\n2 x EPS 8-PIN (4+4) @ 700mm ± 10mm\r\n5 x PERIPHERAL / FDD 4-PIN @ 1100mm ± 10mm', '50d664fd4aa7b0a60fba0a39fe23754c.jpg', 3),
(11, 'Placa Gráfica Asus ROG Strix LC Radeon RX 6800 XT ', '1004.80', b'0', 'A placa gráfica AMD Radeon™ RX 6800 XT, alimentada pela arquitetura AMD RDNA™ 2, oferece 72 unidades avançadas de computação poderosas, 128 MB do mais recente AMD Infinity Cache e 16GB de memória GDDR6 dedicada. Criada para oferecer taxas de frames ultra elevadas e jogos em resolução 4K de alto nível.\r\n\r\nMotor Gráfico: AMD Radeon RX 6800 XT\r\nBus: PCI Express 4.0\r\nMemória: 16GB GDDR6\r\nClock GPU: Até 2360 MHz (Boost Clock) / 2110 MHz (Game Clock)\r\nStream Processors: 4608\r\nClock de Memória: 16.0 Gbps\r\nInterface de Memória: 256 Bits\r\nInterface:\r\n             1 x HDMI 2.1\r\n             2 x DisplayPort 1.4\r\n             1 x USB-C\r\nSuporte HDCP: Sim\r\nOpenGL: 4.6\r\nDirectX®: 12\r\nDimensões do Produto: Placa: 27.7 x 13.08 x 4.36 cm / Radiador: 27.6 x 12 x 5.17 cm (including fan)', '835573904856ef2b6328a9696b5ab5db.jpg', 1),
(12, 'Portátil ASUS VivoBook F512JP-70AM3SB1 15.6\'\' ', '899.99', b'0', 'Marca: ASUS\r\nModelo: VivoBook F512JP-70AM3SB1\r\n\r\nProcessador\r\nCPU: Intel Core i7-1065G7\r\nVelocidade Processador: 1.3 GHz (Turbo: 3.90 GHz)\r\nNúmero de Núcleos Core: Quad Core\r\n\r\nMemória e Armazenamento\r\nMemória RAM: 8 GB\r\nArmazenamento: 1 TB HDD + 256 GB SSD\r\n\r\nPlaca Gráfica\r\nGráfica: NVIDIA GeForce MX330\r\n\r\nEcrã\r\nEcrã: Full HD, Anti-reflexo\r\nResolução de Ecrã: 1920 x 1080 (FHD)\r\nEcrã Tátil: Não\r\n\r\nPeriféricos\r\nTeclado Numérico: Sim\r\nTeclado Mecânico: Não\r\nTeclado Retroiluminado: Sim\r\nLinguagem de Teclado: Português\r\n\r\nOutros\r\nSistema Operativo: Windows 10\r\nCâmara Integrada: Sim', '404e01cf126dd8f837421a93b833ec46.jpg', 4),
(13, 'Portátil ASUS ZenBook 14 UX425EA-71DXECB2 14\'\' ', '1610.11', b'0', 'O novo e belo ZenBook 14 é mais portátil do que nunca. É mais fino, mais leve e incrivelmente compacto, e inclui HDMI, Thunderbolt™ 3 USB-C™, USB Type-A e leitor de cartões MicroSD para uma versatilidade inigualável. Construído para proporcionar um desempenho potente, o ZenBook 14 é a escolha perfeita para um estilo de vida em movimento sem esforços.\r\n\r\nProcessador\r\nCPU:Intel Core i7-1165G7\r\nVelocidade Processador: 2.8 GHz\r\nNúmero de Núcleos Core: Quad Core\r\n\r\nMemória e Armazenamento\r\nMemória RAM: 16 GB\r\nArmazenamento: 1 TB SSD\r\n\r\nPlaca Gráfica\r\nGráfica: Intel Iris Xe\r\n\r\nEcrã\r\nEcrã: IPS, 300 nits\r\nResolução de Ecrã: 1920 x 1080 (FHD)\r\nEcrã Tátil: Não\r\n\r\nPeriféricos\r\nTeclado Numérico: Não\r\nTeclado Mecânico: Não\r\nTeclado Retroiluminado: Sim\r\nLinguagem de Teclado: Português\r\n\r\nOutros\r\nSistema Operativo: Windows 10 Home\r\nConetividade: Wi-Fi e Bluetooth\r\n', '7be0b238e49f04b7a42c59f7de2f326b.jpg', 4),
(14, 'Portátil ASUS ExpertBook P2451FA-50EHDPP2 14\'\'', '899.99', b'0', 'Proporcionando uma produtividade completa para ajudar a ultrapassar o dia de trabalho, o ASUS ExpertBook P2 é o pacote completo de negócios. Este portátil leve combina a robustez de nível militar com a segurança de nível empresarial, e apresenta o novo SensePoint pointing nub.\r\n\r\nProcessador\r\nCPU: Intel Core i5-10210U\r\nVelocidade Processador: 1.6 GHz (Turbo: 4.2 GHz)\r\nNúmero de Núcleos Core: Quad Core\r\n\r\nMemória e Armazenamento\r\nMemória RAM: 8 GB\r\nArmazenamento: 256 GB SSD \r\n\r\nPlaca Gráfica\r\nGráfica: Intel UHD Graphics\r\n\r\nEcrã\r\nEcrã: Anti-glare Narrow Bezel\r\nResolução de Ecrã: 1920 x 1080 (FHD)\r\nEcrã Tátil: Não\r\n\r\nPeriféricos\r\nTeclado Numérico: Não\r\nTeclado Mecânico: Não\r\nTeclado Retroiluminado: Sim\r\nLinguagem de Teclado: Português\r\n\r\nOutros\r\nSistema Operativo: Windows 10 Home\r\nConetividade: Wi-Fi e Bluetooth', 'e5f2d2d9d30fa238cba8b10f9edd48ea.jpg', 4),
(15, 'Portátil ACER Predator Helios 300 PH315-53-72YV', '1499.00', b'0', 'Acende a Fusão.\r\nPronto para a batalha e ansioso por lutar, o Helios 300 mergulha-o no jogo com tudo aquilo de que precisa.\r\n\r\nProcessador\r\nCPU: Intel Core i7-10750H\r\nVelocidade Processador: 2.6 GHz (Turbo: 5 GHz)\r\nNúmero de Núcleos Core: Hexa Core\r\n\r\nMemória e Armazenamento\r\nMemória RAM: 16 GB\r\nArmazenamento: 1 TB SSD\r\n\r\nPlaca Gráfica\r\nGráfica: NVIDIA GeForce RTX 2060\r\nMemória GPU: 6 GB\r\n\r\nEcrã\r\nEcrã: IPS 144 Hz\r\nResolução de Ecrã: 1920 x 1080 (FHD)\r\nEcrã Tátil: Não\r\n\r\nPeriféricos\r\nTeclado Numérico: Sim\r\nTeclado Mecânico: Não\r\nTeclado Retroiluminado: Sim\r\nLinguagem de Teclado: Português\r\n\r\nOutros\r\nSistema Operativo: Windows 10 Home\r\nConetividade: Wi-Fi e Bluetooth', '13f8e68e9dc2f39dbaed7da70b6dbf07.jpg', 4),
(16, 'Portátil HP 14s-dq0008np 14\'', '299.99', b'1', 'HP Laptop 14s-dq0008np, Um portátil fino e fiável com ecrã de grandes dimensões.\r\nMantenha-se ligado ao que é mais importante com uma bateria de elevada autonomia e um ecrã de moldura fina num design fino e elegante. Concebido para o manter produtivo e entretido em qualquer lugar, este portátil HP de 35,6 cm (14 pol.) oferece um desempenho fiável e incorpora um ecrã de grandes dimensões para que possa fazer streaming, navegar e executar rapidamente tarefas desde o nascer ao pôr do sol.\r\n\r\nProcessador\r\nCPU: Intel Celeron N4020\r\nVelocidade Processador: 1.1 GHz (Turbo: 2.8 GHz)\r\nNúmero de Núcleos Core: Dual Core\r\n\r\nMemória e Armazenamento\r\nMemória RAM: 4 GB\r\nArmazenamento: 64 GB eMMC\r\n\r\nPlaca Gráfica\r\nGráfica: Intel UHD Graphics\r\n\r\nEcrã\r\nEcrã: HD 220 nits\r\nResolução de Ecrã: 1366 x 768 (FWXGA)\r\nEcrã Tátil: Não\r\n\r\nPeriféricos\r\nTeclado Numérico: Não\r\nTeclado Mecânico: Não\r\nTeclado Retroiluminado: Não\r\nLinguagem de Teclado: Português\r\n\r\nOutros\r\nSistema Operativo: Windows 10 Home S\r\nConetividade: Wi-Fi e Bluetooth', 'f5592363810be34159bf72d0ebce7f55.jpg', 4),
(17, 'Cadeira Operativa PIQUERAS Y CRESPO Ayna Preto', '83.00', b'0', 'Cadeira de Escritório Modelo Ayna, ergonómica com mecanismo de contato permanente, regulável em altura. Banco e encosto estofados em tecido BALI.\r\n\r\nCor: Preto\r\nDimensões: 100x59x57 cm\r\nPeso: 8 kg\r\nAltura: 100 cm\r\nLargura:59 cm\r\nProfundidade: 57 cm\r\nMaterial:Tecido\r\n\r\nCom Encosto: Sim\r\nSuporte Lombar: Sim\r\nEncosto de cabeça:Não\r\nAssento Almofadado:Sim\r\nForma do Assento: Quadrado\r\nBraços ajustáveis: Sim\r\nAltura do assento regulável: Sim\r\nAltura do encosto regulável: Sim\r\nInclinação Regulável: Sim', 'afe4a2992b1373deb265c97aa92222ec.jpg', 8),
(18, 'Banco de Escritório VIDAXL branco', '42.99', b'0', 'Este banco de escritório possui um assento confortável e estilo moderno. Seguindo a estética do design moderno, este banco de escritório é macio ao toque e um assento agradável. Este banco de escritório oferece ajuste em altura, desde a altura da barra até à altura do balcão, com a função de elevação a gás. O estofamento de alta qualidade garante um assento confortável. O banco de escritório é leve para facilitar a mobilidade. Este artigo vai ser um ótimo complemento para a sua casa.', '27597d1182054b1cf1e2bfd1f84c0dfd.jpg', 9),
(19, 'Cadeira de Visitante LINEA FABBRICA 592124', '32.90', b'0', 'Cor: Cinzento\r\nGiratório: Não\r\nNúmero de Pernas: 4\r\n\r\nSuporte Lombar: Sim\r\nEncosto de cabeça: Não\r\nBraços ajustáveis: Não', 'ef5d52b8d7d1d26095517793b9b242d7.jpg', 8),
(20, 'Cadeira Executiva VIDAXL giratória couro preta', '373.99', b'0', 'Esta cadeira de escritório não é apenas elegante, mas também muito confortável. É feito de materiais de alta qualidade. Graças ao mecanismo de de elevação a gás, esta cadeira pode ser ajustada em altura, o que pode ajudá-lo a definir a cadeira na posição perfeita. Os braços podem ser virados para cima. O encosto de cabeça também pode ser ajustado para atender às suas necessidades pessoais. Com cinco rodízios de nylon, é fácil para se movimentar. Com o seu design contemporâneo, esta cadeira vai ser uma ótima escolha para o seu escritório.', 'a9e03a493e680b5978f7585283e5bb0a.jpg', 8),
(21, 'Cadeira Executiva VIDAXL poliéster cinzento', '240.99', b'0', 'A nossa cadeira de escritório aconchegante possui um design luxuoso, ergonómico e será um ótimo complemento para qualquer escritório. O design de costas altas com encosto, apoios de braços e assento estilo borboleta acolchoados de forma ergonómica permite-lhe trabalhar durante longos períodos de tempo. O design ajustável em altura possibilita-lhe adaptar-se à altura da mesa, usufruindo assim de um maior conforto e de um alinhamento saudável da coluna vertebral. O design giratório a 360 graus garante ainda uma gama de movimentos versátil. As 5 rodas de nylon permitem-lhe movimentar a cadeira de forma silenciosa e fácil.', 'de9ba3cdd0f3069e8e3686150ddfd95a.jpg', 8),
(22, 'Secretária LEVIRA Hessel ', '90.19', b'0', 'Cor: Cerejeira Choco\r\nDimensões: 120 x 60 x 74 cm', '61cd0da41fe1108d9e09d1696acee09d.jpg', 9),
(23, 'Secretária KASA Prateleiras', '60.00', b'0', 'Dimensões: 120 x 73 x 50 cm', 'd250f06728ac344c25fd4b65fa4df8f5.jpg', 9),
(24, 'Secretária DS MUEBLES iCub ', '194.99', b'0', 'Secretária Icub em madeira maciça e metal estilo industrial vintage. Metal cor preto. Comprimento: 60cm x Largura 120cm x Altura 73cm. A beleza da simplicidade e minimalismo com as matérias-primas. Perfeito para criar uma atmosfera industrial. O estilo dos moveis industriais antigos leva suas caracteristicas de antigas fábricas ou espaços industriais, nos quais peças sólidas de madeira maciça sâo combinadas com elementos metállicos que formam a uniâo e, ao mesmo tempo, conferem uma resistência extraordinária ao uso. Tampo de madeira maciça de pinho de 30mm. Tocado muito agradável à madeira natural. Estrutura em tubo de aço de 1,5mm. De espessura.\r\n\r\nCor: Preto\r\nPeso: 17 kg\r\nDimensões: 60 x 120 x 73 cm\r\nMaterial: Madera e Metal\r\nMaterial do Tampo: Madeira', '958fec551cf7c4e41018cf8a9dbe8b9a.jpg', 9),
(25, 'Auscultadores Bluetooth SONY WHCH510B', '37.99', b'0', 'Leve a música para todo o lado\r\nO design leve e os auriculares giratórios permitem-lhe guardar os auscultadores numa mala quando estiver em movimento. A banda para a cabeça, fina e ajustável, oferece uma aparência elegante e conforto.\r\n\r\nsom de qualidade Ouça a sua música ao longo do dia sem interrupções\r\nOs WH-CH510 são sem fios, leves e têm uma autonomia da bateria suficientemente longa para estar sempre consigo.\r\n\r\nm som de qualidade Ouça a sua música ao longo do dia sem interrupções\r\nOs WH-CH510 são sem fios, leves e têm uma autonomia da bateria suficientemente longa para estar sempre consigo.\r\n\r\nCompatível com o assistente de voz\r\nBasta premir um botão para estabelecer ligação ao assistente de voz do smartphone para obter direções, reproduzir música e comunicar com os contactos.\r\n\r\nPeso: 132 gramas\r\nCor: Preto\r\n\r\nFrequência de Resposta (Hz): 20 - 20.000 Hz\r\nDiafragma (mm): 30 mm\r\nAlcance (m): 10 mts\r\n\r\nAutonomia: Até 35Horas\r\nMicrofone: Sim\r\nControlo de Volume: Sim\r\nBotão de chamadas: Sim\r\nDesportivos: Não\r\n\r\n', '6ba6a9327282ec56573fdb1a2c3651b7.jpg', 12),
(26, 'Auscultadores Bluetooth SONY WHCH710', '89.99', b'0', 'Auscultadores que cancelam o mundo\r\nQuer esteja num voo de longa distância ou a viajar para o trabalho, a função de cancelamento de ruído com inteligência artificial (AINC) analisa constantemente os componentes do som ambiente e seleciona automaticamente o modo de cancelamento de ruído mais eficaz para o seu ambiente envolvente.\r\n\r\nGanhe controlo sobre o que ouve através da tecnologia de sensores de ruído duplos\r\nOs microfones duplos \"feed-forward\" e \"feed-backward\" nos auscultadores WH-CH710N eliminam mais sons ambiente do que nunca. Portanto, se pretende bloquear o ruído de trânsito da cidade ou as conversas de escritório, poderá fazê-lo ao envolver-se totalmente no que está a ouvir.\r\n\r\nCarregamento rápido\r\nA bateria de iões de lítio incorporada proporciona até 35 horas de áudio com um único carregamento. Além disso, o carregamento rápido proporciona 60 minutos de reprodução com apenas um carregamento de 10 minutos.\r\n\r\nPersonalize o seu som\r\nO Modo som ambiente coloca-o em controlo total da sua experiência de audição. Ligue-o e poderá ouvir a sua música, enquanto continua a ouvir os sons essenciais do dia a dia que o mantêm seguro, como os ruídos do trânsito e os anúncios dos transportes.\r\n\r\nCor: Preto\r\n\r\nDiafragma (mm): 30 mm\r\nAlcance (m): 10 mts\r\n\r\nAutonomia: Até 35Horas\r\nQuick Charge: Sim\r\nMicrofone: Sim\r\nNoise Cancelling: Sim\r\nControlo de Volume: Sim\r\nBotão de chamadas: Sim\r\nDesportivos: Não', '3cc0e8da9e64866b03b549384aa10546.jpg', 12),
(27, 'Auscultadores Bluetooth SONY WH-1000XM3B', '249.99', b'0', 'Perca-se no silêncio\r\nA tecnologia de cancelamento de ruído dos WH-1000XM3 é a mais avançada de sempre, com proteção dos ouvidos de ajuste perfeito e o Processador de Cancelamento de ruído HD QN1. Os auscultadores WH-1000XM3 cancelam o ruído de veículos em viagem, mas também são altamente eficientes a bloquear ruídos comuns como vozes e sons de fundo típicos da cidade.\r\n\r\nLiberdade sem fios, excelente som em silêncio\r\nO LDAC transmite aproximadamente três vezes mais dados do que o áudio sem fios BLUETOOTH® convencional, permitindo-lhe desfrutar de conteúdos com áudio de alta resolução e qualidade excecional, o mais próxima possível da qualidade de uma ligação com fios dedicada.\r\n\r\nSom em que acredita\r\nO amplificador integrado no Processador de Cancelamento de ruído HD QN1 tem a melhor relação sinal/ruído e baixa distorção para dispositivos portáteis, com uma qualidade de som excecional. Os diafragmas de 40 mm fabricados em polímeros de cristais líquidos (LPC) tornam estes auscultadores perfeitos para batidas fortes e reproduzem uma gama completa de frequências até 40 kHz.\r\n\r\nRestaure todos os seus ficheiros comprimidos\r\nO Digital Sound Enhancement Engine HX (DSEE HX™) melhora ficheiros de música comprimidos, aproximando-os da qualidade de áudio de alta resolução. Ao restaurar o som de alta gama perdido na compressão, o DSEE HX™ produz ficheiros de música digital num som claro e rico.\r\n\r\nAudição inteligente através de SENSE ENGINE\r\nVeja como o Controlo de som adaptável deteta automaticamente a sua atividade como quando está a viajar, a andar e em espera, e ajusta as definições de som ambiente por si. Com a Atenção Rápida, pode comunicar sem remover os auscultadores: basta colocar a mão sobre a estrutura para reduzir o volume instantaneamente e conversar.\r\n\r\nMais inteligência com o Assistente de voz\r\nBasta perguntar ao seu assistente para fazer a gestão do seu dia. Desfrute de entretenimento, ligue-se aos seus amigos, obtenha informações, ouça música e notificações, defina lembretes e muito mais.\r\n\r\nEnergia todo o dia, carregamento rápido\r\nCom 30 horas de autonomia da bateria, tem energia suficiente para longas viagens. Se necessitar de carregar rapidamente, pode obter 5 horas de carga ao fim de apenas 10 minutos com o transformador CA opcional.\r\n\r\nCor: Preto\r\n\r\nImpedância nominal (Ohms): 47\r\nFrequência de Resposta (Hz): 4-40.000\r\nDiafragma (mm): 30 mm\r\nAlcance (m): 10 mts\r\n\r\nAutonomia: Até 30 Horas\r\nQuick Charge: Sim\r\nMicrofone: Sim\r\nNoise Cancelling: Sim\r\nAudio Hi-Res: Sim\r\nControlo de Volume: Sim\r\nBotão de chamadas: Sim\r\nDesportivos: Não', '16d1de69b671005bc85fd1841ef1dfd4.jpg', 12),
(28, 'Soundbar SAMSUNG HW-Q800T', '710.12', b'0', 'Cor: Preto\r\nPeso: 13.4 kg\r\nAltura: 6 cm\r\nLargura: 98 cm\r\nProfundidade: 11.5 cm\r\nPotência satélite (RMS): 330\r\nNúmero de canais: 3.1.2\r\nDescodificadores áudio: Dolby Digital Plus, DTS, Dolby True HD, Dolby Atmos\r\nEqualizador: Não\r\nComando: Sim\r\nMontagem na parede: Sim\r\nConsumo de energia (W): 28 W\r\n\r\nSubwoofer: Sem Fios\r\n\r\nCompatível com assistente inteligentes: Alexa\r\n\r\nBluetooth: Sim\r\nWi-Fi: Sim\r\nLigação USB: Não\r\nHDMI: Sim\r\nEntrada ótica: Sim\r\nEntrada Digital Áudio (Coaxial): Não\r\nEntrada AUX: Não\r\n', 'e8a83a95e6b7005e91f9e76c6415b568.jpg', 13),
(29, 'Soundbar SONY HTSF150', '149.99', b'0', 'A soundbar Sony HTSF150 de cor preta possibilita que desfrute dos seus programas de televisão preferidos com qualidade de som melhorada através de uma soundbar de dois canais com coluna Bass Reflex. O design de perfil esguio da SF150 adapta-se facilmente ao seu ambiente doméstico e combina harmoniosamente com qualquer interior. Assim, trata-se de uma soundbar compacta que permite uma ligação fácil a um televisor através de HDMI ARC, oferecendo som de qualidade elevada do S-Force PRO Front Surround. Reproduza música através de USB ou Bluetooth 4.2 com tecnologia Bass Reflex, uma vez que esta coluna Sony HTSF150 oferece graves poderosos sem comprometer o detalhe e a definição, sendo perfeita para desfrutar do som de programas televisivos e de música. Além disso, nunca foi tão fácil ligar ao seu televisor. Com HDMI ARC, basta um cabo para estabelecer uma ligação fácil para todo o áudio do seu televisor. Pode controlar ambos com um só telecomando. Por sua vez, a tecnologia de som surround virtual coloca-o no centro dos filmes que adora, replicando o som surround ao estilo das salas de cinema. Outras características relevantes: amplificador S-Master com 120 W de potência; Bravia Sync; leitura de ficheiros WAV, MP3 e WMA; modos de som (Auto, Cinema, Música, Noturno, Voz e Padrão). Garantia de dois anos.\r\n\r\nA Worten destaca: soundbar de dois canais com coluna Bass Reflex e design de perfil esguio; conexão HDMI ARC; S-Force PRO Front Surround; reprodução via USB ou Bluetooth 4.2; tecnologia Bass Reflex; tecnologia de som surround virtual; amplificador S-Master com 120 W de potência; leitura de ficheiros WAV, MP3 e WMA; modos de som (Auto, Cinema, Música, Noturno, Voz e Padrão).\r\n\r\n	Cor: Preto\r\nPeso: 2.3 kg\r\nAltura: 6.4 cm\r\nLargura: 90 cm\r\nProfundidade: 8.8 cm\r\nPotência satélite (RMS): 330\r\nNúmero de canais: 3.1.2\r\nDescodificadores áudio: Dolby Digital\r\nEqualizador: Não\r\nComando: Sim\r\nMontagem na parede: Sim\r\nConsumo de energia (W): 30 W\r\n\r\nCompatível com assistente inteligentes: Não\r\n\r\nBluetooth: Sim\r\nWi-Fi: Não\r\nLigação USB: Sim\r\nHDMI: Sim\r\nEntrada ótica: Sim\r\nEntrada Digital Áudio (Coaxial): Não\r\nEntrada AUX: Não', 'd47a8793bd29f7c4dd77619b3374670f.jpg', 13),
(30, 'Desktop LENOVO Ideacentre 510A-15ARR', '599.99', b'0', 'Cor: Iron Grey\r\nPeso: 6.85 kg\r\nAltura: 36.6\r\nLargura: 14.5\r\nProfundidade: 28.5\r\nUnidade de Medida: cm\r\n\r\nProcessador\r\nCPU: AMD Ryzen 5 3400G\r\nVelocidade Processador: 3.7 GHz (Turbo: 4.2 GHz)\r\n\r\nMemória e Armazenamento\r\nMemória RAM: 8 GB\r\nArmazenamento: 2 TB HDD + 128 GB SSD\r\n\r\nPlaca Gráfica\r\nGráfica: AMD Radeon RX Vega 11\r\nMemória GPU: Integrada na CPU\r\n\r\nOutros\r\nPlaca de Som: Realtek ALC662\r\nSistema Operativo: Windows 10 Home\r\nConetividade: Wi-Fi e Bluetooth\r\n\r\nConexões: 1 headphone / microphone combo jack (3.5mm), 2 USB 3.1 Gen1, 1 microphone (3.5mm), 2 USB 2.0. 2 USB 2.0, ethernet (RJ-45), VGA, HDMI (1.4) Line-in (3.5mm), line-out (3.5mm), microphone-in (3.5mm)', '9e42c94de81c664225fe694794f4d646.jpg', 2),
(31, 'Desktop HP 290 G2', '747.85', b'0', 'Cor: Preto\r\nPeso: 5.4 kg\r\nAltura: 277,5 mm\r\nLargura: 170 mm\r\nProfundidade: 338 mm\r\n\r\nProcessador\r\nCPU: Intel Core i3-8100\r\nVelocidade Processador: 3.6 GHz\r\nNúmero de Núcleos Core: Quad Core\r\n\r\nMemória e Armazenamento\r\nMemória RAM: 4 GB\r\nArmazenamento: 1 TB HDD\r\n\r\nPlaca Gráfica\r\nGráfica: Intel UHD Graphics 630\r\nMemória GPU: Integrada na CPU\r\n\r\nOutros\r\nPlaca de Som: Realtek ALC662\r\nSistema Operativo: Windows 10 Home\r\nConetividade: Wi-Fi e Bluetooth\r\n\r\nConexões: 4 USB 2.0, 4 USB 3.2 Gen 1 (3.1 Gen 1), 1 RJ-45, 1 VGA (D-Sub), 1 HDMI', 'dd3b01b8eb268327b55d6ad3fe86fa85.jpg', 2),
(32, 'Desktop ASUS S425MC-R3DV8PB1', '499.99', b'0', 'Cor: Preto\r\nPeso: 7 Kg\r\nAltura: 35.5\r\nLargura: 16\r\nProfundidade: 34.7\r\nUnidade de Medida: cm\r\n\r\nProcessador\r\nCPU: AMD Ryzen 3 3200G\r\nVelocidade Processador: 3.6 GHz (Turbo: 4 GHz)\r\n\r\nMemória e Armazenamento\r\nMemória RAM: 8 GB\r\nArmazenamento: 1 TB SSD\r\n\r\nPlaca Gráfica\r\nGráfica: AMD Radeon Vega 8\r\nMemória GPU: Integrada na CPU\r\n\r\nOutros\r\nPlaca de Som: High Definition 7.1 Channel Audio\r\nSistema Operativo: Windows 10 Home\r\nConetividade: Wi-Fi e Bluetooth\r\n\r\nConexões: 1x RJ45, 1x VGA, 1x 7.1 channel audio (3 ports), 4x USB 3.2 Gen 1, 2x USB 3.2 Gen 2, 2x PS2, 1x DVI-D, 1x Headphone, 1x Mic in, 1x Headphone, 1x MIC in, 2x USB 2.0, 1x USB-C 3.2 Gen 1, 1x USB 3.2 Gen 1', 'c4d2d4285c76d87016d9d66e4a4d6c60.jpg', 2),
(33, 'Coluna Bluetooth JBL Xtreme 2 GM', '299.99', b'0', 'Transmissão sem fio via Bluetooth\r\nConecte até 2 smartphones ou tablets à caixa de som, sem fios, e use-os alternadamente para apreciar músicas com um som estéreo imersivo.\r\n\r\n15 horas de reprodução\r\nA bateria integrada recarregável de íon de lítio suporta até 15 horas de reprodução e carrega seus dispositivos sem esforço através de uma porta USB.\r\n\r\nClassificação IPX7 à prova d\'água\r\nLeve a Xtreme 2 para a praia ou piscina sem se preocupar com espirros ou submersão em água.\r\n\r\nJBL Connect+\r\nAmplifique sua experiência sonora a níveis épicos e agite a festa de forma perfeita conectando mais de 100 caixas de som sem fios JBL Connect+ ativadas.\r\n\r\nViva-voz\r\nAtenda chamadas com total nitidez usando esta caixa de som com viva-voz e cancelamento de ecos e ruídos.\r\n\r\nRadiador de Graves JBL\r\nOs radiadores passivos duplos fornecem um som JBL poderoso e agradável aos ouvidos, que ressoa alto e claro\r\n', '2be7bdca49629be6e5768134653928a4.jpg', 11),
(34, 'Coluna Bluetooth JBL Flip Essential ', '79.99', b'0', 'Cor: Preto\r\nPeso: 0.3 kg\r\nAltura: 25 cm\r\nLargura: 12 cm\r\nProfundidade: 12 cm\r\n\r\nPotência: 16 W\r\nAutonomia da Bateria: até 10 h\r\nComando: Não\r\n\r\nRádio FM: Não\r\nIluminação: Não\r\nÀ Prova de Água: Sim\r\n\r\nConteúdo Extra: Cabo de carregamento\r\nOutros: Grau de proteção IPX7 (protegido contra imersão temporária em água de até 1 metro por 30 minutos)', 'b152faaf5b85d260f7ec35b734864f61.jpg', 11),
(35, 'Coluna Bluetooth MARSHALL Stockwell II', '249.99', b'0', 'Cor: Preto\r\nPeso: 1.41 kg\r\nAltura: 16.5\r\nLargura: 15 cm\r\nProfundidade: 17 cm\r\n\r\nAutonomia da Bateria: até 20 h\r\nComando: Não\r\n\r\nRádio FM: Não\r\nIluminação: Não\r\nÀ Prova de Água: Não\r\n\r\nConteúdo Extra: 1 cabo USB-C, Guia de configuração rápida\r\nOutros: Frequências de resposta: 60 - 20000 Hz; Som multidireccional; Versão de Bluetooth: 5.0; Resistência à água IPX4; Funcionalidade multi-host; Função de carga rápida', '10bfc5f831d03f4a2a8523a48047a0a0.jpg', 11),
(36, 'Coluna Bluetooth SONY XB43 ', '179.99', b'0', 'Som que vale a pena partilhar\r\nA coluna sem fios SRS-XB43 combina graves profundos com vozes nítidas para proporcionar um som de festival. Além disso, é resistente e fácil de utilizar, pelo que todos podem simplesmente desfrutar da festa.\r\n\r\nDesfrute de um som potente em qualquer lugar\r\nAproveite o som profundo e potente onde quiser com a sua coluna EXTRA BASS™. Os radiadores passivos duplos funcionam em conjunto com o sistema de colunas bidirecional para aumentar os tons de baixa frequência, dando um impulso aos graves.\r\n\r\nO que é a X-Balanced Speaker Unit?\r\nAo contrário do diafragma circular de uma coluna convencional, a mais recente X-Balanced Speaker Unit da XB43 apresenta um diafragma quase retangular.\r\n\r\nO tweeter aumenta a nitidez vocal\r\nO sistema de colunas bidirecional da XB43 combina um woofer para frequências baixas a médias com um tweeter dedicado às frequências mais elevadas. O resultado é uma nitidez vocal excecional.\r\n\r\nSemelhante a uma experiência ao vivo\r\nToque no botão SOM AO VIVO e ouça a sua música de uma forma totalmente nova. Anime a sua festa com uma experiência de som tridimensional única, criando um ambiente de festival onde quer que se encontre.', 'c8e6be5190e5027329e631e7241234ff.jpg', 11),
(37, 'Coluna Bluetooth SONY XB12', '49.99', b'0', 'Cor: Preto\r\nPeso: 0.3 kg\r\n\r\nAlcance: Alcance Máx. Comunicação 10m\r\nAutonomia da Bateria: até 16 h\r\nComando: Não\r\n\r\nRádio FM: Não\r\nIluminação: Não\r\nÀ Prova de Água: Sim\r\n\r\nConteúdo Extra: Cabo USB, Correia (fixada ao corpo do produto)\r\nOutros: Design pequeno e leve. Com uma correia removível que permite pendurar a coluna em qualquer sítio e levar a música para todo o lado.', 'b2750d9446c19f9d89ed7aca74b32591.jpg', 11);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `nif` int(9) DEFAULT NULL,
  `postal_code` varchar(8) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_ibfk_1` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `firstName`, `lastName`, `phone`, `address`, `nif`, `postal_code`, `city`, `country`, `id_user`) VALUES
(1, 'Bruno', 'Correia', '911911911', 'Rua de Plataformas', 911911911, '3450-337', 'Leiria', 'Portugal', 1),
(2, 'Trabalhador', 'Um', '922922922', 'Rua de Plataformas', 922922922, '3450-337', 'Leiria', 'Portugal', 2),
(3, 'Trabalhador', 'Dois', '933933933', 'Rua de Plataformas', 933933933, '3450-337', 'Leiria', 'Portugal', 3),
(4, 'Trabalhador', 'Três', '944944944', 'Rua de Plataformas', 944944944, '3450-337', 'Leiria', 'Portugal', 4),
(5, 'Trabalhador', 'Quatro', '955955955', 'Rua de Plataformas', 955955955, '3450-337', 'Leiria', 'Portugal', 5),
(6, 'Cliente', 'Um', '966966966', 'Rua de Plataformas', 966966966, '3450-337', 'Leiria', 'Portugal', 6),
(7, 'Cliente', 'Dois', '977977977', 'Rua de Plataformas', 977977977, '3450-337', 'Leiria', 'Portugal', 7),
(8, 'Cliente', 'Três', '988988988', 'Rua de Plataformas', 988988988, '3450-337', 'Leiria', 'Portugal', 8),
(9, 'Cliente', 'Quatro', '999999999', 'Rua de Plataformas', 999999999, '3450-337', 'Leiria', 'Portugal', 9);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sale_finished` bit(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `sale_date`, `sale_finished`, `id_user`) VALUES
(1, '2021-01-07 00:00:00', b'1', 8),
(2, '2021-01-09 17:34:30', b'0', 6),
(3, '2021-01-09 17:35:44', b'0', 6),
(4, '2021-01-09 17:36:53', b'0', 9),
(5, '2021-01-09 17:37:37', b'1', 9),
(6, '2021-01-09 17:38:23', b'0', 8);

-- --------------------------------------------------------

--
-- Table structure for table `sale_item`
--

DROP TABLE IF EXISTS `sale_item`;
CREATE TABLE IF NOT EXISTS `sale_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_price` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_sale` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  KEY `id_sale` (`id_sale`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_item`
--

INSERT INTO `sale_item` (`id`, `unit_price`, `quantity`, `id_product`, `id_sale`) VALUES
(1, '49.99', 1, 37, 1),
(2, '37.99', 2, 25, 1),
(3, '60.00', 1, 23, 2),
(4, '83.00', 1, 17, 2),
(5, '89.99', 1, 26, 2),
(6, '1499.00', 1, 15, 2),
(7, '79.99', 1, 34, 3),
(8, '55.45', 1, 5, 3),
(9, '60.00', 1, 23, 4),
(10, '240.99', 1, 21, 5),
(11, '124.90', 1, 10, 5),
(13, '599.90', 1, 8, 5),
(14, '49.99', 1, 37, 6),
(15, '89.99', 1, 26, 6),
(16, '179.99', 1, 36, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Bruno', 'dhZmCG7nmr55vqDsjcOS1mnCq1sO_xW4', '$2y$13$3EajmmlLnN3LUmQQRtR3oOc4DGpSXK1NGYmva3YgtuLfxMhcyZbxK', NULL, 'brunocorreia@mailinator.com', 10, 1610186969, 1610186969, '8X1Ohnx9OYNHrf3cZnJP8K3LkWVkNYO7_1610186969'),
(2, 'Trabalhador 1', 'v0dgtG5O7FiH9B-rUPPYBgqyce0jDqCc', '$2y$13$/PQE1z3SnalatBHBAvqA2.SDaxvDDXCBqMESoVZriXwTp/XHi/P9S', NULL, 'trabalhador1@mailinator.com', 0, 1610187118, 1610212260, 'prXc_cgt20zFjWloZKYf0tDycFixBCQw_1610187118'),
(3, 'Trabalhador 2', 'ZEBijCyFpOPEyPjq15KxcBAaveM7bGnP', '$2y$13$yQrbqwAfvr/QmujikmO77u7sxuxqE1N098ka8Ql3DxAQ.6SvODOLm', NULL, 'trabalhador2@mailinator.com', 10, 1610187163, 1610187163, 'A8tlWWqhQybbosv3kGFSnsVV7kPsHojc_1610187163'),
(4, 'Trabalhador 3', 'N6yVAWPtHSnGAmHgw7mMnJ-RwPXowtZN', '$2y$13$tvS1xUwUR4jjRdigg.FJl.gAQz.6/hfsbnSKKDnpC0pOnllKmZ1S6', NULL, 'trabalhador3@mailinator.com', 9, 1610187283, 1610212933, 'quB-GClozgnD-VyfErw9-eKW4-lnIejh_1610187283'),
(5, 'Trabalhador 4', 'ARsEoJFTSKGDuHrip8zMj5lGLnUKS4AZ', '$2y$13$g52.xxGR3Iehr.waaALsY.6amvSDGN6YYHOLcDYLHd88RhS3J0tPi', NULL, 'trabalhador4@mailinator.com', 10, 1610212089, 1610212089, 'cknQblqTyjBIm6I7DCev00Rk0pHFckkS_1610212089'),
(6, 'Cliente 1', 'CnWb3At5hUwwaj5TXeVHJCLnAoQkO-an', '$2y$13$S8KVGBqgszCVAXzLY8rFKerPkW8bcC./Emfw/xhMlaLfEOh5Hp1xe', NULL, 'cliente1@mailinator.com', 10, 1610213036, 1610213036, 'K6ZD4pIhaXAR1XX16zoGmCyDqWB6TN9D_1610213036'),
(7, 'Cliente 2', 'b-Od1lVhKewbTAd15RBtluvXz79PgLYW', '$2y$13$lcJGTA7Ea7TvinlnEyNRlOxSwWVKqo8uwszXOUit6at6R0NqXVYqW', NULL, 'cliente2@mailinator.com', 10, 1610213066, 1610213066, 'oCQKrNVZi9jVhlBQLx4w9PCoMFWIoqR4_1610213066'),
(8, 'Cliente 3', 'NcTy424QcWjZnKUZB7B2Us0Oa0nKTAuF', '$2y$13$.PdnA7JEpONbzRq8BaV76.ZWyquOcaf0HeW3hxAetJn5X4wn3TT56', NULL, 'cliente3@mailinator.com', 10, 1610213123, 1610213123, 'V1vew8rk8JleJqwYpu525FycmRbUspb-_1610213123'),
(9, 'Cliente 4', 'zrEpTq6RKOi7Khj7ydmytQBNahkO28tc', '$2y$13$RewWSX6Gve.ymDKutO/Sg.xvWzJq47Tli1.csogifg1ydnDl3X12C', NULL, 'cliente4@mailinator.com', 10, 1610213205, 1610213205, 'xXhxaxM0HcrxxYZ0yumKtJnXClAwxJxw_1610213205');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
