<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupportCommentRequest;
use App\Http\Requests\StoreSupportCommentRequest;
use App\Http\Requests\UpdateSupportCommentRequest;
use App\Models\SupportComment;
use App\Models\SupportTicket;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SupportCommentsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('support_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SupportComment::with(['ticket', 'user'])->select(sprintf('%s.*', (new SupportComment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'support_comment_show';
                $editGate = 'support_comment_edit';
                $deleteGate = 'support_comment_delete';
                $crudRoutePart = 'support-comments';

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
            $table->editColumn('text', function ($row) {
                return $row->text ? $row->text : '';
            });
            $table->addColumn('ticket_title', function ($row) {
                return $row->ticket ? $row->ticket->title : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'ticket', 'user']);

            return $table->make(true);
        }

        return view('admin.supportComments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('support_comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = SupportTicket::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.supportComments.create', compact('tickets', 'users'));
    }

    public function store(StoreSupportCommentRequest $request)
    {
        $supportComment = SupportComment::create($request->all());

        // return redirect()->route('admin.support-comments.index');
        return redirect()->back();
    }

    public function edit(SupportComment $supportComment)
    {
        abort_if(Gate::denies('support_comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = SupportTicket::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $supportComment->load('ticket', 'user');

        return view('admin.supportComments.edit', compact('supportComment', 'tickets', 'users'));
    }

    public function update(UpdateSupportCommentRequest $request, SupportComment $supportComment)
    {
        $supportComment->update($request->all());

        return redirect()->route('admin.support-comments.index');
    }

    public function show(SupportComment $supportComment)
    {
        abort_if(Gate::denies('support_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportComment->load('ticket', 'user');

        return view('admin.supportComments.show', compact('supportComment'));
    }

    public function destroy(SupportComment $supportComment)
    {
        abort_if(Gate::denies('support_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportComment->delete();

        return back();
    }

    public function massDestroy(MassDestroySupportCommentRequest $request)
    {
        SupportComment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
