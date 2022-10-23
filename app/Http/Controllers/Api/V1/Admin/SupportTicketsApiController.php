<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportTicketRequest;
use App\Http\Requests\UpdateSupportTicketRequest;
use App\Http\Resources\Admin\SupportTicketResource;
use App\Models\SupportTicket;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportTicketsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportTicketResource(SupportTicket::with(['status', 'priority', 'category', 'user'])->get());
    }

    public function store(StoreSupportTicketRequest $request)
    {
        $supportTicket = SupportTicket::create($request->all());

        return (new SupportTicketResource($supportTicket))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SupportTicket $supportTicket)
    {
        abort_if(Gate::denies('support_ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportTicketResource($supportTicket->load(['status', 'priority', 'category', 'user']));
    }

    public function update(UpdateSupportTicketRequest $request, SupportTicket $supportTicket)
    {
        $supportTicket->update($request->all());

        return (new SupportTicketResource($supportTicket))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SupportTicket $supportTicket)
    {
        abort_if(Gate::denies('support_ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportTicket->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
