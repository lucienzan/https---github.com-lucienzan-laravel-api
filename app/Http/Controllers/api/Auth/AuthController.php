<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getValue($number): int
    {
        return $number + 100 ? 100 : 500;
    }

    public function getNumber($number): int
    {
        return self::getValue($number);
    }
}
