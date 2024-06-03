# Proyecto Laravel 10 con ARBAC, Datatables y AdminLTE

Este proyecto Laravel 10 es un punto de partida inicial para facilitar el desarrollo de aplicaciones web robustas y eficientes. Incluye funcionalidades como un modelo de autorización de accesos basado en roles y capacidades (ARBAC), la implementación de Datatables del lado del servidor para manejar grandes conjuntos de datos de manera eficiente y la integración del tema AdminLTE para una interfaz de usuario moderna y receptiva.

## Características Principales

### Breeze

Laravel Breeze es una implementación mínima y simple de todas las funciones de autenticación de Laravel , incluido el inicio de sesión, el registro, el restablecimiento de contraseña, la verificación de correo electrónico y la confirmación de contraseña.

 ```bash
    composer require laravel/breeze --dev
    php artisan breeze:install
    
    php artisan migrate
    npm install
    npm run dev
```
Si aparece el menu para elegir, elegir blade.

### Modelo de Autorización de Accesos (ARBAC)

El proyecto implementa un modelo de autorización de accesos basado en roles y capacidades (ARBAC), utilizando laravel-permission de Spatie, para controlar de manera efectiva qué usuarios tienen acceso a qué recursos en la aplicación. Los roles y permisos pueden ser administrados de manera centralizada para simplificar la gestión de la autorización.

```bash
    Composer require spatie/Laravel-permission
```

En el archivo config/app.php
```php
    'providers' => ServiceProvider::defaultProviders()->merge([
        Spatie\Permission\PermissionServiceProvider::class,
    ])->toArray(),
```

### Datatables del Lado del Servidor

Se ha integrado Datatables del lado del servidor, utilizando, Yajra Datatables, para proporcionar una experiencia de usuario mejorada al manejar grandes conjuntos de datos de manera eficiente. Esto permite la paginación, búsqueda y ordenación de datos de manera fluida y rápida.

```bash
    Composer require yajra/laravel-datatables:^10
```

En el archivo config/app.php
```php
    'providers' => ServiceProvider::defaultProviders()->merge([
        Yajra\DataTables\DataTablesServiceProvider::class,
    ])->toArray(),
```
```bash
    Php artisan vendor:publish –tag=datatables
```
### AdminLTE - Interfaz de Usuario Moderna

La interfaz de usuario del proyecto se basa en AdminLTE, un tema de administración de panel de control de código abierto. AdminLTE ofrece un diseño limpio, moderno y receptivo, facilitando la creación de interfaces de usuario atractivas y fáciles de usar.

## Requisitos del Sistema

- PHP >= 8.1
- Composer (para instalar dependencias)
- Habilitar en php.ini: extension=zip y extension=gd

## Instalación

1. **Clona el Repositorio:**

    ```bash
    git clone https://github.com/jcarlosad7/sistemalaravel10-temp.git
    cd tuproyecto
    ```

2. **Instala las Dependencias de Composer:**

    ```bash
    composer install
    ```

3. **Archivo de Configuración:**
    Configura las variables de entorno en el archivo `.env` según tus necesidades.

4. **Genera la Clave de la Aplicación:**

    ```bash
    php artisan key:generate
    ```

5. **Migraciones y Semillas:**

    ```bash
    php artisan migrate --seed
    ```

6. **Inicia el Servidor de Desarrollo:**

    ```bash
    php artisan serve
    ```

    Visita `http://localhost:8000` en tu navegador.

## Uso y Personalización

1. **Roles y Permisos:**

    Utiliza las migraciones y semillas proporcionadas para gestionar roles y permisos. Puedes personalizar estos seeder según las necesidades específicas de tu aplicación.

2. **Configuración de Datatables:**

    Configura Datatables en tus controladores para aprovechar las características del lado del servidor.

3. **Personalización de la Interfaz de Usuario:**

    Modifica las vistas y recursos de AdminLTE según las necesidades específicas de tu proyecto.
