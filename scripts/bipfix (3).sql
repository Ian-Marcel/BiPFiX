-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/12/2023 às 21:55
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bipfix`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `account`
--

CREATE TABLE `account` (
  `id_name` varchar(20) NOT NULL,
  `pub_name` varchar(255) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `id_odr` int(10) DEFAULT NULL,
  `id_trd` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `account`
--

INSERT INTO `account` (`id_name`, `pub_name`, `passwd`, `id_odr`, `id_trd`) VALUES
('Flavio', 'Flavio', '123', NULL, NULL),
('ian', 'IAN', '123', NULL, NULL),
('matheus', 'MATHEUS', '123', NULL, NULL),
('Matheus1', 'Matheus', '123456', NULL, NULL),
('victor', 'VICTOR', '123', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `account_trade_connection`
--

CREATE TABLE `account_trade_connection` (
  `id_conn_dmp` int(10) NOT NULL,
  `id_trd_conn` int(10) DEFAULT NULL,
  `id_nm_conn` varchar(255) DEFAULT NULL,
  `t_pub_name` varchar(255) DEFAULT NULL,
  `m_pub_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `id_order` int(10) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'created',
  `time_gap` time DEFAULT NULL,
  `v_brl` decimal(6,2) DEFAULT NULL,
  `v_btc` decimal(9,0) DEFAULT NULL,
  `percentage` decimal(4,2) DEFAULT 0.00,
  `id_odr_trd` int(10) DEFAULT NULL,
  `user_identifier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `orders`
--

INSERT INTO `orders` (`id_order`, `type`, `status`, `time_gap`, `v_brl`, `v_btc`, `percentage`, `id_odr_trd`, `user_identifier`) VALUES
(91, 'Venda', 'created', '24:00:00', 22.00, NULL, -11.00, NULL, 'Matheus1'),
(92, 'Compra', 'created', '24:00:00', 31.00, NULL, 20.00, NULL, 'Matheus1'),
(93, 'Compra', 'created', '24:00:00', 11.00, NULL, 9.00, NULL, 'Matheus1'),
(94, 'Venda', 'created', '24:00:00', 85.00, NULL, 10.00, NULL, 'Matheus1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `trade`
--

CREATE TABLE `trade` (
  `id_trade` int(10) NOT NULL,
  `prep_gap` time DEFAULT '02:00:00',
  `trade_gap` time DEFAULT '12:00:00',
  `health` varchar(10) DEFAULT 'healthy',
  `m_guarantee` varchar(255) DEFAULT NULL,
  `t_guarantee` varchar(255) DEFAULT NULL,
  `seller_btc` varchar(1024) DEFAULT NULL,
  `pix_key` varchar(255) DEFAULT NULL,
  `buyer_invoice` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_name`),
  ADD UNIQUE KEY `id_odr` (`id_odr`),
  ADD UNIQUE KEY `id_trd` (`id_trd`);

--
-- Índices de tabela `account_trade_connection`
--
ALTER TABLE `account_trade_connection`
  ADD PRIMARY KEY (`id_conn_dmp`);

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_orders_account` (`user_identifier`);

--
-- Índices de tabela `trade`
--
ALTER TABLE `trade`
  ADD PRIMARY KEY (`id_trade`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `account_trade_connection`
--
ALTER TABLE `account_trade_connection`
  MODIFY `id_conn_dmp` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de tabela `trade`
--
ALTER TABLE `trade`
  MODIFY `id_trade` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_account` FOREIGN KEY (`user_identifier`) REFERENCES `account` (`id_name`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
