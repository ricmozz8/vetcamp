<?php
require_once 'Controller.php';

class ApplicationController extends Controller
{

    public static function index()
    {
        dd(Auth::user());
        if (!Auth::check()) {
            redirect('/login');
        }
        render_view('application/dashboard', [], 'Aplica');
    }

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function editApplication($user_id)
    {
        if ($user_id == null) {
            redirect('/admin/requests');
        }
        // your index view here
        $user = User::find($user_id);
        $application = $user->application();

        
        render_view('profile', 
            ['user' => $user, 
            'application' => $application,
            'postal_address' => $user->postal_address(),
            'physical_address' => $user->physical_address(),
            'school_address' => $user->school_address(),
            'preferred_session' => $application->preferred_session(true),
            'profile_pic'=> $application->url_picture,
            'document_count' => $application->documentCount(),
        ], 'Aplicación');

    }
    public static function updateStatus($request_method)
    {
        if ($request_method === 'POST') {
            $application_id = $_POST['application_id'] ?? null;
            $new_status = $_POST['status'] ?? null;
            $notify = isset($_POST['notify']) && $_POST['notify'] === 'on';

            // Mapeo de estados en español a inglés
            $status_map = [
                'Sometida' => 'submitted',
                'Necesita Cambios' => 'need_changes',
                'Denegada' => 'denied',
                'Aprobada' => 'approved',
                'Incompleta' => 'incomplete',
                'No Sometida' => 'unsubmitted',
            ];

            // Convertir estado al valor en inglés
            $new_status = $status_map[$new_status] ?? null;

            if ($application_id && $new_status) {
                // Buscar la aplicación usando el modelo
                try {
                    $application = Application::find($application_id);

                    // Actualizar el estado
                    $application->update(['status' => $new_status]);

                    if ($notify) {
                        $_SESSION['success_message'] = "Estado actualizado y notificación enviada.";
                    } else {
                        $_SESSION['success_message'] = "Estado actualizado correctamente.";
                    }
                } catch (ModelNotFoundException $e) {
                    $_SESSION['error_message'] = "No se encontró la solicitud con el ID proporcionado.";
                }
            } else {
                $_SESSION['error_message'] = "ID de aplicación o estado inválido.";
            }
        } else {
            http_response_code(405);
            $_SESSION['error_message'] = "Método de solicitud no permitido.";
        }

        // Redirigir de vuelta a la página de la solicitud
        redirect('/admin/requests/r');
        exit;
    }
}