<?php

if (!function_exists('hasPermission')) {

    function hasPermission($key_word): bool
    {
        if (in_array($key_word, auth()->user()->role->permissions)) {
            return true;
        }
        return false;
    }
}
