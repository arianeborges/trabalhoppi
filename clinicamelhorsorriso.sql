-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Jun-2018 às 04:59
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicamelhorsorriso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `codAgendamento` int(11) NOT NULL,
  `dataconsulta` date NOT NULL,
  `horario` int(11) NOT NULL,
  `codFuncionario` int(11) NOT NULL,
  `codPaciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `data` date NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `motivo` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mensagem` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`nome`, `data`, `email`, `motivo`, `mensagem`) VALUES
('Ariane Santos Borges', '2018-06-01', 'ariianeboorges@gmail.com', 'elogio', 'A Clínica Melhor Sorriso possui um ótimo serviço de qualidade e possui profissionais excelentes!!'),
('Weuler', '2018-06-01', 'filhoweuler@outlook.com', 'duvida', 'Quais convênios vocês aceitam?');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecofunc`
--

CREATE TABLE `enderecofunc` (
  `id_funcionario` int(11) NOT NULL,
  `cep` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `estado` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cidade` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `bairro` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tipologradouro` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `logradouro` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `enderecofunc`
--

INSERT INTO `enderecofunc` (`id_funcionario`, `cep`, `estado`, `cidade`, `bairro`, `tipologradouro`, `logradouro`, `numero`, `complemento`) VALUES
(1, '38408-734', 'MG', 'Uberlandia', 'Santa Monica', 'Rua', 'Maria Dirce Ribeiro', 295, 'apto 302'),
(2, '38408-194', 'MG', 'Uberlandia', 'Santa Monica', 'Rua', 'Maria Dirce Ribeiro', 295, 'apto 302');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `datanascimento` date NOT NULL,
  `sexo` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `estadocivil` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cargo` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `especialidade` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cpf` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rg` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `outro` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `nome`, `datanascimento`, `sexo`, `estadocivil`, `cargo`, `especialidade`, `cpf`, `rg`, `outro`) VALUES
(1, 'Ariane Santos Borges', '1995-04-14', 'F', 'Solteira', 'Secretaria', '', '120.738.476-33', '18.548.244', ''),
(2, 'Weuler Borges Santos Filho', '1995-08-03', 'M', 'Solteiro', 'Dentista', 'Ortodentista', '998.227.406-62', '12.482.399-3', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `telefone` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `login` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `senha` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`login`, `senha`) VALUES
('ariane', 'ariane');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`codAgendamento`),
  ADD UNIQUE KEY `unique_hora_func_paciente` (`dataconsulta`,`horario`,`codFuncionario`),
  ADD KEY `fk_funcionario_agenda` (`codFuncionario`),
  ADD KEY `fk_paciente_agenda` (`codPaciente`);

--
-- Indexes for table `enderecofunc`
--
ALTER TABLE `enderecofunc`
  ADD KEY `fk_id_funcionario` (`id_funcionario`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `codAgendamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `fk_funcionario_agenda` FOREIGN KEY (`codFuncionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `fk_paciente_agenda` FOREIGN KEY (`codPaciente`) REFERENCES `paciente` (`id`);

--
-- Limitadores para a tabela `enderecofunc`
--
ALTER TABLE `enderecofunc`
  ADD CONSTRAINT `fk_id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
