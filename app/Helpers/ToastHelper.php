<?php

namespace App\Helpers;

class ToastHelper
{
    /**
     * Ajouter un toast de succès
     */
    public static function success($message)
    {
        session()->flash('toast', $message);
        session()->flash('toast_type', 'success');
    }

    /**
     * Ajouter un toast d'erreur
     */
    public static function error($message)
    {
        session()->flash('toast', $message);
        session()->flash('toast_type', 'error');
    }

    /**
     * Ajouter un toast d'avertissement
     */
    public static function warning($message)
    {
        session()->flash('toast', $message);
        session()->flash('toast_type', 'warning');
    }

    /**
     * Ajouter un toast d'information
     */
    public static function info($message)
    {
        session()->flash('toast', $message);
        session()->flash('toast_type', 'info');
    }
}
