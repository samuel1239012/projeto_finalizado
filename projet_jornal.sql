-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Mar-2024 às 21:28
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projet_jornal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastre-se`
--

CREATE TABLE `cadastre-se` (
  `pk_id` int(11) NOT NULL,
  `e_mail` varchar(220) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `senha` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cinema`
--

CREATE TABLE `cinema` (
  `pk_id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `sinopse` varchar(300) NOT NULL,
  `elenco` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `pk_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `email` varchar(220) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `token` varchar(12) NOT NULL,
  `habilita` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`pk_id`, `nome`, `cpf`, `whatsapp`, `email`, `senha`, `token`, `habilita`) VALUES
(1, 'Samuel', '222225678912', '341242344234', 'teste@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 1),
(3, 'douvlis', '12345678912', '12996568721', 'testando@gmail.com', '173af653133d964edfc16cafe0aba33c8f500a07f3ba3f81943916910c257705', '', 1),
(16, 'ter2ça', '57107273850', '12345', 'terça@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `destaque_home`
--

CREATE TABLE `destaque_home` (
  `pk_id` int(11) NOT NULL,
  `fk_noticia` int(11) NOT NULL,
  `fk_redacao` int(11) NOT NULL,
  `habilita` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `destaque_home`
--

INSERT INTO `destaque_home` (`pk_id`, `fk_noticia`, `fk_redacao`, `habilita`) VALUES
(2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `generos`
--

CREATE TABLE `generos` (
  `pk_id` int(11) NOT NULL,
  `tipo_genero` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `generos`
--

INSERT INTO `generos` (`pk_id`, `tipo_genero`) VALUES
(3, 'Automobilismo'),
(11, 'Cultura'),
(5, 'Economia'),
(1, 'Esporte'),
(10, 'Politica'),
(4, 'Tecnologia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `pk_id` int(11) NOT NULL,
  `palavra_chave` varchar(200) NOT NULL,
  `texto` text NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `sub_titulo` varchar(300) NOT NULL,
  `data_postagem` datetime DEFAULT NULL,
  `imagem` varchar(100) NOT NULL,
  `fk_generos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`pk_id`, `palavra_chave`, `texto`, `titulo`, `sub_titulo`, `data_postagem`, `imagem`, `fk_generos`) VALUES
(1, 'Teste, Testando, Testar', 'Testando algo que ainda não foi implementado na face da terra!', 'Ratanabá', 'Teste', '2024-03-11 13:49:03', 'assets/img/noticia/Qpnj1tzb-480x480-480x480.webp', 1),
(5, 'dasdasdasdas', 'sssesadasas', 'dsdsadsadsdsadsdd', 'dsadsadsadasd', '2024-03-08 14:54:36', 'assets/img/noticia/Qpnj1tzb-480x480-480x480.webp', 2),
(6, 'erwerwerwe', 'erwerwer', 'rwerwerwer', 'rwerwerwe', '2024-03-11 16:19:37', 'assets/img/noticia/i257652.jpeg', 3),
(7, 'sadasdasd', 'assadsa', 'dsdasdasd', 'dasdasdas', '2024-03-11 16:26:56', 'assets/img/noticia/i257652.jpeg', 1),
(8, 'weqweqwewq', 'weqweqwewqe', 'wqewqeqweqwe', 'wqewqewqe', '2024-03-11 16:27:33', 'api_jornal/noticia/imgQpnj1tzb-480x480-480x480.webp', 5),
(9, 'dasdasdsad', 'asdasdasds', 'dasdasdsadsa', 'dsadasdasd', '2024-03-11 16:35:39', 'C:/xampp/htdocs/api_jornal/noticia/imgi257652.jpeg', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `redacao`
--

CREATE TABLE `redacao` (
  `pk_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `salario` float NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `redacao`
--

INSERT INTO `redacao` (`pk_id`, `nome`, `salario`, `telefone`, `cpf`) VALUES
(1, 'Samuel', 4500, '1299676253015', '12345678912'),
(2, 'victor@gmail.com', 1234, '1', '57107273850');

-- --------------------------------------------------------

--
-- Estrutura da tabela `revisor`
--

CREATE TABLE `revisor` (
  `pk_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `salario` float NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `revisor`
--

INSERT INTO `revisor` (`pk_id`, `nome`, `salario`, `telefone`, `cpf`) VALUES
(1, 'victor@gmail.com', 1234, '1', '57107273850');

-- --------------------------------------------------------

--
-- Estrutura da tabela `token`
--

CREATE TABLE `token` (
  `pk_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `token` varchar(12) NOT NULL,
  `data_criacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `token`
--

INSERT INTO `token` (`pk_id`, `email`, `cpf`, `token`, `data_criacao`) VALUES
(1, 'Da@gmail.com', '12012316578', 'f6a95880e88e', '2024-02-08 13:56:21'),
(6, 'bashsaudhasudh@gmail.com', '42432423432423', '4e692ca25aba', '2024-02-08 14:22:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `pk_id` int(11) NOT NULL,
  `e_mail` varchar(220) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `habilita` smallint(6) NOT NULL,
  `recuperar_senha` varchar(30) NOT NULL,
  `cargo` varchar(80) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`pk_id`, `e_mail`, `senha`, `habilita`, `recuperar_senha`, `cargo`, `cpf`, `codigo`, `nome`) VALUES
(2, 'costasamuca8@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, '', 'ADM', '13580593650', 'a90a9d', 'Samuel'),
(22, 'sdfsdfdfsd@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '', 'REDACAO', '2', '', 'gdfgfdg'),
(23, 'samuel@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '', 'REVISOR', '3', '', 'zxcxzczxc'),
(25, 'victor@gmail.com', '1234', 1, '', 'FUNCIONARIO', '142', '', 'eweweq'),
(29, 'terça@gmail.com', '1234', 1, '', 'FUNCIONARIO', '57107273850', '', 'Jul'),
(31, 'wrew@gmail', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0, '', 'FUNCIONARI', '571273850', '', 'wqeqeqwewq');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastre-se`
--
ALTER TABLE `cadastre-se`
  ADD PRIMARY KEY (`pk_id`);

--
-- Índices para tabela `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`pk_id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`pk_id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `whatsapp` (`whatsapp`);

--
-- Índices para tabela `destaque_home`
--
ALTER TABLE `destaque_home`
  ADD PRIMARY KEY (`pk_id`);

--
-- Índices para tabela `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`pk_id`),
  ADD UNIQUE KEY `tipo_genero` (`tipo_genero`);

--
-- Índices para tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`pk_id`);

--
-- Índices para tabela `redacao`
--
ALTER TABLE `redacao`
  ADD PRIMARY KEY (`pk_id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Índices para tabela `revisor`
--
ALTER TABLE `revisor`
  ADD PRIMARY KEY (`pk_id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Índices para tabela `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`pk_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`pk_id`),
  ADD UNIQUE KEY `e_mail` (`e_mail`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastre-se`
--
ALTER TABLE `cadastre-se`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cinema`
--
ALTER TABLE `cinema`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `destaque_home`
--
ALTER TABLE `destaque_home`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `generos`
--
ALTER TABLE `generos`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `redacao`
--
ALTER TABLE `redacao`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `revisor`
--
ALTER TABLE `revisor`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `token`
--
ALTER TABLE `token`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
