@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.receivable.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.receivables.update", [$receivable->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="financeref">{{ trans('cruds.receivable.fields.financeref') }}</label>
                            <input class="form-control" type="number" name="financeref" id="financeref" value="{{ old('financeref', $receivable->financeref) }}" step="1">
                            @if($errors->has('financeref'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('financeref') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.receivable.fields.financeref_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="lastupdate">{{ trans('cruds.receivable.fields.lastupdate') }}</label>
                            <input class="form-control datetime" type="text" name="lastupdate" id="lastupdate" value="{{ old('lastupdate', $receivable->lastupdate) }}" required>
                            @if($errors->has('lastupdate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lastupdate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.receivable.fields.lastupdate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.receivable.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $receivable->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.receivable.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="username">{{ trans('cruds.receivable.fields.username') }}</label>
                            <input class="form-control" type="text" name="username" id="username" value="{{ old('username', $receivable->username) }}" required>
                            @if($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.receivable.fields.username_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="subscriberid">{{ trans('cruds.receivable.fields.subscriberid') }}</label>
                            <input class="form-control" type="number" name="subscriberid" id="subscriberid" value="{{ old('subscriberid', $receivable->subscriberid) }}" step="1" required>
                            @if($errors->has('subscriberid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subscriberid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.receivable.fields.subscriberid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.receivable.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $receivable->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.receivable.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="amount_received">{{ trans('cruds.receivable.fields.amount_received') }}</label>
                            <input class="form-control" type="number" name="amount_received" id="amount_received" value="{{ old('amount_received', $receivable->amount_received) }}" step="0.01">
                            @if($errors->has('amount_received'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount_received') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.receivable.fields.amount_received_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.receivable.fields.settled') }}</label>
                            <select class="form-control" name="settled" id="settled">
                                <option value disabled {{ old('settled', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Receivable::SETTLED_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('settled', $receivable->settled) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('settled'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('settled') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.receivable.fields.settled_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="settled_by_id">{{ trans('cruds.receivable.fields.settled_by') }}</label>
                            <select class="form-control select2" name="settled_by_id" id="settled_by_id">
                                @foreach($settled_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('settled_by_id') ? old('settled_by_id') : $receivable->settled_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('settled_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('settled_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.receivable.fields.settled_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="settled_at">{{ trans('cruds.receivable.fields.settled_at') }}</label>
                            <input class="form-control datetime" type="text" name="settled_at" id="settled_at" value="{{ old('settled_at', $receivable->settled_at) }}">
                            @if($errors->has('settled_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('settled_at') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection