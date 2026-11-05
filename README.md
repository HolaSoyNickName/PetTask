# 🐾 PetTask

**Organiza tus tareas escolares y avanza junto a tu mascota virtual.**

## 📖 Descripción

PetTask es una aplicación web diseñada para ayudar a los estudiantes a organizar y administrar sus actividades escolares de una manera sencilla, visual y divertida.

Su propósito es fomentar la responsabilidad y la constancia mediante elementos de gamificación, como mascotas virtuales, rachas de actividad y recompensas.

## 🎯 Objetivo del proyecto

Desarrollar una herramienta que facilite la organización de tareas escolares y motive a los estudiantes a cumplir con sus actividades académicas.

## ✨ Funcionalidades

### Implementadas

- Visualización de tareas escolares.
- Registro de nuevas tareas.
- Edición de tareas existentes.
- Consulta de detalles de cada tarea.
- Eliminación de tareas con confirmación personalizada.
- Clasificación de tareas por materia.
- Estados de tareas: pendientes y completadas.
- Estadísticas de tareas registradas, completadas y pendientes.

### Funcionalidades contempladas para el proyecto

- Sistema de rachas de actividad diaria.
- Mascotas virtuales que acompañan al estudiante.
- Recompensas por completar actividades.
- Tienda de artículos para personalizar las mascotas.
- Recordatorios y notificaciones.

## 🛠️ Tecnologías utilizadas

- **Laravel:** framework para el desarrollo del backend.
- **PHP:** lenguaje de programación.
- **Blade:** motor de plantillas para las vistas.
- **Bootstrap 5:** diseño de interfaces responsivas.
- **Bootstrap Icons:** iconografía.
- **HTML y CSS:** estructura y estilos de la aplicación.
- **JavaScript:** interactividad de la interfaz.

## 🎨 Diseño

La interfaz de PetTask está basada en los principios de Material Design y utiliza la siguiente paleta de colores:

| Color            | Código    |
| ---------------- | --------- |
| Fondo azul claro | `#E5EAF5` |
| Rosa             | `#FF6F82` |
| Azul claro       | `#8FA3ED` |
| Azul             | `#557FFC` |
| Azul marino      | `#1E1E50` |
| Blanco           | `#FFFFFF` |

## 📸 Capturas de pantalla

En esta sección se muestran las principales interfaces de PetTask.

### 1. Página principal

Vista general de la aplicación, estadísticas y listado de tareas.

![Página principal de PetTask](docs/capturas/inicio.png)

### 2. Crear tarea

Formulario para registrar una nueva tarea escolar.

![Crear tarea](docs/capturas/crear-tarea.png)

### 3. Editar tarea

Formulario para modificar la información de una tarea.

![Editar tarea](docs/capturas/editar-tarea.png)

### 4. Detalles de la tarea

Visualización de la información de una tarea seleccionada.

![Detalles de la tarea](docs/capturas/detalles-tarea.png)

### 5. Confirmación de eliminación

Ventana personalizada para confirmar la eliminación de una tarea.

![Confirmación de eliminación](docs/capturas/eliminar-tarea.png)

## ⚙️ Instalación y ejecución

### Requisitos previos

- PHP.
- Composer.
- Node.js y npm.
- Git.

### 1. Clonar el repositorio

```bash
git clone https://github.com/HolaSoyNickName/PetTask.git
```

### 2. Entrar a la carpeta

```bash
cd PetTask
```

### 3. Instalar dependencias

```bash
composer install
```

### 4. Crear el archivo de configuración

```bash
cp .env.example .env
```

En Windows también puedes copiar `.env.example` y renombrar la copia como `.env`.

### 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 6. Instalar dependencias del frontend

```bash
npm install
```

### 7. Iniciar la aplicación

En una terminal ejecuta:

```bash
php artisan serve
```

En otra terminal ejecuta:

```bash
npm run dev
```

Abre en tu navegador:

`http://127.0.0.1:8000`

## 📂 Estructura del proyecto

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
│   └── Capturas/
│       ├── inicio.png
│       ├── crear-tarea.png
│       ├── editar-tarea.png
│       ├── detalles-tarea.png
│       └── eliminar-tarea.png
│
└── README.md
```

## 👥 Equipo de desarrollo

Proyecto académico desarrollado de manera colaborativa.

## 📌 Estado del proyecto

PetTask se encuentra en desarrollo. Actualmente cuenta con las funcionalidades principales para la administración de tareas escolares y una interfaz visual personalizada.

Las características de gamificación se contemplan como parte de las siguientes etapas de desarrollo.

---

**PetTask — ¡Organiza tus tareas, cuida tu mascota y alcanza tus metas! 🐾**
