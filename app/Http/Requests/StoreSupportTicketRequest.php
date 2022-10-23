<?php

namespace App\Http\Requests;

use App\Models\SupportTicket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSupportTicketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_ticket_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'content' => [
                'string',
                'nullable',
            ],
            'auther_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
