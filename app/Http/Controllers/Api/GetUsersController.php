<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;

class GetUsersController extends BaseController
{
    // ==================== Статичный справочник пользователей. =====================
    public function index()
    {
        return User::all();
    }
}
