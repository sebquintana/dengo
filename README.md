dengo
=====
Primer commit en nuestro repo de git :)

Comentarios:

Para usar el proyecto sigan los siguientes pasos:

Crear un proyecto laravel propio con : composer create-project laravel/laravel prueba  --prefer-dist

Reemplazar los archivos y las carpetas app y public, por las que estan en el repositorio de Git

Configurar el archivo : app/config/database.php , aca configurar la base de datos mysql dodne esta comentado.

Ejecutar desde la raiz del proyecto: 

 php artisan migrate => Esto crea las tablas con su estructura.

 php artisan db:seed => Esto llena las tablas segun se configure (en este caso va a llenar la tabla sources con los diarios que teniamos en la otra tabla).

