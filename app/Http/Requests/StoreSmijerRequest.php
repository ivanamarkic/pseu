<?php

namespace App\Http\Requests;

use App\Smijer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSmijerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('smijer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
