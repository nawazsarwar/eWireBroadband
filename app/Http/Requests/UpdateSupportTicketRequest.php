<?php

namespace App\Http\Requests;

use App\Models\SupportTicket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSupportTicketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_ticket_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'auther_name' => [
                'string',
                'nullable',
            ],
            'assigned_tos.*' => [
                'integer',
            ],
            'assigned_tos' => [
                'array',
            ],
        ];
    }
}
