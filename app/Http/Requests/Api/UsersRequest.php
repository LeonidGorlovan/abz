<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Trait\FormatValidationJson;
use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    use FormatValidationJson;

    public function rules(): array
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
            'count' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
