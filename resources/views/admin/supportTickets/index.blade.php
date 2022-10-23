@extends('layouts.admin')
@section('content')
@can('support_ticket_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.support-tickets.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.supportTicket.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.supportTicket.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SupportTicket">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.content') }}
                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.auther_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.author_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.priority') }}
                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.supportTicket.fields.assigned_to') }}
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
@can('support_ticket_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.support-tickets.massDestroy') }}",
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
    ajax: "{{ route('admin.support-tickets.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'content', name: 'content' },
{ data: 'auther_name', name: 'auther_name' },
{ data: 'author_email', name: 'author_email' },
{ data: 'status_name', name: 'status.name' },
{ data: 'priority_name', name: 'priority.name' },
{ data: 'category_name', name: 'category.name' },
{ data: 'user_name', name: 'user.name' },
{ data: 'assigned_to', name: 'assigned_tos.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SupportTicket').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection