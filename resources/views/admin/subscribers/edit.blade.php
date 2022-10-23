@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subscriber.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subscribers.update", [$subscriber->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.subscriber.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $subscriber->username) }}" required>
                @if($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="firstname">{{ trans('cruds.subscriber.fields.firstname') }}</label>
                <input class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" type="text" name="firstname" id="firstname" value="{{ old('firstname', $subscriber->firstname) }}" required>
                @if($errors->has('firstname'))
                    <span class="text-danger">{{ $errors->first('firstname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.firstname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lastname">{{ trans('cruds.subscriber.fields.lastname') }}</label>
                <input class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" type="text" name="lastname" id="lastname" value="{{ old('lastname', $subscriber->lastname) }}">
                @if($errors->has('lastname'))
                    <span class="text-danger">{{ $errors->first('lastname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.lastname_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobileno">{{ trans('cruds.subscriber.fields.mobileno') }}</label>
                <input class="form-control {{ $errors->has('mobileno') ? 'is-invalid' : '' }}" type="text" name="mobileno" id="mobileno" value="{{ old('mobileno', $subscriber->mobileno) }}" required>
                @if($errors->has('mobileno'))
                    <span class="text-danger">{{ $errors->first('mobileno') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.mobileno_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alternate_mobile_no">{{ trans('cruds.subscriber.fields.alternate_mobile_no') }}</label>
                <input class="form-control {{ $errors->has('alternate_mobile_no') ? 'is-invalid' : '' }}" type="text" name="alternate_mobile_no" id="alternate_mobile_no" value="{{ old('alternate_mobile_no', $subscriber->alternate_mobile_no) }}">
                @if($errors->has('alternate_mobile_no'))
                    <span class="text-danger">{{ $errors->first('alternate_mobile_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.alternate_mobile_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.subscriber.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $subscriber->email) }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.subscriber.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $subscriber->address) }}" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="packagename">{{ trans('cruds.subscriber.fields.packagename') }}</label>
                <input class="form-control {{ $errors->has('packagename') ? 'is-invalid' : '' }}" type="text" name="packagename" id="packagename" value="{{ old('packagename', $subscriber->packagename) }}">
                @if($errors->has('packagename'))
                    <span class="text-danger">{{ $errors->first('packagename') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.packagename_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="billingtypeid">{{ trans('cruds.subscriber.fields.billingtypeid') }}</label>
                <input class="form-control {{ $errors->has('billingtypeid') ? 'is-invalid' : '' }}" type="text" name="billingtypeid" id="billingtypeid" value="{{ old('billingtypeid', $subscriber->billingtypeid) }}">
                @if($errors->has('billingtypeid'))
                    <span class="text-danger">{{ $errors->first('billingtypeid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.billingtypeid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="subscriberid">{{ trans('cruds.subscriber.fields.subscriberid') }}</label>
                <input class="form-control {{ $errors->has('subscriberid') ? 'is-invalid' : '' }}" type="text" name="subscriberid" id="subscriberid" value="{{ old('subscriberid', $subscriber->subscriberid) }}" required>
                @if($errors->has('subscriberid'))
                    <span class="text-danger">{{ $errors->first('subscriberid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.subscriberid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gstin">{{ trans('cruds.subscriber.fields.gstin') }}</label>
                <input class="form-control {{ $errors->has('gstin') ? 'is-invalid' : '' }}" type="text" name="gstin" id="gstin" value="{{ old('gstin', $subscriber->gstin) }}">
                @if($errors->has('gstin'))
                    <span class="text-danger">{{ $errors->first('gstin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.gstin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.subscriber.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', $subscriber->status) }}" step="1">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="expiry">{{ trans('cruds.subscriber.fields.expiry') }}</label>
                <input class="form-control datetime {{ $errors->has('expiry') ? 'is-invalid' : '' }}" type="text" name="expiry" id="expiry" value="{{ old('expiry', $subscriber->expiry) }}">
                @if($errors->has('expiry'))
                    <span class="text-danger">{{ $errors->first('expiry') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.expiry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="registrationdate">{{ trans('cruds.subscriber.fields.registrationdate') }}</label>
                <input class="form-control datetime {{ $errors->has('registrationdate') ? 'is-invalid' : '' }}" type="text" name="registrationdate" id="registrationdate" value="{{ old('registrationdate', $subscriber->registrationdate) }}">
                @if($errors->has('registrationdate'))
                    <span class="text-danger">{{ $errors->first('registrationdate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.registrationdate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance">{{ trans('cruds.subscriber.fields.balance') }}</label>
                <input class="form-control {{ $errors->has('balance') ? 'is-invalid' : '' }}" type="number" name="balance" id="balance" value="{{ old('balance', $subscriber->balance) }}" step="0.01">
                @if($errors->has('balance'))
                    <span class="text-danger">{{ $errors->first('balance') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sub_status">{{ trans('cruds.subscriber.fields.sub_status') }}</label>
                <input class="form-control {{ $errors->has('sub_status') ? 'is-invalid' : '' }}" type="text" name="sub_status" id="sub_status" value="{{ old('sub_status', $subscriber->sub_status) }}">
                @if($errors->has('sub_status'))
                    <span class="text-danger">{{ $errors->first('sub_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.sub_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.subscriber.fields.remarks') }}</label>
                <input class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" type="text" name="remarks" id="remarks" value="{{ old('remarks', $subscriber->remarks) }}">
                @if($errors->has('remarks'))
                    <span class="text-danger">{{ $errors->first('remarks') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriber.fields.remarks_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.subscriber.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
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



@endsection

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.subscribers.storeMedia') }}',
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