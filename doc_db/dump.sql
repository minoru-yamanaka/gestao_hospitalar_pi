
-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS gestao_hospitalar;
USE gestao_hospitalar;

-- Tabela: usuario
CREATE TABLE IF NOT EXISTS usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    email VARCHAR(45),
    senha VARCHAR(150),
    token VARCHAR(150)
);

-- Tabela: pacientes
CREATE TABLE IF NOT EXISTS pacientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    sobrenome VARCHAR(30),
    data_nascimento VARCHAR(20),
    sexo VARCHAR(20),
    data_cadastro VARCHAR(20)
);

-- Tabela: endereco
CREATE TABLE IF NOT EXISTS endereco (
    id INT PRIMARY KEY AUTO_INCREMENT,
    logradouro VARCHAR(45),
    bairro VARCHAR(20),
    cidade VARCHAR(20),
    estado VARCHAR(10),
    paciente_id INT,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
);

-- Tabela: medico
CREATE TABLE IF NOT EXISTS medico (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    especialidade VARCHAR(30),
    crm VARCHAR(20)
);

-- Tabela: convenio
CREATE TABLE IF NOT EXISTS convenio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    empresa VARCHAR(30),
    cnpj VARCHAR(20),
    telefone VARCHAR(20),
    email VARCHAR(20),
    paciente_id INT,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
);

-- Tabela: consulta
CREATE TABLE IF NOT EXISTS consulta (
    id INT PRIMARY KEY AUTO_INCREMENT,
    data DATE,
    horas TIME,
    especialidade VARCHAR(30),
    paciente_id INT,
    medico_id INT,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id),
    FOREIGN KEY (medico_id) REFERENCES medico(id)
);

-- Inserts

INSERT INTO usuario (nome, email, senha, token) VALUES
('João Silva', 'joao@example.com', 'senha123', 'token_abc123'),
('Maria Oliveira', 'maria@example.com', 'senha456', 'token_def456');

INSERT INTO pacientes (nome, sobrenome, data_nascimento, sexo, data_cadastro) VALUES
('Carlos', 'Souza', '1985-06-15', 'Masculino', '2025-06-01'),
('Ana', 'Lima', '1990-11-23', 'Feminino', '2025-06-10');

INSERT INTO endereco (logradouro, bairro, cidade, estado, paciente_id) VALUES
('Rua das Flores', 'Centro', 'São Paulo', 'SP', 1),
('Av. Brasil', 'Copacabana', 'Rio de Janeiro', 'RJ', 2);

INSERT INTO medico (nome, especialidade, crm) VALUES
('Dr. Renato Pereira', 'Cardiologia', 'CRM1234'),
('Dra. Luana Silva', 'Dermatologia', 'CRM5678');

INSERT INTO convenio (empresa, cnpj, telefone, email, paciente_id) VALUES
('Amil', '12.345.678/0001-90', '11987654321', 'contato@amil.com', 1),
('Unimed', '98.765.432/0001-10', '21912345678', 'atendimento@unimed.com', 2);

INSERT INTO consulta (data, horas, especialidade, paciente_id, medico_id) VALUES
('2025-06-20', '09:00:00', 'Cardiologia', 1, 1),
('2025-06-21', '14:00:00', 'Dermatologia', 2, 2);

-- Consultas

-- 1. Todos os usuários
SELECT * FROM usuario;

-- 2. Todos os pacientes com endereços e convênios
SELECT
  p.id AS paciente_id,
  p.nome,
  p.sobrenome,
  p.data_nascimento,
  p.sexo,
  p.data_cadastro,
  e.logradouro,
  e.bairro,
  e.cidade,
  e.estado,
  c.empresa AS convenio_empresa,
  c.cnpj AS convenio_cnpj,
  c.telefone AS convenio_telefone,
  c.email AS convenio_email
FROM pacientes p
LEFT JOIN endereco e ON p.id = e.paciente_id
LEFT JOIN convenio c ON p.id = c.paciente_id;

-- 3. Todos os médicos
SELECT * FROM medico;

-- 4. Todas as consultas com dados do paciente e médico
SELECT
  con.id AS consulta_id,
  con.data,
  con.horas,
  con.especialidade,
  p.nome AS paciente_nome,
  p.sobrenome AS paciente_sobrenome,
  m.nome AS medico_nome,
  m.especialidade AS medico_especialidade,
  m.crm
FROM consulta con
JOIN pacientes p ON con.paciente_id = p.id
JOIN medico m ON con.medico_id = m.id;

-- 5. Todos os convênios com nome do paciente
SELECT
  c.id AS convenio_id,
  c.empresa,
  c.cnpj,
  c.telefone,
  c.email,
  p.nome AS paciente_nome,
  p.sobrenome AS paciente_sobrenome
FROM convenio c
JOIN pacientes p ON c.paciente_id = p.id;

-- 6. Todos os endereços com nome do paciente
SELECT
  e.id AS endereco_id,
  e.logradouro,
  e.bairro,
  e.cidade,
  e.estado,
  p.nome AS paciente_nome,
  p.sobrenome AS paciente_sobrenome
FROM endereco e
JOIN pacientes p ON e.paciente_id = p.id;
