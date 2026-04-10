# Serviço 3 - Analisador / Contador

Microserviço FastAPI para calcular estatísticas de tarefas (`total`, `concluidas`, `pendentes`) por `usuarioId`.

## Configuração e Execução

1. Crie um ambiente virtual (recomendável):
   ```bash
   python -m venv venv
   .\venv\Scripts\activate
   ```

2. Instale as dependências:
   ```bash
   pip install -r requirements.txt
   ```

3. Instancie a API utilizando Uvicorn:
   ```bash
   uvicorn app.main:app --port 8010
   ```

A API responderá pela porta 8010. Você pode acessar via `http://localhost:8010/stats/1`.
A documentação interativa fica disponível em `http://localhost:8010/docs`.
