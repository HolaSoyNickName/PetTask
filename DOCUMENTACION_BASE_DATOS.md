Documentación de base de datos - PetTask

1. Configuración de PostgreSQL

Se configuró PostgreSQL como sistema gestor de base de datos para el proyecto PetTask, utilizando Laravel como framework de desarrollo.

Motor: PostgreSQL 18.6
Base de datos: petask
Host: 127.0.0.1
Puerto: 5432 2. Migraciones

Se crearon y ejecutaron las siguientes migraciones:

create_users_table
create_cache_table
create_jobs_table
create_tasks_table
create_pets_table
create_streaks_table 3. Tablas principales
Tasks

Almacena las tareas de los usuarios, incluyendo título, descripción, fecha límite y estado de finalización.

Pets

Almacena la información de las mascotas, incluyendo nombre, especie, nivel y experiencia.

Streaks

Almacena el seguimiento de las rachas de actividades de cada usuario.

4. Relaciones y restricciones
   Tasks tiene una llave foránea user_id relacionada con users.
   Pets tiene una llave foránea user_id relacionada con users y una restricción UNIQUE.
   Streaks tiene una llave foránea user_id relacionada con users y una restricción UNIQUE.
   Se configuró eliminación en cascada para las relaciones con users.
5. Comprobaciones realizadas

Se utilizaron los siguientes comandos:

php artisan db:show
php artisan migrate:status
php artisan db:table tasks
php artisan db:table pets
php artisan db:table streaks

Las comprobaciones confirmaron que PostgreSQL está conectado y que las tablas principales están creadas correctamente.
