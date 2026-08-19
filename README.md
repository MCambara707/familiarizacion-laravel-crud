# Productos CRUD — Laravel

CRUD de productos (crear, listar, editar, eliminar) hecho con Laravel +
Eloquent + Blade, usando MySQL/MariaDB como base de datos y Bootstrap 5
(vía CDN) para el estilo. Es el mismo CRUD y la misma tabla `productos`
que la versión de CodeIgniter 3 (`../codeigniter-productos-crud`) — sirve
para comparar cómo resuelve cada framework exactamente lo mismo.

## Requisitos

- PHP 8.1 o superior
- Composer
- MySQL o MariaDB corriendo localmente (o accesible por red)

## 1. Instalar dependencias

Si clonaste el proyecto sin la carpeta `vendor/` (por ejemplo, si lo
copiaste sin incluirla), instala las dependencias con Composer:

```bash
composer install
```

## 2. Configurar las variables de entorno (`.env`)

Laravel lee la configuración de la base de datos desde el archivo `.env`.
Si no existe, cópialo desde la plantilla:

```bash
cp .env.example .env
php artisan key:generate
```

Abre `.env` y edita estas líneas con los datos de **tu** MySQL/MariaDB
local:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=productos_crud
DB_USERNAME=root
DB_PASSWORD=
```

- `DB_DATABASE`: el nombre de la base de datos (créala primero, ver paso 3).
- `DB_USERNAME` / `DB_PASSWORD`: tu usuario y contraseña de MySQL/MariaDB
  (en XAMPP/MAMP local suele ser `root` con contraseña vacía).

## 3. Crear la base de datos y las tablas

Crea la base de datos vacía (una sola vez):

```sql
CREATE DATABASE productos_crud;
```

Y deja que Laravel cree la tabla `productos` (y sus tablas internas de
sesiones, cache, etc.) ejecutando las migraciones:

```bash
php artisan migrate
```

La tabla `productos` que se crea es:

```sql
CREATE TABLE productos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

## 4. Levantar el servidor

```bash
php artisan serve
```

Abre [http://127.0.0.1:8000/productos](http://127.0.0.1:8000/productos) en
el navegador.

## Estructura relevante

- `app/Models/Producto.php` — modelo Eloquent.
- `app/Http/Controllers/ProductoController.php` — controlador con las 5
  acciones del CRUD (index, create, store, edit, update, destroy).
- `database/migrations/*_create_productos_table.php` — definición de la
  tabla.
- `resources/views/productos/` — vistas Blade (`index`, `create`, `edit`).
- `resources/views/layouts/app.blade.php` — layout compartido con
  Bootstrap 5 vía CDN.
- `routes/web.php` — rutas (`Route::resource('productos', ...)`).

## Notas

- El código no usa `declare(strict_types=1)` ni tipado estricto en los
  métodos del controlador/modelo a propósito — es tipado ligero,
  consistente con cómo suelen verse los ejemplos "estándar" de Laravel.
- Si ves un error `SQLSTATE[HY000] [2002] Connection refused` al abrir
  `/productos`, es porque MySQL/MariaDB no está corriendo o los datos del
  `.env` no coinciden con tu instalación local — no es un bug del CRUD.

## 🧪 Ejercicio de práctica — antes de arrancar el proyecto

**Modalidad**: por equipo — para los equipos a los que les tocó **Laravel**
en el proyecto integrador "Oficina del Agua".
**Entrega**: sábado 22 de agosto (antes de pasar a la Semana 2 — desarrollo del
proyecto).

### Objetivo

Esta carpeta es el ejemplo, no el ejercicio. La prueba de concepto es que tu
equipo tome esta misma estructura como plantilla y construya, desde cero, un
CRUD completo (crear, listar, editar, eliminar) para una **entidad distinta**
de `productos` — para practicar Eloquent, migraciones y Blade con las manos
antes de que el esfuerzo real se vaya al proyecto.

### Qué tabla elegir

Elige una entidad simple relacionada con "Oficina del Agua" — no hace falta
que sea una de las tablas finales del proyecto ni que el modelo de datos sea
definitivo, solo que sirva para practicar el flujo completo. Por ejemplo:
`clientes`, `contadores` o `tarifas`.

### Pasos (siguiendo el mismo patrón que `productos`)

1. **Migración**: `php artisan make:migration create_<entidad>_table` y
   define las columnas, siguiendo el mismo estilo que
   `database/migrations/*_create_productos_table.php`.
2. **Modelo**: `php artisan make:model <Entidad>` — un modelo Eloquent
   simple, igual que `app/Models/Producto.php` (sin lógica extra todavía).
3. **Controlador**: `php artisan make:controller <Entidad>Controller
   --resource` y completa las mismas 5 acciones que
   `ProductoController.php` (`index`, `create`, `store`, `edit`, `update`,
   `destroy`).
4. **Vistas**: crea `resources/views/<entidad>/` con `index`, `create` y
   `edit`, reutilizando `resources/views/layouts/app.blade.php` para
   mantener el mismo look con Bootstrap 5.
5. **Ruta**: agrega `Route::resource('<entidad>', <Entidad>Controller::class);`
   en `routes/web.php`.
6. Corre `php artisan migrate` para crear la tabla nueva y prueba las 4
   operaciones en el navegador antes de dar por terminado.

### Requisitos técnicos

- MySQL/MariaDB real vía Eloquent (nada de datos hardcodeados en el
  controlador).
- Validación real en el `store`/`update` del controlador (con `$request->validate()`
  o un `FormRequest` propio) — al menos un campo requerido y un tipo
  numérico o de longitud.
- Blade debe mostrar los errores de validación (`@error`) igual que
  esperarías ver en un formulario de Laravel estándar.

### Entregables

- La carpeta del CRUD funcionando (o el commit/rama correspondiente si ya
  vive en el repositorio del equipo).
- Captura de pantalla de las 4 operaciones (listar, crear, editar, eliminar)
  funcionando contra MySQL/MariaDB.
