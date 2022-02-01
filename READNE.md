# Configurar Laravel

## Base de datos, correo electrónico
Fichero **/.env**:
Laravel está configurado para que no se suba el archivo **/.env**
```ini
// DB
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_database
DB_USERNAME=username
DB_PASSWORD=password
// Correo
APP_NAME=NOMBRE_DE_LA_APP
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME= _**
MAIL_PASSWORD=**_
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@midominio.com"
MAIL_FROM_NAME="${APP_NAME}"
```
Fichero **/config/database.php
```php
env('DB_CONNECTION','mysql'); // Usar esta función para credenciales en servidor de desarrollo. Asigna a un parámnetro un valor sólo si no está definido en ./env
```
## Localizacion
Fichero **/config/app.php**
```php
/* debe estar en /resources/lang */
'locale' => 'es',
```
Fichero **/resources/lang/validation.php**
```php
'attributes' => [ /* Cambia los nombres de los atributos en los mensajes de validación (:attribute) */
	'name' => 'nombre'
],
```

# ÓRDENES DEL CLI

## Órdenes básicas
* Crear proyecto
```bash
laravel new MI_PROYECTO
```
* Crear proyecto con composer:
```bash
composer create-project laravel/laravel MI_PROYECTO
```
* Version de Laravel: 
```bash
php artisan --version
```
* Lanzar servidor de desarrollo: 
```bash
php artisan serve
```

# NOTAS PREVIAS
Sólo se puede acceder a la carpeta public
index.php es el punto de entrada

# SOLUCIÓN DE ERRORES

## Error 500
```bash
cp .env.example .env
php artisan key:generate
php artisan cache:clear 
php artisan config:clear
```
## CSRF (produce error 419 en los test)
/var/www/html/liga_futbol/app/Http/Middleware/VerifyCsrfToken.php
```php
protected  $except = [
	'player/destroy',
	'player/update',
	'player/store',
	...
	'login',
]; 
```

# RUTAS
## /routes/web.php
Las rutas se leen de arriba a abajo. En caso de conflicto, la primera que coincida.

* Vista:
```php
Route::get('/', function () { return  view('welcome'); });
```
* Controlador con un sólo método con parámetro opcional:
```php
Route::get("usuario/estudiante/{id?}", EstudianteController::class);
```
* Controlador, indicando todos los métodos principales:
```
Route::get('paises', [PaisController::class, 'index | store']);
Route::get('paises/{pais}', [PaisController::class, 'show | update | destroy']);
```
* Controlador, simplificado e indicando métodos no definidos:
```php
Route::resource('paises', PaisController::class)->except(['create', 'edit']);
```
* Ejemplos de controlador con rutas más complejas:
```php
Route::get('paises/{pais}/departamentos', [DepartamentoController::class, 'index | store']);
Route::get('paises/{pais}/departamentos/{departamento}', [DepartamentoController::class, 'show | update | destroy']);
```
* Método resource simplificado:
```php
Route::resource('paises.departamentos', DepartamentoController::class)->except(['create', 'edit']);
```
* Nombrar rutas (alias)
```php
Route::get('', [DepartamentoController::class, 'index'])->name('admin.home');
Route::resource('paises.departamentos', DepartamentoController::class)->names('admin.departamentos');
```

# CONTROLADORES

## Convenciones
```
Método*    Verbo      URI                  Nombre de la ruta
index()    GET        /model               model.index
create()   GET        /model/create        model.create
store()    POST       /model               model.store
show()     GET        /model/{model}       model.show
edit()     GET        /model/{model}/edit  model.edit
update()   PUT/PATCH  /model/{model}       model.update
destroy()  DELETE     /model/{model}       model.destroy
(*) nombre típico
```
## cli
php artisan make:controller EstudianteController

## /app/http/controllers/EstudianteController.php
* La clase controlador debe extender Controller:
```php
class  EstudianteController  extends  Controller
```
* Para una única vista usando invoke:
```php
public  function  __invoke( $parametro1 = valor1, ... )
```
* Devolver vista (pasando parámetros):
```php
return view ('estudiante.index',['p1'=>$p1, 'p2' => $p2...]);
```
Simplificado:
```php
return  view ('estudiante.index',compact('p1', 'p2'...));
```

## /routes/web.php
```php
use namespace App\Http\Controllers\EstudianteController;
```

# VISTAS CON BLADE

## /resources/views/layouts/plantilla.blade.php
Usando principalmente @yield ( y también métodos de app .... )
ˋˋˋphp
ESTO SE SUPONE CODIGO
ˋˋˋ

```php
<!DOCTYPE  html>
<html  lang="{{  str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta  charset="utf-8">
		<meta  name="viewport"  content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
	</head>
	<body>
		<h1>
		@yield('controller')
		</h1>
		<p>
		@yield('content')
		</p>
	</body>
</html>
```

## /resources/views/Departamentos/show.blade.php

```php
@extends('layouts.plantilla')
@section('title', 'Mostrando departamento')
@section('controller', 'Departamentos')
@section('content')
Viendo: {{$id_departamento}}</strong> en: <strong>{{$id_pais}}
@endsection
```

# MIDDLEWARE

## cli
```bash
php artisan make:middleware Authenticate
```

## /app/http/MiddleWare/NombreMiddleware.php
```php
namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
class Authenticate extends Middleware {
	/**
	* Get the path the user should be redirected to when they are not authenticated.
	*
	* @param \Illuminate\Http\Request $request
	* @return  string|null
	*/
	protected function redirectTo($request) {
		if (!$request->expectsJson()) {
		 return route('login');
		}
	}
}
```

## /app/http/kernel.php
Registrarlo al final:
```php
protected  $routeMiddleware = [
...
'auth' => \App\Http\Middleware\Authenticate::class,
...
```

# TAILWINDCSS
## Instalación
```bash
npm install
npm install -D tailwindcss@latest postcss@latest autoprefixer@latest
npm tailwindcss init
```

## /tailwind.config.js
Elimina los estilos no usados en producción:
```js
module.exports = {
	purge: [
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue',
],
```

## /webpack.mix.js
Añadir tailwindcss como un plugin postcss
```js
mix.js("resources/js/app.js", "public/js")
  .postCss("resources/css/app.css", "public/css", [
require("tailwindcss"),
  ]);
```

## /resources/css/app.css
Incluir tailwind en el css de la app:
```css
@tailwind base;  
@tailwind components;  
@tailwind utilities;  
```

## cli
```bash
npm run watch - Vigila y compila automáticamente los cambios
npm run dev - Compila todo el proyecto
npm run prod - Compila para producción
```

## Importar el stylesheet en la plantilla Blade principal
Normalmente en **/resources/views/layouts/app.blade.php** o similar.
```php
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
```
Añadir también el viewport si no está definido.
```php
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
```

## Redefinir con estilos tailwind elementos HTML:
Usando la directiva @apply en **/resources/css/app.css**. Se recomienda también el uso de la directiva layer:
```css
@layer base {
// By using the  `@layer`  directive, Tailwind will automatically move those styles to the same place as  `@tailwind base`  to avoid unintended specificity issues. Using the  `@layer`  directive will also instruct Tailwind to consider those styles for purging when purging the  `base`  layer
	h1 { @apply font-sans text-3xl md:text-6xl font-bold mb-4; }
}
```

## Reglas font-face
Se puede definir también en **/resources/css/app.css** reglas para los font-face de manera similar:
```css
@layer base {
  @font-face {
    font-family: Proxima Nova;
    font-weight: 400;
    src: url(/fonts/proxima-nova/400-regular.woff) format("woff");
  }
}
```

