Proyecto Laravel 6
//instalamos las dependencias del proyecto
<br>
composer install 

//clonamos el contenido del archivo .env <br>
cp .env.example .env

//generamos una App_Key  <br>
php artisan Key:generate

//ejecutamos el servidor para asegurarnos que funciono <br>
php artisan serve
