@extends('layouts.admin')
@section('content')
@can('subscriber_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.subscribers.create') }}">
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
        <table class=" table table-sm table-bordered table-striped table-hover ajaxTable datatable datatable-Subscriber">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('subscriber_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.subscribers.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.subscribers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'username', name: 'username' },
{ data: 'firstname', name: 'firstname' },
{ data: 'lastname', name: 'lastname' },
{ data: 'mobileno', name: 'mobileno' },
{ data: 'email', name: 'email' },
{ data: 'status', name: 'status' },
{ data: 'expiry', name: 'expiry' },
{ data: 'balance', name: 'balance' },
{ data: 'photo', name: 'photo', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Subscriber').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection