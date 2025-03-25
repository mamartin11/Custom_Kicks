# Proyecto Laravel - Custom Kicks

Este proyecto es una tienda virtual de zapatos personalizados desarrollada en Laravel. A continuación, se detallan los pasos para configurar y ejecutar el proyecto en un entorno local.

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalados los siguientes componentes:

* [Git](https://git-scm.com)
* [PHP 8.x](https://www.php.net)
* [Composer](https://getcomposer.org)
* [XAMPP](https://www.apachefriends.org)
* [Node.js y NPM](https://nodejs.org/es)
* [Laravel](https://laravel.com)

## Instalación y Configuración

### 1. Clonar el Repositorio
```
 git clone https://github.com/usuario/Custom_Kicks.git
 cd Custom_Kicks
```

### 2. Instalar Dependencias

Ejecuta el siguiente comando para instalar las dependencias de Laravel:

`composer install`

### 3. Configurar Variables de Entorno

Duplica el archivo .env.example y renómbralo como .env:

`cp .env.example .env`

Genera la clave de aplicación de Laravel:

`php artisan key:generate`

### 4. Configurar la Base de Datos

1. Inicia MySQL desde XAMPP.

2. Crea una base de datos en phpMyAdmin llamada customkicks.

3. Importa el archivo de base de datos:

    * Entra a [phpMyAdmin](http://localhost/phpmyadmin/).

    * Selecciona la base de datos customkicks.

    * Ve a la pestaña Importar.

    * Selecciona el archivo .sql que se haya exportado previamente.


4. Asegúrate de configurar correctamente la conexión en el archivo .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=customkicks
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Instalar Dependencias Frontend

```
npm install
npm run dev
```

### 6. Iniciar el Servidor

`php artisan serve`

## Ruta Principal

Para acceder a la plataforma, abre en tu navegador:

`http://127.0.0.1:8000/`

## Comandos Útiles

Para limpiar cachés y configuraciones:

```
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

Para verificar la correcta conexión a la base de datos:

`php artisan migrate:status`

## Desarrolladores

* [Miguel Ángel Martínez](https://github.com/mamartin11)
* [Nicolás Hurtado](https://github.com/NicoHurtado)
* [Jacobo Restrepo](https://github.com/jacorestrepom)
* [Santiago Rodríguez](https://github.com/santiagord2004)
