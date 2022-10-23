<?php

namespace App\Http\Requests;

use App\Models\SupportCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySupportCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('support_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:support_categories,id',
        ];
    }
}
