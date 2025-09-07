# Favorites API

API desenvolvida em **PHP 8.1.0** com **PostgreSQL 17.6-1** para gerenciamento de clientes e suas listas de produtos favoritos.  

---

## Estrutura de pastas  

- `doc`: documentação da API gerada em Swagger  
- `postman-collection`: coleção de requisições para testes via Postman  
- `public`: roteamento para pastas e arquivos públicos  
- `api`: autenticação, endpoints e lógica da API  

---

## Documentação  

A documentação da API foi gerada a partir do Swagger e pode ser acessada via navegador:  

```
file:///{Pasta onde estiver armazenado o projeto}/favorites-api/doc/index.html
```

---

## Requisitos  

- PHP 8.1.0  
- PostgreSQL 17.6-1  
  - Porta padrão: **5433**  
  - Senha configurada: **senha**  

---

## Configuração do Banco de Dados  

Após clonar o repositório, é necessário executar os arquivos SQL disponíveis em api/sql/

Criar tabelas (obrigatório):  

```bash
psql -U postgres -d postgres -f "api\sql\tables.sql"
```

Popular o banco com dados de exemplo (opcional):  

```bash
psql -U postgres -d postgres -f "api\sql\populate.sql"
```

---

## Executando a API  

Na pasta raiz do projeto, inicie o servidor com:  

```bash
php -S localhost:8000 -t public public/router.php
```

A API estará disponível em: [http://localhost:8000](http://localhost:8000)  

---

## Autenticação

A autenticação foi criada se inspirando no JWT, porém mais simplificada, que gera um Bearer token para ser utilizado nas requisições. Para mais informações sobre a geração do token, consulte a documentação.

---

## Testes  

Importar a coleção do Postman disponível em `postman-collection`.  

---
