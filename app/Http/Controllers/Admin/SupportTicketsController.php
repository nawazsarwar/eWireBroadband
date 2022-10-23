<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class SupportTicketsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('support_ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SupportTicket::with(['status', 'priority', 'category', 'user'])->select(sprintf('%s.*', (new SupportTicket())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'support_ticket_show';
                $editGate = 'support_ticket_edit';
                $deleteGate = 'support_ticket_delete';
                $crudRoutePart = 'support-tickets';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('content', function ($row) {
                return $row->content ? $row->content : '';
            });
            $table->editColumn('auther_name', function ($row) {
                return $row->auther_name ? $row->auther_name : '';
            });
            $table->editColumn('author_email', function ($row) {
                return $row->author_email ? $row->author_email : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->addColumn('priority_name', function ($row) {
                return $row->priority ? $row->priority->name : '';
            });

            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'status', 'priority', 'category', 'user']);

            return $table->make(true);
        }

        return view('admin.supportTickets.index');
    }

    public function create()
    {
        abort_if(Gate::denies('support_ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = SupportStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = SupportPriority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = SupportCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.supportTickets.create', compact('categories', 'priorities', 'statuses', 'users'));
    }

    public function store(StoreSupportTicketRequest $request)
    {
        $supportTicket = SupportTicket::create($request->all());

        return redirect()->route('admin.support-tickets.index');
    }

    public function edit(SupportTicket $supportTicket)
    {
        abort_if(Gate::denies('support_ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = SupportStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = SupportPriority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = SupportCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $supportTicket->load('status', 'priority', 'category', 'user');

        return view('admin.supportTickets.edit', compact('categories', 'priorities', 'statuses', 'supportTicket', 'users'));
    }

    public function update(UpdateSupportTicketRequest $request, SupportTicket $supportTicket)
    {
        $supportTicket->update($request->all());

        return redirect()->route('admin.support-tickets.index');
    }

    public function show(SupportTicket $supportTicket)
    {
        abort_if(Gate::denies('support_ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportTicket->load('status', 'priority', 'category', 'user');

        return view('admin.supportTickets.show', compact('supportTicket'));
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
