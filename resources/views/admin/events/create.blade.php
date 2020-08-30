@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.events.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.event.fields.name') }}</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($event) ? $event->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                <label for="start_time">{{ trans('cruds.event.fields.start_time') }}</label>
                <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($event) ? $event->start_time : '') }}">
                @if($errors->has('start_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.start_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                <label for="end_time">{{ trans('cruds.event.fields.end_time') }}</label>
                <input type="text" id="end_time" name="end_time" class="form-control datetime" value="{{ old('end_time', isset($event) ? $event->end_time : '') }}">
                @if($errors->has('end_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.end_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('smijer_id') ? 'has-error' : '' }}">
                <label for="smijer">{{ trans('cruds.event.fields.smijer') }}</label>
                <select name="smijer_id" id="smijer" class="form-control select2">
                    @foreach($smijerovi as $id => $smijer)
                        <option value="{{ $id }}" {{ (isset($event) && $event->smijer ? $event->smijer->id : old('smijer_id')) == $id ? 'selected' : '' }}>{{ $smijer }}</option>
                    @endforeach
                </select>
                @if($errors->has('smijer_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('smijer_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('godina') ? 'has-error' : '' }}">
                <label for="godina">{{ trans('cruds.event.fields.godina') }}</label>
                <select name="godina" id="godina" class="form-control select2">              
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                </select>
                @if($errors->has('godina'))
                    <em class="invalid-feedback">
                        {{ $errors->first('godina') }}
                    </em>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection