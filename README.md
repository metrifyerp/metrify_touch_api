# Metrify Cloud ERP

# API ERP Desarrollado con el stack LAMP PHP 7.4, MySQL 8.0.30 y Arquitectura MVC

Desarrollado con el stack LAMP, utilizando PHP 7.4 y MySQL 8.0.30, con una arquitectura MVC.

Se comunica con los componentes de la vista mediante javascript y ajax usando respuestas en formato json, el cúal se encuentra
montado en producción en un Droplet de Digital Ocean con Ubuntu 20.04.

Correo empresarial:
```
metrifyerp@gmail.com
admin@metrifyerp.com
```

Github:
```
User: metrifyerp
Repo: https://github.com/metrifyerp/metrify_touch_api.git
```

Antes de instalar localmente es necesario descargar el repositorio de Metrify:
```
git clone https://github.com/metrifyerp/metrify_touch_api.git
```

Ahora instalamos localmente los complementos de composer (vendor) mediante el archivo de configuración:
composer.json:
```
composer install
```

Cambiar correo empresarial:
```
git config user.email "user@metrifyerp.com"
```

## Configuración Desarrollo

En caso de no necesitar los cambios:
```
git update-index --assume-unchanged src/php/com/metrify/framework/utils/configprod.php
git update-index --assume-unchanged META-INF/context.php
```
En caso de necesitar los cambios:
```
git update-index --no-assume-unchanged META-INF/context.php
```

## Configuración prevía al despliegue

Cambiar la configuración de conexión a la DB:

context.php
```
//Base de datos a la cual se conectará;
define("_DATABASE", "DATABASE");

//Nombre de usuario de conexión
define("_USERNAME", "root");

//Contraseña de usuario
define("_PASSWORD", "root");
```

Trabajar mediante:
git config pull.rebase false  # fusionar

Esta opción crea un nuevo commit de fusión (merge commit) que une los cambios de la rama remota con los cambios de la rama local.



