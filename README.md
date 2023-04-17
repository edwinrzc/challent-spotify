########### Manual de instalación Api-Farmacia

1 - Para realizar la instalación, es necesario clonar el repositorio de git, para ello podemos usar el siguiente comando:

git clone https://github.com/edwinrzc/api-farmacia.git 

*Podemos ejecutar también el comando
php artisan key:generate

2 - Luego que se complete la descarga del proyecto debemos instalar las dependencias.

composer update

3 - Se deben crear 3 bases de datos con los siguientes nombres:

- db_challent_spotify
- db_challent_spotify_tests
- db_challent_spotify_enlighten

4 - Debemos realizar una compia del archivo .env.example

cp .env.example .env

5 - Instalamos las migraciones básicas

php artisan mmigrate

6 - Instalamos las migraciones de Laravel Passport

php artisan passport:install

7 - Para instalar las migraciones de la documentación es necesario ejecutar los siguientes comandos

php artisan enlighten:migrate

también se puede ejecutar 

php artisan enlighten:migrate:fresh

Para generar la documentación solo debes ejecutar:

php artisan enlighten


para visualizar la documentación en el navegador la dirección sería la siguiente:


http://localhost/enlighten


con docker

http://localhost:8087/enlighten



######## Instalación usando composer ###########

1 - Construir la imagen, desde la raíz del proyecto nos posicionamos sobre la carpeta docker y se construye la imagen

cd docker

./build

2. Iniciamos los contenedores, para hacerlo debemos volver a la carpeta raíz. Se creo un script "develop" para controlar los comandos en docker

cd ..
./develop up -d
./develop 

también 

./develop ps

3. Comandos controlados desde el script: composer, php, artisan, gulp, node

./develop composer

./develop php

./develop art 

./develop gulp

./develop node

./develop test