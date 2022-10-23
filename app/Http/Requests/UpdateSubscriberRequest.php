<?php

namespace App\Http\Requests;

use App\Models\Subscriber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSubscriberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('subscriber_edit');
    }

    public function rules()
    {
        return [
            'username' => [
                'string',
                'min:5',
                'max:25',
                'required',
                'unique:subscribers,username,' . request()->route('subscriber')->id,
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
                'unique:subscribers,email,' . request()->route('subscriber')->id,
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
                'unique:subscribers,subscriberid,' . request()->route('subscriber')->id,
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
        ];
    }
}
