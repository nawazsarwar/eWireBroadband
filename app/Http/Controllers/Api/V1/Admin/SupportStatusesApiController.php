<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportStatusRequest;
use App\Http\Requests\UpdateSupportStatusRequest;
use App\Http\Resources\Admin\SupportStatusResource;
use App\Models\SupportStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportStatusesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportStatusResource(SupportStatus::all());
    }

    public function store(StoreSupportStatusRequest $request)
    {
        $supportStatus = SupportStatus::create($request->all());

        return (new SupportStatusResource($supportStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SupportStatus $supportStatus)
    {
        abort_if(Gate::denies('support_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportStatusResource($supportStatus);
    }

    public function update(UpdateSupportStatusRequest $request, SupportStatus $supportStatus)
    {
        $supportStatus->update($request->all());

        return (new SupportStatusResource($supportStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SupportStatus $supportStatus)
    {
        abort_if(Gate::denies('support_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
