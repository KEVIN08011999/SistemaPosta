##Desarrollado por AC Soluciones Digitales

Proceso de puesta en funcinamiento:
- git clone del repositorio actual
- Abre tu terminal y ejecuta los siguientes comandos en ese orden
    -   cp .env.example .env
    Al ejecutar el primer comando en tu editor de codigo busca el archivo .env y configura los datos de conexion de tu base de datos. posterior a eso continua con la ejecucion de los siguientes comandos en consola.
    -   composer install
    -   php artisan migrate
    -   php artisan db:seed
