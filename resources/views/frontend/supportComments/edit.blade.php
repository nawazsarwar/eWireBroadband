@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.supportComment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.support-comments.update", [$supportComment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="text">{{ trans('cruds.supportComment.fields.text') }}</label>
                            <textarea class="form-control" name="text" id="text">{{ old('text', $supportComment->text) }}</textarea>
                            @if($errors->has('text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportComment.fields.text_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="ticket_id">{{ trans('cruds.supportComment.fields.ticket') }}</label>
                            <select class="form-control select2" name="ticket_id" id="ticket_id" required>
                                @foreach($tickets as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('ticket_id') ? old('ticket_id') : $supportComment->ticket->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ticket'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ticket') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supportComment.fields.ticket_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.supportComment.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $supportComment->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection