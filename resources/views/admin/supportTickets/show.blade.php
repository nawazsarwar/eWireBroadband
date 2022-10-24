@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supportTicket.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.support-tickets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-sm table-show table-bordered table-striped">
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
                            <span class="text-lg badge badge-{{ $supportTicket->priority->color ?? '' }}">{{ $supportTicket->priority->name ?? '' }}</span>
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
                    <tr>
                        <th>
                            {{ trans('cruds.supportTicket.fields.assigned_to') }}
                        </th>
                        <td>
                            @foreach($supportTicket->assigned_tos as $key => $assigned_to)
                                <span class="label label-info">{{ $assigned_to->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.support-tickets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
        </div>

        <div class="row">
            @foreach ( $supportTicket->comments as $comment)
                <div class="col-md-12">
                    <div class="card @if( $comment->user->id == auth()->id() ) float-right text-white bg-success @else float-left text-white bg-primary @endif">
                        <div class="card-body pt-1 pb-1">
                            {{ $comment->user->name }}: <span class="text-bold">{!! $comment->text !!}</span><br>
                            <small class="font-italic font-weight-light">{{ $comment->created_at }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route("admin.support-comments.store") }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="ticket_id" value="{{ $supportTicket->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div class="form-group">
                        <label for="text">{{ trans('cruds.supportComment.fields.text') }}</label>
                        <textarea class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" name="text" id="text">{{ old('text') }}</textarea>
                        @if($errors->has('text'))
                            <span class="text-danger">{{ $errors->first('text') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.supportComment.fields.text_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
