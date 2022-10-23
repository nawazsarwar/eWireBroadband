<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportPriorityRequest;
use App\Http\Requests\UpdateSupportPriorityRequest;
use App\Http\Resources\Admin\SupportPriorityResource;
use App\Models\SupportPriority;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportPrioritiesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_priority_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportPriorityResource(SupportPriority::all());
    }

    public function store(StoreSupportPriorityRequest $request)
    {
        $supportPriority = SupportPriority::create($request->all());

        return (new SupportPriorityResource($supportPriority))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SupportPriority $supportPriority)
    {
        abort_if(Gate::denies('support_priority_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportPriorityResource($supportPriority);
    }

    public function update(UpdateSupportPriorityRequest $request, SupportPriority $supportPriority)
    {
        $supportPriority->update($request->all());

        return (new SupportPriorityResource($supportPriority))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SupportPriority $supportPriority)
    {
        abort_if(Gate::denies('support_priority_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportPriority->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
