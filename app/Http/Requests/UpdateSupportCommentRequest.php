<?php

namespace App\Http\Requests;

use App\Models\SupportComment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSupportCommentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_comment_edit');
    }

    public function rules()
    {
        return [
            'text' => [
                'string',
                'required',
            ],
            'ticket_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
