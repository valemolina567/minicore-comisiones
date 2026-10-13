# Mini Core de Ventas y Comisiones

Aplicación web desarrollada con **CodeIgniter 4** para gestionar vendedores, registrar ventas y consultar reportes de comisiones. El proyecto utiliza una base de datos MySQL y está desplegado en la nube.

## 🌐 Demo

**Aplicación en producción:** [Mini Core de Ventas y Comisiones](https://minicore-comisiones-mtj4.onrender.com/)

## 📋 Descripción del proyecto

Mini Core de Ventas y Comisiones es una aplicación web que permite administrar la información de vendedores y sus ventas, así como consultar reportes relacionados con las comisiones generadas.

El proyecto fue desarrollado utilizando el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**, que separa la lógica de acceso a datos, la presentación y el control de las solicitudes.

## ✨ Funcionalidades

* **Gestión de vendedores:** consultar y registrar vendedores.
* **Gestión de ventas:** consultar y registrar ventas asociadas a vendedores.
* **Reportes:** acceder a los reportes de ventas y comisiones.
* **Navegación:** menú principal para acceder a las diferentes secciones.
* **Persistencia de datos:** almacenamiento en una base de datos MySQL.
* **Despliegue en la nube:** aplicación publicada mediante Render.

## 🛠️ Tecnologías utilizadas

| Tecnología    | Uso                                           |
| ------------- | --------------------------------------------- |
| PHP           | Lenguaje de programación del backend          |
| CodeIgniter 4 | Framework PHP basado en MVC                   |
| MySQL         | Sistema de gestión de bases de datos          |
| Aiven         | Servicio de base de datos en la nube          |
| Docker        | Contenerización de la aplicación              |
| Apache        | Servidor web                                  |
| Composer      | Gestión de dependencias de PHP                |
| Render        | Despliegue de la aplicación                   |
| Git y GitHub  | Control de versiones y alojamiento del código |

## 🗂️ Estructura del proyecto

```text
minicore-comisiones/
├── app/
│   ├── Config/
│   │   ├── Database.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── Vendedores.php
│   │   ├── Ventas.php
│   │   └── Reportes.php
│   ├── Models/
│   └── Views/
├── public/
├── writable/
├── docker/
│   └── ca.pem
├── .env
├── .env.example
├── .dockerignore
├── Dockerfile
├── composer.json
└── README.md
```

*La estructura representa los componentes principales del proyecto; algunos archivos pueden variar según la configuración local.*

## ⚙️ Requisitos

Para ejecutar el proyecto localmente se recomienda tener instalado:

* PHP 8.2 o superior.
* Composer.
* MySQL.
* Git.
* XAMPP u otro entorno de desarrollo PHP compatible.

## 🚀 Instalación y ejecución local

### 1. Clonar el repositorio

```bash
git clone https://github.com/valemolina567/minicore-comisiones.git
cd minicore-comisiones
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar las variables de entorno

Copia el archivo de ejemplo `.env.example` como `.env` y configura los parámetros de tu entorno local.

Configura, como mínimo, el entorno y los datos de conexión a MySQL según la configuración de CodeIgniter:

```ini
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = minicore_comisiones
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Asegúrate de que la base de datos exista y de que las credenciales correspondan a tu instalación local.

### 4. Ejecutar la aplicación

Desde la carpeta del proyecto, ejecuta:

```bash
php spark serve
```

Abre en el navegador la dirección indicada por CodeIgniter, normalmente:

`http://localhost:8080`

## 🗄️ Base de datos

La aplicación utiliza MySQL para almacenar la información de vendedores, ventas y reglas de comisión.

Las tablas principales son:

* **vendedores:** almacena la información de los vendedores.
* **ventas:** registra las ventas y su relación con los vendedores.
* **reglas_comision:** contiene las reglas utilizadas para calcular las comisiones.

La relación entre vendedores y ventas permite asociar cada venta con el vendedor correspondiente mediante una clave foránea.

En producción, la base de datos está alojada en **Aiven** y la conexión está configurada mediante variables de entorno en Render.

## ☁️ Despliegue

La aplicación está desplegada en Render mediante Docker y utiliza una base de datos MySQL alojada en Aiven.

El archivo `Dockerfile` contiene la configuración necesaria para construir la imagen de la aplicación.

Las variables de entorno de producción se configuran directamente en Render. Entre ellas se encuentran:

* `CI_ENVIRONMENT`
* `DB_HOST`
* `DB_USER`
* `DB_PASSWORD`
* `DB_NAME`
* `DB_PORT`

**Importante:** no publiques contraseñas, credenciales de acceso ni archivos `.env` con información sensible en el repositorio.

## 🏗️ Arquitectura MVC

El proyecto aplica el patrón Modelo-Vista-Controlador:

* **Modelo:** gestiona el acceso y las operaciones sobre los datos.
* **Vista:** presenta la información y los formularios al usuario.
* **Controlador:** procesa las solicitudes, coordina los modelos y selecciona las vistas correspondientes.

Esta separación facilita la organización, el mantenimiento y la ampliación de la aplicación.

## 👩‍💻 Autora

**Valeria Molina**

Proyecto académico de Ingeniería de Software.

---

Desarrollado con PHP, CodeIgniter 4 y MySQL.
