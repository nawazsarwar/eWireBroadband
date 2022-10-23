<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupportPriorityRequest;
use App\Http\Requests\StoreSupportPriorityRequest;
use App\Http\Requests\UpdateSupportPriorityRequest;
use App\Models\SupportPriority;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportPrioritiesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_priority_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportPriorities = SupportPriority::all();

        return view('frontend.supportPriorities.index', compact('supportPriorities'));
    }

    public function create()
    {
        abort_if(Gate::denies('support_priority_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.supportPriorities.create');
    }

    public function store(StoreSupportPriorityRequest $request)
    {
        $supportPriority = SupportPriority::create($request->all());

        return redirect()->route('frontend.support-priorities.index');
    }

    public function edit(SupportPriority $supportPriority)
    {
        abort_if(Gate::denies('support_priority_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.supportPriorities.edit', compact('supportPriority'));
    }

    public function update(UpdateSupportPriorityRequest $request, SupportPriority $supportPriority)
    {
        $supportPriority->update($request->all());

        return redirect()->route('frontend.support-priorities.index');
    }

    public function show(SupportPriority $supportPriority)
    {
        abort_if(Gate::denies('support_priority_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.supportPriorities.show', compact('supportPriority'));
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
