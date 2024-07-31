<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class ProductRequest extends Request
{
    public function storeRules() : array
    {
        return [
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'user_id' => 'required|numeric|exists:users,id',
        ];
    }
}
