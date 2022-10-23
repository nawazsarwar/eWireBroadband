<?php

namespace App\Http\Controllers\Frontend;

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

class SupportCommentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportComments = SupportComment::with(['ticket', 'user'])->get();

        return view('frontend.supportComments.index', compact('supportComments'));
    }

    public function create()
    {
        abort_if(Gate::denies('support_comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = SupportTicket::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.supportComments.create', compact('tickets', 'users'));
    }

    public function store(StoreSupportCommentRequest $request)
    {
        $supportComment = SupportComment::create($request->all());

        return redirect()->route('frontend.support-comments.index');
    }

    public function edit(SupportComment $supportComment)
    {
        abort_if(Gate::denies('support_comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = SupportTicket::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $supportComment->load('ticket', 'user');

        return view('frontend.supportComments.edit', compact('supportComment', 'tickets', 'users'));
    }

    public function update(UpdateSupportCommentRequest $request, SupportComment $supportComment)
    {
        $supportComment->update($request->all());

        return redirect()->route('frontend.support-comments.index');
    }

    public function show(SupportComment $supportComment)
    {
        abort_if(Gate::denies('support_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportComment->load('ticket', 'user');

        return view('frontend.supportComments.show', compact('supportComment'));
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
