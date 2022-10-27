-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Set-2022 às 01:01
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `qualeaboa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `nome_evento` text NOT NULL,
  `data_evento` date NOT NULL,
  `hora` time(6) NOT NULL,
  `local_evento` varchar(100) NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `classificacao_indicativa` int(2) NOT NULL,
  `cidade` text NOT NULL,
  `assunto` text NOT NULL,
  `descricao` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`nome_evento`, `data_evento`, `hora`, `local_evento`, `preco`, `classificacao_indicativa`, `cidade`, `assunto`, `descricao`) VALUES
('IF IN CONCERT', '2022-09-30', '23:30:00.000000', 'Estr. Washington Luís ', '45', 12, 'Niterói', 'Música', 'Evento voltado para amantes de música'),
('Rock in RIo', '2022-09-08', '23:08:00.000000', 'Casa de portela', '250', 18, 'Rio de Janeiro', 'Música', 'ntes da música'),
('IF IN CONCERT', '2022-09-30', '16:50:00.000000', 'IFRJ cnit', '0', 18, 'Niterói', 'Música', 'Muita música ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `login` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varbinary(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`login`),
  ADD UNIQUE KEY `login` (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
