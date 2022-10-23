@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.subscriber.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.subscribers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.username') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->username }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.firstname') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->firstname }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.lastname') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->lastname }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.mobileno') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->mobileno }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.alternate_mobile_no') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->alternate_mobile_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.packagename') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->packagename }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.billingtypeid') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->billingtypeid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.subscriberid') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->subscriberid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.gstin') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->gstin }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->status }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.expiry') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->expiry }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.registrationdate') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->registrationdate }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.balance') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->balance }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.sub_status') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->sub_status }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.remarks') }}
                                    </th>
                                    <td>
                                        {{ $subscriber->remarks }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.photo') }}
                                    </th>
                                    <td>
                                        @if($subscriber->photo)
                                            <a href="{{ $subscriber->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $subscriber->photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.subscribers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection