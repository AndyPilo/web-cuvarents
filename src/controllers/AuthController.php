<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{

    public function login(): void
    {
        Auth::requireGuest();

        // SEO dinámico para evitar indexación de login
        $seo = $seo ?? [
            'title'       => 'Iniciar sesión | CuVaRents',
            'description' => 'Accede a tu cuenta de CuVaRents.',
            'keywords'    => '',
            'url'         => rtrim(BASE_URL, '/') . '/login',
            'image'       => rtrim(BASE_URL, '/') . '/assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_ES',
            'robots'      => 'noindex, nofollow',
            'breadcrumb'  => [['Inicio', BASE_URL], ['Login', rtrim(BASE_URL, '/') . '/login']],
            'pageType'    => 'auth-login'
        ];

        $error = Session::flash('error');
        $info  = Session::flash('info');

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

        // SEO dinámico para evitar indexación de register
        $seo = $seo ?? [
            'title'       => 'Crear cuenta | CuVaRents',
            'description' => 'Crea una cuenta en CuVaRents.',
            'keywords'    => '',
            'url'         => rtrim(BASE_URL, '/') . '/register',
            'image'       => rtrim(BASE_URL, '/') . '/assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_ES',
            'robots'      => 'noindex, nofollow',
            'breadcrumb'  => [['Inicio', BASE_URL], ['Register', rtrim(BASE_URL, '/') . '/register']],
            'pageType'    => 'auth-register'
        ];

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
        // Logout no necesita indexación tampoco
        header('X-Robots-Tag: noindex, nofollow', true);

        Auth::logout();
        header('Location: ' . BASE_URL);
        exit;
    }
}
