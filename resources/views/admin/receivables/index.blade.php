@extends('layouts.admin')
@section('content')
@can('receivable_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.receivables.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.receivable.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Receivable', 'route' => 'admin.receivables.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.receivable.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Receivable">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.financeref') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.lastupdate') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.username') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.subscriberid') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.settled') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.settled_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.receivable.fields.settled_at') }}
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
@can('receivable_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.receivables.massDestroy') }}",
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
    ajax: "{{ route('admin.receivables.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'financeref', name: 'financeref' },
{ data: 'lastupdate', name: 'lastupdate' },
{ data: 'description', name: 'description' },
{ data: 'username', name: 'username' },
{ data: 'subscriberid', name: 'subscriberid' },
{ data: 'amount', name: 'amount' },
{ data: 'settled', name: 'settled' },
{ data: 'settled_by_name', name: 'settled_by.name' },
{ data: 'settled_at', name: 'settled_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Receivable').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection