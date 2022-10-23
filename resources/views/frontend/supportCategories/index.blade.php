@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('support_category_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.support-categories.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.supportCategory.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.supportCategory.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SupportCategory">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supportCategory.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supportCategory.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supportCategory.fields.color') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supportCategory.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supportCategory.fields.remarks') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supportCategories as $key => $supportCategory)
                                    <tr data-entry-id="{{ $supportCategory->id }}">
                                        <td>
                                            {{ $supportCategory->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportCategory->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportCategory->color ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportCategory->status ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supportCategory->remarks ?? '' }}
                                        </td>
                                        <td>
                                            @can('support_category_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.support-categories.show', $supportCategory->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('support_category_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.support-categories.edit', $supportCategory->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('support_category_delete')
                                                <form action="{{ route('frontend.support-categories.destroy', $supportCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('support_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.support-categories.massDestroy') }}",
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
  let table = $('.datatable-SupportCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection