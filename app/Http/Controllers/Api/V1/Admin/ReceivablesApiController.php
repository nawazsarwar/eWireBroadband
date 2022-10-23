<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReceivableRequest;
use App\Http\Requests\UpdateReceivableRequest;
use App\Http\Resources\Admin\ReceivableResource;
use App\Models\Receivable;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReceivablesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('receivable_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReceivableResource(Receivable::with(['settled_by'])->get());
    }

    public function store(StoreReceivableRequest $request)
    {
        $receivable = Receivable::create($request->all());

        return (new ReceivableResource($receivable))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Receivable $receivable)
    {
        abort_if(Gate::denies('receivable_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReceivableResource($receivable->load(['settled_by']));
    }

    public function update(UpdateReceivableRequest $request, Receivable $receivable)
    {
        $receivable->update($request->all());

        return (new ReceivableResource($receivable))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Receivable $receivable)
    {
        abort_if(Gate::denies('receivable_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receivable->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
