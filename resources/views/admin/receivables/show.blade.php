@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.receivable.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.receivables.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-sm table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.id') }}
                        </th>
                        <td>
                            {{ $receivable->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.financeref') }}
                        </th>
                        <td>
                            {{ $receivable->financeref }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.lastupdate') }}
                        </th>
                        <td>
                            {{ $receivable->lastupdate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.description') }}
                        </th>
                        <td>
                            {{ $receivable->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.username') }}
                        </th>
                        <td>
                            {{ $receivable->username }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.subscriberid') }}
                        </th>
                        <td>
                            {{ $receivable->subscriberid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.amount') }}
                        </th>
                        <td>
                            {{ $receivable->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.amount_received') }}
                        </th>
                        <td>
                            {{ $receivable->amount_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.settled') }}
                        </th>
                        <td>
                            {{ App\Models\Receivable::SETTLED_SELECT[$receivable->settled] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.settled_by') }}
                        </th>
                        <td>
                            {{ $receivable->settled_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receivable.fields.settled_at') }}
                        </th>
                        <td>
                            {{ $receivable->settled_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.receivables.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