## Modificando el tema por defecto
Configura module.exports en **/tailwind.config.js** 
> Los plugins permiten registrar nuevos estilos inyectado en la hoja de estilo javascript en vez de usar CSS
>
```js
module.exports = {
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        sm: '2rem',
        lg: '4rem',
        xl: '5rem',
        '2xl': '6rem',
      },      
    },
	screens: {
	  'sm': '640px',
	  'md': '768px',
	  'lg': '1024px',
	  'xl': '1280px',
	  '2xl': '1536px',
	},
	colors: {
	  transparent: 'transparent',
	  black: '#000',
	  white: '#fff',
	  gray: {
	    100: '#f7fafc',
	    // ...
	    900: '#1a202c',
	  },  
	spacing: {
	  px: '1px',
	  0: '0',
	  0.5: '0.125rem',
	  1: '0.25rem',
	  // ...
	  96: '24rem',
	},
	fontFamily: {
	  'sans': ['ui-sans-serif', 'system-ui', ...],
	  'serif': ['ui-serif', 'Georgia', ...],
	  'mono': ['ui-monospace', 'SFMono-Regular', ...],
	  'display': ['Oswald', ...],
	  'body': ['"Open Sans"', ...],
	},
  },
  plugins:
    plugin(function({ addBase, theme }) {
      addBase({
        'h1': { fontSize: theme('fontSize.2xl') },
        'h2': { fontSize: theme('fontSize.xl') },
        'h3': { fontSize: theme('fontSize.lg') },
      })
    })
  ]
}
```

# Importar módulo CSS de node

## /resources/css/app.css
```css
@import  '~@fortawesome/fontawesome-free/css/all.min.css';
```

# Migraciones

## CLI
Genera una migración. Si para el nombre se usa la convención en el método up llama a las funciones que generan los id y timestampS y en el método down genera el dropIfExists
```bash
php artisan make:migration create_TABLA_table
```
Con la siguiente convención, en el método up de la migración generada se usa el método table y no create para conseguir una migración no destructiva. Al tener ya la tabla datos las columnas nuevas deben ser nullables. En el método down usar $table->dropColumn('columna') para rollback no destructivo
```bash
php artisan make:migration add_COLUMNA_to_TABLA_table
```
Requerido para modificar propiedades de columnas:
```bash
composer require doctrine/dbal
```
Ejecuta el método up de las migraciones que no se hayan realizado según la tabla migrations
```bash
php artisan migrate
```
Elimina todas las tablas (método drop) y las vuelve a migrar (método up) (no usar en producción, usar por ejemplo en desarrollo para recrear migraciones a las que se han añadido actualizaciones)
```bash
php artisan migrate:refresh
```
No ejecuta el método down en todas las migraciones, elimina todas las tablas y luego ejecuta el método up. Si se indica seed añade finalmente los datos definidos en el seeder
```bash
php artisan migrate:fresh [--seed]
```
Elimina todas las tablas excepto las de migraciones:
```bash
php artisan migrate:reset
```
Revierte una migración (revierte al número de lote penúltimo indicado en la columna batch de la tabla migrations)
```bash
php artisan migrate:rollback
```
Añade los datos definidos en el seeder:
```bash
php artisan db:seed
```
## Funciones de migración
**/database/migrations/TIMESTAMP_create_TABLA_table**
```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	public function up(){ // ejemplo con create
		Schema::create('users',function(Blueprint $table) {
			$table->id(); // integer unsigned incremento
			$table->string('nombre',[LONGITUD]); // varchar, si no se indica longitud 255
			$table->text('descripcion'); // text para más de 255 carácteres
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable([false]);
			$table->rememberToken(); // varchar 100 token de sesión
			$table->timestamps(); // en plural, crea 2 columnas created_at / updated_at
			});
	}
	
	public function up(){ // ejemplo con table
		Schema::table('users',function(Blueprint $table) {
			$table->string('ciudad')->after('email'); // coloca columna después de otra
			$table->string('nombre',50)->change(); // modifica propiedad de la columna. También usar esta función en el método down indicando la propiedad original
			});
	}
	
	public function down() {
		Schema::dropIfExists('users');
	}
```
# Validación de formularios mediante controlador

## CLI
Crea un form request - para validaciones que no se implementan en el controlador
```bash
php artisan make:request ProductCreateRequest
```

