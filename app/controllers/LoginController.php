<?php
require_once 'Controller.php';

class LoginController extends Controller
{
    /**
     * This renders the index view.
     *
     * @return void
     */ 
    public static function index()
    {
        render_view('login', [], 'Login');
    }


    /**
     * Authenticate a user.
     *
     * @param string $method The HTTP method of the request.
     *
     * @return void
     */
    public static function authenticate($method)
    {
        if ($method == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (isset($email) && isset($password)) {
                try{ 
                    $user = User::findBy(['email' => $email, 'status' => 'active']);


                } catch (ModelNotFoundException $e) {
                    // User was not found
                    $error= 'Incorrect credentials';
                    redirect('/login');
                }

                if (password_verify($password, $user->__get('password'))) {
                    // Authentication successful
                    Auth::login($user);

                    if (Auth::$user->type == 'admin') {
                        redirect('/admin');
                    } else {
                        redirect('/apply');
                    }

                } else {
                    // Authentication failed
                    $error = 'Incorrect credentials';
                    redirect('/login');
                }   
            }
        }  
    }

}
