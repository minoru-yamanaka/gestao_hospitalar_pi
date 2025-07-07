### 💾 Nome do banco de dados: `gestao_hospitalar`

---

# 🧱 **Entidades e Relacionamentos**

### 🔹 1. `usuario`

Representa os usuários do sistema (como administradores ou operadores).

**Campos:**

* `id`: Identificador único.
* `nome`: Nome do usuário.
* `email`: Email de login.
* `senha`: Senha do sistema.
* `token`: Token de autenticação.

---

### 🔹 2. `pacientes`

Representa os pacientes cadastrados no hospital.

**Campos:**

* `id`: Identificador único do paciente.
* `nome`: Nome do paciente.
* `sobrenome`: Sobrenome do paciente.
* `data_nascimento`: Data de nascimento.
* `sexo`: Gênero do paciente.
* `data_cadastro`: Quando o paciente foi registrado.

---

### 🔹 3. `endereco`

Representa os endereços dos pacientes.

**Campos:**

* `id`: Identificador único.
* `logradouro`: Nome da rua.
* `bairro`: Bairro.
* `cidade`: Cidade.
* `estado`: Estado.
* `paciente_id`: Chave estrangeira referenciando `pacientes(id)`.

🔗 **Relacionamento**: Muitos endereços para um paciente (1\:N).

---

### 🔹 4. `medico`

Representa os médicos do hospital.

**Campos:**

* `id`: Identificador único do médico.
* `nome`: Nome do médico.
* `especialidade`: Área de atuação (ex: cardiologia).
* `crm`: Número de registro no CRM.

---

### 🔹 5. `convenio`

Representa convênios (planos de saúde) dos pacientes.

**Campos:**

* `id`: Identificador único.
* `empresa`: Nome da operadora.
* `cnpj`: CNPJ da operadora.
* `telefone`: Contato.
* `email`: Email do plano.
* `paciente_id`: Chave estrangeira referenciando `pacientes(id)`.

🔗 **Relacionamento**: Muitos convênios para um paciente (1\:N).

---

### 🔹 6. `consulta`

Representa as consultas médicas realizadas.

**Campos:**

* `id`: Identificador único.
* `data`: Data da consulta.
* `horas`: Horário da consulta.
* `especialidade`: Especialidade da consulta.
* `paciente_id`: Chave estrangeira referenciando `pacientes(id)`.
* `medico_id`: Chave estrangeira referenciando `medico(id)`.

🔗 **Relacionamentos**:

* Muitos para um paciente (N:1).
* Muitos para um médico (N:1).


# 🧾 **Script SQL**

```sql
CREATE DATABASE gestao_hospitalar;
USE gestao_hospitalar;

CREATE TABLE usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    email VARCHAR(45),
    senha VARCHAR(150),
    token VARCHAR(150)
);

CREATE TABLE pacientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    sobrenome VARCHAR(30),
    data_nascimento VARCHAR(20),
    sexo VARCHAR(20),
    data_cadastro VARCHAR(20)
);

CREATE TABLE endereco (
    id INT PRIMARY KEY AUTO_INCREMENT,
    logradouro VARCHAR(45),
    bairro VARCHAR(20),
    cidade VARCHAR(20),
    estado VARCHAR(10),
    paciente_id INT,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
);

CREATE TABLE medico (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    especialidade VARCHAR(30),
    crm VARCHAR(20)
);

CREATE TABLE convenio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    empresa VARCHAR(30),
    cnpj VARCHAR(20),
    telefone VARCHAR(20),
    email VARCHAR(20),
    paciente_id INT,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
);

CREATE TABLE consulta (
    id INT PRIMARY KEY AUTO_INCREMENT,
    data DATE,
    horas TIME,
    especialidade VARCHAR(30),
    paciente_id INT,
    medico_id INT,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id),
    FOREIGN KEY (medico_id) REFERENCES medico(id)
);
```

# 📥 **INSERTs – Dados Fictícios**

```sql
-- Usuários do sistema
INSERT INTO usuario (nome, email, senha, token) VALUES
('João Silva', 'joao@example.com', 'senha123', 'token_abc123'),
('Maria Oliveira', 'maria@example.com', 'senha456', 'token_def456');

-- Pacientes
INSERT INTO pacientes (nome, sobrenome, data_nascimento, sexo, data_cadastro) VALUES
('Carlos', 'Souza', '1985-06-15', 'Masculino', '2025-06-01'),
('Ana', 'Lima', '1990-11-23', 'Feminino', '2025-06-10');

-- Endereços dos pacientes
INSERT INTO endereco (logradouro, bairro, cidade, estado, paciente_id) VALUES
('Rua das Flores', 'Centro', 'São Paulo', 'SP', 1),
('Av. Brasil', 'Copacabana', 'Rio de Janeiro', 'RJ', 2);

-- Médicos
INSERT INTO medico (nome, especialidade, crm) VALUES
('Dr. Renato Pereira', 'Cardiologia', 'CRM1234'),
('Dra. Luana Silva', 'Dermatologia', 'CRM5678');

-- Convênios dos pacientes
INSERT INTO convenio (empresa, cnpj, telefone, email, paciente_id) VALUES
('Amil', '12.345.678/0001-90', '11987654321', 'contato@amil.com', 1),
('Unimed', '98.765.432/0001-10', '21912345678', 'atendimento@unimed.com', 2);

-- Consultas
INSERT INTO consulta (data, horas, especialidade, paciente_id, medico_id) VALUES
('2025-06-20', '09:00:00', 'Cardiologia', 1, 1),
('2025-06-21', '14:00:00', 'Dermatologia', 2, 2);
```

# 🔎 **Consultas SQL completas (Listagens com todos os dados)**

### 1. 📄 Listar todos os **usuários**

```sql
SELECT * FROM usuario;
```

---

### 2. 🧍‍♂️ Listar todos os **pacientes com seus endereços e convênios**

```sql
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
```

---

### 3. 🩺 Listar todos os **médicos**

```sql
SELECT * FROM medico;
```

---

### 4. 📆 Listar todas as **consultas com dados do paciente e do médico**

```sql
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
```

---

### 5. 📋 Listar todos os **convênios com o nome do paciente associado**

```sql
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
```

---

### 6. 🏠 Listar todos os **endereços com o nome do paciente**

```sql
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
```
