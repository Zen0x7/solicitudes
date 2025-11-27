# Solicitudes

[![CI](https://github.com/Zen0x7/solicitudes/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/Zen0x7/solicitudes/actions/workflows/ci.yml)
[![codecov](https://codecov.io/gh/Zen0x7/solicitudes/graph/badge.svg?token=LGJZ2II0NJ)](https://codecov.io/gh/Zen0x7/solicitudes)

## Instrucciones

Ejecute los siguientes comandos en un entorno con `composer`, `php`, `node@24` y `yarn`.

```bash
git clone git@github.com:Zen0x7/solicitudes.git
cd solicitudes
cp .env.example .env
composer install
yarn && yarn build
php artisan migrate --force
php artisan db:seed
php artisan key:generate
php artisan serve
```

## Características

- Puedes ingresar solicitudes.
- Puedes ejercer acciones sobre las solicitudes (aprobación y rechazo).
- Puedes buscar solicitudes por número de documento.
- Sí hay más de 10 solicitudes puedes navegar entre páginas.
- Puedes ordenar los registros de forma ascendente y descendente por identificador, número de documento y fecha de creación.

## Aspectos técnicos

- El proyecto cuenta con CI y pruebas unitarias en backend y frontend.
- Las rutas, controladores, modelos, recursos y repositorios son simples y limpios.
- Los endpoints de solicitudes cumplen con los códigos REST y manejan errores.
- El frontend está construido con Vue 3, Pinia, Tailwindcss, HeadlessUI y Heroicons.
- Las actualizaciones son manejadas cuando existe mutación del estado en base de datos y solo se obtiene un bloque de registros.

## Sobre la tubería automatizada

1. Corre sobre Ubuntu.
2. Cachea dependencias (frontend y backend).
3. Instala Node 24.
4. Instala dependencias del frontend.
5. Transpila el código a javascript.
6. Copia las variables de entorno.
7. Configura PHP con `dom, curl, libxml, mbstring, zip, pcntl, pdo, sqlite, pdo_sqlite, bcmath, soap, intl, gd, exif, iconv, mysql`.
8. Instala dependencias del backend.
9. Prepara la aplicación Laravel.
10. Corre las pruebas.
11. Actualiza el reporte de cobertura.

## Sobre la gestión del proyecto

El sistema se construyó en 5 ramas:

- [#1 CI Added **rama: feature/ci**](https://github.com/Zen0x7/solicitudes/pull/1): Se incorporó un proceso de pruebas automatizadas sobre un proyecto nuevo en laravel.
- [#2 Backend Added **rama: feature/backend**](https://github.com/Zen0x7/solicitudes/pull/2): Se incorporó una API con todos los métodos de RESTful para el recurso solicitud.
- [#3 Typo Fixed **rama: hotfix/typo-fixed**](https://github.com/Zen0x7/solicitudes/pull/3): Se reparó un detalle tipográfico en un controlador (intencional para demostrar branching).
- [#4 Frontend Added **rama: feature/frontend**](https://github.com/Zen0x7/solicitudes/pull/4): Se incorporó una SPA que implementa los métodos y funcionalidades **solicitadas**.
- [#5 Instructions Added **rama: feature/instructions**](https://github.com/Zen0x7/solicitudes/pull/5): Se instrucciones de despliegue al frontend.
