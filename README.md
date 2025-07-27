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

# 1. Clone o repositório e entre na pasta do projeto

git clone git@github.com:DevLucasMelo/projeto-candidatos-despesas.git

cd projeto-candidatos-despesas

# 2. Copie o .env de exemplo
cp .env.example .env

# 3. Edite o .env para configurar conexão com o banco de dados remoto:
DB_CONNECTION=mysql
DB_HOST=maglev.proxy.rlwy.net
DB_PORT=41238
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=VWTdgydrzfwqoEmhaDhZkHefFFKPQdQb

# 4. Suba os containers
docker-compose up -d --build

# 5. Instale as dependências PHP dentro do container
docker exec -it laravel_app composer install

# 6. Gere a chave da aplicação
docker exec -it laravel_app php artisan key:generate

# 7. Ajuste permissões para storage e cache
docker exec -it laravel_app chmod -R 775 storage bootstrap/cache
docker exec -it laravel_app chown -R www-data:www-data storage bootstrap/cache

# 8. Acesse no navegador
http://localhost:8000

#AVISO:# O banco de dados está hospedado remotamente como um diferencial do projeto, logo o migrate e alimentação das tabelas já foram feitos. Sendo assim, caso queira executar o migrate e alimentação localmente, será necessário modificar as configs do banco de dados no .env e rodar os comandos abaixo:

# 9. Rode as migrations
docker exec -it laravel_app php artisan migrate

# 10. Importe os dados da API da Câmara
docker exec -it laravel_app php artisan importar:deputados

# 11. Acesse no navegador
http://localhost:8000


