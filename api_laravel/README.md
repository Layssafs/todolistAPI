# 📜 Serviço 2: Gerador de Logs

Bem-vindo ao **Serviço de Logs**! Este microsserviço (desenvolvido em PHP 8 e Laravel) faz parte de um ecossistema, sendo a sua principal responsabilidade registrar ações essenciais da aplicação, como a criação e conclusão de tarefas, além de erros de sistema.

Desenvolvido utilizando estritamente os princípios estruturais da **Clean Architecture**, o projeto é formulado de maneira a isolar totalmente o *Framework*, a camada de banco de dados (Eloquent ORM) e o *Delivery* RESTful das regras de negócios principais, facilitando a testabilidade e o versionamento.

---

## 🛠️ Pré-requisitos

Para que o projeto funcione localmente, o seu ambiente de desenvolvimento necessita possuir:

- **PHP 8.1** ou superior
- **Composer** (Gerenciador de pacotes do PHP)
- Ambiente local de Banco de Dados: Recomendado **Laragon** (que inclua MySQL/PostgreSQL) ou similar.

---

## 🚀 Instalação e Configuração

Siga os passos abaixo, via terminal, para rodar este repositório localmente:

1. **Instalar Dependências**
   Abra o terminal na pasta raiz do projeto e instale todos os pacotes PHP através do Composer:
   ```bash
   composer install
   ```

2. **Configuração das Variáveis de Ambiente (.env)**
   Crie uma cópia do arquivo `.env.example`, caso ele ainda não exista:
   ```bash
   cp .env.example .env
   ```
   No arquivo `.env` gerado, ajuste a conexão com o banco de dados conforme o seu ambiente (Exemplo usando MySQL):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nome_do_seu_banco
   DB_USERNAME=root
   DB_PASSWORD=sua_senha
   ```

3. **Geração da Chave e Execução das Tabelas**
   A primeira inicialização do Laravel precisa ser gerada a Application Key e por fim as tabelas de banco de dados (Migrations):
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

---

## 🏗️ Estrutura do Projeto (Clean Architecture)

A lógica central da aplicação ignora Controllers e a integração com o ORM diretamente. As implementações de negócio estão segmentadas da seguinte maneira no diretório raiz do Framework (`app/`):

- **`app/Domain/Entities`**: A classe `Log.php` reflete a entidade principal dos dados isoladamente sem métodos de Framework. 
- **`app/Domain/Repositories`**: A `LogRepositoryInterface.php` atua como contrato obrigatório de chamadas pelo Use Case limitando restrições do Framework.
- **`app/UseCases/Logs`**: Os "Gerenciadores", onde se encontram o arquivo principal da lógica (`CreateLogUseCase.php`), determinando puramente as regras e exigências de cadastro deste microsserviço.
- **`app/Infrastructure/Repositories`**: Aonde mora o motor final real do Framework, como no caso do `EloquentLogRepository.php`, responsável por converter a Entidade Log nativa para dentro do Banco de Dados pelo `LogModel.php`. 

---

## 📡 Endpoints da API

Abaixo seguem os mapeamentos acessíveis para comunicação.

### Criar Log (`POST /api/logs`)
Responsável por salvar uma nova atividade no sistema enviando o ID do usuário de origem e suas descrições.

**Payload JSON de Envio Esperado:**
```json
{
    "acao": "Criação de Tarefa",
    "detalhe": "Inclusão da tarefa XPTO realizada.",
    "usuarioId": 1
}
```

**Respostas:**
Retorna o Código **HTTP 201 Created**, espelhando assim os dados inseridos, incluindo o identificador automático e a validação do `timestamp`.

---

## 🧪 Como Testar

### Automatizado 🤖
As rotas e fluxos lógicos estão totalmente blindadas por testes. Você não precisa estar com o MySQL rodando no seu computador por padrão para ver a mágica, pois os testes utilizam banco relacional SQLite nativo em modo de Memória.

Para executar todos os testes da Feature da API basta rodar:
```bash
php artisan test
```

### Manualmente (CURL / Postman / Insomnia) 🧩
Certifique-se do seu artisan estar rodando um servidor (`php artisan serve`). Depois direcione requisições para `localhost:8000`.

**Exemplo de teste via Terminal utilizando *curl*:**
```bash
curl -X POST http://127.0.0.1:8000/api/logs \
-H "Content-Type: application/json" \
-d '{"acao": "Conclusão", "detalhe": "Tarefa feita", "usuarioId": 10}'
```

---

## 🚨 Nota Importante sobre Autenticação

Para se adequar perfeitamente ao ecossistema atual proposto, e em respeito às diretrizes do sistema micro-serviço e fluxo de tráfego de dados, **ainda não constam** implementações nativas ou nativo-limitadoras de Autenticações (como Sanctum, Passport e afins), assim como nenhuma diretiva estrita de `Middleware Auth`. A API encontra-se publicamente desprotegida, levando em consideração que o "Portão de Barreira Autenticável" pode atuar nos estágios iniciais/externos perante o Gateway Primário ou através de outro Micro-serviço (responsável pela injeção pura de repasse do Payload já Autorizado e Verificado em contraponto).
