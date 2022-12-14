@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.receivable.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.receivables.update", [$receivable->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="financeref">{{ trans('cruds.receivable.fields.financeref') }}</label>
                <input class="form-control {{ $errors->has('financeref') ? 'is-invalid' : '' }}" type="number" name="financeref" id="financeref" value="{{ old('financeref', $receivable->financeref) }}" step="1">
                @if($errors->has('financeref'))
                    <span class="text-danger">{{ $errors->first('financeref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.financeref_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lastupdate">{{ trans('cruds.receivable.fields.lastupdate') }}</label>
                <input class="form-control datetime {{ $errors->has('lastupdate') ? 'is-invalid' : '' }}" type="text" name="lastupdate" id="lastupdate" value="{{ old('lastupdate', $receivable->lastupdate) }}" required>
                @if($errors->has('lastupdate'))
                    <span class="text-danger">{{ $errors->first('lastupdate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.lastupdate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.receivable.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $receivable->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.receivable.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $receivable->username) }}" required>
                @if($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="subscriberid">{{ trans('cruds.receivable.fields.subscriberid') }}</label>
                <input class="form-control {{ $errors->has('subscriberid') ? 'is-invalid' : '' }}" type="number" name="subscriberid" id="subscriberid" value="{{ old('subscriberid', $receivable->subscriberid) }}" step="1" required>
                @if($errors->has('subscriberid'))
                    <span class="text-danger">{{ $errors->first('subscriberid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.subscriberid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.receivable.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $receivable->amount) }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_received">{{ trans('cruds.receivable.fields.amount_received') }}</label>
                <input class="form-control {{ $errors->has('amount_received') ? 'is-invalid' : '' }}" type="number" name="amount_received" id="amount_received" value="{{ old('amount_received', $receivable->amount_received) }}" step="0.01">
                @if($errors->has('amount_received'))
                    <span class="text-danger">{{ $errors->first('amount_received') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.amount_received_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.receivable.fields.settled') }}</label>
                <select class="form-control {{ $errors->has('settled') ? 'is-invalid' : '' }}" name="settled" id="settled">
                    <option value disabled {{ old('settled', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Receivable::SETTLED_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('settled', $receivable->settled) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('settled'))
                    <span class="text-danger">{{ $errors->first('settled') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.settled_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="settled_by_id">{{ trans('cruds.receivable.fields.settled_by') }}</label>
                <select class="form-control select2 {{ $errors->has('settled_by') ? 'is-invalid' : '' }}" name="settled_by_id" id="settled_by_id">
                    @foreach($settled_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('settled_by_id') ? old('settled_by_id') : $receivable->settled_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('settled_by'))
                    <span class="text-danger">{{ $errors->first('settled_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.settled_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="settled_at">{{ trans('cruds.receivable.fields.settled_at') }}</label>
                <input class="form-control datetime {{ $errors->has('settled_at') ? 'is-invalid' : '' }}" type="text" name="settled_at" id="settled_at" value="{{ old('settled_at', $receivable->settled_at) }}">
                @if($errors->has('settled_at'))
                    <span class="text-danger">{{ $errors->first('settled_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receivable.fields.settled_at_helper') }}</span>
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