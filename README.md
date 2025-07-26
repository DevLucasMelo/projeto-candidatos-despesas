# Gerenciamento de Despesas dos Deputados Federais

Projeto Laravel para visualizar informações e comparar despesas de deputados federais, consumindo os dados da [API da Câmara dos Deputados](https://dadosabertos.camara.leg.br/swagger/api.html).

## ⚙️ Funcionalidades

- Listagem de deputados por estado, partido e nome.
- Visualização de informações detalhadas: situação, gabinete, redes sociais, escolaridade, etc.
- Dashboard de despesas com ordenação e soma total.
- Comparação visual entre deputados com gráficos.

## 🐳 Como rodar com Docker

### Pré-requisitos

- [Docker](https://www.docker.com/) instalado.
- [Docker Compose](https://docs.docker.com/compose/) instalado.

### Passos

# 1. Clone o repositório
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio

# 2. Copie o .env de exemplo
cp .env.example .env

# 3. Suba os containers
docker-compose up -d --build

# 4. Instale as dependências do Laravel
docker exec -it app composer install

# 5. Gere a chave da aplicação
docker exec -it app php artisan key:generate

# 6. Rode as migrations
docker exec -it app php artisan migrate

# 7. (Opcional) Importe os dados da API da Câmara
docker exec -it app php artisan deputados:importar

# 8. Acesse a aplicação no navegador
http://localhost:8000
