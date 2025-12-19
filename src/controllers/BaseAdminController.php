<?php
// src/controllers/BaseAdminController.php

abstract class BaseAdminController
{
    public function __construct()
    {
        // Cualquier controlador que herede de este, será solo admin
        Auth::requireAdmin();
    }

    /**
     * Devuelve el usuario autenticado actual (atajo a Auth::user()).
     */
    protected function currentUser(): ?array
    {
        return Auth::user();
    }
}
