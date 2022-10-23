@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supportPriority.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.support-priorities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supportPriority.fields.id') }}
                        </th>
                        <td>
                            {{ $supportPriority->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportPriority.fields.name') }}
                        </th>
                        <td>
                            {{ $supportPriority->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportPriority.fields.color') }}
                        </th>
                        <td>
                            {{ $supportPriority->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportPriority.fields.status') }}
                        </th>
                        <td>
                            {{ $supportPriority->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportPriority.fields.remarks') }}
                        </th>
                        <td>
                            {{ $supportPriority->remarks }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.support-priorities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection