@extends('layouts.admin')
@section('content')
@can('order_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.orders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.order.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Order">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.order.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.parameters') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.currency') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.transacted_on') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.narration') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.response') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.receivable') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.merchant_order') }}
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
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
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
    ajax: "{{ route('admin.orders.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'parameters', name: 'parameters' },
{ data: 'amount', name: 'amount' },
{ data: 'currency', name: 'currency' },
{ data: 'status', name: 'status' },
{ data: 'transacted_on', name: 'transacted_on' },
{ data: 'narration', name: 'narration' },
{ data: 'response', name: 'response' },
{ data: 'receivable_username', name: 'receivable.username' },
{ data: 'merchant_order', name: 'merchant_order' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Order').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection