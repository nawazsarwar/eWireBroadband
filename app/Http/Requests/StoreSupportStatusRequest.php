<?php

namespace App\Http\Requests;

use App\Models\SupportStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSupportStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_status_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:support_statuses',
            ],
            'color' => [
                'string',
                'nullable',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
