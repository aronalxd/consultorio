<?php
declare(strict_types=1);

require_once __DIR__ . '/app/bootstrap.php';

$request = resolve_request_route();
$route = $request['route'];
$params = $request['params'];
$method = request_method();

foreach ($params as $key => $value) {
    if (!isset($_GET[$key])) {
        $_GET[$key] = $value;
    }
}

switch ($route) {
    case '':
    case 'login':
        if ($method === 'POST') {
            (new AuthController())->login();
            break;
        }
        (new AuthController())->showLogin();
        break;

    case 'register-admin':
        if ($method === 'POST') {
            (new AuthController())->registerAdmin();
            break;
        }
        (new AuthController())->showRegisterAdmin();
        break;

    case 'dashboard':
        (new HomeController())->dashboard();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    case 'users':
        (new UsersController())->index();
        break;

    case 'users-create':
        (new UsersController())->create();
        break;

    case 'users-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new UsersController())->store();
        break;

    case 'users-edit':
        (new UsersController())->edit();
        break;

    case 'users-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new UsersController())->update();
        break;

    case 'users-toggle':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new UsersController())->toggleStatus();
        break;

    case 'users-delete':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new UsersController())->destroy();
        break;

    case 'roles':
        (new RolesController())->index();
        break;

    case 'roles-create':
        (new RolesController())->create();
        break;

    case 'roles-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new RolesController())->store();
        break;

    case 'roles-edit':
        (new RolesController())->edit();
        break;

    case 'roles-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new RolesController())->update();
        break;

    case 'roles-delete':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new RolesController())->destroy();
        break;

    case 'permissions':
        (new PermissionsController())->index();
        break;

    case 'permissions-create':
        (new PermissionsController())->create();
        break;

    case 'permissions-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PermissionsController())->store();
        break;

    case 'permissions-edit':
        (new PermissionsController())->edit();
        break;

    case 'permissions-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PermissionsController())->update();
        break;

    case 'permissions-delete':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PermissionsController())->destroy();
        break;

    case 'pacientes':
        (new PatientsController())->index();
        break;

    case 'pacientes-create':
        (new PatientsController())->create();
        break;

    case 'pacientes-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PatientsController())->store();
        break;

    case 'pacientes-show':
        (new PatientsController())->show();
        break;

    case 'pacientes-edit':
        (new PatientsController())->edit();
        break;

    case 'pacientes-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PatientsController())->update();
        break;

    case 'pacientes-toggle':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PatientsController())->toggleStatus();
        break;

    case 'pacientes-delete':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PatientsController())->destroy();
        break;

    case 'medicos':
        (new DoctorsController())->index();
        break;

    case 'medicos-create':
        (new DoctorsController())->create();
        break;

    case 'medicos-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new DoctorsController())->store();
        break;

    case 'medicos-show':
        (new DoctorsController())->show();
        break;

    case 'medicos-edit':
        (new DoctorsController())->edit();
        break;

    case 'medicos-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new DoctorsController())->update();
        break;

    case 'medicos-toggle':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new DoctorsController())->toggleStatus();
        break;

    case 'medicos-delete':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new DoctorsController())->destroy();
        break;

    case 'citas':
        (new AppointmentsController())->index();
        break;

    case 'citas-create':
        (new AppointmentsController())->create();
        break;

    case 'citas-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new AppointmentsController())->store();
        break;

    case 'citas-show':
        (new AppointmentsController())->show();
        break;

    case 'citas-edit':
        (new AppointmentsController())->edit();
        break;

    case 'citas-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new AppointmentsController())->update();
        break;

    case 'citas-delete':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new AppointmentsController())->destroy();
        break;

    case 'citas-export-excel':
        (new AppointmentsController())->exportExcel();
        break;

    case 'citas-export-pdf':
        (new AppointmentsController())->exportPdf();
        break;

    case 'atenciones':
        (new AttentionsController())->index();
        break;

    case 'atenciones-create':
        (new AttentionsController())->create();
        break;

    case 'atenciones-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new AttentionsController())->store();
        break;

    case 'atenciones-show':
        (new AttentionsController())->show();
        break;

    case 'atenciones-edit':
        (new AttentionsController())->edit();
        break;

    case 'atenciones-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new AttentionsController())->update();
        break;

    case 'atenciones-delete':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new AttentionsController())->destroy();
        break;


    case 'diagnosticos':
        (new DiagnosesController())->index();
        break;

    case 'diagnosticos-create':
        (new DiagnosesController())->create();
        break;

    case 'diagnosticos-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new DiagnosesController())->store();
        break;

    case 'diagnosticos-edit':
        (new DiagnosesController())->edit();
        break;

    case 'diagnosticos-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new DiagnosesController())->update();
        break;

    case 'diagnosticos-delete':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new DiagnosesController())->destroy();
        break;

    case 'recetas':
        (new PrescriptionsController())->index();
        break;

    case 'recetas-create':
        (new PrescriptionsController())->create();
        break;

    case 'recetas-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PrescriptionsController())->store();
        break;

    case 'recetas-show':
        (new PrescriptionsController())->show();
        break;

    case 'recetas-edit':
        (new PrescriptionsController())->edit();
        break;

    case 'recetas-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PrescriptionsController())->update();
        break;

    case 'recetas-delete':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PrescriptionsController())->destroy();
        break;

    case 'ajax-pacientes':
        (new AjaxController())->patients();
        break;

    case 'ajax-medicos':
        (new AjaxController())->doctors();
        break;

    case 'ajax-citas':
        (new AjaxController())->appointments();
        break;

    case 'ajax-medicamentos':
        (new AjaxController())->medications();
        break;

    case 'ajax-facturas':
        (new AjaxController())->invoices();
        break;


    case 'laboratorio':
        (new ModulesController())->laboratorio();
        break;

    case 'farmacia':
        (new ModulesController())->farmacia();
        break;

    case 'facturacion':
        (new InvoicesController())->index();
        break;

    case 'facturacion-search-appointment':
        (new InvoicesController())->searchAppointment();
        break;

    case 'facturacion-create':
        (new InvoicesController())->create();
        break;

    case 'facturacion-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new InvoicesController())->store();
        break;

    case 'facturacion-show':
        (new InvoicesController())->show();
        break;

    case 'facturacion-edit':
        (new InvoicesController())->edit();
        break;

    case 'facturacion-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new InvoicesController())->update();
        break;

    case 'facturacion-annul':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new InvoicesController())->annul();
        break;



    case 'facturacion-export-excel':
        (new InvoicesController())->exportExcel();
        break;

    case 'facturacion-export-pdf':
        (new InvoicesController())->exportPdf();
        break;

    case 'facturacion-show-export-excel':
        (new InvoicesController())->exportSingleExcel();
        break;

    case 'facturacion-show-export-pdf':
        (new InvoicesController())->exportSinglePdf();
        break;

    case 'pagos':
        (new PaymentsController())->index();
        break;

    case 'pagos-create':
        (new PaymentsController())->create();
        break;

    case 'pagos-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PaymentsController())->store();
        break;

    case 'pagos-show':
        (new PaymentsController())->show();
        break;

    case 'pagos-edit':
        (new PaymentsController())->edit();
        break;

    case 'pagos-update':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PaymentsController())->update();
        break;

    case 'pagos-annul':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PaymentsController())->annul();
        break;

    case 'pagos-refund':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new PaymentsController())->refund();
        break;

    case 'caja':
        (new CashController())->index();
        break;

    case 'caja-open':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new CashController())->open();
        break;

    case 'caja-session':
        (new CashController())->showSession();
        break;

    case 'caja-close':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new CashController())->close();
        break;

    case 'caja-movimiento':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new CashController())->movement();
        break;

    case 'conciliacion':
        (new ReconciliationsController())->index();
        break;

    case 'conciliacion-create':
        (new ReconciliationsController())->create();
        break;

    case 'conciliacion-store':
        if ($method !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            break;
        }
        (new ReconciliationsController())->store();
        break;

    case 'conciliacion-show':
        (new ReconciliationsController())->show();
        break;

    case 'cobranzas':
        (new CollectionsController())->index();
        break;

    case 'cobranzas-export-excel':
        (new CollectionsController())->exportExcel();
        break;

    case 'cobranzas-export-pdf':
        (new CollectionsController())->exportPdf();
        break;

    default:
        http_response_code(404);
        echo 'Ruta no encontrada.';
        break;
}
