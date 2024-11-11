<?php
require_once 'Controller.php';

DB::connect([
    'host' => '127.0.1.1', // Cambia esto con tu servidor de base de datos
    'dbname' => 'vetcampdb',
    'charset' => 'utf8mb4'
], 'joseph33', 'Joseph1@');

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
     * Returns all records from the associated table where the specified column
     * matches the given value.
     *
     * @param string getvalue from html input name = email
     * @param string getvalue from html input name = password
     */
    public static function auten()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($email && $password) {
                $user = DB::where("users", "email", $email);

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        if ($user['type'] == 'user') {
                            echo 'soy usuario';
                            Auth::login($user);
                            header("Location: /login/auth/form1");
                            exit();
                        }

                        if ($user['type'] == 'admin') {
                            echo 'soy admin';
                            Auth::login($user);
                            render_view('backDashboard', [], 'Login');
                            exit();
                        }
                    } else {
                        echo "Contraseña incorrecta.";
                    }
                } else {
                    echo "El correo no está registrado.";
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
