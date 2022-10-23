<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReceivableRequest;
use App\Http\Requests\StoreReceivableRequest;
use App\Http\Requests\UpdateReceivableRequest;
use App\Models\Receivable;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReceivablesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('receivable_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Receivable::with(['settled_by'])->select(sprintf('%s.*', (new Receivable())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'receivable_show';
                $editGate = 'receivable_edit';
                $deleteGate = 'receivable_delete';
                $crudRoutePart = 'receivables';

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
            $table->editColumn('financeref', function ($row) {
                return $row->financeref ? $row->financeref : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : '';
            });
            $table->editColumn('subscriberid', function ($row) {
                return $row->subscriberid ? $row->subscriberid : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('settled', function ($row) {
                return $row->settled ? $row->settled : '';
            });
            $table->addColumn('settled_by_name', function ($row) {
                return $row->settled_by ? $row->settled_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'settled_by']);

            return $table->make(true);
        }

        return view('admin.receivables.index');
    }

    public function create()
    {
        abort_if(Gate::denies('receivable_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settled_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.receivables.create', compact('settled_bies'));
    }

    public function store(StoreReceivableRequest $request)
    {
        $receivable = Receivable::create($request->all());

        return redirect()->route('admin.receivables.index');
    }

    public function edit(Receivable $receivable)
    {
        abort_if(Gate::denies('receivable_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settled_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $receivable->load('settled_by');

        return view('admin.receivables.edit', compact('receivable', 'settled_bies'));
    }

    public function update(UpdateReceivableRequest $request, Receivable $receivable)
    {
        $receivable->update($request->all());

        return redirect()->route('admin.receivables.index');
    }

    public function show(Receivable $receivable)
    {
        abort_if(Gate::denies('receivable_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receivable->load('settled_by');

        return view('admin.receivables.show', compact('receivable'));
    }

    public function destroy(Receivable $receivable)
    {
        abort_if(Gate::denies('receivable_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receivable->delete();

        return back();
    }

    public function massDestroy(MassDestroyReceivableRequest $request)
    {
        Receivable::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
