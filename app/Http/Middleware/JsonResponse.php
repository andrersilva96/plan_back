<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JsonResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $data = $response->getData(true);
            $response->setData([
                'success' => $response->getStatusCode() < 400,
                'data' => $data
            ]);
        }

        return $response;
    }
}
