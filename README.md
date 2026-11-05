# 🐾 PetTask — CRUD de Tareas con Mascotas

PetTask es una aplicación web de organización de tareas que permite a los usuarios crear recordatorios, administrar sus actividades y dar seguimiento a sus pendientes. Cuenta con una mascota virtual que crece conforme se completan las tareas y que necesita cuidados para mantenerse viva. Su objetivo es motivar a los usuarios a ser más organizados y responsables mediante una experiencia divertida e interactiva.

Aplicación desarrollada en **Laravel** que utiliza los **cuatro métodos HTTP** (`GET`, `POST`, `PUT/PATCH` y `DELETE`). El proyecto **no utiliza base de datos**: toda la información se almacena temporalmente en la **sesión de Laravel**, cumpliendo con los requisitos de la asignación.

---

## 👥 Integrantes del equipo

| Integrante | Responsabilidad |
| :--- | :--- |
| Alexander Emir Sandoval Resendiz | Vista de detalle (`show.blade.php`) |
| Ángel Alvarez Del Valle | Lógica del controlador (`PetTaskController.php`) |
| Adolfo Alexander Zarate Garrido | Layout principal y listado (`app.blade.php` / `index.blade.php`) |
| Bryan Yael Hernandez Camargo | Formularios (`create.blade.php` / `edit.blade.php`) |
| Norma Angélica Dector Montiel | Documentación (`README.md` / `readme2.tex`) |
| Mariana Ordaz Cano | Pruebas, capturas y organización de la demo |

---

## ⚙️ Tecnologías utilizadas

- **Laravel 10/11:** Framework de desarrollo PHP.
- **Blade:** Motor de plantillas de Laravel.
- **Bootstrap 5:** Herramienta para el diseño de la interfaz.
- **Sesiones de Laravel:** Almacenamiento temporal de información sin utilizar una base de datos.
- **Git y GitHub:** Control de versiones y trabajo colaborativo.

---

## 📋 Requisitos previos

Para ejecutar el proyecto es necesario contar con:

- **PHP:** Versión 8.1 o superior.
- **Composer:** Administrador de dependencias de PHP.
- **Node.js y npm:** Opcionales, en caso de necesitar compilar los archivos de frontend.
- **Git:** Para clonar el repositorio.

---

## 🚀 Instalación paso a paso

Para descargar y ejecutar el proyecto, sigue estos pasos:

**1. Clonar el repositorio:**

```bash
git clone https://github.com/HolaSoyNickName/PetTask.git
```

**2. Entrar a la carpeta del proyecto:**

```bash
cd PetTask
```

**3. Instalar las dependencias de PHP:**

```bash
composer install
```

**4. Crear el archivo de configuración del entorno:**

```bash
cp .env.example .env
```

**5. Generar la clave de la aplicación:**

```bash
php artisan key:generate
```

**6. Instalar las dependencias del frontend (opcional):**

```bash
npm install
npm run build
```

**7. Iniciar el servidor local:**

```bash
php artisan serve
```

**8. Abrir la aplicación en el navegador:**

http://127.0.0.1:8000/tasks

> **Nota:** Este proyecto no necesita configurar una base de datos. La información de las tareas se almacena temporalmente en las sesiones de Laravel.

---

## 📁 Estructura del proyecto

La organización principal de los archivos es la siguiente:

```text
PetTask/
│
├── app/
│   └── Http/
│       └── Controllers/
│           └── PetTaskController.php
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       │
│       └── tasks/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
│
├── routes/
│   └── web.php
│
├── docs/
│   └── screenshots/
│       ├── 01-index.png
│       ├── 02-create.png
│       ├── 03-show.png
│       ├── 04-edit.png
│       └── 05-delete.png
│
├── README.md
└── .env.example
```

---

## 🔗 Tabla de rutas del sistema

El sistema utiliza diferentes rutas para realizar las operaciones de crear, consultar, actualizar y eliminar tareas.

| Método HTTP | URI | Acción | Nombre de ruta | Descripción |
| :--- | :--- | :--- | :--- | :--- |
| GET | `/tasks` | `index()` | `tasks.index` | Muestra todas las tareas registradas. |
| GET | `/tasks/create` | `create()` | `tasks.create` | Muestra el formulario para crear una tarea. |
| POST | `/tasks` | `store()` | `tasks.store` | Guarda una nueva tarea. |
| GET | `/tasks/{id}` | `show()` | `tasks.show` | Muestra los detalles de una tarea. |
| GET | `/tasks/{id}/edit` | `edit()` | `tasks.edit` | Muestra el formulario de edición. |
| PUT/PATCH | `/tasks/{id}` | `update()` | `tasks.update` | Actualiza una tarea existente. |
| DELETE | `/tasks/{id}` | `destroy()` | `tasks.destroy` | Elimina una tarea. |

