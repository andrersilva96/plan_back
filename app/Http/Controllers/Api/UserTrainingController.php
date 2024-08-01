<?php

namespace App\Http\Controllers\Api;

use App\Models\UserTraining;
use App\Policies\UserTrainingPolicy;
use Orion\Http\Controllers\Controller;

class UserTrainingController extends Controller
{
    protected $model = UserTraining::class;

    protected $policies = [
        UserTraining::class => UserTrainingPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }

    public function filterableBy() : array
    {
        return ['title'];
    }
}
