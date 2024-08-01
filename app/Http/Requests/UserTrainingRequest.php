<?php

namespace App\Http\Requests;

use App\Models\UserTraining;
use Illuminate\Validation\Rule;
use Orion\Http\Requests\Request;

class UserTrainingRequest extends Request
{
    public function commonRules(): array
    {
        return [
            'user_id' => 'required|numeric|exists:users,id',
            'training_id' => [
                'required',
                'numeric',
                'exists:trainings,id',
                Rule::unique(UserTraining::class)->where(function ($query) {
                    return $query->where('user_id', $this->user_id)
                        ->where('training_id', $this->training_id);
                }),
            ],
            'answer' => 'required|string|max:255',
        ];
    }
}
