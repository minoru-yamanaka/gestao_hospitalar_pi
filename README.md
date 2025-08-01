# [ Sistema de Gestão Hospitalar](https://gestaohospitalarsenacpi.minoruyamanaka.com.br/)

Este é um projeto de um sistema de gestão hospitalar desenvolvido em PHP, que permite o gerenciamento de pacientes, médicos, convênios, consultas e endereços. O sistema possui uma interface web para interação e um banco de dados MySQL para persistência dos dados.

[Veja o PDF do projeto](/GESTAO%20HOSPITALAR.pdf)


## Funcionalidades Principais

* **Autenticação de Usuário**: Sistema seguro com funcionalidades de login, logout e cadastro de novos usuários. O acesso às funcionalidades principais é restrito a usuários autenticados.
* **Gerenciamento de Pacientes**: Funcionalidades completas de Criar, Ler, Atualizar e Excluir (CRUD) para os registros de pacientes.
* **Gerenciamento de Médicos**: CRUD completo para os registros de médicos, incluindo nome, especialidade e CRM.
* **Gerenciamento de Convênios**: CRUD para os convênios, permitindo associá-los aos pacientes cadastrados.
* **Gerenciamento de Endereços**: CRUD para os endereços, que são vinculados diretamente aos pacientes.
* **Agendamento de Consultas**: Sistema de CRUD para agendamento de consultas, associando um paciente a um médico em uma data e hora específicas.

## Tecnologias Utilizadas

* **Back-end**: PHP
* **Front-end**: HTML e CSS
* **Banco de Dados**: MySQL

## Estrutura do Projeto

O projeto é organizado seguindo uma arquitetura que separa as responsabilidades em diferentes camadas:

* **/frontend**: Contém os arquivos PHP responsáveis pela interface com o usuário, como formulários de cadastro/edição e páginas de listagem de dados.
* **/backend/Model**: Classes PHP que representam as entidades do banco de dados (ex: Paciente, Medico). Elas definem a estrutura dos dados.
* **/backend/DAO**: (Data Access Object) Classes responsáveis por toda a comunicação com o banco de dados. Contêm as queries SQL para as operações de CRUD.
* **/css**: Contém a folha de estilo (`style.css`) que define a aparência de todo o sistema.
* **Arquivos na raiz**: Incluem a página principal (`index.php`), o script de conexão com o banco (`Conexao.php`) e os scripts de autenticação.

## Como Executar o Projeto Localmente

Siga os passos abaixo para configurar e executar o projeto em seu ambiente local.

### 1. Pré-requisitos
Certifique-se de ter um ambiente de servidor local instalado, como XAMPP, WAMP ou MAMP, que inclua:
* PHP
* MySQL (ou MariaDB)
* phpMyAdmin (recomendado)

### 2. Configuração do Banco de Dados
1.  Inicie seu servidor Apache e MySQL.
2.  Acesse o phpMyAdmin.
3.  Crie um novo banco de dados com o nome `gestao_hospitalar`.
4.  Selecione o banco de dados recém-criado e vá para a aba "Importar".
5.  Importe o arquivo `minoru_gestao_hospitalar.sql` para criar todas as tabelas e inserir os dados iniciais.

### 3. Configuração do Projeto
1.  Copie todos os arquivos do projeto para o diretório raiz do seu servidor web (ex: `htdocs` no XAMPP).
2.  Abra o arquivo `Conexao.php`.
3.  Verifique se as credenciais de conexão com o banco de dados correspondem à sua configuração local. A configuração padrão é:
    * `$host="localhost"`
    * `$bd="gestao_hospitalar"`
    * `$user="root"`
    * `$pass=""`

### 4. Acesso ao Sistema
Após a configuração, você pode acessar o sistema através do seu navegador.

* **URL Local**: `http://localhost/caminho/para/o/projeto/`
* **Criar um Usuário**: Para acessar as funcionalidades do sistema, utilize a página de "Cadastrar-se" para criar uma nova conta de usuário.

## Links do Projeto

URL de Produção: 
````
https://gestaohospitalarsenacpi.minoruyamanaka.com.br/
````


