<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupportTicketRequest;
use App\Http\Requests\StoreSupportTicketRequest;
use App\Http\Requests\UpdateSupportTicketRequest;
use App\Models\SupportCategory;
use App\Models\SupportPriority;
use App\Models\SupportStatus;
use App\Models\SupportTicket;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportTicketsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportTickets = SupportTicket::with(['status', 'priority', 'category', 'user'])->get();

        return view('frontend.supportTickets.index', compact('supportTickets'));
    }

    public function create()
    {
        abort_if(Gate::denies('support_ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = SupportStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = SupportPriority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = SupportCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.supportTickets.create', compact('categories', 'priorities', 'statuses', 'users'));
    }

    public function store(StoreSupportTicketRequest $request)
    {
        $supportTicket = SupportTicket::create($request->all());

        return redirect()->route('frontend.support-tickets.index');
    }

    public function edit(SupportTicket $supportTicket)
    {
        abort_if(Gate::denies('support_ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = SupportStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = SupportPriority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = SupportCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $supportTicket->load('status', 'priority', 'category', 'user');

        return view('frontend.supportTickets.edit', compact('categories', 'priorities', 'statuses', 'supportTicket', 'users'));
    }

    public function update(UpdateSupportTicketRequest $request, SupportTicket $supportTicket)
    {
        $supportTicket->update($request->all());

        return redirect()->route('frontend.support-tickets.index');
    }

    public function show(SupportTicket $supportTicket)
    {
        abort_if(Gate::denies('support_ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportTicket->load('status', 'priority', 'category', 'user');

        return view('frontend.supportTickets.show', compact('supportTicket'));
    }

    public function destroy(SupportTicket $supportTicket)
    {
        abort_if(Gate::denies('support_ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportTicket->delete();

        return back();
    }

    public function massDestroy(MassDestroySupportTicketRequest $request)
    {
        SupportTicket::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