### Métodos HTTP utilizados

- **GET:** Permite consultar y mostrar información de las tareas.
- **POST:** Se utiliza para registrar nuevas tareas.
- **PUT/PATCH:** Permite modificar la información de una tarea existente.
- **DELETE:** Se utiliza para eliminar tareas registradas.

Con estos cuatro métodos se cumplen las operaciones principales de un CRUD.

---

## 📸 Capturas de pantalla del sistema

A continuación, se muestran las diferentes vistas que conforman la aplicación PetTask.

### 1. Pantalla principal — Listado de tareas

En esta pantalla se muestran las tareas registradas y las opciones para consultar, editar o eliminar cada una.

![Pantalla principal](docs/screenshots/01-index.png)

### 2. Formulario de creación

Permite registrar una nueva tarea ingresando su título, seleccionando una mascota y agregando una descripción.

![Formulario de creación](docs/screenshots/02-create.png)

### 3. Vista de detalle

Muestra la información completa de una tarea seleccionada, incluyendo su título, mascota y descripción.

![Detalle de tarea](docs/screenshots/03-show.png)

### 4. Formulario de edición

Permite modificar los datos de una tarea que ya se encuentra registrada.

![Formulario de edición](docs/screenshots/04-edit.png)

### 5. Eliminación de tareas

Permite eliminar una tarea del listado mediante la opción correspondiente.

![Eliminación de tarea](docs/screenshots/05-delete.png)

> **Nota:** Las imágenes deben guardarse en la carpeta `docs/screenshots/` utilizando exactamente los nombres indicados. Las capturas deben corresponder al funcionamiento real de la aplicación.

---

## 💾 ¿Cómo funciona el almacenamiento en sesión?

PetTask no utiliza una base de datos para guardar la información. En su lugar, utiliza las sesiones de Laravel para almacenar temporalmente las tareas.

El controlador `PetTaskController.php` administra un arreglo de tareas que contiene información como:

- ID de la tarea.
- Título.
- Nombre de la mascota.
- Descripción.

Por ejemplo, al registrar una tarea, el sistema puede guardar sus datos en la sesión de la siguiente manera:

```php
$tasks = session('tasks', []);

$tasks[] = [
    'id' => uniqid(),
    'titulo' => $request->titulo,
    'mascota' => $request->mascota,
    'descripcion' => $request->descripcion,
];

session(['tasks' => $tasks]);
```

De esta manera, la aplicación puede realizar las operaciones CRUD sin necesidad de conectarse a una base de datos.

---

## 🎥 Demostración en vivo (5 minutos)

Para presentar el funcionamiento del proyecto, se realizará una demostración breve donde se explicarán las principales características de la aplicación.

| Tiempo | Responsable | Actividad |
| :--- | :--- | :--- |
| 0:00 – 0:30 | Mariana | Introducción al proyecto y explicación del objetivo. |
| 0:30 – 1:30 | Alexander | Presentación de la pantalla principal y el listado de tareas. |
| 1:30 – 2:30 | Bryan | Demostración de creación y edición de tareas. |
| 2:30 – 3:15 | Emir | Presentación de la vista de detalle. |
| 3:15 – 4:00 | Ángel | Explicación del controlador y almacenamiento mediante sesiones. |
| 4:00 – 4:45 | Angélica | Explicación del README y la tabla de rutas. |
| 4:45 – 5:00 | Todos | Cierre de la presentación. |

---

## ✅ Entregables del proyecto

- [x] Repositorio del proyecto en GitHub.
- [x] Organización del trabajo entre los integrantes.
- [x] Desarrollo de las vistas Blade.
- [x] Controlador para administrar las tareas.
- [x] Implementación de los cuatro métodos HTTP.
- [x] Almacenamiento temporal mediante sesiones.
- [x] Documentación del proyecto.
- [ ] Capturas de pantalla del sistema funcionando.
- [ ] Commits de todos los integrantes.
- [ ] Demostración en vivo de 5 minutos.

---

## 📄 Licencia

PetTask es un proyecto académico desarrollado para la asignatura de Desarrollo Web con Laravel, bajo la supervisión de la profesora Yeniza.

Su finalidad es educativa y permite poner en práctica los conocimientos adquiridos sobre Laravel, vistas Blade, rutas, controladores y operaciones CRUD.

---

**🐾 Hecho con cariño por el equipo PetTask.**