### Arquitetura do Projeto

O sistema foi desenvolvido seguindo uma arquitetura em camadas, separando as responsabilidades para facilitar a manutenção e escalabilidade. As camadas principais são: Apresentação (View), Lógica de Controle (Controller), Acesso a Dados (DAO) e Modelo (Model).

#### 1\. Camada de Apresentação (View)

Esta camada é responsável por toda a interação com o usuário. É composta por arquivos HTML, CSS e PHP que renderizam as páginas.

  * **Responsabilidade**: Exibir dados ao usuário e capturar suas entradas por meio de formulários e botões.
  * **Componentes**:
      * **Páginas de Interface (`/frontend/*.php`)**: Arquivos que contêm a estrutura HTML das páginas de listagem (`lista_*.php`) e dos formulários (`form_*.php`).
      * **Páginas de Autenticação (`/frontend/*.php`)**: Telas de `login.php`, `cadastro.php` e `usuario.php`.
      * **Página Principal (`index.php`)**: Funciona como o ponto de entrada e painel principal do sistema.
      * **Estilização (`/css/style.css`)**: Define toda a aparência visual da aplicação.

#### 2\. Camada de Lógica de Controle (Controller)

Embora não haja um framework MVC formal com uma pasta "Controllers", a lógica de controle está implementada no topo dos próprios arquivos da camada de apresentação.

  * **Responsabilidade**: Receber as requisições do usuário (ex: um envio de formulário), processar os dados, interagir com a camada DAO para buscar ou salvar informações e, por fim, direcionar o usuário para a página correta.
  * **Exemplo**: O arquivo `form_paciente.php` contém no topo um bloco de código PHP que verifica se a requisição é do tipo `POST`. Se for, ele coleta os dados do formulário, instancia um objeto `Paciente` e chama o `PacienteDAO` para salvar os dados no banco.

#### 3\. Camada de Modelo (Model)

Esta camada representa as entidades de dados do sistema. São classes PHP simples que contêm propriedades e métodos `get/set`.

  * **Responsabilidade**: Estruturar os dados da aplicação, servindo como um "molde" para os objetos que são transportados entre as camadas (ex: do DAO para a View).
  * **Componentes (`/backend/Model/*.php`)**:
      * `Paciente.php`
      * `Medico.php`
      * `Consulta.php`
      * `Convenio.php`
      * `Endereco.php`
      * `Usuario.php`

#### 4\. Camada de Acesso a Dados (DAO - Data Access Object)

Esta camada isola completamente a lógica de acesso ao banco de dados do resto da aplicação.

  * **Responsabilidade**: Executar todas as operações de SQL (CRUD - Create, Read, Update, Delete). Ela é a única camada que "conversa" diretamente com o banco de dados.
  * **Componentes (`/backend/DAO/*.php`)**: Cada classe DAO gerencia uma tabela específica do banco.
      * `PacienteDAO.php`
      * `MedicoDAO.php`
      * `ConsultaDAO.php`
      * `ConvenioDAO.php`
      * `EnderecoDAO.php`
      * `UsuarioDAO.php`

#### 5\. Banco de Dados e Conexão

A base de toda a aplicação, onde os dados são armazenados de forma persistente.

  * **Banco de Dados (`minoru_gestao_hospitalar.sql`)**: Script SQL que define a estrutura de todas as tabelas, seus relacionamentos e os dados iniciais.
  * **Gerenciador de Conexão (`Conexao.php`)**: Uma classe Singleton responsável por criar e fornecer uma única instância da conexão PDO com o banco de dados, garantindo que a conexão seja reutilizada e gerenciada de forma eficiente.

## Autores

Este projeto foi desenvolvido por:
  
* [Minoru Yamanaka](https://minoru-yamanaka.github.io/cv/)
* [Lucimara Dias](URL_DO_PERFIL_DA_LUCIMARA)
* [Carlos Gonçalves](URL_DO_PERFIL_DO_CARLOS)


## Acesso Fácil por QRCode

![QRCode_Facil](/QRCode_Facil.png)


