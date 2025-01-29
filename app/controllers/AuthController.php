<?php
require_once 'Controller.php';
require_once 'app/models/User.php';
require_once 'app/models/PasswordReset.php';

class AuthController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function login($method)
    {
        if ($method == 'POST') {

            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

            // this is a dummy test to prevent bot registry.
            if (!empty($_POST['age'])) {
                redirect('/');
            }


            if (isset($email) && isset($password)) {
                try {
                    $user = User::findBy(['email' => $email, 'status' => 'active']);
                } catch (ModelNotFoundException $e) {
                    // User was not found
                    $_SESSION['error'] = 'Credenciales Incorrectas, intente de nuevo';
                    redirect('/login');
                }

                if (password_verify($password, $user->__get('password'))) {
                    // Authentication successful
                    Auth::login($user);

                    // update last login timestamp
                    $user->update(['last_login' => date('Y-m-d H:i:s')]);

                    if (Auth::user()->type == 'admin') {
                        redirect('/admin');
                    } else {
                        redirect('/apply');
                    }
                } else {
                    // Authentication failed
                    $_SESSION['error'] = 'Credenciales Incorrectas, intente de nuevo';
                    redirect('/login');
                }
            }
        } else {
            // method is GET
            if (Auth::check()) {
                if (Auth::user()->type == 'admin') {
                    redirect('/admin');
                } else {
                    redirect('/apply');
                }
            }

            render_view('login', [], 'Login');
        }
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

            if (!empty($_POST['age'])) {
                redirect('/');
            }

            if ($_POST['password'] !== $_POST['confirm_password']) {
                $error = 'Passwords do not match';
                redirect('/register');
            }

            $first_name = filter_input(INPUT_POST, 'first_name', FILTER_DEFAULT);
            $last_name = filter_input(INPUT_POST, 'last_name', FILTER_DEFAULT);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

            if (!$first_name || !$last_name || !$email || !$password) {
                $error = 'Por favor llene todos los campos';
                redirect('/register');
            }

            // prevent registry for already existing users
            try {
                User::findBy(['email' => $_POST['email']]);
                $error = 'Email already exists';
                redirect('/login');
            } catch (ModelNotFoundException $e) {
                // User was not found
                User::create([
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'phone_number' => deformat_phone($_POST['phone_number']),
                ]);

                $user = User::findBy(['email' => $_POST['email']]);

                Mailer::send(
                    $user->email,
                    'Bienvenido a vetcamp',
                    'Tu cuenta ha sido registrada en vetcamp!'
                );

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // take the OTP from the request
            $reset_code = filter_input(INPUT_POST, 'reset-code', FILTER_DEFAULT);

            if (!$reset_code) {
                $_SESSION['error'] = "Por favor ingresa un código de restablecimiento.";
                redirect('/restablish');
            }

            try {
                $reset_request = PasswordReset::findBy(['OTP' => $reset_code]);
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = "Código de restablecimiento inválido.";
                redirect('/forgotpass');
            }

            if (!$reset_request->valid) {
                $_SESSION['error'] = "Código de restablecimiento inválido.";
                redirect('/forgotpass');
            }

            // Define the time-to-live in days
            $ttlInDays = $reset_request->ttl;

            // Convert TTL from days to seconds
            $ttlInSeconds = $ttlInDays * 86400; // 86400 seconds in a day

            $now = new DateTime('now');
            $madeOn = new DateTime($reset_request->made_on);

            // Check if the reset request has expired
            if (($now->getTimestamp() - $madeOn->getTimestamp()) > $ttlInSeconds) {
                $_SESSION['error'] = "Código de restablecimiento ha expirado.";
                $reset_request->update(['valid' => 0]);
                redirect('/forgotpass');
            }

            // invalidate the current reset request
            $reset_request->update(['valid' => 0]);

            render_view('passReset', ['reset_token' => $reset_request->reset_token], 'Restablecer contraseña');
        } else {
            redirect('/forgotpass');
        }
    }

    public static function changePassword()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
            $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_DEFAULT);
            $token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);

            if ($password !== $confirm_password) {
                $_SESSION['error'] = "Las contrasenas no coinciden";
                redirect('/restablish');
            }

            if (strlen($password) < 8) {
                $_SESSION['error'] = "La contraseña debe tener al menos 8 caracteres";
                redirect('/restablish');
            }

            try {
                $reset_request = PasswordReset::findBy(['reset_token' => $token]);
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = "Código de restablecimiento inválido.";
                redirect('/forgotpass');
            }

            try {
                $user = User::find($reset_request->user_id);
                $user->update(['password' => password_hash($password, PASSWORD_DEFAULT)]);
            } catch (ModelNotFoundException $e) {
                // handle here when the user is not found
                $_SESSION['error'] = "Código de restablecimiento inválido.";
                redirect('/forgotpass');
            }


            $_SESSION['message'] = "Contraseña restablecida correctamente";

            redirect('/login');
        }
    }


    public static function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // take the email from the request
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

            if (!$email) {
                $_SESSION['error'] = "Por favor ingresa un correo electrónico válido.";
                redirect('/forgotpass');
            }

            try {
                $user = User::findBy(['email' => $email]);
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = "No se encontró el usuario.";
                redirect('/forgotpass');
            }


            $reset_request = PasswordReset::create([
                'user_id' => $user->__get('user_id'),
                'reset_token' => PasswordReset::generateToken(),
                'OTP' => PasswordReset::generateOTP()
            ]);

            Mailer::send(
                $user->email,
                'Restablecer contraseña',
                'Tu código de restablecimiento es ' . $reset_request->OTP
            );

            render_view('resetPassword', ['reset_email' => $user->email], 'Restablecer contraseña');
        } else {
            render_view('forgotPass', [], 'Restablecer contraseña');
        }
    }

    /**
     * Checks if the user hasn't logged in in the last 2 days. If so, log the user out.
     * This method is meant to be used as a middleware
     */
    public static function checkLastLogin()
    {
        Auth::checkLastLogin();
    }
}
