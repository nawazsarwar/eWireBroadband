<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupportCategoryRequest;
use App\Http\Requests\StoreSupportCategoryRequest;
use App\Http\Requests\UpdateSupportCategoryRequest;
use App\Models\SupportCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SupportCategoriesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('support_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SupportCategory::query()->select(sprintf('%s.*', (new SupportCategory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'support_category_show';
                $editGate = 'support_category_edit';
                $deleteGate = 'support_category_delete';
                $crudRoutePart = 'support-categories';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.supportCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('support_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supportCategories.create');
    }

    public function store(StoreSupportCategoryRequest $request)
    {
        $supportCategory = SupportCategory::create($request->all());

        return redirect()->route('admin.support-categories.index');
    }

    public function edit(SupportCategory $supportCategory)
    {
        abort_if(Gate::denies('support_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supportCategories.edit', compact('supportCategory'));
    }

    public function update(UpdateSupportCategoryRequest $request, SupportCategory $supportCategory)
    {
        $supportCategory->update($request->all());

        return redirect()->route('admin.support-categories.index');
    }

    public function show(SupportCategory $supportCategory)
    {
        abort_if(Gate::denies('support_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supportCategories.show', compact('supportCategory'));
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
