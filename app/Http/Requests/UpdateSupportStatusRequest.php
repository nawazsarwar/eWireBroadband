<?php

namespace App\Http\Requests;

use App\Models\SupportStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSupportStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_status_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:support_statuses,name,' . request()->route('support_status')->id,
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
