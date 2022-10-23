@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.supportTicket.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.support-tickets.update", [$supportTicket->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.supportTicket.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $supportTicket->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportTicket.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content">{{ trans('cruds.supportTicket.fields.content') }}</label>
                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content">{{ old('content', $supportTicket->content) }}</textarea>
                @if($errors->has('content'))
                    <span class="text-danger">{{ $errors->first('content') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportTicket.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="auther_name">{{ trans('cruds.supportTicket.fields.auther_name') }}</label>
                <input class="form-control {{ $errors->has('auther_name') ? 'is-invalid' : '' }}" type="text" name="auther_name" id="auther_name" value="{{ old('auther_name', $supportTicket->auther_name) }}">
                @if($errors->has('auther_name'))
                    <span class="text-danger">{{ $errors->first('auther_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportTicket.fields.auther_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="author_email">{{ trans('cruds.supportTicket.fields.author_email') }}</label>
                <input class="form-control {{ $errors->has('author_email') ? 'is-invalid' : '' }}" type="email" name="author_email" id="author_email" value="{{ old('author_email', $supportTicket->author_email) }}">
                @if($errors->has('author_email'))
                    <span class="text-danger">{{ $errors->first('author_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportTicket.fields.author_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.supportTicket.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $supportTicket->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportTicket.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="priority_id">{{ trans('cruds.supportTicket.fields.priority') }}</label>
                <select class="form-control select2 {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority_id" id="priority_id">
                    @foreach($priorities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('priority_id') ? old('priority_id') : $supportTicket->priority->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('priority'))
                    <span class="text-danger">{{ $errors->first('priority') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportTicket.fields.priority_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="category_id">{{ trans('cruds.supportTicket.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $supportTicket->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportTicket.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.supportTicket.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $supportTicket->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportTicket.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assigned_tos">{{ trans('cruds.supportTicket.fields.assigned_to') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('assigned_tos') ? 'is-invalid' : '' }}" name="assigned_tos[]" id="assigned_tos" multiple>
                    @foreach($assigned_tos as $id => $assigned_to)
                        <option value="{{ $id }}" {{ (in_array($id, old('assigned_tos', [])) || $supportTicket->assigned_tos->contains($id)) ? 'selected' : '' }}>{{ $assigned_to }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_tos'))
                    <span class="text-danger">{{ $errors->first('assigned_tos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportTicket.fields.assigned_to_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection