# Prueba Backend - Laravel 12 

API desarrollada en **Laravel 12** para la gestión de productos y sistema de precios en múltiples divisas.

## Requisitos del Sistema
- PHP >= 8.2
- Composer
- MySQL o base de datos compatible

--

## Instalación y Configuración Local

1. **Clonar el repositorio:**
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd prueba-backend-Rosangela-Brito
Instalar dependencias de PHP:

Bash
composer install
Configurar el entorno:
Copia el archivo de configuración de ejemplo y configura tu base de datos:

Bash
copy .env.example .env
(En Linux/Mac usa cp .env.example .env)

Generar la llave de la aplicación:

Bash
php artisan key:generate
Ejecutar migraciones y seeders (Base de datos):

Bash
php artisan migrate --seed
Iniciar el servidor local:

Bash
php artisan serve
El servidor estará disponible en http://127.0.0.1:8000.

🔌 Endpoints de la API
Productos (/api/products)
GET /api/products: Obtiene el listado completo de productos.

POST /api/products: Crea un nuevo producto.

Body de ejemplo (JSON):

JSON
{
    "name": "Laptop Gamer Pro",
    "description": "Laptop de alto rendimiento",
    "price": 1200.00,
    "currency_id": 1,
    "tax_cost": 150.00,
    "manufacturing_cost": 800.00
}
GET /api/products/{id}: Muestra el detalle de un producto específico.

PUT/PATCH /api/products/{id}: Actualiza un producto.

DELETE /api/products/{id}: Elimina un producto.

Precios Multidivisa (/api/products/{id}/prices)
GET /api/products/{id}/prices: Consulta los precios del producto en diferentes divisas.

POST /api/products/{id}/prices: Agrega o actualiza un precio en otra divisa para el producto.

Body de ejemplo (JSON):

JSON
{
    "currency_id": 2,
    "price": 1104.00
}