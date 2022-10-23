<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportCategoryRequest;
use App\Http\Requests\UpdateSupportCategoryRequest;
use App\Http\Resources\Admin\SupportCategoryResource;
use App\Models\SupportCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportCategoriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportCategoryResource(SupportCategory::all());
    }

    public function store(StoreSupportCategoryRequest $request)
    {
        $supportCategory = SupportCategory::create($request->all());

        return (new SupportCategoryResource($supportCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SupportCategory $supportCategory)
    {
        abort_if(Gate::denies('support_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportCategoryResource($supportCategory);
    }

    public function update(UpdateSupportCategoryRequest $request, SupportCategory $supportCategory)
    {
        $supportCategory->update($request->all());

        return (new SupportCategoryResource($supportCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SupportCategory $supportCategory)
    {
        abort_if(Gate::denies('support_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
