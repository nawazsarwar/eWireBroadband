@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('subscriber_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.subscribers.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.subscriber.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Subscriber', 'route' => 'admin.subscribers.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.subscriber.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Subscriber">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.username') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.firstname') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.lastname') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.mobileno') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.expiry') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.balance') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscriber.fields.photo') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscribers as $key => $subscriber)
                                    <tr data-entry-id="{{ $subscriber->id }}">
                                        <td>
                                            {{ $subscriber->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscriber->username ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscriber->firstname ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscriber->lastname ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscriber->mobileno ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscriber->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscriber->status ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscriber->expiry ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscriber->balance ?? '' }}
                                        </td>
                                        <td>
                                            @if($subscriber->photo)
                                                <a href="{{ $subscriber->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $subscriber->photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('subscriber_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.subscribers.show', $subscriber->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('subscriber_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.subscribers.edit', $subscriber->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('subscriber_delete')
                                                <form action="{{ route('frontend.subscribers.destroy', $subscriber->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('subscriber_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.subscribers.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Subscriber:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection