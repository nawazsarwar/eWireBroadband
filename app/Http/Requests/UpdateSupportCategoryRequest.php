<?php

namespace App\Http\Requests;

use App\Models\SupportCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSupportCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_category_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:support_categories,name,' . request()->route('support_category')->id,
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
