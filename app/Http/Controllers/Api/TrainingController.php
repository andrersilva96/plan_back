<?php

namespace App\Http\Controllers\Api;

use App\Models\Training;
use App\Models\User;
use App\Policies\TrainingPolicy;
use Orion\Http\Controllers\Controller;

class TrainingController extends Controller
{
    protected $model = Training::class;

    protected $relation = User::class;

    protected $policies = [
        Training::class => TrainingPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }

    public function filterableBy() : array
    {
        return ['name'];
    }
}
