@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supportStatus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.support-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supportStatus.fields.id') }}
                        </th>
                        <td>
                            {{ $supportStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportStatus.fields.name') }}
                        </th>
                        <td>
                            {{ $supportStatus->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportStatus.fields.color') }}
                        </th>
                        <td>
                            {{ $supportStatus->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportStatus.fields.status') }}
                        </th>
                        <td>
                            {{ $supportStatus->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportStatus.fields.remarks') }}
                        </th>
                        <td>
                            {{ $supportStatus->remarks }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.support-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection