<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersLimitRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
