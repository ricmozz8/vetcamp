<?php
require_once 'Controller.php';
require_once 'app/models/Comment.php';
require_once 'app/models/Audit.php';

class CommentController extends Controller
{


    /**
     * Updates or Deletes a comment made by an admin depending on the option
     * @param string $method Either GET/POST
     * @param string $option The action to realize on the comment (either 'destroy' or 'update')
     * @return void Redirects back to the application with a success/error messag
     */
    public static function manage(string $method, string $option)
    {
        $application_url = '/admin/requests/r?id=';

        if (!in_array($option, ['update', 'destroy'])) {
            ErrorLog::log('Error: ' . $option . ' is not a valid option', __FILE__, '');
            $_SESSION['error'] = 'Hubo un error al actualizar el comentario';
            redirect('/admin/requests');
        }

        if ($method === 'POST') {

            $comment_id = filter_input(INPUT_POST, 'comment_id');
            $application_user = filter_input(INPUT_POST, 'application_user');

            $action = $option == 'update' ? 'actualizar' : 'eliminar';

            if (empty($comment_id) || empty($application_user)) {

                $_SESSION['error'] = 'Hubo un error al ' . $action . ' el comentario';
                redirect('/admin/requests');
            }

            // Finding the comment on the DB

            try {
                $comment = Comment::find($comment_id);
            } catch (ModelNotFoundException $e) {
                ErrorLog::log('Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine(), __FILE__, $e->getTraceAsString());
                $_SESSION['error'] = 'Hubo un error al ' . $action . ' el comentario';
                redirect($application_url . $application_user);
            }


            if (Auth::user()->__get('user_id') !== $comment->user_id) {
                $_SESSION['error'] = 'No puedes ' . $action . '  un comentario que no hayas creado';
                redirect($application_url . $application_user);
            }

            // finally we can edit the comment if there is no inconsistencies
            if ($option === 'destroy'){

                // Log the action
                Audit::register('Eliminó su comentario en la solicitud con ID ' . $comment->application_id . '', 'delete');

                $success = $comment->delete();

                
                
            }
            else if ($option === 'update') {
                $new_comment = filter_input(INPUT_POST, 'comment');

                if (empty($new_comment)) {
                    $_SESSION['error'] = 'El comentario no puede estar vacío';
                    redirect($application_url . $application_user);
                }

                Audit::register('Actualizó su comentario en una solicitud', 'update');


                $success = $comment->update([
                    'comment' => $new_comment,
                    'edited' => 1
                ]);
            }

            if (!$success) {
                $_SESSION['error'] = 'Hubo un error al ' . $action . ' el comentario';
                redirect($application_url . $application_user);
            }

            $action_past = $action == 'actualizar' ? 'actualizado' : 'eliminado';

            $_SESSION['message'] = 'Comentario ' . $action_past . ' correctamente';
            redirect($application_url . $application_user);


        } else {
            redirect('/admin/requests');
        }


    }


}
