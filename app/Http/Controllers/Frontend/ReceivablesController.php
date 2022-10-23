<?php

namespace App\Http\Controllers\Frontend;

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

class ReceivablesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('receivable_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receivables = Receivable::with(['settled_by'])->get();

        return view('frontend.receivables.index', compact('receivables'));
    }

    public function create()
    {
        abort_if(Gate::denies('receivable_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settled_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.receivables.create', compact('settled_bies'));
    }

    public function store(StoreReceivableRequest $request)
    {
        $receivable = Receivable::create($request->all());

        return redirect()->route('frontend.receivables.index');
    }

    public function edit(Receivable $receivable)
    {
        abort_if(Gate::denies('receivable_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settled_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $receivable->load('settled_by');

        return view('frontend.receivables.edit', compact('receivable', 'settled_bies'));
    }

    public function update(UpdateReceivableRequest $request, Receivable $receivable)
    {
        $receivable->update($request->all());

        return redirect()->route('frontend.receivables.index');
    }

    public function show(Receivable $receivable)
    {
        abort_if(Gate::denies('receivable_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receivable->load('settled_by');

        return view('frontend.receivables.show', compact('receivable'));
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
