# 🐾 PetTask — CRUD de Tareas con Mascotas

PetTask es una aplicación web de organización de tareas que permite a los usuarios crear recordatorios, administrar sus actividades y dar seguimiento a sus pendientes. Cuenta con una mascota virtual que crece conforme se completan las tareas y que necesita cuidados para mantenerse viva. Su objetivo es motivar a los usuarios a ser más organizados y responsables mediante una experiencia divertida e interactiva.

Aplicación desarrollada en **Laravel** que usa los **cuatro métodos HTTP** (`GET`, `POST`, `PUT/PATCH` y `DELETE`). El proyecto **no utiliza base de datos**: toda la información se almacena temporalmente en la **sesión** de Laravel.

## 👥 Integrantes del equipo

| Integrante | Responsabilidad |
| :--- | :--- |
| Alexander Emir Sandoval Resendiz | Vista de detalle (`show.blade.php`) |
| Ángel Alvarez Del Valle | Lógica del controlador (`PetTaskController.php`) |
| Adolfo Alexander Zarate Garrido | Layout principal y listado (`app.blade.php` / `index.blade.php`) |
| Bryan Yael Hernandez Camargo | Formularios (`create.blade.php` / `edit.blade.php`) |
| Norma Angélica Dector Montiel | Documentación (`README.md` / `readme2.tex`) |
| Mariana Ordaz Cano | Pruebas, capturas y organización de la demo |

## ⚙️ Tecnologías utilizadas
- **Laravel 10/11** (Framework PHP)
- **Blade** (Motor de plantillas)
- **Bootstrap 5** (Estilos)
- **Sesiones de Laravel** (Sin base de datos)
- **Git / GitHub** (Control de versiones)

## 🚀 Instalación paso a paso

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/HolaSoyNickName/PetTask.git
   cd PetTask
