<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stocks' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            if($this->stocks == 0 && $this->status == 'available') {
                $validator->errors()->add('stocks', 'If available stocks needs to be at least 1.');
            }
        });
    }
}
