@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="parameters">{{ trans('cruds.order.fields.parameters') }}</label>
                <textarea class="form-control {{ $errors->has('parameters') ? 'is-invalid' : '' }}" name="parameters" id="parameters">{{ old('parameters', $order->parameters) }}</textarea>
                @if($errors->has('parameters'))
                    <span class="text-danger">{{ $errors->first('parameters') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.parameters_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.order.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $order->amount) }}" step="0.01">
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="currency">{{ trans('cruds.order.fields.currency') }}</label>
                <input class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" type="text" name="currency" id="currency" value="{{ old('currency', $order->currency) }}">
                @if($errors->has('currency'))
                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.order.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $order->status) }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transacted_on">{{ trans('cruds.order.fields.transacted_on') }}</label>
                <input class="form-control datetime {{ $errors->has('transacted_on') ? 'is-invalid' : '' }}" type="text" name="transacted_on" id="transacted_on" value="{{ old('transacted_on', $order->transacted_on) }}">
                @if($errors->has('transacted_on'))
                    <span class="text-danger">{{ $errors->first('transacted_on') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.transacted_on_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="narration">{{ trans('cruds.order.fields.narration') }}</label>
                <input class="form-control {{ $errors->has('narration') ? 'is-invalid' : '' }}" type="text" name="narration" id="narration" value="{{ old('narration', $order->narration) }}">
                @if($errors->has('narration'))
                    <span class="text-danger">{{ $errors->first('narration') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.narration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="response">{{ trans('cruds.order.fields.response') }}</label>
                <textarea class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" name="response" id="response">{{ old('response', $order->response) }}</textarea>
                @if($errors->has('response'))
                    <span class="text-danger">{{ $errors->first('response') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.response_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receivable_id">{{ trans('cruds.order.fields.receivable') }}</label>
                <select class="form-control select2 {{ $errors->has('receivable') ? 'is-invalid' : '' }}" name="receivable_id" id="receivable_id">
                    @foreach($receivables as $id => $entry)
                        <option value="{{ $id }}" {{ (old('receivable_id') ? old('receivable_id') : $order->receivable->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('receivable'))
                    <span class="text-danger">{{ $errors->first('receivable') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.receivable_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="merchant_order">{{ trans('cruds.order.fields.merchant_order') }}</label>
                <input class="form-control {{ $errors->has('merchant_order') ? 'is-invalid' : '' }}" type="text" name="merchant_order" id="merchant_order" value="{{ old('merchant_order', $order->merchant_order) }}">
                @if($errors->has('merchant_order'))
                    <span class="text-danger">{{ $errors->first('merchant_order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.merchant_order_helper') }}</span>
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