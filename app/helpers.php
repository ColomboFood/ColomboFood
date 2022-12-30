<?php

if (!function_exists('insensitive_like')) {
    function insensitive_like($connection = null): string {
        $like = 'like';
        if( (!$connection && config('database.default') == 'pgsql') || ($connection == 'pgsql') )
        {
            $like = 'ilike';
        }
        return $like;
    }
}