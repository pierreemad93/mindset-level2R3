<?php

namespace App\helpers;


class Views
{

    public static function adminView($path, $dataPassed = null)
    {
        view('admin.' . $path);
    }
}
