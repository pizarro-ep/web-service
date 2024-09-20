Un pequeño servicio web creado con el patrón MVC usando Docker como contenedor
- Lenguaje: php
- Base de datos: MySQL
- Framework: Slim framework, PHPUnit 

####################################################################
LINEA DE COMANDOS

composer dump-autoload                                              Generar archivos de autocarga esencial para namespaces
php -S localhost:port -t public                                     iniciar servidor

composer require firebase/php-jwt                                   nos permite codificar y decodificar el token
composer require tuupola/slim-jwt-auth                              midleware para trabajar con slim y jwt
composer require twig/twig                                          para trabajar con vistas

composer require --dev phpunit/phpunit                              instalar phpunit
./vendor/bin/phpunit                                                correr phpunit

docker-compose up -d                                               levantar docker en desarrollo
docker-compose up --build                                          construir docker
docker-compose down                                                reiniciar docker
docker ps                                                           mostrar detalles de los contenedores de docker
docker exec -it <name_container> bash                               acceder al conenedor
mysql -u user -p                                                    usar mysql en el cotenedor
docker exec -it <name_container> mysql -u <username> -p             ingresar al contenedor de mysql
docker-compose exec php php -v                                      version de php en docker
docker-compose exec php ./vendor/bin/phpunit --version              version de phpunit en docker
docker-compose exec php ./vendor/bin/phpunit --config phpunit.xml   ejecutar phpunit en docker
