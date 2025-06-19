Tecnologías utilizadas:
    PHP (Versión 8.1 o superior)
        Propósito: Procesamiento de la lógica de negocio, manejo de datos y generación de respuestas dinámicas.
        
    Laravel (Framework de PHP):
        Propósito: Agilizar el desarrollo web, proveer funcionalidades listas para usar y mantener la aplicación organizada.
        
    MySQL (Base de Datos):
        Propósito: Almacenamiento y gestión estructurada de los datos de la aplicación.
        
    Laravel Migrations:
        Propósito: Gestionar el esquema de la base de datos, permitiendo su control de versiones y facilitando la colaboración.
    
    Laravel Tinker:
        Propósito: Depuración, testeo rápido y gestión directa de datos en el entorno de desarrollo.
    
    HTML5:
        Propósito: Proporcionar la estructura de la interfaz de usuario.
    
    CSS3:
        Propósito: Dar formato, color y diseño a la interfaz de usuario.
    
    JavaScript:
        Propósito: Mejorar la experiencia del usuario y la interactividad en el navegador.
    
    Laravel Breeze:
    Propósito: Proveer un sistema de autenticación listo para usar, acelerando el inicio del proyecto.
    
    LocalStorage y SessionStorage (APIs de Almacenamiento Web):
        Propósito: Permitir el almacenamiento de datos del lado del cliente para mejorar la experiencia o gestionar estados de sesión.

--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Antes de correr el proyecto, se debe instalar lo siguiete:
    composer require laravel/breeze --dev
    php artisan breeze:install
    npm install && npm run dev
    composer require spatie/laravel-permission
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
Luego se debe migrar la base de datos:
*Se ha utilizado MySql*
    php artisan migrate
    php artisan migrate:fresh --seed
    
Para asignar el rol a su usuario después de registrarse:
    Primero se deben crear los roles:
        php artisan tinker
        Spatie\Permission\Models\Role::create(['name' => 'admin']);
        Spatie\Permission\Models\Role::create(['name' => 'user']);
    Luego se asigna el rol al usuario:
        $user = App\Models\User::where('email', 'correo registrado')->first();
        $user->assignRole('admin');
