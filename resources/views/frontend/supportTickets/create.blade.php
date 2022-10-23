@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.supportTicket.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.support-tickets.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.supportTicket.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportTicket.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="content">{{ trans('cruds.supportTicket.fields.content') }}</label>
                            <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportTicket.fields.content_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="auther_name">{{ trans('cruds.supportTicket.fields.auther_name') }}</label>
                            <input class="form-control" type="text" name="auther_name" id="auther_name" value="{{ old('auther_name', '') }}">
                            @if($errors->has('auther_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('auther_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportTicket.fields.auther_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="author_email">{{ trans('cruds.supportTicket.fields.author_email') }}</label>
                            <input class="form-control" type="email" name="author_email" id="author_email" value="{{ old('author_email') }}">
                            @if($errors->has('author_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('author_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportTicket.fields.author_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status_id">{{ trans('cruds.supportTicket.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id">
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportTicket.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="priority_id">{{ trans('cruds.supportTicket.fields.priority') }}</label>
                            <select class="form-control select2" name="priority_id" id="priority_id">
                                @foreach($priorities as $id => $entry)
                                    <option value="{{ $id }}" {{ old('priority_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('priority'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('priority') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportTicket.fields.priority_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="category_id">{{ trans('cruds.supportTicket.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id">
                                @foreach($categories as $id => $entry)
                                    <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportTicket.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.supportTicket.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportTicket.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="assigned_tos">{{ trans('cruds.supportTicket.fields.assigned_to') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="assigned_tos[]" id="assigned_tos" multiple>
                                @foreach($assigned_tos as $id => $assigned_to)
                                    <option value="{{ $id }}" {{ in_array($id, old('assigned_tos', [])) ? 'selected' : '' }}>{{ $assigned_to }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('assigned_tos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assigned_tos') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection