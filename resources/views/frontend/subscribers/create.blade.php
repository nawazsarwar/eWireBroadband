@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.subscriber.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.subscribers.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="username">{{ trans('cruds.subscriber.fields.username') }}</label>
                            <input class="form-control" type="text" name="username" id="username" value="{{ old('username', '') }}" required>
                            @if($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.username_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="firstname">{{ trans('cruds.subscriber.fields.firstname') }}</label>
                            <input class="form-control" type="text" name="firstname" id="firstname" value="{{ old('firstname', '') }}" required>
                            @if($errors->has('firstname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('firstname') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.firstname_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="lastname">{{ trans('cruds.subscriber.fields.lastname') }}</label>
                            <input class="form-control" type="text" name="lastname" id="lastname" value="{{ old('lastname', '') }}">
                            @if($errors->has('lastname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lastname') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.lastname_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="mobileno">{{ trans('cruds.subscriber.fields.mobileno') }}</label>
                            <input class="form-control" type="text" name="mobileno" id="mobileno" value="{{ old('mobileno', '') }}" required>
                            @if($errors->has('mobileno'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobileno') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.mobileno_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="alternate_mobile_no">{{ trans('cruds.subscriber.fields.alternate_mobile_no') }}</label>
                            <input class="form-control" type="text" name="alternate_mobile_no" id="alternate_mobile_no" value="{{ old('alternate_mobile_no', '') }}">
                            @if($errors->has('alternate_mobile_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('alternate_mobile_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.alternate_mobile_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.subscriber.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="address">{{ trans('cruds.subscriber.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="packagename">{{ trans('cruds.subscriber.fields.packagename') }}</label>
                            <input class="form-control" type="text" name="packagename" id="packagename" value="{{ old('packagename', '') }}">
                            @if($errors->has('packagename'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('packagename') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.packagename_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="billingtypeid">{{ trans('cruds.subscriber.fields.billingtypeid') }}</label>
                            <input class="form-control" type="text" name="billingtypeid" id="billingtypeid" value="{{ old('billingtypeid', '') }}">
                            @if($errors->has('billingtypeid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('billingtypeid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.billingtypeid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="subscriberid">{{ trans('cruds.subscriber.fields.subscriberid') }}</label>
                            <input class="form-control" type="text" name="subscriberid" id="subscriberid" value="{{ old('subscriberid', '') }}" required>
                            @if($errors->has('subscriberid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subscriberid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.subscriberid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="gstin">{{ trans('cruds.subscriber.fields.gstin') }}</label>
                            <input class="form-control" type="text" name="gstin" id="gstin" value="{{ old('gstin', '') }}">
                            @if($errors->has('gstin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gstin') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.gstin_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.subscriber.fields.status') }}</label>
                            <input class="form-control" type="number" name="status" id="status" value="{{ old('status', '') }}" step="1">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="expiry">{{ trans('cruds.subscriber.fields.expiry') }}</label>
                            <input class="form-control datetime" type="text" name="expiry" id="expiry" value="{{ old('expiry') }}">
                            @if($errors->has('expiry'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('expiry') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.expiry_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="registrationdate">{{ trans('cruds.subscriber.fields.registrationdate') }}</label>
                            <input class="form-control datetime" type="text" name="registrationdate" id="registrationdate" value="{{ old('registrationdate') }}">
                            @if($errors->has('registrationdate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('registrationdate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.registrationdate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="balance">{{ trans('cruds.subscriber.fields.balance') }}</label>
                            <input class="form-control" type="number" name="balance" id="balance" value="{{ old('balance', '') }}" step="0.01">
                            @if($errors->has('balance'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('balance') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.balance_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sub_status">{{ trans('cruds.subscriber.fields.sub_status') }}</label>
                            <input class="form-control" type="text" name="sub_status" id="sub_status" value="{{ old('sub_status', '') }}">
                            @if($errors->has('sub_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.sub_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.subscriber.fields.remarks') }}</label>
                            <input class="form-control" type="text" name="remarks" id="remarks" value="{{ old('remarks', '') }}">
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.remarks_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photo">{{ trans('cruds.subscriber.fields.photo') }}</label>
                            <div class="needsclick dropzone" id="photo-dropzone">
                            </div>
                            @if($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscriber.fields.photo_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('frontend.subscribers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($subscriber) && $subscriber->photo)
      var file = {!! json_encode($subscriber->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection