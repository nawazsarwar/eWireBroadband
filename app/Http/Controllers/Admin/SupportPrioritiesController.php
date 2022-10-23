<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupportPriorityRequest;
use App\Http\Requests\StoreSupportPriorityRequest;
use App\Http\Requests\UpdateSupportPriorityRequest;
use App\Models\SupportPriority;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SupportPrioritiesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('support_priority_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SupportPriority::query()->select(sprintf('%s.*', (new SupportPriority())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'support_priority_show';
                $editGate = 'support_priority_edit';
                $deleteGate = 'support_priority_delete';
                $crudRoutePart = 'support-priorities';

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

        return view('admin.supportPriorities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('support_priority_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supportPriorities.create');
    }

    public function store(StoreSupportPriorityRequest $request)
    {
        $supportPriority = SupportPriority::create($request->all());

        return redirect()->route('admin.support-priorities.index');
    }

    public function edit(SupportPriority $supportPriority)
    {
        abort_if(Gate::denies('support_priority_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supportPriorities.edit', compact('supportPriority'));
    }

    public function update(UpdateSupportPriorityRequest $request, SupportPriority $supportPriority)
    {
        $supportPriority->update($request->all());

        return redirect()->route('admin.support-priorities.index');
    }

    public function show(SupportPriority $supportPriority)
    {
        abort_if(Gate::denies('support_priority_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supportPriorities.show', compact('supportPriority'));
    }

    public function destroy(SupportPriority $supportPriority)
    {
        abort_if(Gate::denies('support_priority_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportPriority->delete();

        return back();
    }

    public function massDestroy(MassDestroySupportPriorityRequest $request)
    {
        SupportPriority::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
