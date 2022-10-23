@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supportCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.support-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supportCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $supportCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $supportCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportCategory.fields.color') }}
                        </th>
                        <td>
                            {{ $supportCategory->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportCategory.fields.status') }}
                        </th>
                        <td>
                            {{ $supportCategory->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supportCategory.fields.remarks') }}
                        </th>
                        <td>
                            {{ $supportCategory->remarks }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.support-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection