@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('support_comment_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.support-comments.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.supportComment.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.supportComment.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SupportComment">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportComment.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supportComment.fields.text') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supportComment.fields.ticket') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supportComment.fields.user') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supportComments as $key => $supportComment)
                                    <tr data-entry-id="{{ $supportComment->id }}">
                                        <td>
                                            {{ $supportComment->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportComment->text ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportComment->ticket->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportComment->user->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('support_comment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.support-comments.show', $supportComment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('support_comment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.support-comments.edit', $supportComment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('support_comment_delete')
                                                <form action="{{ route('frontend.support-comments.destroy', $supportComment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('support_comment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.support-comments.massDestroy') }}",
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
  let table = $('.datatable-SupportComment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection