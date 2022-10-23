<?php

namespace App\Http\Requests;

use App\Models\SupportPriority;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSupportPriorityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_priority_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:support_priorities,name,' . request()->route('support_priority')->id,
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
