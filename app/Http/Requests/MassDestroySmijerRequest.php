<?php

namespace App\Http\Requests;

use App\Smijer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySmijerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('smijer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:smijerovi,id',
        ];
    }
}
