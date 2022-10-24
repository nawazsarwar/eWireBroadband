<?php

namespace App\Http\Requests;

use App\Models\Subscriber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubscriberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('subscriber_create');
    }

    public function rules()
    {
        return [
            'username' => [
                'string',
                'min:5',
                'max:25',
                'required',
                'unique:subscribers',
            ],
            'address' => [
                'string',
                'required',
            ],
            'gstin' => [
                'string',
                'nullable',
            ],
            'status' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'expiry' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'sub_status' => [
                'string',
                'nullable',
            ],
            'remarks' => [
                'string',
                'nullable',
            ],
            'lastname' => [
                'string',
                'nullable',
            ],
            'alternate_mobile_no' => [
                'string',
                'min:10',
                'max:15',
                'nullable',
            ],
            'email' => [
                'required',
                'unique:subscribers',
            ],
            'packagename' => [
                'string',
                'nullable',
            ],
            'billingtypeid' => [
                'string',
                'nullable',
            ],
            'subscriberid' => [
                'string',
                'required',
                'unique:subscribers',
            ],
            'registrationdate' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'firstname' => [
                'string',
                'required',
            ],
            'mobileno' => [
                'string',
                'min:10',
                'max:20',
                'required',
            ],
            'location' => [
                'string',
                'max:50',
                'required',
            ],
        ];
    }
}
