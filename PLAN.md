# Sistema de Información Web — Hechizos Diseños y Complementos

## Datos del Proyecto

| Campo | Valor |
|-------|-------|
| **Institución** | Universidad Politécnica Territorial "Mario Briceño Iragorry" — Valera, Estado Trujillo |
| **Autor** | Salvador Salerno C.I: 28.206.457 |
| **Año** | 2026 |
| **Negocio** | Hechizos Diseños y Complementos |
| **Ubicación** | Av. Independencia, Calle 3 Miranda, C.C. Plaza Marina 2do piso, Local 30. Municipio Trujillo, Estado Trujillo |

---

## Stack Tecnológico

| Tecnología | Versión | Uso |
|------------|---------|-----|
| PHP | 8.2.4 | Lenguaje backend |
| Laravel | 12.x | Framework PHP |
| MySQL | 8.x | Base de datos |
| Tailwind CSS | 3.x | Estilos |
| Alpine.js | 3.x | Interactividad frontend |
| Vite | 7.x | Bundler de assets |
| Laravel Breeze | 2.x | Autenticación scaffold |
| DomPDF | ^3.1 | Generación de PDF (facturas y reportes) |
| Composer | Último | Gestor de dependencias PHP |
| Node.js / npm | Último | Gestor de dependencias JS |

---

## Identidad Visual

### Paleta de colores — Blanco, beige y estilo animalista

```js
// tailwind.config.js
colors: {
  beige: {
    50:  '#faf8f3',
    100: '#f5f0e1',
    200: '#e8dcc8',
    300: '#d4c5a9',
    400: '#c4a97d',
    500: '#b08a5a',
    600: '#8b6914',
    700: '#5c4033',
    800: '#3e2b22',
    900: '#2a1c15',
  }
}
```

| Color | Hex | Aplicación |
|-------|-----|------------|
| Blanco | `#ffffff` | Fondos principales, tarjetas, contenido |
| Beige claro | `#f5f0e1` | Fondos secundarios, secciones alternas |
| Beige medio | `#e8dcc8` | Bordes, hover states |
| Beige oscuro | `#c4a97d` | Botones primarios, headers, acentos |
| Marrón animal print | `#8b6914` | Textos destacados, hover en botones |
| Marrón oscuro | `#5c4033` | Títulos, footer, elementos de contraste |

### Tipografía
- **Títulos:** Playfair Display (serif elegante) — Google Fonts
- **Cuerpo:** Inter o Outfit (sans-serif limpia) — Google Fonts

### Estilo visual
- Diseño luminoso, limpio y elegante (tienda de diseño y artesanía)
- Patrón sutil animal print (leopardo/zebra) en hero section o banners decorativos
- Ambiente natural / boho / artesanal en fotos y presentación de productos
- Botones con bordes cálidos, sombras suaves
- Iconografía minimalista y orgánica

---

## Base de Datos

### Esquema general

> Convención de nombres: tablas en plural español, timestamps automáticos, `softDeletes` donde aplique.

#### Tabla: `users`
| Columna | Tipo | Restricciones |
|---------|------|---------------|
| id | bigint AI | PK |
| name | varchar(255) | NOT NULL |
| email | varchar(255) | UNIQUE, NOT NULL |
| password | varchar(255) | NOT NULL |
| cedula | varchar(20) | NULLABLE |
| telefono | varchar(20) | NULLABLE |
| direccion | text | NULLABLE |
| role | enum('admin','cliente') | DEFAULT 'cliente' |
| remember_token | varchar(100) | NULLABLE |
| timestamps | — | created_at, updated_at |

#### Tabla: `categorias`
| Columna | Tipo | Restricciones |
|---------|------|---------------|
| id | bigint AI | PK |
| nombre | varchar(100) | NOT NULL |
| descripcion | text | NULLABLE |
| activo | boolean | DEFAULT true |
| timestamps | — | — |

#### Tabla: `productos`
| Columna | Tipo | Restricciones |
|---------|------|---------------|
| id | bigint AI | PK |
| categoria_id | bigint | FK → categorias.id, ON DELETE SET NULL |
| nombre | varchar(255) | NOT NULL |
| descripcion | text | NULLABLE |
| precio | decimal(10,2) | NOT NULL |
| stock | integer | DEFAULT 0 |
| stock_minimo | integer | DEFAULT 5 |
| imagen | varchar(255) | NULLABLE (ruta de archivo) |
| activo | boolean | DEFAULT true |
| timestamps | — | — |

#### Tabla: `movimientos_inventario`
| Columna | Tipo | Restricciones |
|---------|------|---------------|
| id | bigint AI | PK |
| producto_id | bigint | FK → productos.id |
| tipo | enum('entrada','salida') | NOT NULL |
| cantidad | integer | NOT NULL |
| motivo | text | NULLABLE |
| user_id | bigint | FK → users.id, NULLABLE |
| timestamps | — | — |

#### Tabla: `ventas`
| Columna | Tipo | Restricciones |
|---------|------|---------------|
| id | bigint AI | PK |
| user_id | bigint | FK → users.id (cliente), NULLABLE (venta presencial sin registro) |
| cliente_nombre | varchar(255) | NULLABLE (para ventas presenciales sin user) |
| total | decimal(10,2) | NOT NULL |
| metodo_pago | enum('efectivo','transferencia','pago_movil','tarjeta') | DEFAULT 'efectivo' |
| estado | enum('completada','anulada') | DEFAULT 'completada' |
| tipo | enum('presencial','web') | DEFAULT 'presencial' |
| timestamps | — | — |

#### Tabla: `venta_detalles`
| Columna | Tipo | Restricciones |
|---------|------|---------------|
| id | bigint AI | PK |
| venta_id | bigint | FK → ventas.id, ON DELETE CASCADE |
| producto_id | bigint | FK → productos.id |
| cantidad | integer | NOT NULL |
| precio_unitario | decimal(10,2) | NOT NULL (precio al momento de la venta) |
| subtotal | decimal(10,2) | NOT NULL |
| timestamps | — | — |

#### Tabla: `facturas`
| Columna | Tipo | Restricciones |
|---------|------|---------------|
| id | bigint AI | PK |
| venta_id | bigint | FK → ventas.id, UNIQUE |
| numero_factura | varchar(50) | UNIQUE, NOT NULL (formato: FACT-YYYYMM-XXXX) |
| total | decimal(10,2) | NOT NULL |
| timestamps | — | — |

#### Tabla: `carrito`
| Columna | Tipo | Restricciones |
|---------|------|---------------|
| id | bigint AI | PK |
| user_id | bigint | FK → users.id, ON DELETE CASCADE |
| producto_id | bigint | FK → productos.id |
| cantidad | integer | NOT NULL, DEFAULT 1 |
| timestamps | — | — |

#### Tabla: `pagos`
| Columna | Tipo | Restricciones |
|---------|------|---------------|
| id | bigint AI | PK |
| venta_id | bigint | FK → ventas.id |
| monto | decimal(10,2) | NOT NULL |
| metodo | varchar(50) | NOT NULL |
| referencia | varchar(255) | NULLABLE |
| estado | enum('pendiente','confirmado','rechazado') | DEFAULT 'confirmado' |
| timestamps | — | — |

---

## Roles de Usuario

| Rol | Acceso |
|-----|--------|
| **admin** | Panel administrativo completo: CRUD productos, categorías, inventario, ventas, clientes, facturación, usuarios, reportes |
| **cliente** | Catálogo público, carrito de compras, historial de pedidos, edición de perfil |

---

## Rutas del Sistema

### Rutas públicas (sin autenticación)

| Método | URI | Controlador | Descripción |
|--------|-----|-------------|-------------|
| GET | `/` | `Web\CatalogoController@index` | Landing page / portada |
| GET | `/productos` | `Web\CatalogoController@index` | Catálogo público con filtros |
| GET | `/productos/{producto}` | `Web\CatalogoController@show` | Detalle del producto |
| GET | `/registro` | `Auth\RegisteredUserController@create` | Formulario registro cliente |
| POST | `/registro` | `Auth\RegisteredUserController@store` | Procesar registro |
| GET | `/login` | `Auth\AuthenticatedSessionController@create` | Formulario login |
| POST | `/login` | `Auth\AuthenticatedSessionController@store` | Procesar login |

### Rutas de clientes (auth, role:cliente)

| Método | URI | Controlador | Descripción |
|--------|-----|-------------|-------------|
| GET | `/carrito` | `Web\CarritoController@index` | Ver carrito |
| POST | `/carrito/agregar` | `Web\CarritoController@store` | Agregar producto al carrito |
| DELETE | `/carrito/{carrito}` | `Web\CarritoController@destroy` | Quitar producto del carrito |
| GET | `/checkout` | `Web\CarritoController@checkout` | Resumen y finalizar compra |
| POST | `/pedidos` | `Web\PedidoController@store` | Procesar pedido |
| GET | `/mis-pedidos` | `Web\PedidoController@index` | Historial de pedidos del cliente |
| GET | `/mis-pedidos/{venta}` | `Web\PedidoController@show` | Detalle del pedido |

### Rutas administrativas (auth, role:admin)

| Método | URI | Controlador | Descripción |
|--------|-----|-------------|-------------|
| GET | `/admin/dashboard` | `Admin\DashboardController@index` | Panel con estadísticas |
| GET | `/admin/productos` | `Admin\ProductoController@index` | Listado de productos |
| GET | `/admin/productos/crear` | `Admin\ProductoController@create` | Formulario crear producto |
| POST | `/admin/productos` | `Admin\ProductoController@store` | Guardar producto |
| GET | `/admin/productos/{producto}/editar` | `Admin\ProductoController@edit` | Formulario editar producto |
| PUT/PATCH | `/admin/productos/{producto}` | `Admin\ProductoController@update` | Actualizar producto |
| DELETE | `/admin/productos/{producto}` | `Admin\ProductoController@destroy` | Eliminar producto |
| GET | `/admin/categorias` | `Admin\CategoriaController@index` | Listado de categorías |
| GET | `/admin/categorias/crear` | `Admin\CategoriaController@create` | Formulario crear categoría |
| POST | `/admin/categorias` | `Admin\CategoriaController@store` | Guardar categoría |
| GET | `/admin/categorias/{categoria}/editar` | `Admin\CategoriaController@edit` | Formulario editar categoría |
| PUT/PATCH | `/admin/categorias/{categoria}` | `Admin\CategoriaController@update` | Actualizar categoría |
| DELETE | `/admin/categorias/{categoria}` | `Admin\CategoriaController@destroy` | Eliminar categoría |
| GET | `/admin/inventario` | `Admin\InventarioController@index` | Movimientos y stock actual |
| GET | `/admin/inventario/crear` | `Admin\InventarioController@create` | Formulario movimiento |
| POST | `/admin/inventario` | `Admin\InventarioController@store` | Registrar movimiento |
| GET | `/admin/ventas` | `Admin\VentaController@index` | Listado de ventas |
| GET | `/admin/ventas/crear` | `Admin\VentaController@create` | Formulario venta presencial |
| POST | `/admin/ventas` | `Admin\VentaController@store` | Procesar venta presencial |
| GET | `/admin/ventas/{venta}` | `Admin\VentaController@show` | Detalle de venta |
| GET | `/admin/facturas/{venta}` | `Admin\FacturaController@show` | Ver factura en HTML |
| GET | `/admin/facturas/{venta}/pdf` | `Admin\FacturaController@pdf` | Descargar factura PDF |
| GET | `/admin/clientes` | `Admin\ClienteController@index` | Listado de clientes (users con role=cliente) |
| GET | `/admin/clientes/{user}` | `Admin\ClienteController@show` | Historial de compras del cliente |
| GET | `/admin/reportes` | `Admin\ReporteController@index` | Panel de reportes |
| GET | `/admin/reportes/productos-mas-vendidos` | `Admin\ReporteController@productosMasVendidos` | PDF — productos más vendidos |
| GET | `/admin/reportes/ventas-por-periodo` | `Admin\ReporteController@ventasPorPeriodo` | PDF — ventas en un rango de fechas |
| GET | `/admin/usuarios` | `Admin\UsuarioController@index` | Gestión de administradores |
| GET | `/admin/usuarios/crear` | `Admin\UsuarioController@create` | Formulario crear admin |
| POST | `/admin/usuarios` | `Admin\UsuarioController@store` | Guardar admin |
| GET | `/admin/usuarios/{user}/editar` | `Admin\UsuarioController@edit` | Formulario editar admin |
| PUT/PATCH | `/admin/usuarios/{user}` | `Admin\UsuarioController@update` | Actualizar admin |

---

## Estructura de Archivos

```
sistema-tienda-ropa/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                    # Breeze scaffold
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProductoController.php
│   │   │   │   ├── CategoriaController.php
│   │   │   │   ├── InventarioController.php
│   │   │   │   ├── VentaController.php
│   │   │   │   ├── FacturaController.php
│   │   │   │   ├── ClienteController.php
│   │   │   │   ├── ReporteController.php
│   │   │   │   └── UsuarioController.php
│   │   │   ├── Web/
│   │   │   │   ├── CatalogoController.php
│   │   │   │   ├── CarritoController.php
│   │   │   │   └── PedidoController.php
│   │   │   └── Controller.php
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php
│   │   └── Requests/                   # Form requests (validación)
│   ├── Models/
│   │   ├── User.php
│   │   ├── Producto.php
│   │   ├── Categoria.php
│   │   ├── MovimientoInventario.php
│   │   ├── Venta.php
│   │   ├── VentaDetalle.php
│   │   ├── Factura.php
│   │   ├── Carrito.php
│   │   └── Pago.php
│   └── Providers/
│       └── AppServiceProvider.php
│
├── bootstrap/
│   └── app.php                          # Registro de middleware
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   └── dompdf.php                       # Config DomPDF
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2026_07_XX_create_categorias_table.php
│   │   ├── 2026_07_XX_create_productos_table.php
│   │   ├── 2026_07_XX_create_movimientos_inventario_table.php
│   │   ├── 2026_07_XX_create_ventas_table.php
│   │   ├── 2026_07_XX_create_venta_detalles_table.php
│   │   ├── 2026_07_XX_create_facturas_table.php
│   │   ├── 2026_07_XX_create_carrito_table.php
│   │   └── 2026_07_XX_create_pagos_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── AdminUserSeeder.php
│       ├── CategoriaSeeder.php
│       └── ProductoSeeder.php
│
├── public/
│   ├── .htaccess
│   ├── index.php
│   ├── build/                            # Vite build output
│   └── storage/                          # Symlink a storage/app/public
│
├── resources/
│   ├── css/
│   │   └── app.css                       # Tailwind directives + personalizados
│   ├── js/
│   │   ├── app.js                        # Alpine.js init
│   │   └── bootstrap.js
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php             # Layout admin (sidebar + navbar)
│       │   ├── guest.blade.php           # Layout login/register
│       │   └── public.blade.php          # Layout tienda pública
│       ├── components/
│       │   ├── admin-sidebar.blade.php
│       │   ├── admin-navbar.blade.php
│       │   ├── public-navbar.blade.php
│       │   ├── public-footer.blade.php
│       │   ├── product-card.blade.php
│       │   └── input-error.blade.php
│       ├── auth/                          # Breeze scaffold (login, register, etc.)
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── productos/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── categorias/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── inventario/
│       │   │   ├── index.blade.php
│       │   │   └── create.blade.php
│       │   ├── ventas/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── show.blade.php
│       │   ├── clientes/
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   ├── reportes/
│       │   │   └── index.blade.php
│       │   └── usuarios/
│       │       ├── index.blade.php
│       │       ├── create.blade.php
│       │       └── edit.blade.php
│       ├── public/
│       │   ├── landing.blade.php
│       │   ├── catalogo.blade.php
│       │   ├── producto-detalle.blade.php
│       │   ├── carrito.blade.php
│       │   ├── checkout.blade.php
│       │   └── mis-pedidos.blade.php
│       ├── pdf/
│       │   ├── layout.blade.php
│       │   ├── factura.blade.php
│       │   ├── productos-mas-vendidos.blade.php
│       │   └── ventas-por-periodo.blade.php
│       └── profile/                       # Breeze scaffold
│
├── routes/
│   ├── web.php
│   └── auth.php                          # Breeze scaffold
│
├── storage/
│   ├── app/public/productos/             # Imágenes de productos
│   └── framework/
│
├── tailwind.config.js
├── vite.config.js
├── postcss.config.js
├── composer.json
├── package.json
├── .env
└── .env.example
```

---

## Plan de Implementación (11 Fases)

### Fase 1 — Inicialización del proyecto
- `composer create-project laravel/laravel .`
- `composer require laravel/breeze --dev`
- `php artisan breeze:install blade`
- `npm install && npm run build`
- Configurar `.env` con conexión MySQL
- Crear base de datos `hechizos_tienda`
- Instalar `composer require barryvdh/laravel-dompdf`
- Configurar colores personalizados en `tailwind.config.js`
- Configurar tipografías (Playfair Display + Inter)
- Crear layout `guest.blade.php` con branding
- Verificar que todo funciona (`php artisan serve`)

### Fase 2 — Autenticación y Roles
- Modificar migración `users`: agregar `role`, `cedula`, `telefono`, `direccion`
- Modificar `RegisteredUserController` para incluir campos extra y asignar `role = 'cliente'`
- Modificar `LoginRequest` para login con email
- Crear `RoleMiddleware`
- Registrar middleware en `bootstrap/app.php`
- Crear rutas admin protegidas por `role:admin`
- Modificar registro para redirigir según rol
- Seeders: crear admin por defecto (`admin@hechizos.com` / `password`)

### Fase 3 — Módulo Categorías (Admin)
- Modelo `Categoria` con fillable, relationships
- `CategoriaController` — CRUD completo
- Migración `create_categorias_table`
- Vistas: index, create, edit
- ClienteSeeder con categorías iniciales (Collares, Pulseras, Artesanías, Accesorios, Importados)

### Fase 4 — Módulo Productos (Admin)
- Modelo `Producto` con fillable, relationships
- `ProductoController` — CRUD completo con subida de imágenes
- Migración `create_productos_table`
- Vistas: index (tabla + tarjetas), create (formulario con imagen), edit
- Almacenamiento de imágenes en `storage/app/public/productos/`
- Enlace público simbólico (`php artisan storage:link`)

### Fase 5 — Módulo Inventario (Admin)
- Modelo `MovimientoInventario`
- `InventarioController` — listar movimientos, registrar entrada/salida
- Migración `create_movimientos_inventario_table`
- Vistas: index (historial con filtros), create (formulario)
- Lógica: al registrar movimiento, actualizar `stock` en `productos`
- Alerta visual cuando `stock <= stock_minimo`

### Fase 6 — Módulo Clientes (Admin)
- `ClienteController` — listar clientes (users con role=cliente), ver detalle con historial de compras
- Vistas: index (tabla con búsqueda), show (perfil + pedidos)
- Sin migración extra (usa tabla `users`)

### Fase 7 — Catálogo Público
- `CatalogoController` — landing page, listado de productos (con filtro por categoría)
- Vista `landing.blade.php`: hero con patrón animal print, productos destacados, CTA
- Vista `catalogo.blade.php`: grid de productos con cards, filtro por categoría, buscador
- Vista `producto-detalle.blade.php`: imagen grande, descripción, precio, botón "Agregar al carrito"
- Layout `public.blade.php`: navbar con logo, enlaces, carrito (cantidad), footer con datos de la tienda

### Fase 8 — Carrito de Compras
- Modelo `Carrito` con relationships
- `CarritoController` — index, store, destroy
- Migración `create_carrito_table`
- Vistas: `carrito.blade.php` (lista de productos, cantidades, total, botón checkout)
- Lógica: carrito por usuario autenticado
- Badge en navbar mostrando cantidad de items

### Fase 9 — Checkout y Pedidos
- `PedidoController` — procesar pedido, historial
- Vista `checkout.blade.php`: resumen del pedido, seleccionar método de pago, confirmar
- Vista `mis-pedidos.blade.php`: tabla de pedidos del cliente
- Lógica:
  1. Validar stock disponible
  2. Crear `Venta` (tipo=web, estado=completada)
  3. Crear `VentaDetalle` por cada item
  4. Descontar stock de productos
  5. Registrar movimiento de inventario (salida)
  6. Vaciar carrito
  7. Redirigir a detalle del pedido con mensaje de éxito

### Fase 10 — Ventas Presenciales y Facturación
- `VentaController@create` — formulario para venta manual (seleccionar productos, cantidades, calcular total)
- `VentaController@store` — procesar venta presencial, descontar stock, crear factura
- `FacturaController@show` — vista HTML de factura
- `FacturaController@pdf` — generar PDF con DomPDF
- Migración `create_facturas_table` + `create_pagos_table`
- Vistas: ventas/index, ventas/create, ventas/show, pdf/factura
- Formato número de factura: `HECHIZOS-FACT-YYYYMM-XXXX`

### Fase 11 — Dashboard y Reportes
- `DashboardController@index` — tarjetas con stats (ventas hoy, ventas mes, productos bajos en stock, total clientes)
- `ReporteController@index` — panel de reportes con filtros de fecha
- `ReporteController@productosMasVendidos` — PDF con top 10
- `ReporteController@ventasPorPeriodo` — PDF con ventas agrupadas por día/mes
- Vistas admin/dashboard, admin/reportes/index
- Vistas PDF para reportes

---

## Dependencias

### Composer (PHP)
```json
{
  "require": {
    "php": "^8.2",
    "laravel/framework": "^12.0",
    "laravel/tinker": "^2.10",
    "barryvdh/laravel-dompdf": "^3.1"
  },
  "require-dev": {
    "laravel/breeze": "^2.4",
    "laravel/pail": "^1.2",
    "laravel/pint": "^1.24",
    "nunomaduro/collision": "^8.6",
    "phpunit/phpunit": "^11.5",
    "mockery/mockery": "^1.6",
    "fakerphp/faker": "^1.23"
  }
}
```

### npm (Frontend)
```json
{
  "devDependencies": {
    "tailwindcss": "^3.1",
    "@tailwindcss/forms": "^0.5",
    "@tailwindcss/vite": "^4.0",
    "alpinejs": "^3.4",
    "autoprefixer": "^10.4",
    "axios": "^1.11",
    "laravel-vite-plugin": "^2.0",
    "postcss": "^8.4",
    "vite": "^7.0"
  }
}
```

---

## Comandos Útiles

```bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets (desarrollo)
npm run dev

# Compilar assets (producción)
npm run build

# Ejecutar migraciones
php artisan migrate:fresh --seed

# Crear enlace simbólico para imágenes
php artisan storage:link

# Limpiar caché
php artisan optimize:clear
```

---

## Seeders (Datos Iniciales)

### AdminUserSeeder
```php
User::create([
    'name'     => 'Administrador',
    'email'    => 'admin@hechizos.com',
    'password' => bcrypt('password'),
    'role'     => 'admin',
    'cedula'   => 'V-12345678',
]);
```

### CategoriaSeeder
```php
$categorias = ['Collares', 'Pulseras', 'Artesanías', 'Accesorios', 'Ropa', 'Importados', 'Decoración'];
```

### ProductoSeeder (10-15 productos demo con imágenes placeholder)

---

## Notas Adicionales

### Validaciones importantes
- Cédula venezolana: formato `V-12345678`, `E-12345678`, `J-12345678`
- Teléfono: formato `+58 412-1234567`
- Precios: formato decimal con 2 decimales
- Stock: no puede ser negativo
- Email: único por usuario

### Seguridad
- Todas las rutas admin protegidas por middleware `auth` + `role:admin`
- Validación con Form Requests para todas las entradas
- Subida de imágenes: solo formatos jpg, png, webp; máximo 2MB
- Escape de salida con Blade (`{{ }}`)
- CSRF Protection activo por defecto

### Características extra (post-MVP)
- [ ] Catálogo con paginación
- [ ] Búsqueda por nombre de producto con AJAX
- [ ] Filtro combinado (categoría + precio + búsqueda)
- [ ] Notificaciones de stock bajo por email
- [ ] Exportar ventas a Excel
- [ ] Múltiples imágenes por producto
- [ ] Variantes de producto (talla, color)
- [ ] Cupones de descuento
- [ ] Integración con pagos en línea (PayPal, Zelle, etc.)
- [ ] Modo oscuro
- [ ] Página "Quiénes somos"
- [ ] Sección de reseñas de clientes
