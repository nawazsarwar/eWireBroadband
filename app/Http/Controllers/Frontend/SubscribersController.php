<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubscriberRequest;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Models\Subscriber;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SubscribersController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('subscriber_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscribers = Subscriber::with(['media'])->get();

        return view('frontend.subscribers.index', compact('subscribers'));
    }

    public function create()
    {
        abort_if(Gate::denies('subscriber_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.subscribers.create');
    }

    public function store(StoreSubscriberRequest $request)
    {
        $subscriber = Subscriber::create($request->all());

        if ($request->input('photo', false)) {
            $subscriber->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $subscriber->id]);
        }

        return redirect()->route('frontend.subscribers.index');
    }

    public function edit(Subscriber $subscriber)
    {
        abort_if(Gate::denies('subscriber_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.subscribers.edit', compact('subscriber'));
    }

    public function update(UpdateSubscriberRequest $request, Subscriber $subscriber)
    {
        $subscriber->update($request->all());

        if ($request->input('photo', false)) {
            if (!$subscriber->photo || $request->input('photo') !== $subscriber->photo->file_name) {
                if ($subscriber->photo) {
                    $subscriber->photo->delete();
                }
                $subscriber->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($subscriber->photo) {
            $subscriber->photo->delete();
        }

        return redirect()->route('frontend.subscribers.index');
    }

    public function show(Subscriber $subscriber)
    {
        abort_if(Gate::denies('subscriber_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.subscribers.show', compact('subscriber'));
    }

    public function destroy(Subscriber $subscriber)
    {
        abort_if(Gate::denies('subscriber_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscriber->delete();

        return back();
    }

    public function massDestroy(MassDestroySubscriberRequest $request)
    {
        Subscriber::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('subscriber_create') && Gate::denies('subscriber_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Subscriber();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
