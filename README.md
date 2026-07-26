<p align="center">
    <br>
    <span style="font-family: 'Playfair Display', Georgia, serif; font-size: 48px; font-weight: 700; background: linear-gradient(135deg, #9e7647, #5c4033); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Hechizos</span>
    <br>
    <span style="font-size: 18px; color: #8b7355;">Diseños y Complementos</span>
</p>

<p align="center">
    <strong>Sistema de gestión de inventario y ventas</strong>
    <br>
    <em>Plataforma web para administración de tienda de artesanías, accesorios y bisutería</em>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-12-rgb(255,45,32)?logo=laravel" alt="Laravel 12">
    <img src="https://img.shields.io/badge/PHP-8.2-777BB4?logo=php" alt="PHP 8.2">
    <img src="https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?logo=tailwindcss" alt="Tailwind CSS 3">
    <img src="https://img.shields.io/badge/MySQL-4479A1?logo=mysql" alt="MySQL">
    <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?logo=alpinedotjs" alt="Alpine.js">
    <img src="https://img.shields.io/badge/DomPDF-FF6B6B" alt="DomPDF">
    <img src="https://img.shields.io/badge/Laravel_Cloud-FF2D20?logo=laravel" alt="Laravel Cloud">
</p>

---

## 📋 Tabla de Contenidos

- [Descripción del Proyecto](#-descripción-del-proyecto)
- [Arquitectura](#-arquitectura)
- [Características](#-características)
- [Stack Tecnológico](#-stack-tecnológico)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Base de Datos](#-base-de-datos)
- [Requisitos Previos](#-requisitos-previos)
- [Instalación con XAMPP](#-instalación-con-xampp)
- [Configuración](#-configuración)
- [Seeders y Datos de Prueba](#-seeders-y-datos-de-prueba)
- [Ejecución de Tests](#-ejecución-de-tests)
- [Despliegue en Laravel Cloud](#-despliegue-en-laravel-cloud)
- [Uso del Sistema](#-uso-del-sistema)
- [API de Rutas](#-api-de-rutas)
- [Desarrollo y Contribución](#-desarrollo-y-contribución)
- [Licencia](#-licencia)

---

## 📖 Descripción del Proyecto

**Hechizos Diseños y Complementos** es un sistema web completo para la administración integral de una tienda de artesanías, accesorios, bisutería, ropa importada y artículos decorativos. El sistema permite gestionar el inventario, registrar ventas tanto presenciales como en línea, administrar clientes y categorías, generar facturas en PDF, realizar cierres de caja diarios con reportes descargables, y ofrecer un catálogo público con carrito de compras para clientes.

Está desarrollado con **Laravel 12** (PHP 8.2+), utilizando **Tailwind CSS 3** con una paleta de colores beige personalizada, **Alpine.js** para interactividad en el frontend, **MySQL** como base de datos local y **PostgreSQL** en producción, y **DomPDF** para la generación de documentos PDF.

---

## 🏗 Arquitectura

El sistema sigue la arquitectura **MVC (Modelo-Vista-Controlador)** de Laravel con una separación clara entre:

- **Modelos** (`app/Models/`): Representan las entidades del negocio y contienen la lógica de acceso a datos, relaciones y scopes de consulta.
- **Controladores** (`app/Http/Controllers/`): Manejan las peticiones HTTP, validan datos, orquestan la lógica de negocio y retornan respuestas (vistas o redirecciones).
- **Vistas** (`resources/views/`): Plantillas Blade con diseño responsivo, organizadas por módulo funcional (admin/, auth/, carrito/, catalogo/, checkout/, pedidos/, profile/).

### Flujo de Datos

```
Navegador → Ruta (web.php) → Middleware (auth, verified, role) → Controlador → Modelo → Base de Datos
                                                                      ↓
                                                              Vista Blade → HTML + CSS + JS → Navegador
```

### Autenticación y Autorización

El sistema utiliza el sistema de autenticación de Laravel Breeze con dos roles:

- **admin**: Acceso completo al panel de administración (productos, categorías, inventario, clientes, ventas, cierres, reportes).
- **cliente**: Acceso al catálogo público, carrito de compras, checkout y visualización de sus propios pedidos.

Los roles se verifican mediante un middleware personalizado que valida el campo `role` en la tabla `users`.

---

## ✨ Características

### Módulo Administrativo

| Funcionalidad | Descripción |
|---|---|
| **Dashboard** | Panel con estadísticas en tiempo real: total de productos, categorías, clientes, ventas, ingresos del día, productos con stock bajo, y últimas ventas. Banner de cierre de día siempre visible. |
| **Productos** | CRUD completo con nombre, descripción, precio, stock, stock mínimo, imagen, categoría y estado (activo/inactivo). |
| **Categorías** | CRUD completo con nombre, descripción y estado. Vista en tarjetas con contador de productos. |
| **Inventario** | Historial de movimientos de entrada/salida con registro de producto, cantidad, motivo y usuario que realizó el movimiento. Actualización automática de stock. |
| **Clientes** | Listado de usuarios registrados con datos de contacto (nombre, email, cédula, teléfono, dirección). |
| **Ventas Presenciales** | Registro de ventas en mostrador con selector dinámico de productos (Alpine.js), cálculo automático de totales, y descuento de stock. |
| **Ventas Online** | Gestión de pedidos realizados por clientes a través del catálogo público. Cambio de estados: pendiente → confirmado → enviado → entregado. Cancelación desde cualquier estado. |
| **Acciones Rápidas** | Botones de cambio de estado directamente en la tabla de ventas con modal de confirmación. |
| **Facturación PDF** | Generación y descarga de facturas en PDF para cada venta con datos del cliente, productos, cantidades, precios y total. |
| **Cierre Diario** | Cierre de ventas del día con generación de PDF detallado (ventas agrupadas por hora, totales). Botón siempre disponible en el dashboard. Historial de cierres con descarga de PDFs. |
| **Reporte Mensual** | Generación de PDF con todas las ventas del mes seleccionado, desglosadas por día con subtotales diarios y gran total. |

### Módulo Público

| Funcionalidad | Descripción |
|---|---|
| **Landing Page** | Página principal con hero section, productos destacados aleatorios, productos más vendidos de la semana, y sección informativa. |
| **Catálogo de Productos** | Grid de productos con filtros por categoría, búsqueda por nombre/descripción, y paginación. |
| **Detalle de Producto** | Vista individual con imagen, precio, disponibilidad, selector de cantidad, botón de agregar al carrito, y productos relacionados. |
| **Carrito de Compras** | Carrito basado en sesión con edición de cantidades, eliminación de items, y cálculo automático de total. |
| **Checkout** | Proceso de pago con resumen del pedido y datos del cliente. Confirmación de pedido con número de seguimiento. |
| **Pedidos** | Historial de pedidos del cliente con estados y descarga de facturas PDF. |
| **Productos Más Vendidos** | Sección "Producto estrella de la semana" que muestra los 4 productos con más ventas en los últimos 7 días. Visible en landing, catálogo y dashboard del cliente. |

### Diseño y Experiencia de Usuario

- **Paleta de colores**: Beige personalizada con 16 tonos (50-900) para una apariencia elegante y consistente.
- **Tipografía**: Playfair Display para títulos e Inter para textos, importadas desde Google Fonts.
- **Componentes reutilizables**: Botones (primary, secondary, outline, danger, success, purple), tarjetas (card, card-hover, card-glass), badges, tablas, formularios, animaciones.
- **Responsive**: Diseño adaptativo para dispositivos móviles, tablets y escritorio.
- **Animaciones**: Transiciones suaves en hover, fade-in, fade-in-up, slide-down.

---

## 🛠 Stack Tecnológico

### Backend

| Tecnología | Versión | Propósito |
|---|---|---|
| **PHP** | ^8.2 | Lenguaje de programación |
| **Laravel** | ^12.0 | Framework web MVC |
| **Laravel Breeze** | * | Sistema de autenticación |
| **DomPDF (barryvdh)** | ^3.1 | Generación de PDFs |
| **MySQL** | — | Base de datos local |
| **PostgreSQL** | 18 | Base de datos en producción (Laravel Cloud) |

### Frontend

| Tecnología | Versión | Propósito |
|---|---|---|
| **Tailwind CSS** | ^3.1 | Framework CSS utilitario |
| **Alpine.js** | ^3.4 | Interactividad en frontend |
| **Vite** | ^7.0 | Bundler de assets |
| **PostCSS** | ^8.4 | Procesador CSS |
| **Google Fonts** | — | Playfair Display + Inter |

### Infraestructura

| Herramienta | Propósito |
|---|---|
| **XAMPP** | Entorno de desarrollo local |
| **Composer** | Gestor de dependencias PHP |
| **npm** | Gestor de dependencias Node |
| **Git/GitHub** | Control de versiones |
| **Laravel Cloud** | Hosting en producción (serverless) |
| **GitHub Actions** | CI/CD (despliegue automático) |

---

## 📁 Estructura del Proyecto

```
sistema-tienda-ropa/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── CategoriaController.php      # CRUD categorías
│   │   │   │   ├── CierreDiarioController.php    # Cierre de ventas diario
│   │   │   │   ├── ClienteController.php         # Listado de clientes
│   │   │   │   ├── InventarioController.php      # Movimientos de inventario
│   │   │   │   ├── ProductoController.php        # CRUD productos
│   │   │   │   ├── ReporteController.php         # Reporte mensual PDF
│   │   │   │   └── VentaController.php           # Gestión de ventas
│   │   │   ├── Auth/                             # Controladores de autenticación
│   │   │   ├── CarritoController.php             # Carrito de compras (sesión)
│   │   │   ├── CatalogoController.php            # Catálogo público
│   │   │   ├── CheckoutController.php            # Proceso de pago
│   │   │   ├── FacturaController.php             # Descarga de facturas PDF
│   │   │   ├── PedidoController.php              # Historial de pedidos del cliente
│   │   │   └── ProfileController.php             # Perfil de usuario
│   │   └── Middleware/                           # Middleware personalizado
│   ├── Models/
│   │   ├── Categoria.php                         # Categorías de productos
│   │   ├── CierreDiario.php                      # Cierres de ventas diarios
│   │   ├── MovimientoInventario.php              # Movimientos de inventario
│   │   ├── Producto.php                          # Productos
│   │   ├── User.php                              # Usuarios (admin/cliente)
│   │   ├── Venta.php                             # Ventas
│   │   └── VentaProducto.php                     # Items de cada venta
│   └── View/Components/                          # Componentes Blade
├── bootstrap/
│   └── app.php                                   # Configuración de Laravel 11+
├── config/
│   ├── app.php                                   # Configuración general
│   ├── auth.php                                  # Configuración de autenticación
│   ├── database.php                              # Configuración de BD
│   └── dompdf.php                                # Configuración de DomPDF
├── database/
│   ├── migrations/                               # Migraciones de BD
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_07_09_122329_create_movimientos_inventario_table.php
│   │   ├── 2026_07_09_123145_create_ventas_table.php
│   │   ├── 2026_07_09_123146_create_venta_productos_table.php
│   │   ├── 2026_07_09_194128_create_categorias_table.php
│   │   ├── 2026_07_09_205911_create_productos_table.php
│   │   └── 2026_07_22_000001_create_cierres_diarios_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php                    # Orquestador de seeders
│       ├── AdminUserSeeder.php                   # Usuario admin por defecto
│       ├── CategoriaSeeder.php                   # 7 categorías demo
│       ├── ProductoSeeder.php                    # 9 productos demo
│       └── DemoDataSeeder.php                    # Datos demo completos
├── resources/
│   ├── css/
│   │   └── app.css                               # Estilos Tailwind + componentes
│   ├── js/
│   │   └── app.js                                # Alpine.js + configuración
│   └── views/
│       ├── admin/                                # Vistas del panel admin
│       │   ├── categorias/                       # CRUD categorías
│       │   ├── cierres/                          # Cierres diarios
│       │   ├── clientes/                         # Listado de clientes
│       │   ├── inventario/                       # Movimientos de inventario
│       │   ├── productos/                        # CRUD productos
│       │   └── ventas/                           # Gestión de ventas
│       ├── auth/                                 # Vistas de autenticación
│       ├── carrito/                              # Carrito de compras
│       ├── catalogo/                             # Catálogo público
│       ├── checkout/                             # Proceso de pago
│       ├── layouts/                              # Layouts base
│       ├── pedidos/                              # Pedidos del cliente
│       ├── profile/                              # Perfil de usuario
│       ├── dashboard.blade.php                   # Dashboard principal
│       ├── factura.blade.php                     # Plantilla PDF factura
│       └── welcome.blade.php                     # Landing page
├── routes/
│   ├── web.php                                   # Todas las rutas web
│   └── auth.php                                  # Rutas de autenticación
├── tests/                                        # Tests PHPUnit
├── .env.example                                  # Ejemplo de configuración
├── composer.json                                 # Dependencias PHP
├── package.json                                  # Dependencias Node
├── phpunit.xml                                   # Configuración PHPUnit
├── tailwind.config.js                            # Configuración Tailwind
└── vite.config.js                                # Configuración Vite
```

---

## 💾 Base de Datos

### Esquema Relacional

```
users
├── id (PK)
├── name, email, password
├── cedula, telefono, direccion
├── role (enum: admin, cliente)
└── timestamps

categorias
├── id (PK)
├── nombre, descripcion
├── activo (boolean)
└── timestamps

productos
├── id (PK)
├── categoria_id (FK → categorias)
├── nombre, descripcion
├── precio (decimal: 10,2)
├── stock (integer), stock_minimo (integer)
├── imagen (string, nullable)
├── activo (boolean)
└── timestamps

movimientos_inventario
├── id (PK)
├── producto_id (FK → productos)
├── user_id (FK → users, nullable)
├── tipo (enum: entrada, salida)
├── cantidad (integer)
├── motivo (text, nullable)
└── timestamps

ventas
├── id (PK)
├── user_id (FK → users)
├── total (decimal: 10,2)
├── estado (enum: pendiente, confirmado, enviado, entregado, cancelado)
└── timestamps

venta_productos
├── id (PK)
├── venta_id (FK → ventas, cascade)
├── producto_id (FK → productos, cascade)
├── cantidad (integer)
├── precio_unitario (decimal: 10,2)
├── subtotal (decimal: 10,2)
└── timestamps

cierres_diarios
├── id (PK)
├── fecha (date, unique)
├── total_ventas (decimal: 10,2)
├── cantidad_ventas (integer)
├── user_id (FK → users, nullable)
├── pdf_path (string, nullable)
└── timestamps
```

### Diagrama de Relaciones

- **users** 1 → N **ventas** (un usuario puede tener muchas ventas)
- **users** 1 → N **movimientos_inventario** (un usuario registra muchos movimientos)
- **users** 1 → N **cierres_diarios** (un usuario realiza muchos cierres)
- **categorias** 1 → N **productos** (una categoría agrupa muchos productos)
- **productos** 1 → N **venta_productos** (un producto aparece en muchas ventas)
- **productos** 1 → N **movimientos_inventario** (un producto tiene muchos movimientos)
- **ventas** 1 → N **venta_productos** (una venta contiene muchos items)

---

## 📋 Requisitos Previos

Antes de instalar el proyecto, asegúrate de tener instalado:

| Software | Versión Mínima | Descarga |
|---|---|---|
| **XAMPP** | 8.2+ | [https://www.apachefriends.org/](https://www.apachefriends.org/) |
| **PHP** | 8.2 | Incluido en XAMPP |
| **Composer** | 2.x | [https://getcomposer.org/](https://getcomposer.org/) |
| **Node.js** | 18+ | [https://nodejs.org/](https://nodejs.org/) |
| **npm** | 9+ | Incluido con Node.js |
| **Git** | 2.x | [https://git-scm.com/](https://git-scm.com/) |

### Verificar Instalaciones

```bash
php --version
composer --version
node --version
npm --version
git --version
```

---

## 🚀 Instalación con XAMPP

### 1. Clonar el Repositorio

```bash
# Navega al directorio htdocs de XAMPP
cd C:\xampp\htdocs

# Clona el repositorio
git clone https://github.com/Salvaberticci/sistema-tienda-ropa.git

# Entra al directorio del proyecto
cd sistema-tienda-ropa
```

### 2. Configurar Variables de Entorno

```bash
# Copia el archivo de ejemplo de entorno
copy .env.example .env
```

Luego edita el archivo `.env` con tus credenciales de base de datos:

```env
APP_NAME="Hechizos Diseños y Complementos"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost/sistema-tienda-ropa/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_tienda
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Instalar Dependencias PHP

```bash
composer install
```

### 4. Generar la Clave de la Aplicación

```bash
php artisan key:generate
```

### 5. Crear la Base de Datos

Abre **phpMyAdmin** (http://localhost/phpmyadmin) o la terminal de MySQL:

```bash
# Opción 1: con phpMyAdmin
# Crea una base de datos llamada "sistema_tienda" con collation utf8mb4_unicode_ci

# Opción 2: con línea de comandos MySQL (si está disponible)
mysql -u root -e "CREATE DATABASE IF NOT EXISTS sistema_tienda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 6. Ejecutar Migraciones y Seeders

```bash
# Ejecuta todas las migraciones
php artisan migrate

# Puebla la base de datos con datos de prueba
php artisan db:seed
```

El seeder creará:
- **Usuario admin**: `admin@hechizos.com` / `password`
- **2 clientes demo**: `maria@test.com` / `password`, `carlos@test.com` / `password`
- **7 categorías** de productos
- **21 productos** para poblar el catálogo
- **Movimientos de inventario** (entradas y salidas)
- **5 ventas** en diferentes estados (pendiente, confirmado, enviado, entregado)

### 7. Instalar Dependencias Frontend

```bash
npm install
```

### 8. Compilar Assets

```bash
# Para desarrollo (con watch):
npm run dev

# Para producción:
npm run build
```

### 9. Configurar el Servidor Web

#### Opción A: Usar el servidor integrado de Laravel (recomendado para desarrollo)

```bash
php artisan serve
```

Luego abre http://localhost:8000 en tu navegador.

#### Opción B: Configurar XAMPP (Apache)

Edita `C:\xampp\apache\conf\extra\httpd-vhosts.conf` y agrega:

```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/sistema-tienda-ropa/public"
    ServerName sistema-tienda.test

    <Directory "C:/xampp/htdocs/sistema-tienda-ropa/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Luego agrega `127.0.0.1 sistema-tienda.test` al archivo `C:\Windows\System32\drivers\etc\hosts`.

### 10. Verificar la Instalación

```bash
# Limpiar cachés
php artisan optimize:clear

# Verificar estado
php artisan about
```

Abre http://localhost:8000 o http://sistema-tienda.test en tu navegador. Deberías ver la landing page de **Hechizos Diseños y Complementos**.

---

## ⚙️ Configuración

### Archivo `.env`

Las variables más importantes del archivo `.env`:

```env
# Aplicación
APP_NAME="Hechizos Diseños y Complementos"
APP_ENV=local                    # local | production | testing
APP_DEBUG=true                   # true en desarrollo, false en producción
APP_URL=http://localhost:8000    # URL base de la aplicación

# Base de Datos
DB_CONNECTION=mysql              # mysql | pgsql | sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_tienda
DB_USERNAME=root
DB_PASSWORD=

# Sesión
SESSION_DRIVER=file              # file | database | cookie

# Cache
CACHE_STORE=file                 # file | database | redis

# Almacenamiento
FILESYSTEM_DISK=local            # local | public | s3
```

### Crear Enlace de Almacenamiento (para imágenes)

```bash
php artisan storage:link
```

Esto crea un enlace simbólico desde `public/storage` a `storage/app/public`. Si estás en Windows y el comando falla, puedes crear el enlace manualmente:

```bash
# Windows (cmd como administrador)
mklink /D C:\xampp\htdocs\sistema-tienda-ropa\public\storage C:\xampp\htdocs\sistema-tienda-ropa\storage\app\public
```

---

## 🧪 Seeders y Datos de Prueba

### Seeders Disponibles

```bash
# Ejecutar todos los seeders
php artisan db:seed

# Ejecutar un seeder específico
php artisan db:seed --class=AdminUserSeeder
php artisan db:seed --class=CategoriaSeeder
php artisan db:seed --class=ProductoSeeder
php artisan db:seed --class=DemoDataSeeder
```

### Descripción de Cada Seeder

| Seeder | Tablas que Puebla | Descripción |
|---|---|---|
| `AdminUserSeeder` | `users` | Crea el usuario administrador por defecto |
| `CategoriaSeeder` | `categorias` | Crea 7 categorías (Collares, Pulseras, Artesanías, Accesorios, Ropa, Importados, Decoración) |
| `ProductoSeeder` | `productos` | Crea 9 productos base (collares, pulseras, artesanías, accesorios) |
| `DemoDataSeeder` | `users`, `productos`, `movimientos_inventario`, `ventas`, `venta_productos` | Crea 2 clientes demo, 12 productos adicionales, movimientos de inventario y 5 ventas completas |

### Credenciales de Prueba

| Rol | Email | Contraseña |
|---|---|---|
| **Administrador** | admin@hechizos.com | password |
| **Cliente** | maria@test.com | password |
| **Cliente** | carlos@test.com | password |

### Reiniciar Base de Datos Completamente

```bash
# Elimina todas las tablas, las recrea y ejecuta los seeders
php artisan migrate:fresh --seed
```

---

## 🧪 Ejecución de Tests

### Configuración

Los tests están configurados para usar **SQLite en memoria** como base de datos de testing (configurado en `phpunit.xml`):

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

Esto asegura que los tests sean rápidos y no afecten la base de datos de desarrollo.

### Ejecutar Todos los Tests

```bash
php artisan test
```

O usando PHPUnit directamente:

```bash
vendor/bin/phpunit
```

### Ejecutar Tests con Cobertura

```bash
# Si tienes Xdebug instalado
php artisan test --coverage
```

### Estructura de Tests

Los tests se encuentran en el directorio `tests/`:

```
tests/
├── Feature/        # Tests de integración (rutas, controladores, autenticación)
├── Unit/           # Tests unitarios (modelos, scopes, helpers)
└── TestCase.php    # Clase base para tests
```

### Escribir Nuevos Tests

Los tests siguen la convención de Laravel usando PHPUnit:

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductoTest extends TestCase
{
    public function test_un_usuario_admin_puede_ver_listado_de_productos(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)
            ->get(route('admin.productos.index'));

        $response->assertStatus(200);
    }
}
```

### Comandos Útiles de Testing

```bash
# Ejecutar tests de un archivo específico
vendor/bin/phpunit tests/Feature/ProductoTest.php

# Ejecutar tests con nombre específico
vendor/bin/phpunit --filter "test_un_usuario_puede_ver_catalogo"

# Ejecutar tests con verbose output
php artisan test --verbose

# Detener en el primer fallo
php artisan test --stop-on-failure
```

---

## ☁️ Despliegue en Laravel Cloud

### Prerrequisitos

- Cuenta en [Laravel Cloud](https://cloud.laravel.com)
- Repositorio en GitHub

### Pasos para el Despliegue

1. **Conectar el repositorio**: En el dashboard de Laravel Cloud, crea un nuevo proyecto y conecta tu repositorio de GitHub.

2. **Configurar variables de entorno**: Agrega las siguientes variables en el panel de Laravel Cloud:

   ```env
   APP_KEY=base64_...
   APP_ENV=production
   APP_DEBUG=false
   ```

   > **Nota**: Laravel Cloud inyecta automáticamente `DB_HOST`, `DB_CONNECTION=pgsql` y las credenciales de la base de datos PostgreSQL. No necesitas configurarlas manualmente.

3. **Configurar el comando de build** (en el panel de Laravel Cloud):

   ```bash
   composer install --no-dev && npm ci && npm run build
   ```

   Este comando se ejecuta en cada despliegue:
   - `composer install --no-dev`: Instala dependencias PHP sin paquetes de desarrollo.
   - `npm ci`: Instala dependencias Node desde `package-lock.json` (instalación limpia).
   - `npm run build`: Compila los assets CSS y JS con Vite.

4. **Comando de deploy** (Laravel Cloud ejecuta automáticamente):

   ```bash
   php artisan migrate --force
   ```

   > Las migraciones se ejecutan automáticamente durante el despliegue. No es necesario agregarlas manualmente.

5. **Activar Object Storage** (opcional, para imágenes):

   Si el sistema utilizará subida de imágenes de productos, agrega un recurso "Object Storage" en Laravel Cloud y configura:

   ```env
   FILESYSTEM_DISK=cloud
   AWS_BUCKET=...
   AWS_ACCESS_KEY_ID=...
   AWS_SECRET_ACCESS_KEY=...
   AWS_DEFAULT_REGION=...
   ```

### Despliegue Automático

Cada vez que hagas `git push` a la rama `main`, Laravel Cloud detectará los cambios y ejecutará el pipeline de despliegue automáticamente:

1. Clona el repositorio
2. Ejecuta el comando de build
3. Ejecuta `php artisan migrate --force`
4. Publica la nueva versión (zero-downtime)

### Comandos Útiles en Laravel Cloud

Desde el panel "Commands" de tu entorno:

```bash
# Ejecutar seeders en producción
php artisan db:seed --force

# Ver el estado de las migraciones
php artisan migrate:status

# Limpiar caché
php artisan optimize:clear

# Ver logs
php artisan pail
```

### URL de Producción

La aplicación desplegada está disponible en:
[https://sistema-tienda-ropa-production-t0hdew.free.laravel.cloud](https://sistema-tienda-ropa-production-t0hdew.free.laravel.cloud)

---

## 🎯 Uso del Sistema

### Usuario Administrador

1. **Iniciar sesión** con `admin@hechizos.com` / `password`
2. **Dashboard**: Visualiza estadísticas generales del negocio y el banner de cierre de día.
3. **Productos**: Agrega, edita o elimina productos del catálogo. Asigna categorías, precios y stock.
4. **Categorías**: Crea categorías para organizar los productos.
5. **Inventario**: Registra movimientos de entrada (compras a proveedores) o salida (ventas en mostrador, ajustes).
6. **Clientes**: Visualiza los usuarios registrados en el sistema.
7. **Ventas**:
   - **Nueva venta**: Registra ventas presenciales seleccionando productos y cantidades dinámicamente.
   - **Listado**: Visualiza todas las ventas, cambia estados con botones de acción rápida.
   - **Reporte mensual**: Descarga PDF con resumen de ventas del mes.
8. **Cierres**: Cierra el día de ventas desde el dashboard y descarga el PDF. Historial de todos los cierres.
9. **Perfil**: Edita tu información personal y contraseña.

### Usuario Cliente

1. **Registrarse** o **iniciar sesión** con `maria@test.com` / `password`
2. **Catálogo**: Navega productos, filtra por categoría o busca por nombre.
3. **Carrito**: Agrega productos al carrito, ajusta cantidades, elimina items.
4. **Checkout**: Confirma el pedido con tus datos de envío.
5. **Pedidos**: Visualiza el historial de tus pedidos y descarga facturas PDF.
6. **Dashboard**: Ve los productos más vendidos de la semana.

### Gestión de Estados de Ventas

El flujo de estados sigue este orden:

```
pedido online:   Pendiente → Confirmado → Enviado → Entregado
                                                ↘ Cancelado
venta presencial:          Confirmado → Enviado → Entregado
                                                ↘ Cancelado
```

---

## 🛣 API de Rutas

### Rutas Públicas (sin autenticación)

| Método | URI | Nombre | Controlador |
|---|---|---|---|
| GET | `/` | `home` | Closure → `welcome.blade.php` |
| GET | `/productos` | `catalogo.index` | `CatalogoController@index` |
| GET | `/productos/{producto}` | `catalogo.show` | `CatalogoController@show` |
| GET | `/carrito` | `carrito.index` | `CarritoController@index` |
| POST | `/carrito` | `carrito.store` | `CarritoController@store` |
| PATCH | `/carrito/{id}` | `carrito.update` | `CarritoController@update` |
| DELETE | `/carrito/{id}` | `carrito.destroy` | `CarritoController@destroy` |

### Rutas Autenticadas (middleware: auth)

| Método | URI | Nombre | Controlador |
|---|---|---|---|
| GET | `/checkout` | `checkout.index` | `CheckoutController@index` |
| POST | `/checkout` | `checkout.store` | `CheckoutController@store` |
| GET | `/checkout/{venta}` | `checkout.confirmacion` | `CheckoutController@confirmacion` |
| GET | `/pedidos` | `pedidos.index` | `PedidoController@index` |
| GET | `/pedidos/{venta}` | `pedidos.show` | `PedidoController@show` |
| GET | `/factura/{venta}` | `factura.view` | `FacturaController@view` |
| GET | `/factura/{venta}/download` | `factura.download` | `FacturaController@download` |

### Rutas Autenticadas + Verified (middleware: auth, verified)

| Método | URI | Nombre |
|---|---|---|
| GET | `/dashboard` | `dashboard` |
| GET | `/profile` | `profile.edit` |
| PATCH | `/profile` | `profile.update` |
| DELETE | `/profile` | `profile.destroy` |

### Rutas Admin (middleware: auth, verified, role:admin, prefix: /admin)

| Método | URI | Nombre |
|---|---|---|
| GET | `/admin/dashboard` | `admin.dashboard` |
| CRUD | `/admin/categorias` | `admin.categorias.*` |
| CRUD | `/admin/productos` | `admin.productos.*` |
| GET | `/admin/inventario` | `admin.inventario.index` |
| GET | `/admin/inventario/crear` | `admin.inventario.create` |
| POST | `/admin/inventario` | `admin.inventario.store` |
| GET | `/admin/clientes` | `admin.clientes.index` |
| GET | `/admin/clientes/{user}` | `admin.clientes.show` |
| GET | `/admin/ventas` | `admin.ventas.index` |
| GET | `/admin/ventas/crear` | `admin.ventas.create` |
| POST | `/admin/ventas` | `admin.ventas.store` |
| GET | `/admin/ventas/{venta}` | `admin.ventas.show` |
| PATCH | `/admin/ventas/{venta}` | `admin.ventas.update` |
| GET | `/admin/ventas/reporte-mensual` | `admin.ventas.reporte-mensual` |
| POST | `/admin/ventas/reporte-mensual` | `admin.ventas.reporte-mensual.download` |
| GET | `/admin/cierres` | `admin.cierres.index` |
| GET | `/admin/cierres/pendiente` | `admin.cierres.pendiente` |
| POST | `/admin/cierres` | `admin.cierres.store` |
| GET | `/admin/cierres/{cierre}/download` | `admin.cierres.download` |

---

## 🧑‍💻 Desarrollo y Contribución

### Comandos de Desarrollo

```bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets en modo desarrollo (con watch)
npm run dev

# Compilar assets para producción
npm run build

# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders
php artisan db:seed

# Limpiar cachés
php artisan optimize:clear

# Ver todas las rutas
php artisan route:list

# Ver todos los comandos disponibles
php artisan list
```

### Flujo de Trabajo Recomendado

1. **Iniciar XAMPP** (Apache + MySQL)
2. **Iniciar el servidor de desarrollo**: `php artisan serve`
3. **Compilar assets en modo watch**: `npm run dev`
4. **Desarrollar** con recarga automática del navegador

### Estándares de Código

- PHP sigue PSR-12 (verificar con `./vendor/bin/pint`)
- Nombres de tablas en plural y snake_case
- Modelos en singular y PascalCase
- Controladores en PascalCase con sufijo Controller
- Vistas Blade en kebab-case dentro de directorios con prefijo del módulo
- Rutas con nombres descriptivos en formato `modulo.accion`

---

## 📄 Licencia

Este proyecto fue desarrollado como parte de un proyecto universitario para la gestión de **Hechizos Diseños y Complementos**, una tienda de artesanías, accesorios y bisutería ubicada en Trujillo, Venezuela.

&copy; 2026 — Todos los derechos reservados.

---

<p align="center">
    <span style="font-family: 'Playfair Display', Georgia, serif; font-size: 20px; color: #8b7355;">
        Hechizos — Diseños y Complementos
    </span>
    <br>
    <span style="color: #aaa; font-size: 12px;">
        Av. Independencia, Calle 3 Miranda — C.C. Plaza Marina, 2do piso, Local 30<br>
        Municipio Trujillo, Estado Trujillo
    </span>
</p>
