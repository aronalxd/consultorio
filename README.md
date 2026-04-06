# Consultorio MVC clínico

## Incluye
- login con `usuarios.password_hash`
- roles y permisos conectados
- menú lateral con diseño clínico
- dashboard con métricas
- módulos de usuarios, roles y permisos
- pacientes, citas, atenciones, diagnósticos y recetas
- búsqueda AJAX
- exportación Excel/PDF en citas
- paginación real en pacientes, citas y atenciones

## Instalación rápida en XAMPP
1. Copia la carpeta en `htdocs/consultorio`
2. Importa `consultorio.sql`
3. Copia `app/config/config.local.example.php` como `app/config/config.local.php`
4. Ajusta tus credenciales MySQL
5. Entra a `http://localhost/consultorio/login`
6. Crea el admin inicial en `/configuracion/admin-inicial`

## Hosting compartido
- El proyecto funciona dentro de una subcarpeta, por ejemplo `/consultorio`
- No depende de una `base_url` fija
- Puedes configurar la app con:
  - `app/config/config.local.php`, o
  - variables de entorno `APP_DEBUG`, `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`, `DB_CHARSET`
- `display_errors` queda apagado por `.user.ini`
- la carpeta `app/` queda protegida con `.htaccess`

## URLs limpias
- `/login`
- `/dashboard`
- `/usuarios`
- `/roles`
- `/permisos`
- `/pacientes`
- `/citas`
- `/atenciones`
- `/diagnosticos`
- `/recetas`

## Notas
- En producción usa `APP_DEBUG=0`
- Para depurar localmente puedes activar `APP_DEBUG=1`
- Si Apache no tiene `mod_rewrite`, aún puedes usar `?route=...`


## Módulos financieros ampliados
- Pagos parciales y múltiples por factura
- Caja / arqueo con aperturas, cierres y movimientos manuales
- Devoluciones de pago
- Conciliación contable
- Reporte de cobranzas

Requiere ejecutar primero `migracion_finanzas_consultorio.sql`.
