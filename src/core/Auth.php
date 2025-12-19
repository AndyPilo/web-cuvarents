<?php
// src/core/Auth.php

class Auth
{
    // Claves de sesión centralizadas
    private const KEY_ID       = 'account_id';
    private const KEY_USER     = 'account_username';
    private const KEY_EMAIL    = 'account_email';
    private const KEY_RANGO    = 'account_rango';
    private const KEY_PREFIX   = 'account_prefix_phone';
    private const KEY_NUMBER   = 'account_number_phone';

    public static function login(array $user): void
    {
        Session::start();

        // Anti fixation
        Session::regenerate();

        Session::set(self::KEY_ID,       (int)$user['account_id']);
        Session::set(self::KEY_USER,     $user['account_username'] ?? '');
        Session::set(self::KEY_EMAIL,    $user['account_email'] ?? '');
        Session::set(self::KEY_RANGO,    (int)($user['account_rango'] ?? 1));
        Session::set(self::KEY_PREFIX,   $user['account_prefix_phone'] ?? null);
        Session::set(self::KEY_NUMBER,   $user['account_number_phone'] ?? null);
    }

    public static function logout(): void
    {
        Session::destroy();
    }

    public static function user(): ?array
    {
        $id = Session::get(self::KEY_ID);

        if ($id === null) {
            return null;
        }

        $prefix = (string) Session::get(self::KEY_PREFIX, '');
        $number = (string) Session::get(self::KEY_NUMBER, '');
        $phone  = trim($prefix . ' ' . $number);

        return [
            'id'       => (int)$id,
            'username' => Session::get(self::KEY_USER),
            'email'    => Session::get(self::KEY_EMAIL),
            'rango'    => (int) Session::get(self::KEY_RANGO, 1),
            'phone'    => $phone,
        ];
    }

    public static function isLoggedIn(): bool
    {
        return self::user() !== null;
    }

    public static function isAdmin(): bool
    {
        $user = self::user();
        return $user !== null && (int)$user['rango'] === 99;
    }

    public static function requireLogin(): void
    {
        if (!self::isLoggedIn()) {
            Session::flash('error', 'Debes iniciar sesión para acceder a esta sección.');
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    public static function requireAdmin(): void
    {
        if (!self::isAdmin()) {
            Session::flash('error', 'No tienes permisos para acceder a esta sección.');
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    /**
     * Evita que usuarios logueados entren a login/register.
     */
    public static function requireGuest(): void
    {
        if (self::isLoggedIn()) {
            header('Location: ' . BASE_URL);
            exit;
        }
    }
}
