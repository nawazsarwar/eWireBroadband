<?php

namespace App\Http\Requests;

use App\Models\SupportCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSupportCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_category_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:support_categories',
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
