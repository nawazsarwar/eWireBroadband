<?php

namespace App\Http\Requests;

use App\Models\SupportComment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySupportCommentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('support_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:support_comments,id',
        ];
    }
}
