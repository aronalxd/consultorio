<?php
declare(strict_types=1);

function base_path(string $path = ''): string
{
    $base = dirname(__DIR__);

    return $path === '' ? $base : $base . '/' . ltrim($path, '/');
}

function app_path(string $path = ''): string
{
    $base = __DIR__;

    return $path === '' ? $base : $base . '/' . ltrim($path, '/');
}

function public_path(string $path = ''): string
{
    $base = base_path('public');

    return $path === '' ? $base : $base . '/' . ltrim($path, '/');
}

function config(?string $key = null, mixed $default = null): mixed
{
    static $config;

    if ($config === null) {
        $config = require app_path('config/config.php');
    }

    if ($key === null || $key === '') {
        return $config;
    }

    $segments = explode('.', $key);
    $value = $config;

    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }

        $value = $value[$segment];
    }

    return $value;
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}


function normalize_view_array(mixed $value, array $defaults): array
{
    $data = is_array($value) ? $value : [];

    return array_replace($defaults, $data);
}

function pagination_window(int $currentPage, int $totalPages, int $radius = 2): array
{
    if ($totalPages <= 1) {
        return [1];
    }

    $startPage = max(1, $currentPage - $radius);
    $endPage = min($totalPages, $currentPage + $radius);

    return range($startPage, $endPage);
}


function format_number(int|float|string|null $value): string
{
    return number_format((float) ($value ?? 0), 0, ',', '.');
}

function format_money(int|float|string|null $value, string $prefix = 'S/ '): string
{
    return $prefix . number_format((float) ($value ?? 0), 2, ',', '.');
}

function format_date_human(?string $value): string
{
    if ($value === null || trim($value) === '') {
        return 'Sin registro';
    }

    try {
        return (new DateTimeImmutable($value))->format('d/m/Y');
    } catch (Throwable $exception) {
        return $value;
    }
}

function calculate_age(?string $birthDate): ?int
{
    if ($birthDate === null || trim($birthDate) === '') {
        return null;
    }

    try {
        $date = new DateTimeImmutable($birthDate);
        $today = new DateTimeImmutable('today');

        if ($date > $today) {
            return null;
        }

        return $date->diff($today)->y;
    } catch (Throwable $exception) {
        return null;
    }
}

function format_datetime_human(?string $value): string
{
    if ($value === null || trim($value) === '') {
        return 'Sin registro';
    }

    try {
        return (new DateTimeImmutable($value))->format('d/m/Y H:i');
    } catch (Throwable $exception) {
        return $value;
    }
}

function request_method(): string
{
    return strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));
}

function app_url(string $path = ''): string
{
    $scriptName = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
    $base = rtrim(dirname($scriptName), '/');

    if ($base === '.' || $base === '/') {
        $base = '';
    }

    if ($path === '') {
        return $base === '' ? '/' : $base;
    }

    return ($base === '' ? '' : $base) . '/' . ltrim($path, '/');
}

function route_patterns(): array
{
    return [
        'login' => '/login',
        'register-admin' => '/configuracion/admin-inicial',
        'dashboard' => '/dashboard',
        'logout' => '/logout',

        'users' => '/usuarios',
        'users-create' => '/usuarios/crear',
        'users-store' => '/usuarios/guardar',
        'users-edit' => '/usuarios/editar/{id}',
        'users-update' => '/usuarios/actualizar/{id}',
        'users-toggle' => '/usuarios/estado',
        'users-delete' => '/usuarios/eliminar',

        'roles' => '/roles',
        'roles-create' => '/roles/crear',
        'roles-store' => '/roles/guardar',
        'roles-edit' => '/roles/editar/{id}',
        'roles-update' => '/roles/actualizar/{id}',
        'roles-delete' => '/roles/eliminar',

        'permissions' => '/permisos',
        'permissions-create' => '/permisos/crear',
        'permissions-store' => '/permisos/guardar',
        'permissions-edit' => '/permisos/editar/{id}',
        'permissions-update' => '/permisos/actualizar/{id}',
        'permissions-delete' => '/permisos/eliminar',

        'pacientes' => '/pacientes',
        'pacientes-create' => '/pacientes/crear',
        'pacientes-store' => '/pacientes/guardar',
        'pacientes-show' => '/pacientes/ver/{id}',
        'pacientes-edit' => '/pacientes/editar/{id}',
        'pacientes-update' => '/pacientes/actualizar/{id}',
        'pacientes-toggle' => '/pacientes/estado',
        'pacientes-delete' => '/pacientes/eliminar',

        'medicos' => '/medicos',
        'medicos-create' => '/medicos/crear',
        'medicos-store' => '/medicos/guardar',
        'medicos-show' => '/medicos/ver/{id}',
        'medicos-edit' => '/medicos/editar/{id}',
        'medicos-update' => '/medicos/actualizar/{id}',
        'medicos-toggle' => '/medicos/estado',
        'medicos-delete' => '/medicos/eliminar',

        'citas' => '/citas',
        'citas-create' => '/citas/crear',
        'citas-store' => '/citas/guardar',
        'citas-show' => '/citas/ver/{id}',
        'citas-edit' => '/citas/editar/{id}',
        'citas-update' => '/citas/actualizar/{id}',
        'citas-delete' => '/citas/eliminar',
        'citas-export-excel' => '/citas/exportar/excel',
        'citas-export-pdf' => '/citas/exportar/pdf',

        'atenciones' => '/atenciones',
        'atenciones-create' => '/atenciones/crear',
        'atenciones-store' => '/atenciones/guardar',
        'atenciones-show' => '/atenciones/ver/{id}',
        'atenciones-edit' => '/atenciones/editar/{id}',
        'atenciones-update' => '/atenciones/actualizar/{id}',
        'atenciones-delete' => '/atenciones/eliminar',

        'diagnosticos' => '/diagnosticos',
        'diagnosticos-create' => '/diagnosticos/crear',
        'diagnosticos-store' => '/diagnosticos/guardar',
        'diagnosticos-edit' => '/diagnosticos/editar/{id}',
        'diagnosticos-update' => '/diagnosticos/actualizar/{id}',
        'diagnosticos-delete' => '/diagnosticos/eliminar',

        'recetas' => '/recetas',
        'recetas-create' => '/recetas/crear',
        'recetas-store' => '/recetas/guardar',
        'recetas-show' => '/recetas/ver/{id}',
        'recetas-edit' => '/recetas/editar/{id}',
        'recetas-update' => '/recetas/actualizar/{id}',
        'recetas-delete' => '/recetas/eliminar',

        'ajax-pacientes' => '/ajax/pacientes',
        'ajax-medicos' => '/ajax/medicos',
        'ajax-citas' => '/ajax/citas',
        'ajax-medicamentos' => '/ajax/medicamentos',
        'laboratorio' => '/laboratorio',
        'farmacia' => '/farmacia',
        'facturacion' => '/facturacion',
        'facturacion-search-appointment' => '/facturacion/buscar-cita',
        'facturacion-create' => '/facturacion/crear',
        'facturacion-store' => '/facturacion/guardar',
        'facturacion-show' => '/facturacion/ver/{id}',
        'facturacion-edit' => '/facturacion/editar/{id}',
        'facturacion-update' => '/facturacion/actualizar/{id}',
        'facturacion-annul' => '/facturacion/anular',
        'facturacion-export-excel' => '/facturacion/exportar/excel',
        'facturacion-export-pdf' => '/facturacion/exportar/pdf',
        'facturacion-show-export-excel' => '/facturacion/ver/{id}/excel',
        'facturacion-show-export-pdf' => '/facturacion/ver/{id}/pdf',

        'pagos' => '/pagos',
        'pagos-create' => '/pagos/crear',
        'pagos-store' => '/pagos/guardar',
        'pagos-show' => '/pagos/ver/{id}',
        'pagos-edit' => '/pagos/editar/{id}',
        'pagos-update' => '/pagos/actualizar/{id}',
        'pagos-annul' => '/pagos/anular',
        'pagos-refund' => '/pagos/devolver',

        'caja' => '/caja',
        'caja-open' => '/caja/abrir',
        'caja-session' => '/caja/sesion/{id}',
        'caja-close' => '/caja/cerrar',
        'caja-movimiento' => '/caja/movimiento',

        'conciliacion' => '/conciliacion',
        'conciliacion-create' => '/conciliacion/crear',
        'conciliacion-store' => '/conciliacion/guardar',
        'conciliacion-show' => '/conciliacion/ver/{id}',

        'cobranzas' => '/cobranzas',
        'cobranzas-export-excel' => '/cobranzas/exportar/excel',
        'cobranzas-export-pdf' => '/cobranzas/exportar/pdf',
        'ajax-facturas' => '/ajax/facturas',
    ];
}

function build_url(string $route, array $params = []): string
{
    $patterns = route_patterns();
    $pattern = $patterns[$route] ?? '/' . trim($route, '/');
    $query = $params;

    $path = preg_replace_callback(
        '/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/',
        static function (array $matches) use (&$query): string {
            $key = $matches[1];

            if (!array_key_exists($key, $query)) {
                throw new InvalidArgumentException(sprintf('Falta el parámetro de ruta "%s".', $key));
            }

            $value = (string) $query[$key];
            unset($query[$key]);

            return rawurlencode($value);
        },
        $pattern
    );

    if (!is_string($path)) {
        $path = '/';
    }

    $url = app_url(ltrim($path, '/'));

    if ($query !== []) {
        $separator = str_contains($url, '?') ? '&' : '?';
        $url .= $separator . http_build_query($query);
    }

    return $url;
}

function resolve_request_route(): array
{
    if (isset($_GET['route']) && $_GET['route'] !== '') {
        $params = $_GET;
        unset($params['route']);

        return [
            'route' => trim((string) $_GET['route']),
            'params' => $params,
        ];
    }

    $requestUri = (string) ($_SERVER['REQUEST_URI'] ?? '/');
    $path = parse_url($requestUri, PHP_URL_PATH);
    $path = is_string($path) ? $path : '/';

    $basePath = app_url();
    if ($basePath !== '/' && $basePath !== '' && str_starts_with($path, $basePath)) {
        $path = substr($path, strlen($basePath));
    }

    $path = '/' . trim($path, '/');

    if ($path === '/' || $path === '') {
        return ['route' => 'login', 'params' => []];
    }

    foreach (route_patterns() as $route => $pattern) {
        $regex = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', '(?P<$1>[^/]+)', $pattern);
        $regex = '#^' . $regex . '/?$#';

        if (preg_match($regex, $path, $matches) === 1) {
            $params = [];

            foreach ($matches as $key => $value) {
                if (!is_int($key)) {
                    $params[$key] = rawurldecode((string) $value);
                }
            }

            return [
                'route' => $route,
                'params' => $params,
            ];
        }
    }

    return [
        'route' => trim($path, '/'),
        'params' => [],
    ];
}

function asset(string $path): string
{
    return app_url('public/' . ltrim($path, '/'));
}

function get_client_ip(): string
{
    $headers = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];

    foreach ($headers as $header) {
        $value = $_SERVER[$header] ?? '';
        if ($value !== '') {
            return trim(explode(',', (string) $value)[0]);
        }
    }

    return '0.0.0.0';
}

function is_logged_in(): bool
{
    return class_exists('Session', true) && Session::has('user');
}

function current_user(): ?array
{
    if (!class_exists('Session', true)) {
        return null;
    }

    $user = Session::get('user');

    return is_array($user) ? $user : null;
}

function current_user_roles(): array
{
    $user = current_user();

    return is_array($user['roles'] ?? null) ? $user['roles'] : [];
}

function current_user_permissions(): array
{
    $user = current_user();

    return is_array($user['permissions'] ?? null) ? $user['permissions'] : [];
}

function user_has_role(string $roleName): bool
{
    foreach (current_user_roles() as $role) {
        if (strtoupper((string) $role) === strtoupper($roleName)) {
            return true;
        }
    }

    return false;
}

function user_has_permission(string $module, string $action): bool
{
    if (user_has_role('ADMIN')) {
        return true;
    }

    $needle = strtoupper($module) . '.' . strtoupper($action);

    return in_array(
        $needle,
        array_map(static fn (mixed $item): string => strtoupper((string) $item), current_user_permissions()),
        true
    );
}

function user_can_access_module(string $module): bool
{
    if (user_has_role('ADMIN')) {
        return true;
    }

    $prefix = strtoupper($module) . '.';

    foreach (current_user_permissions() as $permission) {
        if (str_starts_with(strtoupper((string) $permission), $prefix)) {
            return true;
        }
    }

    return false;
}

function load_user_context(int $userId): array
{
    $pdo = Database::connection();

    $userStmt = $pdo->prepare(
        'SELECT id_usuario, username, nombre_mostrar, email, activo
         FROM usuarios
         WHERE id_usuario = :id_usuario
         LIMIT 1'
    );
    $userStmt->execute(['id_usuario' => $userId]);
    $user = $userStmt->fetch();

    if (!$user) {
        throw new RuntimeException('Usuario no encontrado.');
    }

    $roleStmt = $pdo->prepare(
        'SELECT r.nombre
         FROM usuario_rol ur
         INNER JOIN roles r ON r.id_rol = ur.id_rol
         WHERE ur.id_usuario = :id_usuario
           AND r.activo = 1
         ORDER BY r.nombre'
    );
    $roleStmt->execute(['id_usuario' => $userId]);
    $roles = array_map(
        static fn (array $row): string => (string) $row['nombre'],
        $roleStmt->fetchAll()
    );

    $permissionStmt = $pdo->prepare(
        'SELECT DISTINCT CONCAT(p.modulo, ".", p.accion) AS codigo
         FROM usuario_rol ur
         INNER JOIN roles r ON r.id_rol = ur.id_rol
         INNER JOIN rol_permiso rp ON rp.id_rol = ur.id_rol
         INNER JOIN permisos p ON p.id_permiso = rp.id_permiso
         WHERE ur.id_usuario = :id_usuario
           AND r.activo = 1
         ORDER BY p.modulo, p.accion'
    );
    $permissionStmt->execute(['id_usuario' => $userId]);
    $permissions = array_map(
        static fn (array $row): string => strtoupper((string) $row['codigo']),
        $permissionStmt->fetchAll()
    );

    return [
        'id_usuario' => (int) $user['id_usuario'],
        'username' => (string) $user['username'],
        'nombre_mostrar' => (string) $user['nombre_mostrar'],
        'email' => $user['email'] !== null ? (string) $user['email'] : '',
        'activo' => (int) $user['activo'],
        'roles' => $roles,
        'permissions' => $permissions,
    ];
}


function current_route_name(): string
{
    static $route = null;

    if ($route === null) {
        $resolved = resolve_request_route();
        $route = (string) ($resolved['route'] ?? 'login');
    }

    return $route;
}

function route_is(string ...$routes): bool
{
    return in_array(current_route_name(), $routes, true);
}

function refresh_current_user_session(): void
{
    $user = current_user();

    if (!is_array($user) || !isset($user['id_usuario'])) {
        return;
    }

    Session::set('user', load_user_context((int) $user['id_usuario']));
}
