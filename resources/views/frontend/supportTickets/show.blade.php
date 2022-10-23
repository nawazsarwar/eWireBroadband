@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.supportTicket.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.support-tickets.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportTicket.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $supportTicket->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportTicket.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $supportTicket->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportTicket.fields.content') }}
                                    </th>
                                    <td>
                                        {{ $supportTicket->content }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportTicket.fields.auther_name') }}
                                    </th>
                                    <td>
                                        {{ $supportTicket->auther_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportTicket.fields.author_email') }}
                                    </th>
                                    <td>
                                        {{ $supportTicket->author_email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportTicket.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $supportTicket->status->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportTicket.fields.priority') }}
                                    </th>
                                    <td>
                                        {{ $supportTicket->priority->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportTicket.fields.category') }}
                                    </th>
                                    <td>
                                        {{ $supportTicket->category->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportTicket.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $supportTicket->user->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.support-tickets.index') }}">
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