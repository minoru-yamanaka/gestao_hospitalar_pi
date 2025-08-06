# **Documentação do Projeto: Sistema de Gestão Hospitalar**

**Versão:** 1.0
**Data:** 1 de agosto de 2025
**Autores:** [Minoru Yamanaka](https://github.com), [Lucimara Dias](https://github.com), [Carlos Gonçalves](https://github.com)

---

## 1. Briefing: Objetivo e Introdução

Este documento detalha a estrutura, funcionalidades e regras de negócio do **Sistema de Gestão Hospitalar**. O objetivo principal do projeto é substituir processos manuais ou descentralizados por uma plataforma web única e segura, garantindo maior eficiência na gestão de dados de pacientes, médicos e consultas, além de assegurar a integridade e a rastreabilidade das informações.

* **Problema:** A gestão de informações hospitalares sem uma ferramenta centralizada pode levar a ineficiências, perda de dados, dificuldade no agendamento e falta de um histórico consolidado dos pacientes.
* **Solução Proposta:** Desenvolver um sistema web com acesso restrito por login e senha, onde administradores possam realizar o cadastro e o gerenciamento completo de pacientes, médicos, convênios associados e o agendamento de consultas.
* **Público-Alvo:** Usuários administrativos responsáveis pela organização e controle dos dados da instituição de saúde.
* **Tecnologias Base:** A aplicação é construída utilizando PHP para o back-end, MySQL para o banco de dados e HTML/CSS para a interface do usuário.

---

## 2. Escopo do Projeto

#### **Dentro do Escopo:**

* Todas as funcionalidades descritas nos Requisitos Funcionais (Autenticação e CRUDs de Pacientes, Médicos, Consultas, Convênios e Endereços).
* Interface web para administração dos dados.

#### **Fora do Escopo:**

* Portal de acesso para pacientes ou médicos.
* Módulo financeiro ou de faturamento de convênios.
* Módulo de controle de estoque de medicamentos ou suprimentos.
* Integração com sistemas de exames laboratoriais.
* Notificações por e-mail ou SMS para lembretes de consulta.

---

### 2.1. Requisitos Funcionais (RF)

* **RF01 - Autenticação de Usuário:**
    * O sistema deve permitir que um usuário se cadastre com nome, e-mail e senha.
    * O sistema deve permitir que um usuário realize login usando e-mail e senha.
    * O sistema deve validar os dados de login e conceder acesso apenas a usuários cadastrados.
    * O sistema deve ter uma funcionalidade de logout que encerre a sessão do usuário.
    * O sistema deve restringir o acesso às páginas de gerenciamento apenas para usuários autenticados.
* **RF02 - Gerenciamento de Pacientes:**
    * O sistema deve permitir o cadastro de novos pacientes com nome, sobrenome, data de nascimento, sexo e data de cadastro.
    * O sistema deve permitir a visualização de todos os pacientes cadastrados em uma lista.
    * O sistema deve permitir a alteração dos dados de um paciente existente.
    * O sistema deve permitir a exclusão de um paciente.
* **RF03 - Gerenciamento de Médicos:**
    * O sistema deve permitir o cadastro de novos médicos com nome, especialidade e CRM.
    * O sistema deve listar todos os médicos cadastrados.
    * O sistema deve permitir a alteração dos dados de um médico existente.
    * O sistema deve permitir a exclusão de um médico.
* **RF04 - Gerenciamento de Consultas:**
    * O sistema deve permitir agendar uma nova consulta, associando um paciente e um médico a uma data, hora e especialidade.
    * O sistema deve listar todas as consultas agendadas.
    * O sistema deve permitir a alteração dos dados de uma consulta.
    * O sistema deve permitir a exclusão (cancelamento) de uma consulta.
* **RF05 - Gerenciamento de Convênios e Endereços:**
    * O sistema deve permitir o cadastro de convênios, associando-os a um paciente.
    * O sistema deve permitir o cadastro de múltiplos endereços, associando-os a um paciente.
    * O sistema deve permitir a visualização, alteração e exclusão de convênios e endereços.

### 2.2. Requisitos Não Funcionais (RNF)

* **RNF01 - Segurança:**
    * As senhas dos usuários devem ser armazenadas no banco de dados de forma criptografada (`password_hash`).
    * A sessão do usuário deve ser mantida por um token seguro gerado aleatoriamente.
* **RNF02 - Usabilidade e Interface:**
    * A interface deve ser intuitiva e de fácil navegação, com um menu consistente em todas as páginas.
    * O sistema deve ser responsivo, adaptando-se a diferentes tamanhos de tela (desktop e mobile).
* **RNF03 - Desempenho:**
    * As consultas ao banco de dados devem ser otimizadas para um tempo de resposta rápido.
    * A conexão com o banco de dados deve ser gerenciada de forma eficiente, utilizando o padrão Singleton para evitar múltiplas conexões desnecessárias.
* **RNF04 - Manutenibilidade:**
    * O código deve ser organizado em camadas (Apresentação, Modelo, DAO), separando as responsabilidades para facilitar futuras manutenções.


### 2.3. Regras de Negócio (RN)

* **RN01 – O acesso ao sistema de gerenciamento é restrito e requer autenticação prévia**
  
   🔐 *Justificativa:* Garante que apenas usuários autorizados possam visualizar, cadastrar ou alterar informações sensíveis, assegurando confidencialidade e integridade dos dados.

* **RN02 – O e-mail de um usuário deve ser único no sistema**
  
   📧 *Justificativa:* Evita conflitos de autenticação e garante a identificação exclusiva de cada usuário, essencial para controle de acesso e rastreabilidade.

* **RN03 – Todos os campos dos formulários de cadastro são obrigatórios**
  
   📝 *Justificativa:* Assegura a consistência e completude dos dados, evitando registros incompletos que possam comprometer operações futuras ou relatórios gerenciais.

* **RN04 – Uma consulta só pode ser agendada se o paciente e o médico já existirem no banco de dados**
  
   🗓️ *Justificativa:* Garante a integridade relacional dos dados e evita agendamentos inválidos ou incoerentes, vinculando apenas registros existentes.

* **RN05 – Um convênio ou endereço só pode ser cadastrado se estiver associado a um paciente existente**
  
   📎 *Justificativa:* Evita dados órfãos no banco de dados, mantendo a coerência e rastreabilidade das informações relacionadas aos pacientes.

* **RN06 – Ao excluir um paciente, todos os seus registros associados (consultas, convênios e endereços) são automaticamente excluídos (ON DELETE CASCADE)**
  
   🧹 *Justificativa:* Garante a limpeza automática dos dados relacionados, evitando resíduos no banco e facilitando a manutenção da integridade dos dados.


### 2.4. Diagrama de Casos de Uso

```
      +-----------+
      |     O     |
      |    /|\    |  <-- Usuário Administrativo
      |    / \    |
      +-----------+
            |
            |---------> (Autenticar-se)
            |
            |---------> (Gerenciar Pacientes)
            |
            |---------> (Gerenciar Médicos)
            |
            |---------> (Gerenciar Consultas)
            |
            +---------> (Gerenciar Dados Associados)
```

* **Ator Principal:** Usuário Administrativo
* **Casos de Uso:**
    * **Autenticar-se:** Inclui as ações de `Login`, `Logout` e `Cadastro`.
    * **Gerenciar Pacientes:** Inclui `Cadastrar`, `Listar`, `Editar` e `Excluir` Paciente.
    * **Gerenciar Médicos:** Inclui `Cadastrar`, `Listar`, `Editar` e `Excluir` Médico.
    * **Gerenciar Consultas:** Inclui `Agendar`, `Listar`, `Editar` e `Cancelar` Consulta.
    * **Gerenciar Dados Associados:** Inclui o gerenciamento de `Convênios` e `Endereços`.

### 2.5. Modelo Conceitual - DER (Diagrama de Entidade-Relacionamento)

Este diagrama representa as principais entidades de dados e como elas se relacionam.

* **Entidades:**
    * `USUARIO` (id, nome, email, senha, token)
    * `PACIENTE` (id, nome, sobrenome, data_nascimento, sexo, data_cadastro)
    * `MEDICO` (id, nome, especialidade, crm)
    * `CONSULTA` (id, data, horas, especialidade)
    * `CONVENIO` (id, empresa, cnpj, telefone, email)
    * `ENDERECO` (id, logradouro, bairro, cidade, estado)
* **Relacionamentos:**
    * Um `PACIENTE` pode ter **muitas** `CONSULTAS`. Uma `CONSULTA` pertence a apenas **um** `PACIENTE` (Relacionamento 1-N).
    * Um `MEDICO` pode realizar **muitas** `CONSULTAS`. Uma `CONSULTA` é realizada por apenas **um** `MEDICO` (Relacionamento 1-N).
    * Um `PACIENTE` pode ter **muitos** `CONVENIOS` (Relacionamento 1-N).
    * Um `PACIENTE` pode ter **muitos** `ENDERECOS` (Relacionamento 1-N).

### 2.6. Diagrama de Classe - MER (Modelo Entidade-Relacionamento de Classes)

Este diagrama descreve a estrutura das classes PHP que representam as entidades e suas operações de acesso a dados.

* **Classe: `Usuario`**
    * Atributos: `-id`, `-nome`, `-email`, `-senha`, `-token`
    * Métodos: `+__construct()`, `+getId()`, `+getNome()`, `+getEmail()`, `+getSenha()`, `+getToken()`
* **Classe: `UsuarioDAO`**
    * Métodos: `+create(Usuario)`, `+updateToken(id, token)`, `+getByEmail(email): Usuario`, `+getByToken(token): Usuario`
* **Classe: `Paciente`**
    * Atributos: `-id`, `-nome`, `-sobrenome`, `-data_nascimento`, `-sexo`, `-data_cadastro`
    * Métodos: `+__construct()`, `+get/set...` para todos os atributos.
* **Classe: `PacienteDAO`**
    * Métodos: `+create(Paciente)`, `+getAll(): Paciente[]`, `+getById(id): Paciente`, `+update(Paciente)`, `+excluir(id)`
* **Classe: `Medico`** (definida como `Medicos` no arquivo)
    * Atributos: `-id`, `-nome`, `-especialidade`, `-crm`
    * Métodos: `+__construct()`, `+get/set...` para todos os atributos.
* **Classe: `MedicoDAO`**
    * Métodos: `+create(Medico)`, `+getAll(): Medico[]`, `+getById(id): Medico`, `+update(Medico)`, `+excluir(id)`
* *(O mesmo padrão de Classes Model e DAO se aplica para `Consulta`, `Convenio` e `Endereco`)*.