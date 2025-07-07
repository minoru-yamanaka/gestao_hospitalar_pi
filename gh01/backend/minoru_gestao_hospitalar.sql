-- Nota; Rodando OK

-- http://localhost/phpmyadmin/

-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS gestaodb;
USE gestaodb;

-- Configurações iniciais
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- ============================
-- TABELA: pacientes
-- ============================
CREATE TABLE pacientes (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(45) NOT NULL,
  sobrenome VARCHAR(30) NOT NULL,
  data_nascimento DATE NOT NULL,
  sexo VARCHAR(20) NOT NULL,
  data_cadastro DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pacientes (nome, sobrenome, data_nascimento, sexo, data_cadastro) VALUES
('Tiago Cardoso', 'Gonçalves', '1989-05-05', 'masculino', '2025-06-11'),
('Natalia Cardoso', 'Gonçalves', '1997-11-17', 'feminino', '2025-06-11'),
('João Pedro', 'Silva Santos', '1990-04-12', 'masculino', '2025-06-28'),
('Ana Beatriz', 'Oliveira Costa', '1985-09-23', 'feminino', '2025-06-28'),
('Lucas Henrique', 'Pereira Lima', '2000-01-15', 'masculino', '2025-06-28'),
('Mariana Souza', 'Almeida', '1993-08-30', 'feminino', '2025-06-28'),
('Carlos Eduardo', 'Rocha Mendes', '1978-05-10', 'masculino', '2025-06-28'),
('Patrícia Gomes', 'Fernandes', '1989-11-11', 'feminino', '2025-06-28'),
('Bruno César', 'Vieira Matos', '1995-03-05', 'masculino', '2025-06-28'),
('Fernanda Dias', 'Camargo', '1996-07-19', 'feminino', '2025-06-28'),
('Rodrigo Nascimento', 'Barros', '1982-12-25', 'masculino', '2025-06-28'),
('Juliana Martins', 'Silveira', '1991-06-06', 'feminino', '2025-06-28');

-- ============================
-- TABELA: medico
-- ============================
CREATE TABLE medico (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(45) NOT NULL,
  especialidade VARCHAR(30) NOT NULL,
  crm VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO medico (nome, especialidade, crm) VALUES
('Dra. Mariana Silva', 'Pediatria', '123456-SP'),
('Dr. Carlos Eduardo', 'Cardiologia', '234567-SP'),
('Dra. Fernanda Lima', 'Ginecologia', '345678-SP'),
('Dr. João Mendes', 'Ortopedia', '456789-SP'),
('Dra. Paula Nogueira', 'Dermatologia', '567890-SP'),
('Dr. Rafael Torres', 'Neurologia', '678901-SP'),
('Dr. André Costa', 'Clínico Geral', '789012-SP'),
('Dra. Camila Rocha', 'Endocrinologia', '890123-SP'),
('Dr. Felipe Martins', 'Psiquiatria', '901234-SP'),
('Dra. Juliana Ribeiro', 'Oftalmologia', '012345-SP');

-- ============================
-- TABELA: consultas
-- ============================
CREATE TABLE consultas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  data DATE NOT NULL,
  horas TIME NOT NULL,
  especialidade VARCHAR(20) NOT NULL,
  paciente_id INT NOT NULL,
  medico_id INT NOT NULL,
  FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
  FOREIGN KEY (medico_id) REFERENCES medico(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO consultas (data, horas, especialidade, paciente_id, medico_id) VALUES
('2025-07-01', '09:00:00', 'Pediatria', 1, 1),
('2025-07-02', '10:30:00', 'Cardiologia', 1, 2),
('2025-07-03', '14:00:00', 'Ginecologia', 2, 3),
('2025-07-04', '16:15:00', 'Ortopedia', 1, 4),
('2025-07-05', '08:45:00', 'Dermatologia', 2, 5),
('2025-07-06', '11:00:00', 'Neurologia', 1, 6),
('2025-07-07', '13:30:00', 'Clínico Geral', 2, 7),
('2025-07-08', '15:00:00', 'Endocrinologia', 1, 8),
('2025-07-09', '09:15:00', 'Psiquiatria', 2, 9),
('2025-07-10', '10:00:00', 'Oftalmologia', 1, 10);

-- ============================
-- TABELA: convenio
-- ============================
CREATE TABLE convenio (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  empresa VARCHAR(30) NOT NULL,
  cnpj VARCHAR(20) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  email VARCHAR(50) NOT NULL,
  paciente_id INT NOT NULL,
  FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO convenio (empresa, cnpj, telefone, email, paciente_id) VALUES
('Unimed', '46.124.624/0001-11', '1343789060', 'unimed@ig.com.br', 1),
('Amil', '23.456.789/0001-02', '11981234567', 'suporte@amil.com.br', 2),
('Bradesco Saúde', '34.567.890/0001-03', '1133224455', 'info@bradescosaude.com.br', 3),
('NotreDame Intermédica', '45.678.901/0001-04', '1144556677', 'atendimento@intermedica.com.br', 4),
('SulAmérica', '56.789.012/0001-05', '1122334455', 'cliente@sulamerica.com.br', 5),
('Hapvida', '67.890.123/0001-06', '1188776655', 'hapvida@hapvida.com.br', 6),
('São Cristóvão', '78.901.234/0001-07', '1177665544', 'contato@saocristovao.com.br', 7),
('Prevent Senior', '89.012.345/0001-08', '1166554433', 'cadastro@preventsenior.com.br', 8),
('Porto Saúde', '90.123.456/0001-09', '1155443322', 'porto@portosaude.com.br', 9),
('Greenline', '01.234.567/0001-10', '1144332211', 'green@greenline.com.br', 10),
('Notredame', '22.333.444/0001-11', '1199338877', 'contact@notredame.com.br', 11),
('CarePlus', '11.222.333/0001-44', '1199776655', 'careplus@care.com.br', 12);

-- ============================
-- TABELA: endereco
-- ============================
CREATE TABLE endereco (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  logradouro VARCHAR(45) NOT NULL,
  bairro VARCHAR(20) NOT NULL,
  cidade VARCHAR(20) NOT NULL,
  estado VARCHAR(10),
  paciente_id INT NOT NULL,
  FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO endereco (logradouro, bairro, cidade, estado, paciente_id) VALUES
('Rua Vitória 76', 'Pq Montreal', 'Franco da Rocha', 'SP', 1),
('Rua das Rosas', 'Jardim das Flores', 'São Paulo', 'SP', 2),
('Av. Brasil', 'Centro', 'Campinas', 'SP', 3),
('Rua das Palmeiras', 'Boa Vista', 'Santos', 'SP', 4),
('Av. Paulista', 'Bela Vista', 'São Paulo', 'SP', 5);

-- ============================
-- TABELA: usuario
-- ============================
CREATE TABLE usuario (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(45) NOT NULL,
  email VARCHAR(45) NOT NULL UNIQUE,
  senha VARCHAR(150) NOT NULL,
  token VARCHAR(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usuario (id, nome, email, senha, token) VALUES
(0, 'Carlos Alexandre', 'carllos3939@gmail.com', '$2y$10$m02fCR8qbpdkSO0zEsrnZeBSYn1NuJLha2TsCpYPSd20I3x/T/YWK', '19533476811494356b42fabf31ab01b724d4293eb8cd68a3f5');

COMMIT;
