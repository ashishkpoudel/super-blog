<?php

namespace src\Users\Http\Requests;

use src\Core\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'emailAddress' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }
}
