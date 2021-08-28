# Sistema de cotação de frete: Backend.

sistema de cotação de frete, desenvolvido em `PHP` utilizando o
framework `Laravel` e `Docker`


## Startar o projeto

Após clonar e acessar a pasta configurar o arquivo `.env` e executar os comandos:

Exemplo de configuração banco de dados.
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=cotacaodb
DB_USERNAME=root
DB_PASSWORD=5x7wPxtXBuRsBv7A
```

Executar os comandos
```sh
# Iniciar docker
docker-compose up -d

# Criar tabelas no banco
docker-compose exec api php artisan migrate

# Adicionar dados iniciais
docker-compose exec api php artisan db:seed --class=TransportadoraSeeder
```
