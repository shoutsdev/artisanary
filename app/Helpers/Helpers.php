<?php

if (!function_exists('hasPermission')) {

    function hasPermission($key_word): bool
    {
        if (in_array($key_word, auth()->user()->role->permissions) || auth()->user()->role_id == 1) {
            return true;
        }
        return false;
    }
}
