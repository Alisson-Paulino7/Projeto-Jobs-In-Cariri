-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Maio-2023 às 20:54
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jobs`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avalicao`
--

CREATE TABLE `avalicao` (
  `id` int(11) NOT NULL,
  `id_cadastro` int(11) NOT NULL,
  `id_vaga` int(6) UNSIGNED NOT NULL,
  `nota` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `dtNascimento` text DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `id_profissao` int(11) DEFAULT NULL,
  `foto` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `nome`, `sobrenome`, `email`, `senha`, `cpf`, `rg`, `dtNascimento`, `endereco`, `cidade`, `celular`, `id_profissao`, `foto`) VALUES
(20, 'Gabrie', 'de Oliveira', 'gabriel.bernardino@urca.br', '123', '123.456.789-00', '12345678', '2023-05-09', 'AV manoel neres de oliveira', 'FORTALEZA', '88999963774', 3, 0x363436353166326162376133335f436170747572612064652074656c6120323032332d30342d3034203039333335332e706e67),
(21, 'andre', 'silva', 'andre@teste.com', '123', '094.724.987-49', '3545346464', '2023-05-01', 'crato', 'Crato', '(99)9.9999.9999', 1, NULL),
(22, 'ze', 'urubu', 'ze@gmail.com', '123', '123456798', '3545346464', '2023-05-02', 'crato', 'Crato', '(99)9.9999.9999', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `id_cadastro_user` int(11) NOT NULL,
  `id_vaga_user` int(6) UNSIGNED NOT NULL,
  `forma_pagamento_user` varchar(50) NOT NULL,
  `valor_user` decimal(10,2) NOT NULL,
  `dtPagamento` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`id`, `id_cadastro_user`, `id_vaga_user`, `forma_pagamento_user`, `valor_user`, `dtPagamento`) VALUES
(1, 21, 26, 'Débito', '450.00', '2023-05-17 15:09:44'),
(2, 22, 26, 'Dinheiro', '950.00', '2023-05-17 18:37:10'),
(3, 21, 26, 'PIX', '1200.00', '2023-05-17 18:37:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int(11) NOT NULL,
  `id_cadastro` int(11) NOT NULL,
  `id_vaga` int(6) UNSIGNED NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dtPagamento` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pagamento`
--

INSERT INTO `pagamento` (`id`, `id_cadastro`, `id_vaga`, `forma_pagamento`, `valor`, `dtPagamento`) VALUES
(9, 20, 25, '', '0.00', NULL),
(10, 21, 26, 'PIX', '1200.00', '2023-05-17 18:37:24'),
(11, 22, 26, 'Dinheiro', '950.00', '2023-05-17 18:37:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissao`
--

CREATE TABLE `profissao` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `profissao`
--

INSERT INTO `profissao` (`id`, `nome`) VALUES
(1, 'Programador'),
(2, 'Designer'),
(3, 'Engenheiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

CREATE TABLE `vagas` (
  `id` int(6) UNSIGNED NOT NULL,
  `empresa` varchar(30) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `requisitos` text DEFAULT NULL,
  `beneficios` text DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_responsavel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `vagas`
--

INSERT INTO `vagas` (`id`, `empresa`, `cargo`, `telefone`, `email`, `requisitos`, `beneficios`, `data_cadastro`, `usuario_responsavel`) VALUES
(25, 'Empresa andre', 'cargo andre', '9898989', 'andre@teste.com', 'test', 'test', '2023-05-17 12:41:34', 21),
(26, 'empres gabriel', 'cargo gabriel', '90809890', 'gabriel.bernardino@urca.br', 'test', 'test', '2023-05-17 12:42:14', 20);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avalicao`
--
ALTER TABLE `avalicao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_avalicao_cadastro` (`id_cadastro`),
  ADD KEY `fk_avalicao_vagas` (`id_vaga`);

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cadastro_profissao` (`id_profissao`);

--
-- Índices para tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_historico_cadastro` (`id_cadastro_user`),
  ADD KEY `fk_historico_vagas` (`id_vaga_user`);

--
-- Índices para tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pagamento_cadastro` (`id_cadastro`),
  ADD KEY `fk_pagamento_vagas` (`id_vaga`);

--
-- Índices para tabela `profissao`
--
ALTER TABLE `profissao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avalicao`
--
ALTER TABLE `avalicao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `profissao`
--
ALTER TABLE `profissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avalicao`
--
ALTER TABLE `avalicao`
  ADD CONSTRAINT `fk_avalicao_cadastro` FOREIGN KEY (`id_cadastro`) REFERENCES `cadastro` (`id`),
  ADD CONSTRAINT `fk_avalicao_vagas` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`id`);

--
-- Limitadores para a tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `fk_cadastro_profissao` FOREIGN KEY (`id_profissao`) REFERENCES `profissao` (`id`);

--
-- Limitadores para a tabela `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `fk_historico_cadastro` FOREIGN KEY (`id_cadastro_user`) REFERENCES `cadastro` (`id`),
  ADD CONSTRAINT `fk_historico_vagas` FOREIGN KEY (`id_vaga_user`) REFERENCES `vagas` (`id`);

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `fk_pagamento_cadastro` FOREIGN KEY (`id_cadastro`) REFERENCES `cadastro` (`id`),
  ADD CONSTRAINT `fk_pagamento_vagas` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