## En el controlador
Usando el método `validate` del trait `ValidatesRequests`:
```php
public  function  store(Request  $request) {
	$validated = $request->validate([
	'nombre' => 'required|unique:jugadors,nombre|min:3|max:50|regex:/^[\pL\s\-]+$/u',
]);
```
o usando el Facade `Validator`:
```php
$validator = Validator::make($request->all(), [
	'name' =>  'required',
	'price' =>  'required|min:0',
]);
if  ($validator->fails())  {
	return  redirect('product/create')
	->withErrors($validator)
	->withInput();
}
// se crea un nuevo producto
```
# Validacion de formularios mediante form request:
## CLI
Crea un form request con 2 métodos authorize y rules
```bash
php artisan make:request ProductCreateRequest
```
## Código
**/app/Http/Requests/ProductCreateRequest.php**
```php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ProductCreateRequest extends FormRequest {
	// ****** OPCIONALES ******
	protected  $redirect = 'https://the.app/product';
	protected  $redirectRoute = 'post.create';
	protected  $redirectAction = '
ProductController@create';
	// ************************
	public  function  authorize() {
		return  true; // método opcional donde implementamos la lógica para la autorización del usuario. Si no se implementa debe devolver true
	}
	public  function  rules() {
		return  [
			'name' =>  'required',
			'price' =>  'required|min:1',
		];
	}
	// ****** OPCIONALES ******
	public function messages() {
		return  [
			'name.required' =>  'El :attribute es obligatorio.',
			'price.required' =>  'Añade un :attribute al producto',
			'price.min' =>  'El :attribute debe ser mínimo 0'
		];
	}
	public function attributes() {
		return  [
			'name' =>  'nombre del producto',
			'price' =>  'precio de venta',
		];
	}
	// ************************
```
**/app/Http/Controllers/ProductController.php**
```php
use App\Http\Requests\ProductCreateRequest;
...
public function store(ProductCreateRequest $request) /* cambiamos el objeto Request al del tipo del form request */
```

# Validacion de formularios en las plantillas
```php
<!-- Create, en caso de error recuerda datos enviados -->
<input type="text" name="nombre" value="{{old('name')}}">
<!-- Update, en caso de error recuerda o bien los datos enviados o bien los datos a actualizar -->
<input type="text" name="nombre" value="{{old('name',$curso->name)}}">	
@error('nombre')
<div>*{{message}}</div>
@enderror
```
# Modelos
## CLI
```bash
php artisan make:model User [-m|c|s|f|a] # en inglés y singular genera una tabla con el nombre en minúscula y plural y con subrayados entre las letras en mayúscula: AirTrafficController -> air_traffic_controllers. Opciones: -m para crear la migración, -c para crear el controlador, -s para crear el seeder, -f para crear el factory, -a para que lo cree todo
```
## Seeders
En el seeder se debe indicar el modelo; e.g.
```php
use App\Models\Course;
```
Para generar un seeder:
```bash
php artisan make:seeder CourseSeeder # lo genera en /database/seeders
```
Seeder general: **/database/seeders/DatabaseSeeder.php**
Código:
```php
public function run() { // mismo código que en tinker
	$this->call(CourseSeeder::class); // si se generó un seeder particular, para invocarlo
```
## Factories
Para generar un factory en **/database/factories/**
```php
php artisan make:factory CourseFactory [--model=Coumethodrse]
```
Si se indica el modelo genera automáticamente:
```php
use App\Models\Course;
class CourseFactory extends Factory {
	protected $model = Course::class;
```
Funciones (ver **UserFactory.php** para más ejemplos)
```php
public function definition() {
	return ['name'=>$this->faker->sentence(),
			'descripcion'=>$this->faker->paragraph(),
			...
			]
```
Para invocarlo, en el seeder o mejor aún en DatabaseSeeder.php:
```php
Course::factory(N)->create(); // N número de registros a crear
```
También son útiles para usar en los test:
```php
$team = Team::factory()->create();
$team = Team::factory()->make(); // No persiste en la base
```

En Laravel 8 podemoos prescindir de seeders para este tipo de relleno de datos porque Factory es una clase. Los seeders se utilizan para rellenos más complejos.

## Relaciones
### Diseño ER
- Crear migración: ``php artisan make:migration create_profiles_table``
- Crear modelo: ``php artisan make:model Profile``
- Método combinado: ``php artisan make:model Category -m``
- En la migración, para las claves foráneas, usar el mismo tipo que el de clave primaria en la tabla padre; añadir la restricción de clave foránea y la restricción unique si es relación 1:1.
- Crear primero las tablas de las entidades fuertes y luego las tablas de las entidades débiles que dependen de aquellas.
### Relaciones 1:1
```php
$table->unsignedBigInteger('user_id')
	->unique() // para 1:1
	->nullable(); // para onDelete/onUpdate set null
$table->foreign('user_id')
	->references('id')
	->on('users')
	->onDelete('cascade|set null')
	->onUpdate('cascade|set null')
```
Para recuperar en una entidad fuerte el registro de su entidad débil dependiente (relación 1:1) :
```php
// en App\Models\User
public function profile() {
	// manualmente
	$profile=Profile::where('user_id',$this->id)->first();
	return $profile;
	// o bien:
	return $this->hasOne(Profile::class); // o hasOne('App\Models\Profile'), si se usa el método class hay que añadir (use) el modelo. Este método entiende que el nombre de la clave foránea es el de la entidad fuerte seguida de '_id'. Sino se ha seguido la convención: return $this->hasOne('App\Models\Profile'[,'fk'][,'pk']);
```
Para recuperar en una entidad débil el registro de su entidad fuerte (relación 1:1) :
```php
// en App\Models\Profile
public function user() {
	// manualmente
	$user = User::find($this->user_id):
	return $user;
	// o bien:
	return $this->belongsTo('App\Models\User'[,'fk'][,'pk']);
```
### Relaciones 1:M
Para recuperar en una entidad fuerte los registros de su entidad débil dependiente (relación 1:M) :
```php
// en App\Models\User
public function posts() { // por convención lo pondremos en plural, ya es la M de la relación
	return $this->hasMany('App\Models\Post');
}
```
Para recuperar para cada registro de una entidad débil el registro de la entidad fuerte del que depende (relación M:1) :
```php
// en App\Models\Post
public function user() { // por convención lo pondremos en signular, ya que es la 1 de la relación
	return $this->belongsTo('App\Models\User');
```
### Relaciones M:N
- Crear una tabla intermedia con el nombre compuesto resultado del singular de cada entidad de la relación separados por por subrayado (de roles y users  -> role_user)
- No se usa un modelo MN (RoleUser) sino el modelo M (Role) y el modelo N (User) (creamos la migración, pero no un modelo MN RoleUser)
- Usaremos en los modelos las correspondientes funciones para obtener los registros dependientes, en este caso sólo mediante el método belongsToMany.
```php
// en App\Models\User
public function roles() {
	return $this->belongsToMany('App\Models\Role');
}
// en App\Models\Role
public function users() {
	return $this->belongsToMany('App\Models\User');
}
```
 


# tinker
## CLI
```bash
php artisan tinker
```
## Funciones
```php
use App\Models\Course;
$course = new Course;
$course->name = 'Laravel';
$course->save(); // guarda el registro; si existe la propiedad id lo actualiza
$course; // muestra el registro (id, updated_at, etc.)
$course=Course::all(); // colección de todos los registros
$course=Course::where('categoria','diseño')[->orderBy('col'[,'desc'])][->get()]; // get para obtener en forma de colección
	::where('id','<',45)
::where('name','like','%word%')
->orWhere('email','like','%word%')
->paginate(RESULTADOS_POR_PAGINA)
->withQueryString() // Añade los parámetros pasados al paginador como ?q=
$courses->links() // En la vista obtiene los enlaces de paginación
::find(ID) // método simplificado para buscar por id
$course->METHOD // Devuelve una propiedad dinámica (lo que devuelve un método del modelo que utiliza funciones de Laravel - hasOne, belongsTo, etc...)
$model->METHOD()->attach(ID[,ID,ID...]); // Guarda un/varios registro/s en la tabla intermedia de una relación M:N con el/los valor/es indicado/s para la relación. Se debe pasar un objeto, no una colección (por ejemplo, mediante find). Ejemplo: $user = User::find(1); $user->roles()->attach(2, 3); // añadiría al usuario 1 los roles 2 y 3 mediante 2 nuevos registros en la tabla intermedia role_user
$model->METHOD()->dettach(ID[,ID,ID...]); // Elimina el registro de la tabla intermedia
$model->METHOD()->sync(ID[,ID,ID...]); // Elimina todos los registros de la tabla intermedia que hagan referencia al objeto (obtenido, por ejemplo, mediante find) y ejecuta el método attach sobre los ID indicados
$courses=course::select('name as nombre', 'desc')
->first()
->take(NUMERO_REGISTTROS_A_DEVOLVER)
$course->name // no funcionaría con get porque es una colección pero si con first que devuelve un objeto
```
# Autenticación con Breeze
## Breeze
### CLI
``` bash
composer require laravel/breeze [--dev]
php artisan breeze:install [--inertia] // por defecto usa blade para las vistas
npm install
npm run dev
```
### Código destacado
**breeze\app\Http\Requests\Auth\LoginRequest.php**
```php
public function ensureIsNotRateLimited() {
	if (!RateLimiter::tooManyAttempts($this->throttleKey(),5)) { return } // Nº intentos por minuto
	...
```
**breeze\app\Http\Controllers\Auth\RegisterUserController.php**
```php
public function store() {
	...
	event(new Registered($user)); // Tiene un listener asociado
	Auth::login($user) // Comentar para impedir login automático
```	    
**breeze\app\Providers\EventServiceProvider.php**
```php
protected $listen = [
	Registered::class => [
		SendEmailVerificationNotification::class // Está deshabilitado por defecto
```
## Laravel-Permission
### CLI
Instalar con composer y publicar la migración y el archivo config/permission.php:
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```
### Código
Spatie genera los modelos Permission y Role y sus relaciones automáticamente (ver en el paquete de spatie src/models), y la relación de usuarios con estos 2 modelos, pero en el modelo usuario hay que añadir:
```php
use Spatie\Permission\Traits\HasRoles
```
y dentro de la clase User:
```php
use HasRoles;
```
A continuación podemos crear roles con un seeder por ejemplo:
```bash
php artisan make:seeder RoleSeeder
```
Luego en el Seeder:
```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
public function run() {

	// Tabla roles
	$role1 = Role::create('name'=>'Admin');
	$role2 = Role::create('name'=>'Blogger');

	// Tabla permissions
	Permission::create('name'=>'admin.home'); // se recomienda usar el nombre (alias) de la ruta para ubicarlos fácilmente
	Permission::create('name'=>'admin.categories.index');
	Permission::create('name'=>'admin.categories.create');
	Permission::create('name'=>'admin.categories.edit');
	Permission::create('name'=>'admin.categories.destroy'); // lo mismo para tags, posts en el caso de un blog
	
	// Tabla roles_has_permissions
	// Manualmente:
	$role1->permissions()->attach(1,2,3...);
	// O mediante uno de estos metodos:
	$permission->assignRole($role);
	$role->givePermissionTo($permission);
	// Si se desean asociar varios, sicronizando (destruye los que tuviera):
	$permission->syncRoles($roles); // se le debe pasar un array: [$role1, $role2...]
	$role->syncPermissions($permissions); // se le debe pasar un array
	// También se pueden deasignar:
	$role->revokePermissionTo($permission);
	$permission->removeRole($role);	
```
Luego en UserSeeder.php asociaríamos el rol a un usuario:
```php
public function run() {
	// Los roles se almacenan en model_has_roles
	User::create([
		'name' => 'Fulano Mengano'
		...
	])
	[->assignRole($role_name)]
	[->syncRoles($roles)];
```

Recordad añadir el seeder en **/database/seeders/DatabaseSeeder.php**:
```php
$this->call(RoleSeeder::class);
```
Y ejecutar el seeder:
```bash
php artisan migrate:fresh --seed
```
En las vistas, para limitar por rol:

