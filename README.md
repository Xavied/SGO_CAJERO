Proyecto Laravel 6
//instalamos las dependencias del proyecto
composer install 

//clonamos el contenido del archivo .env
cp.env.example .env

//generamos una App_Key 
php artisan Key:generate

//ejecutamos el servidor para asegurarnos que funciono
php artisan serve
