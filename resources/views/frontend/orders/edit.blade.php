@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.orders.update", [$order->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="parameters">{{ trans('cruds.order.fields.parameters') }}</label>
                            <textarea class="form-control" name="parameters" id="parameters">{{ old('parameters', $order->parameters) }}</textarea>
                            @if($errors->has('parameters'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('parameters') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.parameters_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="amount">{{ trans('cruds.order.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $order->amount) }}" step="0.01">
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="currency">{{ trans('cruds.order.fields.currency') }}</label>
                            <input class="form-control" type="text" name="currency" id="currency" value="{{ old('currency', $order->currency) }}">
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.order.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', $order->status) }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="transacted_on">{{ trans('cruds.order.fields.transacted_on') }}</label>
                            <input class="form-control datetime" type="text" name="transacted_on" id="transacted_on" value="{{ old('transacted_on', $order->transacted_on) }}">
                            @if($errors->has('transacted_on'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transacted_on') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.transacted_on_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="narration">{{ trans('cruds.order.fields.narration') }}</label>
                            <input class="form-control" type="text" name="narration" id="narration" value="{{ old('narration', $order->narration) }}">
                            @if($errors->has('narration'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('narration') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.narration_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="response">{{ trans('cruds.order.fields.response') }}</label>
                            <textarea class="form-control" name="response" id="response">{{ old('response', $order->response) }}</textarea>
                            @if($errors->has('response'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('response') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.response_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="receivable_id">{{ trans('cruds.order.fields.receivable') }}</label>
                            <select class="form-control select2" name="receivable_id" id="receivable_id">
                                @foreach($receivables as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('receivable_id') ? old('receivable_id') : $order->receivable->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('receivable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('receivable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.receivable_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="merchant_order">{{ trans('cruds.order.fields.merchant_order') }}</label>
                            <input class="form-control" type="text" name="merchant_order" id="merchant_order" value="{{ old('merchant_order', $order->merchant_order) }}">
                            @if($errors->has('merchant_order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('merchant_order') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection