# Sistema de cotação de frete.

sistema de cotação de frete, desenvolvido em `PHP` utilizando o
framework `Laravel` e `Docker`

## Como usar

Clonar repositório `git clone https://github.com/rogerioadris/cotacao-frete.git`

Renomear o arquivo `.env.example` para `.env` e alterar a conexão do banco de dados:

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=cotacaodb
DB_USERNAME=root
DB_PASSWORD=5x7wPxtXBuRsBv7A
```

Iniciar os container docker:

```sh
docker-compose up -d
```

Instalar dependências php

```sh
docker-compose exec api composer install
```

Criar tabelas no banco

```sh
docker-compose exec api php artisan migrate
```

Cadastrar transportadoras

```sh
docker-compose exec api php artisan db:seed --class=TransportadoraSeeder
```
