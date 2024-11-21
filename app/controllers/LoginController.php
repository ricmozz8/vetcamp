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
                    $_POST['error'] = 'Incorrect credentials';
                    redirect('/login');
                }

                if (password_verify($password, $user->values['password'])) {
                    // Authentication successful
                    Auth::login($user);

                    if (Auth::$user->type == 'admin') {
                        redirect('/admin');
                    } else {
                        redirect('/apply');
                    }

                } else {
                    // Authentication failed
                    $_POST['error'] = 'Incorrect credentials';
                    redirect('/login');
                }   
            }
        }  
    }

    //Metodos de las vistas 
    public static function form1()
    {
        render_view('form1', [], 'Form');    
    }
    public static function form2()
    {
        render_view('form2', [], 'Form');    
    }
    public static function form3()
    {
        render_view('form3', [], 'Form');    
    }
    public static function form4()
    {
        render_view('form4', [], 'Form');    
    }
    public static function form5()
    {
        render_view('form5', [], 'Form');    
    }
}
