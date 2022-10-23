<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupportStatusRequest;
use App\Http\Requests\StoreSupportStatusRequest;
use App\Http\Requests\UpdateSupportStatusRequest;
use App\Models\SupportStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportStatusesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportStatuses = SupportStatus::all();

        return view('frontend.supportStatuses.index', compact('supportStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('support_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.supportStatuses.create');
    }

    public function store(StoreSupportStatusRequest $request)
    {
        $supportStatus = SupportStatus::create($request->all());

        return redirect()->route('frontend.support-statuses.index');
    }

    public function edit(SupportStatus $supportStatus)
    {
        abort_if(Gate::denies('support_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.supportStatuses.edit', compact('supportStatus'));
    }

    public function update(UpdateSupportStatusRequest $request, SupportStatus $supportStatus)
    {
        $supportStatus->update($request->all());

        return redirect()->route('frontend.support-statuses.index');
    }

    public function show(SupportStatus $supportStatus)
    {
        abort_if(Gate::denies('support_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.supportStatuses.show', compact('supportStatus'));
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