@can('PERMISO')
@endcan

Y en las rutas mediante middleware:
->middleware('can:PERMISO');

### User CRUD
class UserController extends Controller
```bash
php artisan make:controller Admin\UserController - r
```
**app\routes\admin.php**
```php
use App\Http\Controllers\Admin\UserController
Route::resource('users',UserController::class)->names('admin.users');
```
**app\Http\Controllers\Admin\UserController.php**
```php
use Spatie\Permission\Models\Role;
public function index() {
	return view('admin.users.index');
```
**app\resources\views\admin\users\index.blade.php**
-  Copiar vista index.blade.php del nivel superior admin
- En H1 poner lista de usuarios
- En config\adminlte.php añadir un enlace debajo de Dashboard para los usuarios y que apunte a admin.users.index
# Testing
## CLI
```bash
php artisan make:test TeamControllerTest // Crea la clase TeamControllerTest en /tests/Feature
php artisan test --testsuite=Feature --stop-on-failure
```
## TESTS DE EJEMPLO
```php
// UserControllerTest,  trait de ejemplo para autenticación, para usar en el resto de tests
namespace  Tests\Feature;
trait  UserControllerTest { //
function test_user_can_auth() {
	$response = $this->post(route('login'), [
	'email' => 'admin@localhost',
	'password' => 'admin'
]);
	$response->assertRedirect(route('home'));
}
}
// TeamControllerTest
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;

class  TeamControllerTest  extends  TestCase {

	use  UserControllerTest;
	
	public function test_user_can_index_team()
	    {
	        $response = $this->get(route('team.index'));  
	        $response->assertStatus(200); // Respuesta HTTP esperada
	    }

    public function test_user_can_edit_team()
    {
	    $this->test_user_can_auth(); // trait de autenticación
        $faker = Factory::create();
        $id = $faker->numberBetween(Team::all()->first()->id, Team::all()->last()->id); // Genera un ID aleatorio mediante el método del faker con un número entre el primer ID y el último registrado en la base
        $response = $this->get(route('team.edit', [
            'team' => $id,
        ])); // Lo pasa mediante el método GET
        $response->assertStatus(200); // Respuesta HTTP esperada
    }

    public function test_user_can_store_team()
    {
	    $this->test_user_can_auth(); // trait de autenticación
        $team = Team::factory()->make(); // usa el Factory de la clase Team para crear un registro que no persiste en la base ya que se usa el método make y no create. Si usaramos create se duplicaría el registro
        $response = $this->post(route('team.store', [
            'player' => $team->id,
            'name' => $team->name,
            'stadium' => $team->stadium,
        ])); // Pasa el registro creado con el Factory de la clase Team mediante el verbo POST para que finalmente se almacene       
        $response->assertStatus(200);
    }

    public function test_user_cannot_store_team_without_name()
    {
		$this->test_user_can_auth(); // trait de autenticación	
        $team = Team::factory()->make();
        $response = $this->post(route('team.store', [
            'player' => $team->id,
            'name' => null,
            'stadium' => $team->stadium,
        ]));        
        $response->assertStatus(302); // Se intentó almacenar un registro pero el modelo impide que se almacene sin nombre, devolverá 302
    }    

    public function test_user_can_update_team()
    {
		$this->test_user_can_auth(); // trait de autenticación
        $team = Team::factory()->make();
        $faker = Factory::create();
        $id = $faker->numberBetween(Team::all()->first()->id, Team::all()->last()->id);
        $response = $this->put(route('team.update', [
            'team' => $id,
            'id' => $id,
            'name' => $team->name,
            'stadium' => $team->stadium,
        ]));
        $response->assertStatus(200);
    }
	    
    public function test_user_can_destroy_team()
    {
		$this->test_user_can_auth(); // trait de autenticación
        $faker = Factory::create();
        $id = $faker->numberBetween(Team::all()->first()->id, Team::all()->last()->id);
        $response = $this->delete(route('team.destroy', [
            'team' => $id,
            'id' => $id
        ]));
        $response->assertStatus(200);
    }
 ```	
 
