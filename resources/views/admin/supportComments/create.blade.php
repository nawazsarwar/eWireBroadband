@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.supportComment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.support-comments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">{{ trans('cruds.supportComment.fields.text') }}</label>
                <textarea class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" name="text" id="text">{{ old('text') }}</textarea>
                @if($errors->has('text'))
                    <span class="text-danger">{{ $errors->first('text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportComment.fields.text_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ticket_id">{{ trans('cruds.supportComment.fields.ticket') }}</label>
                <select class="form-control select2 {{ $errors->has('ticket') ? 'is-invalid' : '' }}" name="ticket_id" id="ticket_id" required>
                    @foreach($tickets as $id => $entry)
                        <option value="{{ $id }}" {{ old('ticket_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ticket'))
                    <span class="text-danger">{{ $errors->first('ticket') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportComment.fields.ticket_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.supportComment.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supportComment.fields.user_helper') }}</span>
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