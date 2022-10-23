<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupportCategoryRequest;
use App\Http\Requests\StoreSupportCategoryRequest;
use App\Http\Requests\UpdateSupportCategoryRequest;
use App\Models\SupportCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportCategoriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('support_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportCategories = SupportCategory::all();

        return view('frontend.supportCategories.index', compact('supportCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('support_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.supportCategories.create');
    }

    public function store(StoreSupportCategoryRequest $request)
    {
        $supportCategory = SupportCategory::create($request->all());

        return redirect()->route('frontend.support-categories.index');
    }

    public function edit(SupportCategory $supportCategory)
    {
        abort_if(Gate::denies('support_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.supportCategories.edit', compact('supportCategory'));
    }

    public function update(UpdateSupportCategoryRequest $request, SupportCategory $supportCategory)
    {
        $supportCategory->update($request->all());

        return redirect()->route('frontend.support-categories.index');
    }

    public function show(SupportCategory $supportCategory)
    {
        abort_if(Gate::denies('support_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.supportCategories.show', compact('supportCategory'));
    }

    public function destroy(SupportCategory $supportCategory)
    {
        abort_if(Gate::denies('support_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supportCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroySupportCategoryRequest $request)
    {
        SupportCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
