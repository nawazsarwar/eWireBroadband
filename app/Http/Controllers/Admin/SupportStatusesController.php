<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupportStatusRequest;
use App\Http\Requests\StoreSupportStatusRequest;
use App\Http\Requests\UpdateSupportStatusRequest;
use App\Models\SupportStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SupportStatusesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('support_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SupportStatus::query()->select(sprintf('%s.*', (new SupportStatus())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'support_status_show';
                $editGate = 'support_status_edit';
                $deleteGate = 'support_status_delete';
                $crudRoutePart = 'support-statuses';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.supportStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('support_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supportStatuses.create');
    }

    public function store(StoreSupportStatusRequest $request)
    {
        $supportStatus = SupportStatus::create($request->all());

        return redirect()->route('admin.support-statuses.index');
    }

    public function edit(SupportStatus $supportStatus)
    {
        abort_if(Gate::denies('support_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supportStatuses.edit', compact('supportStatus'));
    }

    public function update(UpdateSupportStatusRequest $request, SupportStatus $supportStatus)
    {
        $supportStatus->update($request->all());

        return redirect()->route('admin.support-statuses.index');
    }

    public function show(SupportStatus $supportStatus)
    {
        abort_if(Gate::denies('support_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supportStatuses.show', compact('supportStatus'));
    }

    public function destroy(SupportStatus $supportStatus)
    {
        abort_if(Gate::denies('support_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroySupportStatusRequest $request)
    {
        SupportStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
