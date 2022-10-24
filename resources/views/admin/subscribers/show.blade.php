@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subscriber.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subscribers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-sm table-bordered table-striped">
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
                            {{ trans('cruds.subscriber.fields.location') }}
                        </th>
                        <td>
                            {{ $subscriber->location }}
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
                <a class="btn btn-default" href="{{ route('admin.subscribers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>

        <table class="table table-sm table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.receivable.fields.financeref') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.lastupdate') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.amount_received') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.settled') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.settled_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.settled_at') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriber->receivables as $receivable)
                    <tr>
                        <td>{{ $receivable->financeref }}</td>
                        <td>{{ $receivable->lastupdate }}</td>
                        <td>{{ $receivable->description }}</td>
                        <td>{{ $receivable->amount }}</td>
                        <td>{{ $receivable->amount_received }}</td>
                        <td>{{ $receivable->settled }}</td>
                        <td>{{ $receivable->settled_by }}</td>
                        <td>{{ $receivable->settled_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>



@endsection
