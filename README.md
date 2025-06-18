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
