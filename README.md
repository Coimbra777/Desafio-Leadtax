# Desafio Técnico: Web Scraping de Produtos de um E-commerce

## Descrição do Desafio
Este projeto tem como objetivo desenvolver uma aplicação Laravel que realiza o web scraping de produtos de um site de e-commerce, como o Mercado Livre. A aplicação extrai informações essenciais sobre os produtos e as armazena em um banco de dados, disponibilizando-as em uma interface web para visualização.

## Funcionalidades
- **Web Scraping:** Coleta de dados de produtos, incluindo nome, preço, imagem e descrição.
- **Armazenamento em Banco de Dados:** Os dados coletados são armazenados em um banco de dados MySQL.
- **Interface Web:** Visualização dos produtos coletados em uma interface amigável.
- **Command para recuperar dados:** Comando cronjob do Laravel para recuperar os dados dos produtos.


## Tecnologias Utilizadas
- **Laravel:** Framework PHP para desenvolvimento web.
- **MySQL:** Sistema de gerenciamento de banco de dados.
- **Guzzle:** Biblioteca PHP para realizar requisições HTTP.
- **Blade:** Motor de template do Laravel para renderização de views.

## Requisitos
- PHP 8.0 ou superior
- Composer
- MySQL
- Laravel

## Instalação
Siga os passos abaixo para instalar e configurar a aplicação:

### Passo a passo

Clone Repositório

```sh
git clone -b laravel-10-com-php-8.1 https://github.com/Coimbra777/Desafio-Leadtax.git
```

```sh
cd app-laravel
```

Crie o Arquivo .env

```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env

```dosini
APP_NAME="projeto-leadtex"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Suba os containers do projeto

```sh
docker-compose up -d
```

Acesse o container app

```sh
docker-compose exec app bash
```

Instale as dependências do projeto

```sh
composer install
```

Gere a key do projeto Laravel

```sh
php artisan key:generate
```

Rode as migrations

```sh
php artisan migrate
```

Rode o command para recuperar os produtos do Marketplace

```sh
php artisan scrape:products
```

Acesse o projeto
(http://localhost:8989/products)
