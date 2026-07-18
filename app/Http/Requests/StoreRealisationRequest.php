<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRealisationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'media_url'   => 'required|string',
            'media_type'  => 'required|in:image,youtube,vimeo',

            'skills'      => 'required|array|min:1',
            'skills.*'    => 'exists:skills,id',
        ];
    }
}
