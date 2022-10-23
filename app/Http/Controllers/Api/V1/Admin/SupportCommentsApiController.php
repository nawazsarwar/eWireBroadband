<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportCommentRequest;
use App\Http\Requests\UpdateSupportCommentRequest;
use App\Http\Resources\Admin\SupportCommentResource;
use App\Models\SupportComment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportCommentsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportCommentResource(SupportComment::with(['ticket', 'user'])->get());
    }

    public function store(StoreSupportCommentRequest $request)
    {
        $supportComment = SupportComment::create($request->all());

        return (new SupportCommentResource($supportComment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SupportComment $supportComment)
    {
        abort_if(Gate::denies('support_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportCommentResource($supportComment->load(['ticket', 'user']));
    }

    public function update(UpdateSupportCommentRequest $request, SupportComment $supportComment)
    {
        $supportComment->update($request->all());

        return (new SupportCommentResource($supportComment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SupportComment $supportComment)
    {
        abort_if(Gate::denies('support_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportComment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
