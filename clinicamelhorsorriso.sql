-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Jun-2018 às 14:18
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
  `horaconsulta` int(11) NOT NULL,
  `codFuncionario` int(11) NOT NULL,
  `codPaciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agenda`
--

INSERT INTO `agenda` (`codAgendamento`, `dataconsulta`, `horaconsulta`, `codFuncionario`, `codPaciente`) VALUES
(5, '2018-06-07', 8, 3, 7),
(6, '2018-06-07', 9, 3, 8),
(7, '2018-06-14', 15, 2, 9);

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
('Weuler', '2018-06-01', 'filhoweuler@outlook.com', 'duvida', 'Quais convênios vocês aceitam?'),
('Bernardo Giovanni', '2018-06-05', 'bernardogiovannimanuelcaldeira_@recatec.com.br', 'reclamar', 'Gostaria de dizer que os banheiros estavam muito sujos quando fui ai dia 06/04/2018. Decepcionado!!'),
('Adriana Moreira', '2018-06-05', 'adrianamoreira_@veraparodi.com.br', 'elogio', 'Excelente atendimento!!!'),
('', '2018-06-05', '', '', ''),
('Sophie Gomes', '2018-06-05', 'sophiegomes@projetemovelaria.com.br', 'duvida', 'Precisa ter login para agendar uma consulta??'),
('', '2018-06-05', '', '', ''),
('Vicente ClÃ¡udio', '2018-06-05', 'vicenteclaudio@gmail.com', 'sugestao', 'Por favor, sirvam cafÃ©zinho!!'),
('', '2018-06-05', '', '', '');

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
(2, '38408-194', 'MG', 'Uberlandia', 'Santa Monica', 'Rua', 'Maria Dirce Ribeiro', 295, 'apto 302'),
(3, '38411759', 'MG', 'Uberlandia', 'Shopping Park', 'Rua', 'Ailton Rodrigues de Sousa', 123, ''),
(4, '38413-313', 'MG', 'UberlÃ¢ndia', 'ChÃ¡caras Tubalina e Quartel', 'Rua', 'Alameda Serra do Japi', 145, ''),
(5, '38409-049', 'MG', 'UberlÃ¢ndia', 'Novo Mundo', 'Rua', 'Ricardo Naves GonÃ§alves', 249, ''),
(6, '38400-714', 'MG', 'UberlÃ¢ndia', 'Brasil', 'Avenida', 'JoÃ£o Pinheiro', 658, ''),
(7, '38402-188', 'MG', 'UberlÃ¢ndia', 'Minas Brasil', 'Rua', 'Betim Paes Leme', 555, ''),
(8, '38401-218', 'MG', 'UberlÃ¢ndia', 'Presidente Roosevelt', 'Rua', 'Professora Alfredina Rezende Alvim', 843, ''),
(9, '38408-516', 'MG', 'UberlÃ¢ndia', 'Lagoinha', 'Rua', 'Ãlvares de Azevedo', 720, '');

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
(2, 'Weuler Borges Santos Filho', '1995-08-03', 'M', 'Solteiro', 'Dentista', 'Ortodontista', '998.227.406-62', '12.482.399-3', ''),
(3, 'VitÃ³ria Freitas', '1985-06-12', 'F', 'Solteiro', 'Dentista', 'CirurgiaoDentista', '483.493.956-13', '12.400.110-5', ''),
(4, 'Julia Sebastiana Almada', '1980-02-14', 'F', 'Casado', 'Dentista', 'Odontohebiatria', '458.135.736-58', '20.672.915-7', ''),
(5, 'Pedro JosÃ© JoÃ£o Ferreira', '1985-08-11', 'M', 'Divorciado', 'Dentista', 'OdontologiaEstÃ©tica', '722.804.346-44', '27.895.447-9', ''),
(6, 'Luiz Henry Moreira', '1985-08-03', 'M', 'Casado', 'Dentista', 'Endodontista', '145.123.556-93', '16.028.804-6', ''),
(7, 'Hadassa Jaqueline', '1977-03-03', 'F', 'Viuvo', 'Dentista', 'Periodontista', '154.448.586-73', '50.496.631-5', ''),
(8, 'Helena Baptista', '1988-01-01', 'F', 'Casado', 'Dentista', 'Protesista', '636.832.676-07', '32.355.344-8', ''),
(9, 'Danilo Levi Iago da ConceiÃ§Ã£o', '1977-06-08', 'M', 'Casado', 'Dentista', 'Implantodontista', '386.369.286-13', '43.249.754-7', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `paciente` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `telefone` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `paciente`
--

INSERT INTO `paciente` (`id`, `paciente`, `telefone`) VALUES
(1, '', ''),
(2, '', ''),
(3, '', ''),
(4, '', ''),
(5, '', ''),
(6, 'Ariane Santos Borges', '34 992004082'),
(7, 'Ariane Santos Borges', '34 992004082'),
(8, 'Weuler Borges Santos Filho', '34 996343009'),
(9, 'LÃºcia Josefa Teresinha Dias', '34 3637-6829');

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
  ADD UNIQUE KEY `unique_hora_func_paciente` (`dataconsulta`,`horaconsulta`,`codFuncionario`),
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
  MODIFY `codAgendamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
