<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySmijerRequest;
use App\Http\Requests\StoreSmijerRequest;
use App\Http\Requests\UpdateSmijerRequest;
use App\Smijer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SmijeroviController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('smijer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $smijerovi = Smijer::all();

        return view('admin.smijerovi.index', compact('smijerovi'));
    }

    public function create()
    {
        abort_if(Gate::denies('smijer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.smijerovi.create');
    }

    public function store(StoreSmijerRequest $request)
    {
        $smijer = Smijer::create($request->all());

        return redirect()->route('admin.smijerovi.index');
    }

    public function edit(Smijer $smijer)
    {
        abort_if(Gate::denies('smijer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.smijerovi.edit', compact('smijer'));
    }

    public function update(UpdateSmijerRequest $request, smijer $smijer)
    {
        $smijer->update($request->all());

        return redirect()->route('admin.smijerovi.index');
    }

    public function show(smijer $smijer)
    {
        abort_if(Gate::denies('smijer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.smijerovi.show', compact('smijer'));
    }

    public function destroy(smijer $smijer)
    {
        abort_if(Gate::denies('smijer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $smijer->delete();

        return back();
    }

    public function massDestroy(MassDestroySmijerRequest $request)
    {
        Smijer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
