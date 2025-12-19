<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function login(): void
    {
        Auth::requireGuest();

        $error = Session::flash('error');      // lee y limpia
        $info  = Session::flash('info');       // ejemplo, por si quieres mensajes informativos

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user      = $userModel->login($email, $password);

            if ($user) {
                Auth::login($user);

                $redirect = ((int)$user['account_rango'] === 99)
                    ? BASE_URL . 'dashboard'
                    : BASE_URL;

                header("Location: {$redirect}");
                exit;
            }

            $error = 'Correo o contraseña incorrectos.';
        }

        // Pasamos $error y $info a la vista
        require __DIR__ . '/../views/auth/login.php';
    }

    public function register(): void
    {
        Auth::requireGuest();

        $error   = Session::flash('error');
        $success = Session::flash('success');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => trim($_POST['name'] ?? ''),
                'email'    => trim($_POST['email'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'prefix'   => $_POST['phone_prefix'] ?? '',
                'number'   => $_POST['phone_number'] ?? '',
            ];

            $userModel = new User();
            $exists    = $userModel->findByEmail($data['email']);

            if ($exists) {
                $error = 'El correo ya está registrado.';
            } else {
                $successInsert = $userModel->register($data);
                if ($successInsert) {
                    Session::flash('success', 'Cuenta creada correctamente. Ya puedes iniciar sesión.');
                    header('Location: ' . BASE_URL . 'login?registered=1');
                    exit;
                } else {
                    $error = 'Error al registrar el usuario. Inténtalo de nuevo.';
                }
            }
        }

        require __DIR__ . '/../views/auth/register.php';
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: ' . BASE_URL);
        exit;
    }
}
