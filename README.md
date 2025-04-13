# Travel app

Para rodar o projeto foi utilizado docker com docker-compose na versão mais atualizada no windows com wsl e docker-desktop
 
- nginx
- php 8.2
- mysql 8
- laravel 12 latest

Rodando o projeto:

```
docker-compose up -d
```

Para configurar o banco de dados:

```` 
DB_CONNECTION=mysql 
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
````

Para rodar os testes de integração:

````
php artisan test
````
