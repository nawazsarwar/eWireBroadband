@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('support_ticket_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.support-tickets.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SupportTicket">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($supportTickets as $key => $supportTicket)
                                    <tr data-entry-id="{{ $supportTicket->id }}">
                                        <td>
                                            {{ $supportTicket->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportTicket->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportTicket->content ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportTicket->auther_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportTicket->author_email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportTicket->status->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportTicket->priority->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportTicket->category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportTicket->user->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($supportTicket->assigned_tos as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('support_ticket_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.support-tickets.show', $supportTicket->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('support_ticket_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.support-tickets.edit', $supportTicket->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('support_ticket_delete')
                                                <form action="{{ route('frontend.support-tickets.destroy', $supportTicket->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('support_ticket_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.support-tickets.massDestroy') }}",
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
  let table = $('.datatable-SupportTicket:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection