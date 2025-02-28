# User Management App

## Descripción
Esta aplicación permite la gestión de usuarios con autenticación JWT, paginación, búsqueda y estadísticas gráficas.
El backend está desarrollado en Laravel y el frontend en React con DataTables y Recharts.

## Tecnologías Utilizadas
### Backend:
- Laravel
- MySQL
- JWT para autenticación
- Swagger para documentación de la API
- Railway para despliegue

### Frontend:
- React
- React Query / Axios para consumo de la API
- React DataTable para la tabla de usuarios
- Recharts para gráficos
- TailwindCSS para estilos
- Vercel para despliegue

## Instalación y Ejecución
### Backend
1. Clonar el repositorio:
   ```bash
   git clone git@github.com:dianaherrerab/backend-user-management.git
   cd backend-user-management
   ```
2. Instalar dependencias:
   ```bash
   composer install
   ```
3. Generar clave de aplicación:
   ```bash
   php artisan key:generate
   ```
4. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```
5. Levantar el servidor:
   ```bash
   php artisan serve
   ```

## Arquitectura del Proyecto
- **Backend:** Laravel sigue un patrón MVC, con controladores manejando la lógica de negocio y modelos gestionando la base de datos.
- **Frontend:** React estructurado en componentes reutilizables.
- **API:** RESTful con autenticación JWT.
- **Base de Datos:** MySQL con índices optimizados para búsquedas eficientes.

## Optimizaciones Implementadas
1. **Paginación con Laravel** para mejorar el rendimiento en listas grandes.
2. **Búsqueda FULLTEXT** en nombre y email para consultas rápidas.
3. **Autenticación JWT** para mayor seguridad.
4. **DataTables** con filtrado y ordenación eficiente.

## Despliegue
- Backend en [Railway](#)
- Frontend en [Vercel](#)


