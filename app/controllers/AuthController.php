<?php
require_once 'Controller.php';

class AuthController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function login()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'admin') {
                redirect('/admin');
            } else {
                redirect('/apply');
            }
        }

        render_view('login', [], 'Login');
    }

    public static function loginUser($method)
    {
        if ($method == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (isset($email) && isset($password)) {
                try {
                    $user = User::findBy(['email' => $email, 'status' => 'active']);
                } catch (ModelNotFoundException $e) {
                    // User was not found
                    $error = 'Incorrect credentials';
                    redirect('/login');
                }

                if (password_verify($password, $user->__get('password'))) {
                    // Authentication successful
                    Auth::login($user);

                    if (Auth::user()->type == 'admin') {
                        redirect('/admin');
                    } else {
                        redirect('/apply');
                    }
                } else {
                    // Authentication failed
                    $error = 'Incorrect credentials';
                }
            }
        }

        redirect('/login');
    }

    public static function register()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'admin') {
                redirect('/admin');
            } else {
                redirect('/apply');
            }
        }
        // your index view here
        render_view('register', [], 'Register');
    }

    public static function registerUser($method)
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'admin') {
                redirect('/admin');
            } else {
                redirect('/apply');
            }
        }

        if ($method == 'POST') {


            if ($_POST['password'] !== $_POST['confirm_password']) {
                $error = 'Passwords do not match';
                redirect('/register');
            }

            try {
                User::findBy(['email' => $_POST['email']]);
                $error = 'Email already exists';
                redirect('/login');
            } catch (ModelNotFoundException $e) {
                // User was not found
                $user = User::create([
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'phone_number' => deformat_phone($_POST['phone_number']),
                ]);
                Auth::login($user);

                redirect('/apply');
            }
        }
        $error = 'Error creating user';
        redirect('/register');
    }

    public static function logoutUser($method)
    {
        if ($method == 'POST') {
            Auth::logout();
            redirect('/');
        } else {
            redirect('/login');
        }
    }

    public static function resetPassword()
    {
        // your index view here
        render_view('passreset', [], 'PassReset');
    }

    public static function forgotPassword()
    {
        // your index view here
        render_view('forgotpass', [], 'ForgotPass');
    }

    // define your other methods here
}
