<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\User;
use App\Policies\ProductPolicy;
use Orion\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $model = Product::class;

    protected $relation = User::class;

    protected $policies = [
        Product::class => ProductPolicy::class,
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
