# Servicio web
***
Un pequeño servicio web creado con el patrón MVC usando Docker como contenedor
- Lenguaje: php
- Base de datos: MySQL
- Framework: Slim framework, PHPUnit 


## LINEA DE COMANDOS

Generar archivos de autocarga esencial para namespaces
```bash
composer dump-autoload
```

Iniciar servidor en slim
```bash
php -S localhost:port -t public
```

Codificar y decodificar el token
```bash
composer require firebase/php-jwt
```

Midleware para trabajar con slim y jwt
```bash
composer require tuupola/slim-jwt-auth                              
```

Para trabajar con vistas en slim
```bash
composer require twig/twig
```

Intalar y correr phpunit
```bash
composer require --dev phpunit/phpunit
./vendor/bin/phpunit
```


### Docker

Levantar un sevidor en desarrollo
```bash
docker-compose up -d
```

Construir docker
```bash
docker-compose up --build
```

Reiniciar docker
```bash
docker-compose down
```

Mostrar detalles de los contenedores de docker
```bash
docker ps
```

Acceder a un contenedor de docker `<name_container>`
```bash
docker exec -it <name_container> bash
```

Acceder a mysql en el contenedor
```bash
mysql -u user -p
```

Ingresar al cotenedor de mysql y usarlo
```bash
docker exec -it <name_container> mysql -u <username> -p
```

Version de php en docker
```bash
docker-compose exec php php -v
```

Version de phpunit en docker
```bash
docker-compose exec php ./vendor/bin/phpunit --version
```

Ejecutar phpunit en docker
```bash
docker-compose exec php ./vendor/bin/phpunit --config phpunit.xml
```
