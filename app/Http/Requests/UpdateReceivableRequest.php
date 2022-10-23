<?php

namespace App\Http\Requests;

use App\Models\Receivable;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReceivableRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('receivable_edit');
    }

    public function rules()
    {
        return [
            'financeref' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'lastupdate' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'username' => [
                'string',
                'required',
            ],
            'subscriberid' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'amount' => [
                'required',
            ],
            'settled_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
