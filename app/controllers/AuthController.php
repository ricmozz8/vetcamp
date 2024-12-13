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
    public static function login($method)
    {
        if ($method == 'POST') {

            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

            // this is a dummy test to prevent bot registry.
            if(!empty($_POST['age'])) {
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

            if(!empty($_POST['age'])) {
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
                    'Tu cuenta ha sido registrada en vetcamp!');

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
            // Sanitize and validate email from session
            $email = $_SESSION['otp_verified_email'] ?? null;
            if (!$email) {
                $_SESSION['error_message'] = "Proceso no iniciado. Intenta nuevamente.";
                redirect('/forgotpass');
                exit;
            }
    
            // Sanitize and validate passwords from POST data
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $confirmPassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
    
            // Validate password length
            if (strlen($password) < 8) {
                $_SESSION['error'] = "La contraseña debe tener al menos 8 caracteres.";
                redirect('/passreset');
            }
    
            // Validate password match
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Las contraseñas no coinciden.";
                redirect('/passreset');
                exit;
            }
    
            try {
                // Try to find the user by email (using the sanitized email)
                $user = User::findBy(['email' => $email]);
    
                if (!$user) {
                    $_SESSION['error'] = "No se encontró el usuario.";
                    redirect('/forgotpass');
                    exit;
                }
    
                // Check if the new password is different from the current password
                $currentPasswordHash = $user->password;
                if (password_verify($password, $currentPasswordHash)) {
                    $_SESSION['error'] = "La nueva contraseña no puede ser igual a la anterior.";
                    redirect('/passreset');
                    exit;
                }
    
                // Update the user's password with sanitized and securely hashed password
                $user->update([
                    'password' => password_hash($password, PASSWORD_BCRYPT)
                ]);
    
                $_SESSION['success_message'] = "Contraseña restablecida correctamente.";
                unset($_SESSION['otp_verified_email']); // Clear OTP session after success
                redirect('/login');
                exit;
    
            } catch (ModelNotFoundException $e) {
                $_SESSION['error_message'] = "Error al restablecer la contraseña: " . $e->getMessage();
                redirect('/forgotpass');
            }
        } else {
            // Render the reset password view
            render_view('passreset', [], 'PassReset');
        }
    }
    
    
    public static function forgotPassword() 
    {
        // Determine flow based on POST data
        $otpSent = isset($_POST['email']);
        $otpValidated = isset($_POST['otp']);
    
        // Simulated OTP for demonstration
        $generatedOtp = $_POST['generatedOtp'] ?? rand(100000, 999999);
    
        // View data to control the flow
        $viewData = [
            'otpSent' => $otpSent,
            'otpValidated' => $otpValidated,
            'generatedOtp' => $generatedOtp, // Simulated OTP
            'error' => null,
            'message' => null
        ];
    
        if ($otpSent && !$otpValidated) {
            $email = $_POST['email'] ?? null;
    
            if ($email) {
                try {
                    // Check if the email exists
                    $user = User::findBy(['email' => $email]);
                    
                    if ($user) {
                        // Save email to session for later use
                        $_SESSION['otp_verified_email'] = $email;
    
                        // For demonstration: Simulate OTP "sent"
                        $viewData['message'] = "Se envió el código OTP a su correo electrónico.";
                    } else {
                        // Email does not exist
                        $viewData['error'] = "No se encontró una cuenta con este correo electrónico.";
                    }
                } catch (ModelNotFoundException $e) {
                    $_SESSION['error'] = "No se encontró una cuenta con este correo electrónico.";
                    redirect('/forgotPass');
                }
            } else {
                $viewData['error'] = "Por favor, ingresa un correo electrónico válido.";
            }
        } elseif ($otpValidated) {
            $enteredOtp = $_POST['otp'] ?? null;
    
            if ($enteredOtp == $generatedOtp) {
                // OTP is valid, redirect to reset password page
                redirect('/passreset');
            } else {
                $viewData['error'] = "Código OTP incorrecto.";
            }
        }
    
        // Render the forgot password view
        render_view('forgotpass', $viewData, 'ForgotPass');
    }
    
}
