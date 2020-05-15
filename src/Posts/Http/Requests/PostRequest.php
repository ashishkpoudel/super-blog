<?php

namespace src\Posts\Http\Requests;

use src\Core\Requests\BaseFormRequest;

class PostRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'body' => ['required', 'string']
        ];
    }
}
