<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Policies\UserPolicy;
use Orion\Http\Controllers\Controller;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserController extends Controller
{
    use HandlesAuthorization;

    protected $model = User::class;

    protected $policy = UserPolicy::class;
}
